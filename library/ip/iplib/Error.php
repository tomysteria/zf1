<?php 
namespace Iplib;

class Error 
{
	public static function handleError($errno, $errstr, $errfile, $errline, $context)
	{
		echo 'Erreur de l\'application';
	}
	
	public static function handleException(\Exception $e)
	{
		echo 'Erreur de l\'application';
	}
}