<?php
namespace adoms\src\lib;

$my = function ($pClassName) {
    include("c:\\xampp\\htdocs\\adoms\\" . strtolower($pClassName) . ".php");
};
spl_autoload_register($my, true, 1);

$view = null;
if (isset($_GET['s_titlewr']) && isset($_GET['s_directory']) && $_GET['s_name']) {
    $view = new PageControllers($_GET['s_titlewr'], $_GET['s_directory']);
    $view->loadJSON();
    $view->mvc[$_GET['s_titlewr']]->view->addShared($_GET['s_name']);
    $view->save();
$view->mvc[$_GET['s_titlewr']]->paginateModels($_GET['s_titlewr'], $_GET['s_directory'],"index.php");

$r = $_GET['s_titlewr']."/view/".$_COOKIE['PHPSESSID']."/index.php";
include($r);
}
if (isset($_GET['s_titlemd']) && isset($_GET['s_dirmd']) && isset($_GET['m_label']) && isset($_GET['m_name']) && isset($_GET['m_regex']) && isset($_GET['m_err']) && isset($_GET['m_val'])) {
    $view = new PageControllers($_GET['s_titlemd'], $_GET['s_dirmd']);
    $view->loadJSON();
    $view->mvc[$_GET['s_titlemd']]->addModelValid($_GET['m_name'],$_GET['m_regex'], $_GET['m_err']);
    $view->mvc[$_GET['s_titlemd']]->addModelData($_GET['s_dirmd'], array("label" => $_GET['m_label'], $_GET['m_name'] => $_GET['m_val']));
    $view->save();
$view->mvc[$_GET['s_titlemd']]->paginateModels($_GET['s_titlewr'], $_GET['s_dirmd'],"index.php");

$r = $_GET['s_titlemd']."/view/".$_COOKIE['PHPSESSID']."/index.php";
include($r);
}
