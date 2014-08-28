<?php 

class Core_Service_Demo
{
	
	/**
	 * Hello world!
	 * @param string $string
	 * @return string
	 */
	public function test($string)
	{
		return "Hello $string!";
	}
	
	/**
	 * calc
	 * @param integer $a
	 * @param integer $b
	 * @return integer
	 */
	public function calc($a,$b)
	{
		return $a+$b;
	}
	
	
}