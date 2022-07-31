<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/helpers/Helper.php");
require_once(ROOT . "/helpers/Router.php");
require_once(ROOT . "/helpers/DotEnv.php");
require_once(ROOT . "/helpers/RedBean.php");

Helper::init();

get('/', 'views/welcome.php');
get('/welcome', 'views/welcome.php');
get('/api/welcome', 'api/welcome.php');
any('/404','views/404.php');
