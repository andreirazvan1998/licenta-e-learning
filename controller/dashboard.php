<?php

class dashboard extends page
{
    function display()
    {
        $users_m = new users_m();
        $users = $users_m->GetAllUsers();
        $admin_dashboard_v = new admin_dashboard_v();
        $admin_dashboard_v->addToInput("users", $users);
        $admin_dashboard_v->display();
    }

    function load_user()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            $admin_dashboard_v = new ajax_dashboard_v();
            if (!empty($_REQUEST['usr_id']) && is_numeric($_REQUEST['usr_id'])) {
                $usr_id=filter_var($_REQUEST['usr_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                //asta ai face in mod normal ^
                $main_m = new main_m();

                $user = $main_m->getUser($usr_id);
                $admin_dashboard_v->addToInput('user_edit', $user);
            } else {
                $admin_dashboard_v->addToInput('error', 'Insufficient data');
            }
            $admin_dashboard_v->addForm();
        } else {
            $this->redirect('index.php', '&page=dashboard');
        }
    }


    function delete_user()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['is_admin'])) {
            $admin_dashboard_v = new ajax_dashboard_v();
            $main_m = new main_m();
            if (!empty($_REQUEST['usr_id']) && is_numeric($_REQUEST['usr_id'])) {
                $usr_id=filter_var($_REQUEST['usr_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                echo  $usr_dck_id = strip_tags(filter_var($_REQUEST['usr_dck_id'], FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT));
                //asta ai face in mod normal ^
                $usr_dck_id = $main_m->getDckId($usr_id);
                $arr1 = implode(" ",$usr_dck_id);
                $main_m->dell_usage($arr1);
                $main_m->delete($usr_id);
            }
            $users_m=new users_m();
            $users = $users_m->GetAllUsers();
            $admin_dashboard_v ->addToInput('users', $users);
            $admin_dashboard_v->display();
        } else {
            $this->redirect('index.php', '&page=dashboard');
        }
    }


    function add()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            $admin_dashboard_v = new ajax_dashboard_v();
            $main_m=new main_m();
            if (!empty($_REQUEST['usr_username']) && !empty($_REQUEST['usr_email'])) {
                $usr_email = strip_tags(filter_var($_REQUEST['usr_email'], FILTER_SANITIZE_STRING)); //cauta pe net, ai sanitize de email, nu doar string
                $usr_password = sha1(trim(strip_tags(filter_var($_REQUEST['usr_password'], FILTER_SANITIZE_STRING)))); //sha1 pt hash, trim pentru a elimina spatiu gol inceput si final string
                $usr_name = strip_tags(filter_var($_REQUEST['usr_name'], FILTER_SANITIZE_STRING));
                $usr_username = strip_tags(filter_var($_REQUEST['usr_username'], FILTER_SANITIZE_STRING));
               echo $usr_dck_id = strip_tags(filter_var($_REQUEST['usr_dck_id'], FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT));
                if (!empty($_REQUEST['usr_id']) && is_numeric($_REQUEST['usr_id'])) {
                    //update
                    $usr_id=filter_var($_REQUEST['usr_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                    //$usr_id = $_SESSION['user']['usr_id'];
                    $old = $main_m->getUser($usr_id);
                    if (!empty($old) && empty($usr_password)) {
                        //daca nu are parola trimis in request folosesc ce avea inainte, nu schimb
                        $usr_password = $old['usr_password'];
                    }
                    $main_m->edit($usr_id, $usr_username, $usr_password, $usr_name, $usr_email,$usr_dck_id);

                } else {
                    //insert, aici nu va intra niciodata la acest fisier
                    $main_m->add($usr_username, $usr_password, $usr_name, $usr_email,$usr_dck_id);
                    $main_m->occupied($usr_dck_id);
                }
                $user = $main_m->getUser($_REQUEST['usr_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT); //iau datele noi
                $admin_dashboard_v ->addToInput('user', $user);
                $this->redirect('index.php', '&page=dashboard');// aici nu era redirect
            } else {
                $admin_dashboard_v ->addToInput('error', 'Insufficient data');
            }
            $admin_dashboard_v ->display();
        } else {
            $this->redirect('index.php', '&page=dashboard');
        }
    }



}


