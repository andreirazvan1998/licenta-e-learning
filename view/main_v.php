<?php
class main_v extends page_v
{
  private $ajax_main_v;
  public function __construct()
  {
    $this->ajax_main_v=new ajax_main_v();
    parent::__construct("main","My Profile");
  }
  function headCustomScripts()
  {
    ?>
    <script type="text/javascript" src="assets/elearning/main.js"></script>
    <?php
  }
  function addToInput($key,$value)
  {
    if (!empty($this->ajax_main_v))
    {
      $this->ajax_main_v->addToInput($key,$value);
    }
    parent::addToInput($key,$value);
  }
  function sideBar()
  {
?>
  <div class="card">
    <div class="card-header">Edit my profile</div>
    <div class="card-body" id="main_form_parent">
      <?php 
      $this->ajax_main_v->addForm();
      ?>
    </div>
    <div class="card-footer"></div>
  </div>
<?php
  }
  function mainBar()
  {
?>
<div class="card">
    <div class="card-header">My info</div>
    <div class="card-body" id="main_content_parent">
      <?php 
      $this->ajax_main_v->display();
      ?>
    </div>
    <div class="card-footer"></div>
  </div>
<?php
  }
}