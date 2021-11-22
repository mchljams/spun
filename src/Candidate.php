<?php

namespace Mchljams\Spun;

use Mchljams\Spun\Configuration;

/**
 * Spin string candidate.
 *
 * @copyright  2021 Michael James
 * @license    https://opensource.org/licenses/MIT   MIT
 * @link       https://github.com/mchljams/spun
 * @since      1.0.0
 */
class Candidate
{
    /** @var string */
    private $str;
    /** @var array */
    private $choices = [];
    /** @var Configuration */
    private $configuration;

    /**
     * @param string A canditate string
     * @param Configuration The spinner configuration
     *
     * @throws Exception if first input argument is not a string
     *
     * @return void
     */
    public function __construct($str, Configuration $configuration)
    {
        // check to make sure input is a string
        if (!is_string($str)) {
            // if its not a string thow an exception
            throw new \Exception('Constructor first argument must be a string');
        }
        // if no configuration provided create default instance
        $this->configuration = $configuration ?? new Configuration();
        // set the candidate string
        $this->str = $str;
        // get the choices as an array
        $this->choices = $this->getChoices($this->removeAnchors($str));
    }

    /**
     * Removes the opening and closing anchors,
     * then returns the resulting string
     *
     * @param string $str The original candidate string
     *
     * @return string the string result with the opening and closing anchors removed
     */
    private function removeAnchors($str): string
    {
        // trim opening character
        $str = trim($str, $this->configuration->getOpeningAnchor());
        // trim closing character
        $str = trim($str, $this->configuration->getClosingAnchor());
        // return the string without the opening and closing characters
        return $str;
    }

    /**
     * Takes a string separated by a specified separator and
     * splits it, returns array of candidate strings.
     *
     * @param string $str The original candidate string
     *
     * @return array The resulting choices from the candidate string
     */
    private function getChoices($candidate): array
    {
        // convert string to array of choices
        $choices = explode($this->configuration->getSeparationCharacter(), $candidate);
        // return the array of choices
        return $choices;
    }

    /**
     * Get the original candidate string.
     *
     * @return string The original candidate string
     */
    public function original(): string
    {
        return $this->str;
    }

    /**
     * Make the random choice from the candidate string
     *
     * @return string A random choice made from the candidate string
     */
    public function choose(): string
    {
        // get a random index from the given array
        $index = array_rand($this->choices, 1);
        // return the choice
        return $this->choices[$index];
    }
}
