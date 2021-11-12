<?php

namespace Mchljams\Spun;

use PHPUnit\Framework\TestCase;

class SpunTest extends TestCase
{

    public function setUp(): void
    {
        $this->one_group = "This is a string that {includes|contains|holds} choices you can spin.";
        $this->two_groups = "This is a {sentence|string} that {includes|contains|holds} choices you can spin.";
    }

    public function tearDown(): void
    {
    }

    public function testConstruct()
    {
        $this->expectExceptionMessage('You must start with a string.');
        $this->expectException('Exception');

        $spun = new Spun(array());
    }

    public function testGetStrReturnsString()
    {
        $spun = new Spun($this->one_group);
        $this->assertIsString($spun->getStr());
    }

    public function testGetSequenceReturnsArray()
    {
        $spun = new Spun($this->one_group);
        $this->assertIsArray($spun->getSequence());
    }

    public function testCombinationsReturnsInt()
    {
        $spun = new Spun($this->one_group);
        $this->assertIsInt($spun->combinations());
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
        $this->assertIsObject($spun->fingerprint());
    }

    public function testRepeatReturnsString()
    {
        $str = "This is a string that {includes|contains|holds} choices you can spin.";
        $spun = new Spun($str);
        $new_str = $spun->spin();
        $this->assertIsString($spun->repeat($spun->fingerprint()->get()));
    }

    public function testRepeatFingerprintException()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Fingerprint does not match');

        $str = "This is a string that {includes|contains|holds} choices you can spin.";
        $spun = new Spun($str);
        $spun->repeat(json_encode(array('this is not a fingerprint')));
    }
}
