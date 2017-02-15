<?php

class Spun {

	private $str;
	private $type = 'random';

	// opening anchor
	private $oa = '{';
	// closing anchor
	private $ca = '}';
	// separation character
	private $sc = '|';

	function __construct($str, $type = 0) {
		// set the string
		$this->str = $str;
	}

	/* removing opening and closing characters */
	private function removeAnchors($str) {
		// trim opening char
		$str = trim($str, $this->oa);
		// trim closing char
		$str = trim($str, $this->ca);

		return $str;
	}

	/* Look through the input string for any spin candidates */
	private function getCandidates($str) {
		// paatter for matching replacement strings
		// $pattern = '#\{[^}]*\}#s';
		$pattern = '#' . $this->oa . '[^' . $this->ca . ']*' . $this->ca . '#s';
		// match groups in input string surrounded by anchor characters
		preg_match_all($pattern, $str, $candidates);
		// return just the matches
		return $candidates[0];

	}

	/* takes a string separated by a specified separator and splits it, returns array of candidate strings */
	private function getChoices($candidate, $separator) {
		// convert string to array of choices
		$choices = explode($this->sc, $candidate);

		return $choices;
	}

	/* get random string from array of strings */
	private function chooseRandom($choices) {
		// get number of choices
		$num_choices = count($choices);
		// generate a random number based on the number of choices
		$random_number = (rand(1, $num_choices)) - 1;
		// make a choice from the array
		$choice = $choices[$random_number];

		return $choice;
	}

	private function chooseFirst($choices) {

		$choice = reset($choices);

		return $choice;

	}

	private function chooseLast($choices) {

		$choice = end($choices);

		return $choice;
	}

	/* for now just use random, but will be configurable for other options */
	private function chooseWord($choices, $type = 'Random') {
		// choose function determined by type input
		$choice = call_user_func(array($this, 'choose' . $type), $choices);
		// return the selected choice
		return $choice;
	}

	public function spin() {
		// identify the candidate groups from the input string
		$candidates = self::getCandidates($this->str);
		// variable to hold new string as changes are made
		$new_str = $this->str;
		// loop through candidates to make replacements
		foreach($candidates as $key => $candidate){
			// store candidate match with anchor characters for replacement
			$match_candidate = $candidate;
			// remove anchor characters
			$candidate = self::removeAnchors($candidate);
			// get choices from candidate string
			$choices = self::getChoices($candidate, $this->sc);
			// get choice
			$choice = self::chooseWord($choices, $this->type);
			// replace candidate string with choice
			$new_str = str_replace($match_candidate, $choice, $new_str);
		}
		// return the string with all substitutions made
		return $new_str;
	}
}

?>
