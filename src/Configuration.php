<?php

namespace Mchljams\Spun;

/**
 * Spinnter Configuration
 *
 * @copyright  2021 Michael James
 * @license    https://opensource.org/licenses/MIT   MIT
 * @link       https://github.com/mchljams/spun
 * @since      1.0.0
 */
class Configuration
{
    // opening anchor
    private $oa;
    // closing anchor
    private $ca;
    // separation character
    private $sc;

    public function __construct($oa = '{', $ca = '}', $sc = '|')
    {
        $this->oa = $oa;
        $this->ca = $ca;
        $this->sc = $sc;
    }

    public function getOpeningAnchor()
    {
        return $this->oa;
    }

    public function getClosingAnchor()
    {
        return $this->ca;
    }

    public function getSeparationCharacter()
    {
        return $this->sc;
    }
}
