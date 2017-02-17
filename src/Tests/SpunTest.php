<?php

namespace Spun;

class SpunTest extends \PHPUnit_Framework_TestCase
{

  public function setUp()
  {
    $this->one_group = "This is a string that {includes|contains|holds} choices you can spin.";
    $this->two_groups = "This is a {sentence|string} that {includes|contains|holds} choices you can spin.";
  }

  public function tearDown()
  {

  }

  public function testGetStrReturnsString()
  {
    $spun = new Spun($this->one_group);
    $this->assertInternalType('string', $spun->getStr());
  }

  public function testGetSequenceReturnsArray()
  {
    $spun = new Spun($this->one_group);
    $this->assertInternalType('array', $spun->getSequence());
  }

  public function testCombinationsReturnsInt()
  {
    $spun = new Spun($this->one_group);
    $this->assertInternalType('int', $spun->combinations());
  }

  public function testCombinationsReturnsCorrectTotalNoGroups()
  {
    $spun = new Spun('String with no spintax');
    $this->assertEquals($spun->combinations(), 1);
  }

  public function testCombinationsReturnsCorrectTotalForOneGroup()
  {
    $spun = new Spun($this->one_group);
    $this->assertEquals($spun->combinations(), 3);
  }

  public function testCombinationsReturnsCorrectTotalForTwoGroups()
  {
    $spun = new Spun($this->two_groups);
    $this->assertEquals($spun->combinations(), 6);
  }

  public function testFingerprintReturnsObject()
  {
    $spun = new Spun($this->one_group);
    $this->assertInternalType('object', $spun->fingerprint());
  }

  //left off at fingerprint method
}
