<?php

namespace Mchljams\Spun;

/**
 * Spinner Configuration
 *
 * @copyright  2021 Michael James
 * @license    https://opensource.org/licenses/MIT   MIT
 * @link       https://github.com/mchljams/spun
 * @since      1.0.0
 */
class Configuration
{
    /** @var string */
    private $oa;
    /** @var string */
    private $ca;
    /** @var string */
    private $sc;

    /**
     * @param string $oa The opening anchor for the spintax string
     * @param string $ca The closing anchor for the spintax string
     * @param string $sc The separation character for the spintax string
     *
     * @return void
     */
    public function __construct($oa = '{', $ca = '}', $sc = '|')
    {
        $this->oa = $oa;
        $this->ca = $ca;
        $this->sc = $sc;
    }

    /**
     * Get the opening anchor for the spintax string
     *
     * @return string The opening anchor for the spintax string
     */
    public function getOpeningAnchor()
    {
        return $this->oa;
    }

    /**
     * Get the closing anchor for the spintax string
     *
     * @return string The closing anchor for the spintax string
     */
    public function getClosingAnchor()
    {
        return $this->ca;
    }

    /**
     * Get the separation character for the spintax string
     *
     * @return string The separation character for the spintax string
     */
    public function getSeparationCharacter()
    {
        return $this->sc;
    }
}
