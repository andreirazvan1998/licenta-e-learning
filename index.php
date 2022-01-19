<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
/*if($_SERVER["HTTPS"] != "on")
{
	header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
	exit();
}*/
require_once 'vendor/autoload.php';
function my_autoloader($class)
{
    if (file_exists('controller/' . $class . '.php')) {
        include_once 'controller/' . $class . '.php';
    } else if (file_exists('model/' . $class . '.php')) {
        include_once 'model/' . $class . '.php';
    } else if (file_exists('view/' . $class . '.php')) {
        include_once 'view/' . $class . '.php';
    }
}

spl_autoload_register('my_autoloader');
if (isset($_REQUEST['page']) && preg_match('/^[a-z_]+$/', $_REQUEST['page'])) {
    $page = strip_tags($_REQUEST['page']);
} else $page = 'main';
if (isset($_REQUEST['action']) && preg_match('/^[a-z_]+$/', $_REQUEST['action'])) {
    $action = strip_tags($_REQUEST['action']);
} else $action = 'display';
$page = new $page();
$page->$action();
?>