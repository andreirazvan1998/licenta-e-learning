<?php
final class Db
{
  /*
   * SINGLETON class
   */
  private static $dbase=null;
  private $connection=null;
  private function __construct($db_name,$db_user,$db_password)
  {
    $this->connection=new PDO("mysql:host=localhost;dbname=$db_name","$db_user",$db_password);
    $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  }
  public static function getInstance($db_name,$db_user,$db_password)
  {
    if(!empty(Db::$dbase))
    {
      return Db::$dbase;
    }else
    {
      Db::$dbase=new Db($db_name,$db_user,$db_password);
      return Db::$dbase;
    }
  }
  function getConnection()
  {
    return $this->connection;
  }
  function __destruct()
  {
    $this->connection=null;
  }
  function getLastId()
  {
    return $this->connection->lastInsertId();
  }
  /*
   * For complex query, we can run directly
   * This time the $param_array has to have :column as key eg: array(":user_name"=>$u_name)
   */
  public function runDirectQuery($query,$param_array=null)
  {
    try
    {
      $true_query=$this->connection->prepare($query);
      if(!empty($param_array))
      {
        foreach($param_array as $key=>$param)
        {
          if(is_array($param))
          {
            if(!empty($param[1]))
            {
              switch($param[1])
              {
                case "int":
                  $true_query->bindValue($key,$param[0],PDO::PARAM_INT);
                break;
                case "string":
                default:
                  $true_query->bindValue($key,$param[0]);
                break;
              }
            }else
            {
              $true_query->bindValue($key,$param[0]);
            }
          }else
          {
            $true_query->bindValue($key,$param);
          }
        }
      }
      $true_query->execute();
      $rows=$true_query->fetchAll(PDO::FETCH_ASSOC);
      $true_query->closeCursor();
      unset($true_query);
      return $rows;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
      die("<br>".$true_query->queryString);
    }
  }
  public function runDirectQuerySingle($query,$param_array=null)
  {
    try
    {
      $true_query=$this->connection->prepare($query);
      if(!empty($param_array))
      {
        foreach($param_array as $key=>$param)
        {
          if(is_array($param))
          {
            if(!empty($param[1]))
            {
              switch($param[1])
              {
                case "int":
                  $true_query->bindValue($key,$param[0],PDO::PARAM_INT);
                break;
                case "string":
                default:
                  $true_query->bindValue($key,$param[0]);
                break;
              }
            }else
            {
              $true_query->bindValue($key,$param[0]);
            }
          }else
          {
            $true_query->bindValue($key,$param);
          }
        }
      }
      $true_query->execute();
      $row=$true_query->fetch(PDO::FETCH_ASSOC);
      $true_query->closeCursor();
      unset($true_query);
      return $row;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
      die("<br>".$true_query->queryString);
    }
  }
  public function runDirectUpdate($query,$param_array)
  {
    try
    {
      $true_query=$this->connection->prepare($query);
      $rez=$true_query->execute($param_array);
      $true_query->closeCursor();
      unset($true_query);
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
      die("<br>".$true_query->queryString);
    }
    return $rez;
  }
  public function getDbConnection()
  {
    return $this->connection;
  }
  /*
   * USAGE
   * select
   * a.*,b.*
   * from table1 as a
   * join table2 as b on a.fk_id=b.pk_id
   * where
   * a.someColumn=someValue
   * and b.someColumn2=someValue2
   * order by a.column3
   */
  /*
   * Equivalent function call:
   * $where=array(
   * 0=>array('column'=>'a.someColumn','value'=>'someValue','relation'=>'','equal'=>'='),
   * 1=>array('column'=>'b.someColumn2','value'=>'someValue2','relation'=>'AND','equal'=>'=')
   * )
   * $rows=select('table1 as a','a.*',$where,'a.column3','table2 as b','b.*','a.fk_id=b.pk_id','JOIN');
   */
  public function select($table,$fieldlist='*',$where=null,$order=null,$jointable=null,$joinfield=null,$joincondition='a.id=b.id',$jointype='JOIN',$limit=null,$offset=null,$simulate=null)
  {
    $where_string="";
    if(!empty($where))
    {
      foreach($where as $key=>$element)
      {
        $param_name=":param".$key;
        switch(strtolower($element['equal']))
        {
          case '=':
            $where_string.=$element["relation"]." ".$element["column"]."=".$param_name." ";
          break;
          case 'like':
            $where_string.=$element["relation"]." ".$element["column"]." like ".$param_name." ";
          break;
          case 'like%':
            if(!empty($where[$key]["value"]))
            {
              $where_string.=$element["relation"]." ".$element["column"]." like ".$param_name." ";
              $where[$key]["value"]="%".$element["value"]."%";
            }else
            {
              $where_string.=$element["relation"]." ".$element["column"]." like '' ";
            }
          break;
          case 'in':
            $where_string.=$element["relation"]." ".$element["column"]." in (".$param_name.") ";
          break;
          case '>':
            $where_string.=$element["relation"]." ".$element["column"].">".$param_name." ";
          break;
          case '>=':
            $where_string.=$element["relation"]." ".$element["column"].">=".$param_name." ";
          break;
          case '<':
            $where_string.=$element["relation"]." ".$element["column"]."<".$param_name." ";
          break;
          case '<=':
            $where_string.=$element["relation"]." ".$element["column"]."<=".$param_name." ";
          break;
        }
      }
    }
    if(empty($jointable))
    {
      if(!empty($where))
      {
        $query=sprintf("select %s from %s where %s ",$fieldlist,$table,$where_string);
      }else
      {
        $query=sprintf("select %s from %s ",$fieldlist,$table);
      }
    }else
    {
      if(!empty($where))
      {
        $query=sprintf("select %s,%s from %s %s %s on %s where %s ",$fieldlist,$joinfield,$table,$jointype,$jointable,$joincondition,$where_string);
      }else
      {
        $query=sprintf("select %s,%s from %s %s %s on %s ",$fieldlist,$joinfield,$table,$jointype,$jointable,$joincondition);
      }
    }
    if($order)
    {
      $query=sprintf('%s order by %s',$query,$order);
    }
    if(!empty($limit))
    {
      $query.=" limit :offset,:limit_val ";
    }
    try
    {
      $true_query=$this->connection->prepare($query);
      $param_values=array();
      $i=0;
      if(!empty($where))
      {
        foreach($where as $key=>$element)
        {
          $param_name=":param".$key;
          $true_query->bindParam($param_name,$element["value"]);
          $param_values[$param_name]=strip_tags(trim($element["value"]));
          $i=$i+1;
        }
      }
      if(!empty($limit))
      {
        $true_query->bindParam(":limit_val",$limit,PDO::PARAM_INT);
        $true_query->bindParam(":offset",$offset,PDO::PARAM_INT);
      }
      $true_query->execute();
      $row1=$true_query->fetchAll(PDO::FETCH_ASSOC);
      $true_query->closeCursor();
      unset($true_query);
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
      die("<br>".$true_query->queryString);
    }
    /*print_r($param_values);
    die($query);*/
    if($simulate==1)
    {
      return $query;
    }else
    {
      return $row1;
    }
  }
  /*
   * ------------------------
   * USAGE: Same as for select
   */
  /**
   * @param $table
   * @param string $fieldlist
   * @param null $where
   * @param null $order
   * @param null $jointable
   * @param null $joinfield
   * @param string $joincondition
   * @param string $jointype
   * @param null $simulate
   * @return array|null
   */
  public function selectSingle(string $table,string $fieldlist='*',?array $where=null,?string $order=null,?string $jointable=null,?string $joinfield=null,?string $joincondition='a.id=b.id',?string $jointype='JOIN',$simulate=null):?array
  {
    $where_string="";
    if(!empty($where))
    {
      foreach($where as $key=>$element)
      {
        $param_name=":param".$key;
        switch(strtolower($element['equal']))
        {
          case '=':
            $where_string.=$element["relation"]." ".$element["column"]."=".$param_name." ";
          break;
          case 'like':
            $where_string.=$element["relation"]." ".$element["column"]." like ".$param_name." ";
          break;
          case 'like%':
            if(!empty($where[$key]["value"]))
            {
              $where_string.=$element["relation"]." ".$element["column"]." like ".$param_name." ";
              $where[$key]["value"]="%".$element["value"]."%";
            }else
            {
              $where_string.=$element["relation"]." ".$element["column"]." like '' ";
            }
          break;
          case 'in':
            $where_string.=$element["relation"]." ".$element["column"]." in (".$param_name.") ";
          break;
          case '>':
            $where_string.=$element["relation"]." ".$element["column"].">".$param_name." ";
          break;
          case '>=':
            $where_string.=$element["relation"]." ".$element["column"].">=".$param_name." ";
          break;
          case '<':
            $where_string.=$element["relation"]." ".$element["column"]."<".$param_name." ";
          break;
          case '<=':
            $where_string.=$element["relation"]." ".$element["column"]."<=".$param_name." ";
          break;
        }
      }
    }
    if(empty($jointable))
    {
      if(!empty($where))
      {
        $query=sprintf("select %s from %s where %s ",$fieldlist,$table,$where_string);
      }else
      {
        $query=sprintf("select %s from %s ",$fieldlist,$table);
      }
    }else
    {
      if(!empty($where))
      {
        $query=sprintf("select %s,%s from %s %s %s on %s where %s ",$fieldlist,$joinfield,$table,$jointype,$jointable,$joincondition,$where_string);
      }else
      {
        $query=sprintf("select %s,%s from %s %s %s on %s ",$fieldlist,$joinfield,$table,$jointype,$jointable,$joincondition);
      }
    }
    if($order)
    {
      $query=sprintf('%s order by %s',$query,$order);
    }
    try
    {
      $true_query=$this->connection->prepare($query);
      $param_values=array();
      $i=0;
      if(!empty($where))
      {
        foreach($where as $key=>$element)
        {
          $param_name=":param".$key;
          $true_query->bindParam($param_name,$element["value"]);
          $param_values[$param_name]=strip_tags(trim($element["value"]));
          $i=$i+1;
        }
      }
      $true_query->execute();
      $row1=$true_query->fetch(PDO::FETCH_ASSOC);
      $true_query->closeCursor();
      unset($true_query);
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
      die("<br>".$true_query->queryString);
    }
    if($simulate==1)
    {
      return $query;
    }else
    {
      return !empty($row1)?$row1:null;
    }
  }
  /*
   * --------------------------------------------------
   * USAGE
   * insert into table1 (col1,col2) values (val1,val2)
   * Equivalent function call
   * $insert_id=insert("table1",array("col1"=>"val1","col2"=>"val2"))
   */
  public function insert(string $table,array $fieldlist)
  {
    //$table="`".$table."`";
    $columns=array();
    $values=array();
    $i=0;
    foreach($fieldlist as $column=>$value)
    {
      $columns[]="`".$column."`";
      $values[]=":param".$i."";
      $i=$i+1;
    }
    $query=sprintf("insert into %s (%s) values (%s)",$table,implode(",",$columns),implode(",",$values));
    try
    {
      $true_query=$this->connection->prepare($query);
      $i=0;
      $param_values=array();
      foreach($fieldlist as $column=>$value)
      {
        $param_name=":param".$i;
        $param_values[$param_name]=strip_tags(trim($value));
        if($param_values[$param_name]==null)
        {
          $true_query->bindValue($param_name,null,PDO::PARAM_NULL);
        }else
        {
          $true_query->bindParam($param_name,$param_values[$param_name]);
        }
        $i=$i+1;
      }
      //print_r($param_values);
      //die($true_query->queryString);
      $true_query->execute();
      $true_query->closeCursor();
      unset($true_query);
      return $this->connection->lastInsertId();
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
      die("<br>".$true_query->queryString);
    }
  }
  /*
   * USAGE: where condition is built the same as for select
   */
  public function delete(string $table,array $where)
  {
    //$table="`".$table."`";
    $where_string="";
    foreach($where as $key=>$element)
    {
      $param_name=":param".$key;
      switch(strtolower($element['equal']))
      {
        case '=':
          $where_string.=$element["relation"]." ".$element["column"]."=".$param_name." ";
        break;
        case 'like':
          $where_string.=$element["relation"]." ".$element["column"]." like ".$param_name." ";
        break;
        case 'like%':
          if(!empty($where[$key]["value"]))
          {
            $where_string.=$element["relation"]." ".$element["column"]." like ".$param_name." ";
            $where[$key]["value"]="%".$element["value"]."%";
          }else
          {
            $where_string.=$element["relation"]." ".$element["column"]." like '' ";
          }
        break;
        case 'in':
          $where_string.=$element["relation"]." ".$element["column"]." in (".$param_name.") ";
        break;
        case '>':
          $where_string.=$element["relation"]." ".$element["column"].">".$param_name." ";
        break;
        case '>=':
          $where_string.=$element["relation"]." ".$element["column"].">=".$param_name." ";
        break;
        case '<':
          $where_string.=$element["relation"]." ".$element["column"]."<".$param_name." ";
        break;
        case '<=':
          $where_string.=$element["relation"]." ".$element["column"]."<=".$param_name." ";
        break;
      }
    }
    $query=sprintf("delete from %s where %s",$table,$where_string);
    try
    {
      $true_query=$this->connection->prepare($query);
      $param_values=array();
      $i=0;
      foreach($where as $element)
      {
        $param_name=":param".$key;
        $param_values[$param_name]=strip_tags(trim($element["value"]));
        $true_query->bindParam($param_name,$param_values[$param_name]);
        $i=$i+1;
      }
      $rez=$true_query->execute();
      return $rez;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
      die("<br>".$true_query->queryString);
    }
  }
  /*
   * USAGE: values same as insert, where same as select
   */
  public function update(string $table,array $values,array $where)
  {
    //$table="`".$table."`";
    $where_string="";
    foreach($where as $key=>$element)
    {
      $param_name=":param".$key;
      switch(strtolower($element['equal']))
      {
        case '=':
          $where_string.=$element["relation"]." ".$element["column"]."=".$param_name." ";
        break;
        case 'like':
          $where_string.=$element["relation"]." ".$element["column"]." like ".$param_name." ";
        break;
        case 'like%':
          if(!empty($where[$key]["value"]))
          {
            $where_string.=$element["relation"]." ".$element["column"]." like ".$param_name." ";
            $where[$key]["value"]="%".$element["value"]."%";
          }else
          {
            $where_string.=$element["relation"]." ".$element["column"]." like '' ";
          }
        break;
        case 'in':
          $where_string.=$element["relation"]." ".$element["column"]." in (".$param_name.") ";
        break;
        case '>':
          $where_string.=$element["relation"]." ".$element["column"].">".$param_name." ";
        break;
        case '>=':
          $where_string.=$element["relation"]." ".$element["column"].">=".$param_name." ";
        break;
        case '<':
          $where_string.=$element["relation"]." ".$element["column"]."<".$param_name." ";
        break;
        case '<=':
          $where_string.=$element["relation"]." ".$element["column"]."<=".$param_name." ";
        break;
      }
    }
    $strings=array();
    $i=0;
    foreach($values as $key=>$value)
    {
      if(preg_match('/^[a-zA-Z0-9\_]+$/',$key))
      {
        $param_name=":value".$i;
        /*
         * $key=mysql_real_escape_string(strip_tags(trim($key))); $value=mysql_real_escape_string(strip_tags(trim($value)));
         */
        //echo $value;
        if($value==="null")
        {
          $strings[]=sprintf('`%s`=NULL',$key);
        }else
        {
          $strings[]=sprintf('`%s`=%s',$key,$param_name);
        }
        $i=$i+1;
      }
    }
    $string=implode(',',$strings);
    $query=sprintf("update %s set %s",$table,$string);
    if(!empty($where_string))
    {
      $query=sprintf("%s where %s",$query,$where_string);
    }
    try
    {
      $true_query=$this->connection->prepare($query);
      $param_values=array();
      $i=0;
      foreach($where as $key=>$element)
      {
        $param_name=":param".$key;
        $param_values[$i]=strip_tags(trim($element["value"]));
        if($param_values[$i]==null)
        {
          $true_query->bindValue($param_name,null,PDO::PARAM_NULL);
        }else
        {
          $true_query->bindParam($param_name,$param_values[$i]);
        }
        $i=$i+1;
      }
      $i=0;
      $actual_values=array();
      foreach($values as $key=>$value)
      {
        $param_name=":value".$i;
        $actual_values[$i]=strip_tags(trim($value));
        if($actual_values[$i]==null)
        {
          $true_query->bindValue($param_name,null,PDO::PARAM_NULL);
        }else
        {
          $true_query->bindParam($param_name,$actual_values[$i]);
        }
        $i=$i+1;
      }
      $rez=$true_query->execute();
      return $rez;
    }
    catch(PDOException $e)
    {
      echo $e->getMessage();
      die("<br>".$true_query->queryString);
    }
  }
}
?>