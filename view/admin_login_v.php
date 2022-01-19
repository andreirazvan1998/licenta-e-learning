<?php
class admin_login_v extends page_v
{
    private $ajax_admin_login_v;
    function __construct()
    {
        $this->ajax_admin_login_v=new ajax_admin_login_v();
        parent::__construct("login","Please log in");
    }
    function wrapper()
    {
        $this->menu();
        ?>
        <div class="container-fluid">
            <div class="row">
                <section class="mainBar col-sm-4 col-xs-12 offset-sm-4 offset-xs-0" id="login_form_parent">
                    <?php
                    $this->ajax_admin_login_v->display();
                    ?>
                </section>
            </div>
        </div>
        <?php
        $this->footer();
    }
}