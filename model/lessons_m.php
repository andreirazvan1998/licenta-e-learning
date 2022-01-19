<?php


class lessons_m extends page_m
{
    public function getCourses()
    {
        return $this->db->select("courses", "*", null, "crs_title");
    }

    public function add(int $uscr_usr_id , int $usc_crs_id)
    {
        $param=[
            'uscr_usr_id'=>$uscr_usr_id,
            'uscr_crs_id'=>$usc_crs_id,
            ];
        $this->db->insert("users_courses",$param);
    }

    public function checkEnroll(int $uscr_usr_id , int $uscr_crs_id)
     {
         $where=[
             [
                 'column'=>'uscr_usr_id',
                 'value'=>$uscr_usr_id,
                 'relation'=>'',
                 'equal'=>'='
             ],
             [
                 'column'=>'uscr_crs_id',
                 'value'=>$uscr_crs_id,
                 'relation'=>'AND',
                 'equal'=>'='
             ]
         ];
        $row=$this->db->selectsingle("users_courses","uscr_id",$where);
        return $row;
     }
}