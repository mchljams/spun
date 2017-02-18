<?php
namespace Mchljams\Spun;

use Mchljams\Spun\Fingerprint;

/**
 * This class parses a strign containing spintax syntax.
 *
 * @copyright  2017 Michael James
 * @license    https://opensource.org/licenses/MIT   MIT
 * @link       https://github.com/mchljams/spun
 * @since      Class available since Release 0.0.1
 */
class Spun
{
    // the string containing spintax
    private $str;
    // array to add sequence numbers into
    private $sequence = array();
    // opening anchor
    private $oa = '{';
    // closing anchor
    private $ca = '}';
    // separation character
    private $sc = '|';

    /**
     * Does something interesting
     *
     * @param string   $str  A string that may contain spintax
     *
     * @throws Exception if input is not a string
     */
    public function __construct($str = null)
    {
        // check to make sure input is a string
        if (!is_string($str)) {
            // if its not a string thow an exception
            throw new \Exception('You must start with a string.');
        }
        // set the string
        $this->str = $str;
    }

    public function getStr()
    {
        // return the string set when the object was instantiated
        return $this->str;
    }

    public function getSequence()
    {
        // return the sequence array
        return $this->sequence;
    }

    /* removing opening and closing characters */
    private function removeAnchors($str)
    {
        // trim opening character
        $str = trim($str, $this->oa);
        // trim closing character
        $str = trim($str, $this->ca);
        // return the string without the opening and closing characters
        return $str;
    }

    /* Look through the input string for any spin candidates */
    private function getCandidates($str)
    {
        // paatter for matching replacement strings
        // $pattern = '#\{[^}]*\}#s';
        $pattern = '#' . $this->oa . '[^' . $this->ca . ']*' . $this->ca . '#s';
        // match groups in input string surrounded by anchor characters
        preg_match_all($pattern, $str, $candidates);
        // return just the matches
        return $candidates[0];
    }

    /* takes a string separated by a specified separator and
    splits it, returns array of candidate strings */
    private function getChoices($candidate, $separator)
    {
        // convert string to array of choices
        $choices = explode($this->sc, $candidate);
        // return the array of choices
        return $choices;
    }

    /* get random string from array of strings */
    private function chooseRandom($choices)
    {
        // get number of choices
        $num_choices = count($choices);
        // generate a random number based on the number of choices
        $random_number = (rand(1, $num_choices)) - 1;
        // make a choice from the array
        $choice = $choices[$random_number];
        // add choice index into fingerprint
        $this->sequence[] = $random_number;
        // returns the single choice string
        return $choice;
    }

    private function getChoicesAsArray()
    {
        // get the array of choices strings
        $candidates = self::getCandidates($this->str);
        // create empty array to fill with all choices
        $choices = [];
        // loop through candidates and add each group of choices as array
        foreach ($candidates as $key => $candidate) {
            // remove anchor characters
            $candidate = self::removeAnchors($candidate);
            // get choices from candidate string
            $choices[] = self::getChoices($candidate, $this->sc);
        }
        // return a multidimentional array of all choices from the string
        return $choices;
    }

    /**
     * Calculate by Rule of Product
     */
    public function combinations()
    {
        // initialze at 1 because object must always be instatiated with a string
        $total = 1;
        // get the choices as an array so it is easy to loop through
        $choices = self::getChoicesAsArray();
        // loop through the choices
        foreach ($choices as $choice) {
            // multiply the total by number in each set
            $total = $total * count($choice);
        }
        // return the total number of combinations
        return $total;
    }

    public function fingerprint()
    {
        // instantiate a new fingerprint object using the
        // current instance of this object
        return new Fingerprint($this);
    }

    public function repeat($json)
    {
        // make sure the fingerprint being used matches the string this
        // instance of the object was created with
        if ($this->fingerprint()->compare($json)) {
            // convery json back into php array
            $fingerprint = json_decode($json);
            // the sequence is the second item in the array
            $sequence = $fingerprint[1];
            // identify the candidate groups from the input string
            $candidates = self::getCandidates($this->str);
            // variable to hold new string as changes are made
            $new_str = $this->str;
            // loop through candidates to make replacements
            foreach ($candidates as $key => $candidate) {
                // store candidate match with anchor characters for replacement
                $match_candidate = $candidate;
                // remove anchor characters
                $candidate = self::removeAnchors($candidate);
                // get choices from candidate string
                $choices = self::getChoices($candidate, $this->sc);
                // get choice
                $choice = $choices[$sequence[$key]];
                // replace candidate string with choice
                $new_str = str_replace($match_candidate, $choice, $new_str);
            }
            // return the string with all substitutions made
            return $new_str;
        } else {
            throw new \Exception('Fingerprint does not match');
        }
    }

    public function spin()
    {
        // identify the candidate groups from the input string
        $candidates = self::getCandidates($this->str);
        // variable to hold new string as changes are made
        $new_str = $this->str;
        // loop through candidates to make replacements
        foreach ($candidates as $key => $candidate) {
            // store candidate match with anchor characters for replacement
            $match_candidate = $candidate;
            // remove anchor characters
            $candidate = self::removeAnchors($candidate);
            // get choices from candidate string
            $choices = self::getChoices($candidate, $this->sc);
            // get choice
            $choice = self::chooseRandom($choices);
            // replace candidate string with choice
            $new_str = str_replace($match_candidate, $choice, $new_str);
        }
        // return the string with all substitutions made
        return $new_str;
    }
}
