<?php
class ajax_page_v implements constants_v
{
  private $input;
  public function addToInput($key,$value)
  {
    $this->input[$key]=$value;
  }
  function display()
  {
  }
  function showErrors()
  {
    $input=$this->getInput();
    if(!empty($input["error"]))
    {
      ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $input["error"] ?>
      </div>
      <?php
    }
  }
  function getInput()
  {
    return $this->input;
  }
  function setInput($input)
  {
    $this->input=$input;
  }
  function showSuccess()
  {
    $input=$this->getInput();
    if(!empty($input["success"]))
    {
      ?>
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $input["success"] ?>
      </div>
      <?php
    }
  }
}