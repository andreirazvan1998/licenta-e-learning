<?php


class add_exercises_v extends page_v
{
    private $ajax_add_exercises_v;
    function __construct()
    {
        $this->ajax_add_exercises_v=new ajax_add_exercises_v();
        parent::__construct("add_exercises","add exercises");
    }

    public function addToInput($key, $value)
    {
        $this->ajax_add_exercises_v->addToInput($key,$value);
        parent::addToInput($key, $value); // TODO: Change the autogenerated stub
    }
    function headCustomScripts()
    {
        ?>
        <script type="text/javascript" src="assets/elearning/add_exercises.js"></script>
        <?php
    }

    function sideBar()
    {
        ?>
        <div class="card">
            <div class="card-header">Exercise edit</div>
            <div class="card-body" id="exercises_form_parent">
                <?php
                $this->ajax_add_exercises_v->addExercises();
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
            <div class="card-header">Exercises info</div>
            <div class="card-body" id="exercises_content_parent">
                <?php
                $this->ajax_add_exercises_v->display();
                ?>
            </div>
            <div class="card-footer"></div>
        </div>

        <?php
    }

}