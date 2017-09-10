<?php
date_default_timezone_set('Asia/Bangkok');
require 'config.php';
require 'util/Auth.php';
require 'util/simplexlsx.class.php';

function __autoload($class){
	require LIBS."$class.php";
}

$app = new Bootstrap();
