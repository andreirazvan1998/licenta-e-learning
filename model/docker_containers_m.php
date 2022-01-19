<?php
class docker_containers_m extends page_m
{
    public function getContainers()
    {
        return $this->db->select("docker_containers","*",null,"dck_name");
    }
    public function getOneContainer(int $dck_id)
    {
        $where=[
            [
                'column'=>'dck_id',
                'value'=>$dck_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        return $this->db->selectSingle("docker_containers","*",$where,'dck_name');
    }
    public function add(string $dck_name,int $dck_used,int $dck_port)
    {
        $param=[
            'dck_name'=>$dck_name,
            'dck_port'=>$dck_port,
            'dck_used'=>$dck_used
        ];
        $this->db->insert("docker_containers",$param);
    }
    public function edit(int $dck_id,string $dck_name,int $dck_used,int $dck_port)
    {
        $param=[
            'dck_name'=>$dck_name,
            'dck_port'=>$dck_port,
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
    public function delete(int $dck_id)
    {
        $where=[
            [
                'column'=>'dck_id',
                'value'=>$dck_id,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        $this->db->delete("docker_containers",$where);
    }
    /*
     * Get first unused container in alphabetical order
     */
    public function getFirstFreeContainer()
    {
        $where=[
            [
                'column'=>'dck_used',
                'value'=>0,
                'relation'=>'',
                'equal'=>'='
            ]
        ];
        return $this->db->selectSingle("docker_containers","*",$where,'dck_name');
    }
}