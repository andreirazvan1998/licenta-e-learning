<?php


class add_exercises extends page
{
    public function display()
    {
        if (isset($_SESSION['logged'])&&!empty($_SESSION['logged'])) {
            $add_exercises_v= new add_exercises_v();
            $exercises_m=new exercises_m();
            $exercise = $exercises_m->getExercise();
            $add_exercises_v->addToInput('courses_exercises',$exercise);
            $add_exercises_v->display();
        }
        else
        {
            $this->redirect('index.php', '&page=login');
        }
    }

    function load_exercises()
    {
        if (isset($_SESSION['logged'])&&!empty($_SESSION['is_admin'])) {
            $add_exercises_v = new ajax_add_exercises_v();
            if (!empty($_REQUEST['cx_id']) && is_numeric($_REQUEST['cx_id'])) {
                $cx_id=filter_var($_REQUEST['cx_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                //asta ai face in mod normal ^
                $exercises_m = new exercises_m();
                $exercise = $exercises_m->getOneExercise($cx_id); //singular, OAIEEE
                $add_exercises_v->addToInput('exe_edit', $exercise);

            } else {
                $add_exercises_v->addToInput('error', 'Insufficient data');
            }

            $add_exercises_v->addExercises();
        } else {
            $this->redirect('index.php', '&page=add_exercises');
        }
    }
    function delete()
    {
        if (isset($_SESSION['logged'])&&!empty($_SESSION['is_admin'])) {
            $add_exercises_v = new ajax_add_exercises_v();
            $exercises_m = new exercises_m();
            if (!empty($_REQUEST['cx_id']) && is_numeric($_REQUEST['cx_id'])) {
                //delete
                $cx_id = filter_var($_REQUEST['cx_id'], FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
                $exercises_m ->delete($cx_id);
            }else {
                $add_exercises_v->addToInput('error', 'Insufficient data');
            }
            $containers = $exercises_m->GetExercise();
            $add_exercises_v ->addToInput('courses_exercises', $containers);
            $add_exercises_v->display();
        }
        else {
            $this->redirect('index.php', '&page=login');
        }
    }

    function add_exe()
    {
        if (isset($_SESSION['logged'])&&!empty($_SESSION['is_admin'])) {
            $add_exercises_v = new ajax_add_exercises_v();
            $exercises_m = new exercises_m();
            if (!empty($_REQUEST['cx_crs_id']) && !empty($_REQUEST['cx_subject']) && !empty($_REQUEST['cx_solution']) && !empty($_REQUEST['cx_points']) && !empty($_REQUEST['cx_mock_txt'])) {
                $cx_cit_id = strip_tags(filter_var($_REQUEST['cx_crs_id']));
                $cx_subject = strip_tags(filter_var($_REQUEST['cx_subject']));
                $cx_solution = strip_tags(filter_var($_REQUEST['cx_solution']));
                $cx_points = strip_tags(filter_var($_REQUEST['cx_points']));
                $cx_mock_text = strip_tags(filter_var($_REQUEST['cx_mock_txt']));
                $exists = $exercises_m->exercises($cx_subject);
                if (empty($exists)) {
                    if (!empty($_REQUEST['cx_id']) && is_numeric($_REQUEST['cx_id'])) {
                        //update
                        $cx_id = filter_var($_REQUEST['cx_id'], FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
                        $exercises_m->edit($cx_id, $cx_cit_id, $cx_subject, $cx_solution, $cx_points, $cx_mock_text);
                    }
                    else {
                            $exercises_m->add_exercises($cx_cit_id, $cx_subject, $cx_solution, $cx_points, $cx_mock_text);
                        }
                }
                else{
                    $add_exercises_v->addtoInput('error', 'Cerinta este deja folosita');
                }

            } else {
                $add_exercises_v->addtoInput('error','Insufficient data');
            }
            $exe = $exercises_m->GetExercise();
            $add_exercises_v->addToInput('courses_exercises',$exe);
            $add_exercises_v->display();
        }
        else
        {
            $this->redirect('index.php','&page=add_exercises');
        }

    }


}