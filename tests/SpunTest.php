<?php

include './src/Spun.php';

class SpunTest extends \PHPUnit_Framework_TestCase
{

	protected $str;


	public function setUp()
	{
		$this->str = "This is a string that {includes|contains|holds} choices you can spin."; 
	}

  	public function tearDown()
  	{

  	}
	
	public function testTrueIsTrue()
	{
	    $foo = true;
	    $this->assertTrue($foo);
	}

	public function testRemoveAnchorsReturnsString()
	{
		$spun = new Spun;
		$str = $spun->removeAnchors('{Test String Here}');
		$this->assertInternalType('string', $str);
	}
}