<?php
class users_m extends page_m
{
    function GetUser(int $usr_id, string $usr_username, string $usr_name, string $usr_email)
    {
        $where = [
            [
                'column' => 'usr_id',
                'value' => $usr_id,
                'relation' => '',
                'equal' => '='
            ],
            [
                'column' => 'usr_username',
                'value' => $usr_username,
                'relation' => '',
                'equal' => '='
            ],
            [
                'column' => 'usr_name',
                'value' => $usr_name,
                'relation' => '',
                'equal' => '='
            ],
            [
                'column' => 'usr_email',
                'value' => $usr_email,
                'relation' => '',
                'equal' => '='
            ]
        ];
        $row = $this->db->selectSingle('users', '*',$where);
        return $row;
    }
    function GetAllUsers()
    {
        $rows = $this->db->select('users', '*',null,"usr_username","docker_containers","dck_name","usr_dck_id=dck_id","left join");
        return $rows;
    }

    function edit(int $usr_id,string $usr_username,string $usr_password,string $usr_name,string $usr_email)
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
            'usr_email'=>$usr_email
        ];
        $this->db->update('users',$param,$where);
    }
}