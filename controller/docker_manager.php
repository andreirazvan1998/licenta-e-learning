<?php


class docker_manager extends page
{
    function display()
    {
        if (isset($_SESSION['logged'])&&!empty($_SESSION['logged'])) {
            $docker_containers_m = new docker_containers_m();
            $containers = $docker_containers_m->GetContainers();
            $docker_manager_v = new docker_manager_v();
            $docker_manager_v->addToInput("docker_containers", $containers);
            $docker_manager_v->display();
        }
        else
        {
            $this->redirect('index.php', '&page=login');
        }
    }
    function load_docker()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            $docker_manager_v = new ajax_docker_manager_v(); //OAIEEEE
            if (!empty($_REQUEST['dck_id']) && is_numeric($_REQUEST['dck_id'])) {
                $dck_id=filter_var($_REQUEST['dck_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                //asta ai face in mod normal ^
                $docker_containers_m = new docker_containers_m();
                $container = $docker_containers_m->getOneContainer($dck_id); //singular, OAIEEE
                $docker_manager_v->addToInput('docker_edit', $container);

            } else {
                $docker_manager_v->addToInput('error', 'Insufficient data');
            }

            $docker_manager_v->addForm();
        } else {
            $this->redirect('index.php', '&page=docker_manager');
        }
    }

    function add()
    {
        if (isset($_SESSION['logged']) && !empty($_SESSION['logged'])) {
            $docker_manager_v = new ajax_docker_manager_v();
            $docker_containers_m = new docker_containers_m();
            if (!empty($_REQUEST['dck_name']) && !empty($_REQUEST['dck_port'])) {
                $dck_name = strip_tags(filter_var($_REQUEST['dck_name'], FILTER_SANITIZE_STRING)); //cauta pe net, ai sanitize de email, nu doar string
                $dck_used = strip_tags(filter_var($_REQUEST['dck_used'], FILTER_SANITIZE_STRING)); //sha1 pt hash, trim pentru a elimina spatiu gol inceput si final string
                $dck_port = strip_tags(filter_var($_REQUEST['dck_port'], FILTER_SANITIZE_STRING));
                if (!empty($_REQUEST['dck_id']) && is_numeric($_REQUEST['dck_id'])) {
                    //update
                    $dck_id=filter_var($_REQUEST['dck_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT);
                    //$usr_id = $_SESSION['user']['usr_id'];

                    $docker_containers_m->edit($dck_id, $dck_name, $dck_used,$dck_port);
                } else {
                    //insert
                    $docker_containers_m->add($dck_name, $dck_used, $dck_port);
                }
                $containers = $docker_containers_m->GetContainers();
                $docker_manager_v ->addToInput('docker_containers', $containers);
            } else {
                $docker_manager_v ->addToInput('error', 'Insufficient data');
            }
            $docker_manager_v ->display();
        } else {
            $this->redirect('index.php', '&page=login');
        }
    }
    function delete()
    {
        if (isset($_SESSION['logged'])&&!empty($_SESSION['logged']))
        {
            $docker_manager_v = new ajax_docker_manager_v();
            $docker_containers_m = new docker_containers_m();
            if (!empty($_REQUEST['dck_id']) && is_numeric($_REQUEST['dck_id'])) {
                //delete
                $dck_id = filter_var($_REQUEST['dck_id'], FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT);
                $docker_containers_m->delete($dck_id);
            }else {
                $docker_manager_v ->addToInput('error', 'Insufficient data');
            }
            $containers = $docker_containers_m->GetContainers();
            $docker_manager_v ->addToInput('docker_containers', $containers);
            $docker_manager_v ->display();
        }
        else {
            $this->redirect('index.php', '&page=login');
        }
    }


}