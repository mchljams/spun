<?php

class Spun {
	
	public $str;
	public $type = 'random';

	public $opening_anchor = '{';
	public $closing_anchor = '}';
	public $separator_char = '|';

	// Define shorter names for interal use
	private $oa;
	private $ca;
	private $sc;

	private $candidates = null;


	function __construct() {

		$this->oa = $this->opening_anchor;
		$this->ca = $this->closing_anchor;
		$this->sc = $this->separator_char;	

	} 

	/* removing opening and closing characters */
	function remove_anchors($str) {

		// trim opening char
		$str = trim($str, $this->oa);
		// trim closing char
		$str = trim($str, $this->ca);

		return $str;

	}

	/* Look through the input string for any spin candidates */
	function get_candidates($str) {

		// paatter for matching replacement strings
		// $pattern = '#\{[^}]*\}#s';
		$pattern = '#' . $this->oa . '[^' . $this->ca . ']*' . $this->ca . '#s';
		
		// match groups in input string surrounded by anchor characters
		preg_match_all($pattern, $str, $candidates); 
		// return just the matches
		return $candidates[0];

	}

	/* takes a string separated by a specified separator and splits it, returns array of */
	function get_choices($candidate, $separator) {

		// convert string to array of choices
		$choices = explode($this->sc, $candidate);

		return $choices;
	}

	/* get random string from array of strings */
	function choose_random($choices) {

		// get number of choices
		$num_choices = count($choices);

		// generate a random number based on the number of choices
		$random_number = (rand(1, $num_choices)) - 1;

		// make a choice from the array
		$choice = $choices[$random_number];

		return $choice;

	}

	function choose_first($choices) {

		$choice = reset($choices);

		return $choice;

	}

	function choose_last($choices) {

		$choice = end($choices);

		return $choice;
	}

	/* for now just use random, but will be configurable for other options */
	function choose_word($choices, $type = 'random') {

		$choice = call_user_func(array($this, 'choose_' . $type), $choices);

		return $choice;
	}

	function spin() {

		// identify the candidate groups from the input string
		$candidates = self::get_candidates($this->str);

		// loop through candidates to make replacements
		foreach($candidates as $key => $candidate){

			// store candidate match with anchor characters for replacement
			$match_candidate = $candidate;

			// remove anchor characters
			$candidate = self::remove_anchors($candidate);

			// get choices from candidate string
			$choices = self::get_choices($candidate, $this->sc);

			// get choice
			$choice = self::choose_word($choices, $this->type);

			// replace candidate string with choice
			$this->str = str_replace($match_candidate, $choice, $this->str);

		}

		return $this->str;
	}
}

?>