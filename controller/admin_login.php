<?php
class admin_login extends page
{
    function display()
    {
        $admin_login_v = new admin_login_v();
        $admin_login_v->display();
    }

    function logout()
    {
        session_destroy();
        session_start();
        session_regenerate_id(true);
        $this->redirect('index.php', '&page=login');
    }

    function do_admin_login()
    {
        $admin_login_v = new admin_login_v();
        if (!empty($_REQUEST['ad_username']) && !empty($_REQUEST['ad_password'])) {
            $ad_username = strip_tags(filter_var($_REQUEST['ad_username']));
            $ad_password = strip_tags(filter_var($_REQUEST['ad_password']));
            $admin_login_m = new admin_login_m();
            $exists = $admin_login_m->checkAdmin($ad_username, sha1($ad_password));
            if (!empty($exists)) {
                //login reusit
                $_SESSION['logged'] = true;
                $_SESSION['is_admin']=true;
                $_SESSION['admin'] = $exists;
                $this->redirect('index.php','&page=dashboard');
                die(); //e bine sa omori scriptul la redirect
            } else {
                $admin_login_v->addtoInput('error', 'Bad username or password');
                $admin_login_v->display();
            }
        } else {
            $admin_login_v->addtoInput('error', 'Insufficient data');
            $admin_login_v->display();
        }
    }
}