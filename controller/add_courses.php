<?php
class add_courses extends page
{
    function display()
    {
        if (isset($_SESSION['logged'])&&!empty($_SESSION['is_admin'])) {
            $add_course_v = new add_course_v();
            $add_course_v->display();
        }
        else
        {
            $this->redirect('index.php','&page=login');
        }
    }
    function add_course()
    {
        if (isset($_SESSION['logged'])&&!empty($_SESSION['is_admin'])) {
            $add_course_v = new ajax_add_course_v();
            if (!empty($_REQUEST['crs_title']) && !empty($_REQUEST['crs_description']) && !empty($_REQUEST['crs_points']) && !empty($_REQUEST['crs_order'])) {
                $crs_title = strip_tags(filter_var($_REQUEST['crs_title']));
                $crs_description = strip_tags(filter_var($_REQUEST['crs_description']));
                $crs_points = strip_tags(filter_var($_REQUEST['crs_points']));
                $crs_order = strip_tags(filter_var($_REQUEST['crs_order']));
                $add_course_m = new add_course_m();
                $exists = $add_course_m->checkCourse($crs_title);
                if (empty($exists)) {
                    $add_course_m->addCourse($crs_title, $crs_description, $crs_points, $crs_order);
                    $this->redirect('index.php', '&page=add_courses');
                } else {
                    $add_course_v->addtoInput('error', 'titlul cursului este deja folosit');
                    $add_course_v->display();
                }
            } else {
                $add_course_v->addtoInput('error', 'Insufficient data');
                $add_course_v->display();
            }
        }
        else
        {
            $this->redirect('index.php','&page=login');
        }
    }

}
