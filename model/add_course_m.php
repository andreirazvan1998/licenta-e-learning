<?php
class add_course_m extends page_m
{

    public function getCourses()
    {
        return $this->db->select("courses","*",null,"crs_id");
    }

    function addCourse(string $crs_title,string $crs_description,string $crs_points,string $crs_order)
    {
        $param=[
            'crs_title'=>$crs_title,
            'crs_description'=>$crs_description,
            'crs_order'=>$crs_order,
            'crs_points'=>$crs_points
        ];
        $this->db->insert("courses",$param);
    }
    function checkCourse(string $crs_title):?array
    {
        $where=[
            [
                'column'=>'crs_title',
                'value'=>$crs_title,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $row=$this->db->selectSingle('courses','*',$where);
        return $row;
    }

    function getUserCourses(int $uscr_usr_id)
    {
        $where=[
            [
                'column'=>'uscr_usr_id',
                'value'=>$uscr_usr_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
       return  $row=$this->db->select('users_courses','*',$where,null,"courses","crs_title","uscr_crs_id=crs_id","left join");
        //select crs_title from users_courses left join courses on uscr_crs_id=crs_id where uscr_usr_id=3
       // SELECT `crs_title` FROM `courses` WHERE `crs_id` in (SELECT `uscr_crs_id` from users_courses where `uscr_usr_id`=3)
      //  select * from courses_exercises left join courses on cx_cit_id=crs_id where cx_cit_id=1
    }
}