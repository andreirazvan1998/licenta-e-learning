<?php
class register_m extends page_m
{
    function add(string $usr_username,string $usr_password,string $usr_name,string $usr_email,int $usr_dck_id)
    {
        $param=[
            'usr_username'=>$usr_username,
            'usr_password'=>$usr_password,
            'usr_name'=>$usr_name,
            'usr_email'=>$usr_email,
            'usr_dck_id'=>$usr_dck_id
        ];
        $this->db->insert("users",$param);
    }
    function checkUser(string $usr_username):?array
    {
        $where=[
            [
                'column'=>'usr_username',
                'value'=>$usr_username,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $row=$this->db->selectSingle('users','*',$where);
        return $row;
    }

    function occupied(int $dck_id)
    {
        $dck_used=1;
        $param=[
            'dck_used'=>$dck_used
        ];
        $where=[
            [
                'column'=>'dck_id',
                'value'=>$dck_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $this->db->update("docker_containers",$param,$where);
    }

}