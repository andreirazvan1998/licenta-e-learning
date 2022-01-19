<?php
class page_m implements constants_m
{
  protected $db;
  function __construct()
  {
    $this->db=Db::getInstance(constants_m::DB_NAME,constants_m::DB_USER,constants_m::DB_PASSWORD);
  }
}
?>