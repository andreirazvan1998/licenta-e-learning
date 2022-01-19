<?php
class register extends page
{
    function display()
    {
        $register_v = new register_v();
        $register_v->display();
    }

    function do_register()
    {
        $register_v = new ajax_register_v();
        if (!empty($_REQUEST['usr_username']) && !empty($_REQUEST['usr_password']) && !empty($_REQUEST['usr_repeat_password']) && !empty($_REQUEST['usr_name']) && !empty($_REQUEST['usr_email'])) {
            $usr_username = strip_tags(filter_var($_REQUEST['usr_username']));
            $usr_name = strip_tags(filter_var($_REQUEST['usr_name']));
            $usr_repeat_password = strip_tags(filter_var($_REQUEST['usr_repeat_password']));
            $usr_email = strip_tags(filter_var($_REQUEST['usr_email']));
            $usr_password = strip_tags(filter_var($_REQUEST['usr_password']));
            $register_m = new register_m();
            $exists = $register_m->checkUser($usr_username);

            if (empty($exists)) {
                if ($usr_repeat_password == $usr_password) {
                    $docker_containers_m=new docker_containers_m();
                    $free_docker=$docker_containers_m->getFirstFreeContainer();
                    if (!empty($free_docker))
                    {
                        $usr_dck_id=$free_docker['dck_id'];
                    }
                    else
                    {
                        $usr_dck_id=0;
                    }
                    $register_m->add($usr_username, sha1($usr_password), $usr_name, $usr_email,$usr_dck_id);
                    $register_m->occupied($usr_dck_id);
                    ?>
                    <script type="text/javascript">
                        console.log("Redirect login");
                        window.location.href="index.php?page=login";
                    </script>
<?php
                    die(0);
                    //$this->redirect('index.php', '&page=login');
                } else {
                    $register_v->addtoInput('error', 'parola nu corespunde');
                    $register_v->display();
                }
            } else {
                $register_v->addtoInput('error', 'ussername exista deja');
                $register_v->display();
            }
        } else {

            $register_v->addtoInput('error', 'Insufficient data');
            $register_v->display();
        }
    }


}
