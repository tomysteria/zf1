<?php 

require 'Single.php';

$single1 = Single::getInstance();
var_dump($single1);
$single2 = Single::getInstance();
var_dump($single2);