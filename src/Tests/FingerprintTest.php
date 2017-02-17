<?php

namespace Mchljams\Spun;

class FingerprintTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function tearDown()
    {
    }

    public function testCompareReturnsBoolean()
    {
        $str = "This is a string that {includes|contains|holds} choices you can spin.";
        $spun = new Spun($str);
        $spun_fingerprint = $spun->fingerprint()->get();

        $fingerprint = new Fingerprint($spun);
        $this->assertInternalType('boolean', $fingerprint->compare($spun_fingerprint));
    }

    public function testCompareReturnsTrue()
    {
        $str = "This is a string that {includes|contains|holds} choices you can spin.";
        $spun = new Spun($str);
        $spun_fingerprint = $spun->fingerprint()->get();

        $fingerprint = new Fingerprint($spun);
        $this->assertTrue($fingerprint->compare($spun_fingerprint));
    }

    public function testCompareReturnsFalse()
    {
        $str1 = "This is a string that {includes|contains|holds} choices you can spin.";
        $spun1 = new Spun($str1);
        $fingerprint1 = new Fingerprint($spun1);

        $str2 = "This is a {sentence|string} that {includes|contains|holds} choices you can spin.";
        $spun2 = new Spun($str2);
        $fingerprint2 = new Fingerprint($spun2);

        $this->assertFalse($fingerprint1->compare($fingerprint2->get()));
    }
}
