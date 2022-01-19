<?php
class login_m extends page_m
{
   function checkUser(string $usr_username,string $usr_password):?array
   {
        $where=[
            [
                'column'=>'usr_username',
                'value'=>$usr_username,
                'relation'=>'',
                'equal'=>'='
            ],
            [
                'column'=>'usr_password',
                'value'=>$usr_password,
                'relation'=>'AND',
                'equal'=>'='
            ]
        ];
        $row=$this->db->selectSingle('users','*',$where,null,'docker_containers','dck_name,dck_port','usr_dck_id=dck_id',"left join");
        return $row;
   } 
}