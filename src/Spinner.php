<?php

namespace Mchljams\Spun;

use Mchljams\Spun\Configuration;
use Mchljams\Spun\Candidates;
use Mchljams\Spun\Candidate;

/**
 * Spin string candidate.
 *
 * @copyright  2021 Michael James
 * @license    https://opensource.org/licenses/MIT   MIT
 * @link       https://github.com/mchljams/spun
 * @since      1.0.0
 */
class Spinner
{
    // the string containing spintax
    private $str;

    private $configuration;

    private $candidates;

    /**
     * @param string   $str  A string that may contain spintax
     *
     * @throws Exception if input is not a string
     */
    public function __construct($str, Configuration $configuration = null)
    {
        $this->str = $str;

        $this->configuration = $configuration ?? new Configuration();

        $this->candidates = $this->discover($str);
    }

    /**
     * gets the replacement candidate strings
     */
    private function discover(string $str): Candidates
    {
        // get opening and closing anchors from configuration
        $oa = $this->configuration->getOpeningAnchor();
        $ca = $this->configuration->getClosingAnchor();
        // pattern for matching replacement strings
        $pattern = '#' . $oa . '[^' . $ca . ']*' . $ca . '#s';  // default: #\{[^}]*\}#s;
        // match groups in input string surrounded by anchor characters
        preg_match_all($pattern, $str, $matches);
        // new instance of the Candidates object
        $candidates = new Candidates();
        // loop through the matches
        foreach ($matches[0] as $match) {
            // new instance of a canditade object
            $candidate = new Candidate($match, $this->configuration);
            // append the candidate to the candidates object
            $candidates->append($candidate);
        }
        // return the candidates
        return $candidates;
    }

    /**
     * takes the candidate replacement strings and choices, and makes the replacements
     * returns the modified string
     */
    public function spin(): string
    {
        return str_replace(
            $this->candidates->candidates(),
            $this->candidates->choices(),
            $this->str
        );
    }
}
