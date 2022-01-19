<?php
class register_v extends page_v
{
    private $ajax_register_v;
    function __construct()
    {
        $this->ajax_register_v=new ajax_register_v();
        parent::__construct("admin_login","please login");

    }
    function headCustomScripts()
    {
        ?>
        <script type="text/javascript" src="assets/elearning/register.js"></script>
        <?php
    }
    function wrapper()
    {
        $this->menu();
        ?>
        <div class="container-fluid">
            <div class="row">
                <section class="mainBar col-sm-4 col-xs-12 offset-sm-4 offset-xs-0" id="register_form_parent">
                    <?php
                    $this->ajax_register_v->display();
                    ?>
                </section>
            </div>
        </div>
        <?php
        $this->footer();
    }
}