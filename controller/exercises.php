<?php
use SoftBricks\Docker\Docker;
class exercises extends page
{
    function display()
    { if (isset($_SESSION['logged'])&&!empty($_SESSION['logged'])) {
        $exercises_v = new exercises_v();
        $exercises_m = new exercises_m();
        if (!empty($_REQUEST['crs_id']))
        {
            $crs_id=sprintf("%d",filter_var($_REQUEST['crs_id'],FILTER_SANITIZE_NUMBER_INT,FILTER_VALIDATE_INT));
            $containers = $exercises_m->getExercises($crs_id);
            $exercises_v->addToInput("courses_exercises", $containers);
        }
        $exercises_v->display();
    }
    }
    function reset()
    {
        $exercises_v=new ajax_exercises_v();
        $docker = new Docker();
        $containerInfo = $docker->getContainerInfo($_SESSION['user']['dck_name']);
        $status = $containerInfo->getStatus();
        if (!strstr($status, "Exited (137)")) {
            $h=curl_init("http://localhost:".$_SESSION['user']['dck_port']."/reset_sql.php");
            if (!empty($h))
            {
                curl_setopt($h, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($h, CURLOPT_POST, 1);
                $res=curl_exec($h);
                if (!empty($res))
                {
                    $exercises_v->addToInput('response', $res);
                }
                else
                {
                    $exercises_v->addToInput('error', 'No response from server');
                }
                curl_close($h);
            }
            else {
                $exercises_v->addToInput('error', 'Connection to Mysql docker server refused');
            }
        } else {
            $exercises_v->addToInput('error','Mysql docker server not started');
        }
        $exercises_v->display();
    }

        function check()
        {

            $exercises_v = new ajax_exercises_v();
            if (!empty($_REQUEST['q'])) {
                $docker = new Docker();
                $containerInfo = $docker->getContainerInfo($_SESSION['user']['dck_name']);
                $status = $containerInfo->getStatus();
                if (!strstr($status, "Exited (137)")) {
                    $q = strip_tags(filter_var(trim($_REQUEST['q'])));
                    $h = curl_init("http://localhost:" . $_SESSION['user']['dck_port'] . "/run_sql.php");
                    if (!empty($h)) {
                        curl_setopt($h, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($h, CURLOPT_POST, 1);
                        curl_setopt($h, CURLOPT_POSTFIELDS, ["q" => $q]);
                        $res = curl_exec($h);
                        if (!empty($_REQUEST['cx_id'])) {
                            $cx_id = sprintf("%d",filter_var($_REQUEST['cx_id'], FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT));
                            $exercises_m = new exercises_m();
                            $solution = $exercises_m->getOneExercise($cx_id);

                            if (!empty($res)) {
                                $response=json_decode($res,true);
                                if ($response["hash"] == $solution["cx_solution"]) {
                                    $exercises_v->addToInput('success', 'Raspuns corect ');
                                    $exercises_v->addToInput('response', $response);
                                } else {
                                    $exercises_v->addToInput('error', 'Raspuns gresit');
                                    // select customerNumber from customers where customerNumber = 103
                                    if (!empty($response))
                                        $exercises_v->addToInput('response', $response);
                                    else
                                        $exercises_v->addToInput('response', $res);
                                }
                            }
                            else {
                                $exercises_v->addToInput('error', 'No response from server');
                            }
                        }
                        else
                        {
                            $exercises_v->addToInput('error', 'No exercise ID');
                        }
                        curl_close($h);
                    } else {
                        $exercises_v->addToInput('error', 'Connection to Mysql docker server refused');
                    }
                } else {
                    $exercises_v->addToInput('error', 'Mysql docker server not started');
                }
            } else {
                $exercises_v->addToInput('error', 'Insufficient data');
            }
            $exercises_v->display();
        }
    }