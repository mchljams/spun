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
    /** @var string */
    private $str;
    /** @var Configuration */
    private $configuration;
    /**  @var Candidates */
    private $candidates;

    /**
     * @param string   $str  A string that may contain spintax
     * @param Configuration $configuration The spinner configuration
     *
     * @throws Exception if input is not a string
     * 
     * @return void
     */
    public function __construct(string $str, Configuration $configuration = null)
    {
        // check to make sure input is a string
        if (!is_string($str)) {
            // if its not a string thow an exception
            throw new \Exception('Constructor first argument must be a string');
        }
        
        $this->str = $str;

        $this->configuration = $configuration ?? new Configuration();

        $this->candidates = $this->discover($str);
    }

    /**
     * Finds the candidate strings from the original input string
     * 
     * @param string $str A string of text that may contain spintax
     * 
     * @return Candidates Object containing the original candidates and thier corresponding replacements
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
     * Makes the spintax replacements.
     * 
     * @return string The string result after spintax replacements are made.
     */
    public function spin(): string
    {
        return str_replace(
            $this->candidates->all(),
            $this->candidates->choices(),
            $this->str
        );
    }
}
