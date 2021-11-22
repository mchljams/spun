<?php

namespace Mchljams\Spun;

use PHPUnit\Framework\TestCase;
use Mchljams\Spun\Configuration;
use Mchljams\Spun\Candidate;

class CandidateTest extends TestCase
{
    /** @var Configuration */
    private $configuration;
    /** @var array */
    private $items = ["one","two"];
    /** @var string */
    private $input;
    /** @var Candidate */
    private $candidate;

    public function setUp(): void
    {
        $this->configuration = new Configuration();

        // Make candidate string
        $str = $this->configuration->getOpeningAnchor() ;
        $str .= implode($this->configuration->getSeparationCharacter(), $this->items);
        $str .= $this->configuration->getClosingAnchor();

        $this->input = $str;

        $this->candidate = new Candidate($this->input, new Configuration());
    }

    public function tearDown(): void
    {
        $this->configuration = null;
        $this->items = null;
        $this->input = null;
        $this->candidate = null;
    }

    public function testOriginal()
    {
        $this->assertSame($this->input, $this->candidate->original());
    }

    public function testChoose()
    {
        $this->assertTrue(in_array($this->candidate->choose(), $this->items));
    }

    public function testConstructorFirstArgmentIsString()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Constructor first argument must be a string');
        $candidate = new Candidate(123, new Configuration());
    }
}
