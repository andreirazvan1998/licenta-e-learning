
<?php
class lessons_v extends page_v
{
    private $ajax_lessons_v;

    function __construct()
    {
        $this->ajax_lessons_v = new ajax_lessons_v();
        parent::__construct("lessons", "lectii");

    }

    public function addToInput($key,$value)
    {
        if (!empty($this->ajax_lessons_v))
            {
                $this->ajax_lessons_v->addToInput($key,$value);
            }
            parent::addToInput($key,$value);
    }
    function headCustomScripts()
    {
        ?>
        <script type="text/javascript" src="assets/elearning/lessons.js"></script>
        <?php
    }
    function wrapper()
    {
        $this->menu();
        ?>
        <div class="align-centre">
            <div class="card">
                <div class="card-header">Courses Info</div>
                <div class="card-body" id="main_lessons_parent">
                    <?php
                    $this->ajax_lessons_v->display();
                    ?>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <?php
        $this->footer();
    }
}