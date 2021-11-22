<?php

namespace Mchljams\Spun;

use PHPUnit\Framework\TestCase;
use Mchljams\Spun\Configuration;
use Mchljams\Spun\Spinner;

class SpinnerTest extends TestCase
{
    /** @var Configuration */
    private $configuration;
    /** @var array */
    private $items = ["one","two"];

    private $candidateStr;

    private $loremIpsum;

    private $str;

    private $spinner;

    public function setUp(): void
    {
        $this->configuration = new Configuration();
        // Make candidate string
        $candidateStr = $this->configuration->getOpeningAnchor() ;
        $candidateStr .= implode($this->configuration->getSeparationCharacter(), $this->items);
        $candidateStr .= $this->configuration->getClosingAnchor();

        $this->candidateStr = $candidateStr;

        $this->loremIpsum = file_get_contents(dirname(__FILE__) . '/data/loremipsum.txt');

        $this->str = substr_replace(
            $this->loremIpsum,
            $candidateStr,
            strlen($this->loremIpsum) / 2
        );

        $this->spinner = new Spinner($this->str);
    }

    public function tearDown(): void
    {
        $this->configuration = null;
        $this->items = null;
        $this->candidateStr = null;
        $this->loremIpsum = null;
        $this->str = null;
        $this->spinner = null;
    }

    public function testConstructorFirstArgmentIsString()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Constructor first argument must be a string');
        $spinner = new Spinner(123);
    }

    public function testSpin()
    {
        $this->assertTrue(str_contains($this->str, $this->candidateStr));
        $this->assertFalse(str_contains($this->spinner->spin(), $this->candidateStr));
    }
}
