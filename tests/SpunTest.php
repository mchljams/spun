<?php

namespace Spun\Test;

use Spun;

class SpunTest extends \PHPUnit_Framework_TestCase
{

	protected $spun;


	public function setUp()
	{
		$this->spun = new Spun;
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
		$str = $this->spun->removeAnchors('{Test String Here}');
		$this->assertInternalType('string', $str);
	}
}