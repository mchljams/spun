<?php

namespace Mchljams\Spun;

use PHPUnit\Framework\TestCase;
use Mchljams\Spun\Configuration;

class ConfigurationTest extends TestCase
{

    /** @var Configuration */
    private $configuration;

    public function setUp(): void
    {
        $this->configuration = new Configuration();
    }

    public function tearDown(): void
    {
        $this->configuration = null;
    }

    public function testDefaultOpeningAnchor()
    {
        $this->assertEquals('{', $this->configuration->getOpeningAnchor());
    }

    public function testDefaultClosingAnchor()
    {
        $this->assertEquals('}', $this->configuration->getClosingAnchor());
    }

    public function testDefaultSeparationCharacter()
    {
        $this->assertEquals('|', $this->configuration->getSeparationCharacter());
    }
}
