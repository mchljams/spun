<?php

namespace Mchljams\Spun;

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
    // the candidate string
    private $str;
    // array of choices from the original string
    private $choices = [];
    // opening anchor
    private $configuration;

    /**
     * @param String a canditate string
     * @param Configuration
     */
    public function __construct($str, Configuration $configuration)
    {
        // check to make sure input is a string
        if (!is_string($str)) {
            // if its not a string thow an exception
            throw new \Exception('Constructor first argument must be a string');
        }

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
     * @param String a candidate string
     *
     * @return String the string result with the opening and closing anchors removed
     */
    private function removeAnchors()
    {
        // trim opening character
        $str = trim($this->str, $this->configuration->getOpeningAnchor());
        // trim closing character
        $str = trim($str, $this->configuration->getClosingAnchor());
        // return the string without the opening and closing characters
        return $str;
    }

    /* takes a string separated by a specified separator and
    splits it, returns array of candidate strings */
    private function getChoices($candidate)
    {
        // convert string to array of choices
        $choices = explode($this->configuration->getSeparationCharacter(), $candidate);
        // return the array of choices
        return $choices;
    }

    public function original()
    {
        return $this->str;
    }

    public function choose()
    {
        // get a random index from the given array
        $index = array_rand($this->choices, 1);
        // return the choice
        return $this->choices[$index];
    }
}
