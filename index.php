<?
/**********************************************************************
Trade Portal
index.php
10.25.2015
Jamie M.
**********************************************************************/
define('CVW', true);
include('../init.php');
//include('sendgridFunctions.php');

$vDB = new voyager_Database(DB_HOST, DB_NAME, DB_USER, DB_PASS);
$vSession = new voyagerSession();

//$addCSS = "";
//$addStyle[] = templateAddStyle($addCSS);
//$addJS = "";
//$addJavaScript[] = templateAddJavaScript($addJS);
//$addStyleSheet[] = templateAddStyleSheet(CSS_URL.'/filename.css');
//$addScript[] = templateAddScript(JS_URL.'/filename.js');
$pageTitle = "";
$pageHeadline = "";
$pageDescription = "";
global $pageTitle,$pageHeadline,$pageDescription;
//include(TEMPLATE_DIR."/header.php");
//include(TEMPLATE_DIR."/footer.php");
include 'header.php';

include 'footer.php';

?>