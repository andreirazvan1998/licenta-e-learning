<?php
class add_course_v extends page_v
{
    private $ajax_add_course_v;
    function __construct()
    {
        $this->ajax_add_course_v=new ajax_add_course_v();
        parent::__construct("add_courses","course");

    }

    function headCustomScripts()
    {
        ?>
        <script type="text/javascript" src="assets/elearning/add_courses.js"></script>
        <?php
    }

    function wrapper()
    {
        $this->menu();
        ?>
        <div class="container-fluid">
            <div class="row">
                <section class="mainBar col-sm-4 col-xs-12 offset-sm-4 offset-xs-0" id="course_form_parent">
                    <?php
                    $this->ajax_add_course_v->display();
                    ?>
                </section>
            </div>
        </div>
        <?php
        $this->footer();
    }
}