<?php
class admin_login_m extends page_m
{
    function checkAdmin(string $ad_username,string $ad_password):?array
    {
        $where=[
            [
                'column'=>'ad_username',
                'value'=>$ad_username,
                'relation'=>'',
                'equal'=>'='
            ],
            [
                'column'=>'ad_password',
                'value'=>$ad_password,
                'relation'=>'AND',
                'equal'=>'='
            ]
        ];
        $row=$this->db->selectSingle('admin','*',$where);
        return $row;
    }
}