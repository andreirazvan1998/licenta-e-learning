<?php
class quizz extends page
{
    function display()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            $add_course_m = new add_course_m();
            $usr_id = $_SESSION['user']['usr_id'];
            $courses = $add_course_m->getUserCourses($usr_id);
            $quizz_v = new quizz_v();
            $quizz_v->addToInput("courses", $courses);
            $quizz_v->display();
        }
    }
      /*  function loadPage()
            {  if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
                $exercises_v = new ajax_exercises_v();
                if (!empty($_REQUEST['cit_id']) && is_numeric($_REQUEST['dck_id'])) {
                    $dck_id=filter_var($_REQUEST['cit_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                    //asta ai face in mod normal ^
                    $exercises_m = new exercises_m();
                    $container = $exercises_m->getExercise($dck_id);
                    $exercises_v->addToInput('exercises', $container);
                    echo $dck_id;
                } else {
                    $exercises_v->addToInput('error', 'Insufficient data');
                }

                $exercises_v->addForm();
            } else {
                $this->redirect('index.php', '&page=exercises');
            }
        }*/

}