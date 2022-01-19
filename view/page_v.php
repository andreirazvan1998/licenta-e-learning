<?php
class page_v implements constants_v
{
  private $title;
  private $page;
  private $input;
  function __construct($page,$title)
  {
    $this->page=$page;
    $this->title=$title;
  }
  public function addToInput($key,$value)
  {
    $this->input[$key]=$value;
  }
  function successMsg()
  {
    $input=$this->getInput();
    if(!empty($input["success_message"]))
    {
      ?>
      <div class="alert alert-success">
        <p><?php echo $input["success_message"] ?></p>
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
  function errorMsg()
  {
    $input=$this->getInput();
    if(!empty($input["error_message"]))
    {
      ?>
      <div class="alert alert-danger">
        <p><?php echo $input["error_message"] ?></p>
      </div>
      <?php
    }
  }
  function display()
  {
    ?>
    <!DOCTYPE html>
    <html lang="en-us">
    <head>
      <?php
      $this->head();
      ?>
    </head>
    <body class="h-100">
    <?php
    $this->wrapper();
    ?>
    <script src="assets/jquery-3.4.1.js"></script>
    <script src="assets/bootstrap431/js/bootstrap.bundle.js"></script>
    <script src="assets/elearning/index.js"></script>
    <?php
    $this->headCustomScripts();
    ?>
    </body>
    </html>
    <?php
  }
  function head()
  {
    ?>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">  <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->  <!-- Title  -->
    <title><?php echo $this->title ?></title>
    <link rel="stylesheet" href="assets/bootstrap431/css/bootstrap.css">
    <link rel="stylesheet" href="assets/elearning/style.css">
    <?php
    $this->headCustomCss();
    ?><?php
  }
  function headCustomCss()
  {
  }
  public function wrapper()
  {
    $this->menu();
    ?>
    <div class="container-fluid">
      <div class="row">
        <aside class="sideBar col-lg-4 col-xs-12">
          <?php
          $this->sideBar();
          ?>
        </aside>
        <section class="mainBar col-lg-8 col-xs-12">
          <?php
          $this->mainBar();
          ?>
        </section>
      </div>
    </div>
    <?php
    $this->footer();
  }
  function menu()
  {
    ?>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand" href="index.php?page=main">Logo</a>
      <!-- Links -->
      <div class="collapse navbar-collapse" id="nav-content">
        <ul class="navbar-nav">          
          <?php
          if (isset($_SESSION['logged'])&&!empty($_SESSION['logged']))
          {
          ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=main">User Profile</a>
          </li>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?page=quizz">Quizz</a>
              </li>

              <?php
              if (!empty($_SESSION['is_admin'])) {
                  ?>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php?page=dashboard">Dashboard</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php?page=add_courses">Add Course</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php?page=docker_manager">Docker Manager</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="index.php?page=add_exercises">Add exercises</a>
                  </li>
                  <?php
              }
                  ?>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?page=lessons">inscriere cursuri</a>
              </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=login&action=logout">Logout</a>
          </li>          
          <?php
          }
          else{
             ?>
              <li class="nav-item">
                  <a class="nav-link" href="index.php?page=admin_login">admin</a>
              </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </nav>
    <?php
  }
  function sideBar()
  {
    $this->sideBarMenu();
  }
  function sideBarMenu()
  {
  }
  function mainBar()
  {
  }
  function footer()
  {
    ?>
    <footer class="footer"></footer>
    <?php
  }
  public function headCustomScripts()
  {
  }
}
?>