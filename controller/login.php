<?php
use SoftBricks\Docker\Docker;
class login extends page
{
    function display()
    {
        $login_v=new login_v();
        $login_v->display();
    }
    private function control_docker(string $docker_name, string $operation)
    {
        $docker = new Docker();
        if ($docker->isInstalled()) {
            if ($docker->isContainerExisting($docker_name)) {
                switch ($operation) {
                    case 'start':
                        if (!$docker->isContainerRunning($docker_name)) {
                            $docker->start($docker_name);
                        }
                        break;
                    case 'stop':
                        if ($docker->isContainerRunning($docker_name)) {
                            $docker->stop($docker_name);
                        }
                        break;
                }

                /*$containerInfo = $docker->getContainerInfo('competent_bhaskara');
                // .. do something with it
                $docker->executeCommand($containerInfo);*/
            }

        }
    }
    function logout()
    {
        $user=new main_m();
        $user_row=$user->getUser($_SESSION['user']['usr_id']);
        if (!empty($user_row['dck_name'])) {
            $this->control_docker($user_row['dck_name'], 'stop');
        }
        session_destroy();
        session_start();
        session_regenerate_id(true);
        $this->redirect('index.php','&page=login');
    }
    function do_login()
    {
        $login_v=new login_v();
        if (!empty($_REQUEST['usr_username'])&&!empty($_REQUEST['usr_password']))
        {
            $usr_username=strip_tags(filter_var($_REQUEST['usr_username']));
            $usr_password=strip_tags(filter_var($_REQUEST['usr_password']));
            $login_m=new login_m();
            $exists=$login_m->checkUser($usr_username,sha1($usr_password));
            if (!empty($exists))
            {
                //login reusit
                $_SESSION['logged']=true;
                $_SESSION['user']=$exists;
                $this->control_docker($exists['dck_name'],'start');
                $this->redirect('index.php','&page=main');
                die(); //e bine sa omori scriptul la redirect
            }
            else
            {
                $login_v->addtoInput('error','Bad username or password');
                $login_v->display();
            }
        }
        else
        {
            $login_v->addtoInput('error','Insufficient data');
            $login_v->display();
        }
    }
}