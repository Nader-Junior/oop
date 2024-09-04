<?php

require_once 'conn.php';
require_once 'classes/request.php';
require_once 'classes/session.php';
require_once 'classes/validation.php';



use Root\nader\exam\Request;

use Root\nader\required\Session;
use Root\nader\required\Validation;

$request= new Request;
$session = new Session;
$validation = new Validation;