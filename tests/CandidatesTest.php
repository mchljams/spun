<?php

namespace Mchljams\Spun;

use PHPUnit\Framework\TestCase;
use Mchljams\Spun\Configuration;
use Mchljams\Spun\Candidate;
use Mchljams\Spun\Candidates;

class CandidatesTest extends TestCase
{
    /** @var Configuration */
    private $configuration;
    /** @var array */
    private $items = ["one","two"];
    /** @var string */
    private $input;
    /** @var Candidate */
    private $candidate;
    /** @var Candidates */
    private $candidates;

    public function setUp(): void
    {
        $this->configuration = new Configuration();

        // Make candidate string
        $str = $this->configuration->getOpeningAnchor() ;
        $str .= implode($this->configuration->getSeparationCharacter(), $this->items);
        $str .= $this->configuration->getClosingAnchor();

        $this->input = $str;

        $this->candidate = new Candidate($this->input, new Configuration());

        $this->candidates = new Candidates();

        $this->candidates->append($this->candidate);
    }

    public function tearDown(): void
    {
        $this->configuration = null;
        $this->items = null;
        $this->input = null;
        $this->candidate = null;
        $this->candidates = null;
    }

    public function testAppend()
    {
        $originalCount = $this->candidates->count();

        $this->candidates->append($this->candidate);

        $updatedCount = $this->candidates->count();

        $this->assertTrue($updatedCount > $originalCount);
    }

    public function testAll()
    {
        $this->assertSame(
            $this->candidate->original(),
            $this->candidates->all()[0]
        );
    }

    public function testChoices()
    {
        $this->assertTrue(in_array($this->candidates->choices()[0], $this->items));
    }
}
