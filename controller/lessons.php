<?php


class lessons extends page
{
    function display()
    {
        $lessons_m = new lessons_m();
        $users = $lessons_m->getCourses();
        $lessons_v = new lessons_v();
        $lessons_v->addToInput("courses", $users);
        $lessons_v->display();
    }

    function load_course()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            if (!empty($_REQUEST['crs_id']) && is_numeric($_REQUEST['crs_id'])) {
                $crs_id = filter_var($_REQUEST['crs_id'], FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
                $usr_id = $_SESSION['user']['usr_id'];
                $lessons_m = new lessons_m();
                $lessons_v = new ajax_lessons_v();
                $exists = $lessons_m->checkEnroll($usr_id,$crs_id);

                if(empty($exists)){
                    $lessons_m->add($usr_id, $crs_id);
                    $lessons_v->addToInput('error', 'Esti deja inscris la acest curs!');
                    $lessons_v->display();
                }
                else
                {
                    $lessons_v->addToInput('error', 'Esti deja inscris la acest curs!');
                    $lessons_v->display();
                }
            }
        }
    }


}