<?php

use SoftBricks\Docker\Docker;


class main extends page
{

    function display()
    {


        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            $main_m = new main_m();
            $user = $main_m->getUser($_SESSION['user']['usr_id']);
            $main_v = new main_v();
            $main_v->addToInput('user', $user);
            $main_v->display();
        } else {
            $this->redirect('index.php', '&page=login');
        }



    }

    function load_one()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            $main_v = new ajax_main_v();
            if (!empty($_REQUEST['usr_id']) && is_numeric($_REQUEST['usr_id'])) {
                //$usr_id=filter_var($_REQUEST['usr_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                $main_m = new main_m();
                $user = $main_m->getUser($_SESSION['user']['usr_id']);
                $main_v->addToInput('user_edit', $user);
                $main_v->display();
            } else {
                $main_v->addToInput('error', 'Insufficient data');
            }
            $main_v->addForm();
        } else {
            $this->redirect('index.php', '&page=main');
        }
    }

    function add()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            $main_v = new ajax_main_v();
            $main_m = new main_m();
            if (!empty($_REQUEST['usr_username']) && !empty($_REQUEST['usr_email'])) {
                $usr_email = strip_tags(filter_var($_REQUEST['usr_email'], FILTER_SANITIZE_STRING)); //cauta pe net, ai sanitize de email, nu doar string
                $usr_password = sha1(trim(strip_tags(filter_var($_REQUEST['usr_password'], FILTER_SANITIZE_STRING)))); //sha1 pt hash, trim pentru a elimina spatiu gol inceput si final string
                $usr_name = strip_tags(filter_var($_REQUEST['usr_name'], FILTER_SANITIZE_STRING));
                $usr_username = strip_tags(filter_var($_REQUEST['usr_username'], FILTER_SANITIZE_STRING));
                if (!empty($_REQUEST['usr_id']) && is_numeric($_REQUEST['usr_id'])) {
                    //update
                    //$usr_id=filter_var($_REQUEST['usr_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                    $usr_id = $_SESSION['user']['usr_id'];
                    $old = $main_m->getUser($usr_id);
                    if (!empty($old) && empty($_REQUEST['usr_password'])) {
                        //daca nu are parola trimis in request folosesc ce avea inainte, nu schimb
                        $usr_password = $old['usr_password'];
                    }
                    $main_m->edit($usr_id, $usr_username,$usr_password, $usr_name, $usr_email);
                } else {
                    //insert, aici nu va intra niciodata la acest fisier
                    $main_m->add($usr_username, $usr_password, $usr_name, $usr_email);
                }
                $user = $main_m->getUser($_SESSION['user']['usr_id']); //iau datele noi
                $main_v->addToInput('user', $user);
            } else {
                $main_v->addToInput('error', 'Insufficient data');
            }
            $main_v->display();
        } else {
            $this->redirect('index.php', '&page=main');
        }
    }
    /*
    function delete()
    {
      if (isset($_SESSION['logged'])&&!empty($_SESSION['logged']))
      {

      }
      else
      {
        $this->redirect('index.php','&page=login');
      }
    }
    */
}