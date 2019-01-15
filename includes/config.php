<?php
ob_start();
session_start();

//database credentials
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'portfolio_db');

//directory structure
define('ROOT',   $_SERVER['DOCUMENT_ROOT'].'/JinaBlog');
define('FUNC',   ROOT."/functions/");
define('MODULE', ROOT."/modules/");
define('PAGE',   ROOT."/pages/");
define('BASE_URI', '/JinaBlog/');
define('MODAL_IMG',   BASE_URI."images/portfolio/modal/");
define('WORK_IMG',    BASE_URI."images/portfolio/");


//set timezone
date_default_timezone_set('America/New_York');
