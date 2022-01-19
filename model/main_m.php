<?php
class main_m extends page_m
{
    function getUser($usr_id):?array
    {
        $where=[
            [
                'column'=>'usr_id',
                'value'=>$usr_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $row=$this->db->selectSingle('users','*',$where,null,'docker_containers','dck_name','usr_dck_id=dck_id',"left join");
        return $row;
    }

    function getDckId(int $usr_id)
    {
        $where=[
            [
                'column'=>'usr_id',
                'value'=>$usr_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $row=$this->db->selectSingle('users','usr_dck_id',$where);
        return $row;
    }

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
    function edit(int $usr_id,string $usr_username,string $usr_password,string $usr_name,string $usr_email,int $usr_dck_id)
    {
        $where=[
            [
                'column'=>'usr_id',
                'value'=>$usr_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $param=[
            'usr_username'=>$usr_username,
            'usr_password'=>$usr_password,
            'usr_name'=>$usr_name,
            'usr_email'=>$usr_email,
            'usr_dck_id'=>$usr_dck_id
        ];
        $this->db->update('users',$param,$where);
    }

    function delete(int $usr_id)
    {
        $where=[
            [
                'column'=>'usr_id',
                'value'=>$usr_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $this->db->delete('users',$where);
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

    function dell_usage(string $dck_id)
    {
        $dck_used=0;
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