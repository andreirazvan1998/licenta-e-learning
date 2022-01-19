<?php
class exercises_m extends page_m
{

    public function getExercise()
    {
        return $this->db->select("courses_exercises","*",null);
    }
    public function getExercises(?int $crs_id)
    {
        $where=[
            [
                'column'=>"cx_id",
                'value'=>1,
                "equal"=>">=",
                "relation"=>""
            ]
        ];
        if (!empty($crs_id))
        {
            $where[]=[
                'column'=>"cx_crs_id",
                'value'=>$crs_id,
                "equal"=>"=",
                "relation"=>"AND"
            ];
        }
        return $this->db->select("courses_exercises","*",$where,"cx_subject");
    }

    public function getOneExercise(string $cx_id )
    {
        $where=[
            [
                'column'=>'cx_id',
                'value'=>$cx_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        return $this->db->selectSingle('courses_exercises','*',$where);
    }
    function exercises(string $cx_subject )
    {
        $where=[
            [
                'column'=>'cx_subject',
                'value'=>$cx_subject,
                'relation'=>'',
                'equal'=>'='
            ]
          /*  [
            'column'=>'cx_subject',
            'value'=>$cx_subject,
            'relation'=>'',
            'equal'=>'='
            ]
*/
        ];
        $row=$this->db->selectSingle('courses_exercises','*',$where);
        return $row;
    }
    public function add_exercises(int $cx_cit_id,string $cx_subject,string $cx_solution,int $cx_points ,string $cx_mock_txt)
    {
        $param=[
            'cx_crs_id'=>$cx_cit_id,
            'cx_subject'=>$cx_subject,
            'cx_solution'=>$cx_solution,
            'cx_points'=>$cx_points,
            'cx_mock_txt'=>$cx_mock_txt
            ];
        $this->db->insert("courses_exercises",$param);
    }
    public function edit(int $cx_id,int $cx_cit_id,string $cx_subject,string $cx_solution,int $cx_points,string $cx_mock_txt)
    {
        $param=[
            'cx_crs_id'=>$cx_cit_id,
            'cx_subject'=>$cx_subject,
            'cx_solution'=>$cx_solution,
            'cx_points'=>$cx_points,
            'cx_mock_txt'=>$cx_mock_txt,
        ];
        $where=[
            [
                'column'=>'cx_id',
                'value'=>$cx_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $this->db->update("courses_exercises",$param,$where);
    }

    public function delete(int $cx_id)
    {
        $where=[
            [
                'column'=>'cx_id',
                'value'=>$cx_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $this->db->delete("courses_exercises",$where);
    }
}