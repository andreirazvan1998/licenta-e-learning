<?php
class page implements constants
{
  function setMsg($text)
  {
    $_SESSION['msg']=strip_tags($text);
  }
  function redirect($url,$data=null)
  {
    header("location: ".$url."?sent=1".$data);
    die();
  }
  function display()
  {
    $pv=new page_v("main","Blank");
    $pv->display();
  }
}
?>