class Spun {
	
	var $str;
	var type = 'random';

	var $opening_anchor = '{';
	var $closing_anchor = '}';
	var $separator_char	= '|';

	private var $oa   = $opening_anchor;
	private var $ca   = $closing_anchor;
	private var $sc   = separator_char;

	private var $candidates = null;

	/* removing opening and closing characters */
	function remove_anchors($str) {

		$str = trim(trim($str,$this->$oa), $this->$ca);

		return str;

	}

	/* Look through the input string for any spin candidates */
	function get_candidates($str) {

		// match groups in input string surrounded by anchor characters
		$pattern = "#\" . $oa . "[^" . $ca . "]*\" + $ca + "#s";
		preg_match_all($pattern, $str, $candidates); 

		return $candidates;

	}

	/* takes a string separated by a specified separator and splits it, returns array of
	function get_choices($candidate, $separator) {

		// convert string to array of choices
		$choices = explode("|",$candidate);

		return $choices;
	}

	/* get random string from array of strings */
	function choose_random($choices) {

		// get number of choices
		$num_choices = count($choices);

		// generate a random number based on the number of choices
		$random_number = (rand(1, $numWords)) - 1;

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
	function choose_word($choices, type = 'random') {

		$choice = call_user_func('choose' . $type, $choices);

		return $choice;
	}

	function spin() {

		// identify the candidate groups from the input string
		$candidates = self::get_candidates($this->str);

		// loop through candidates to make replacements
		foreach($candidates as $candidate){

			// remove anchor characters
			$candidate = remove_anchors($candidate);

			// get choices from candidate string
			$choices = self::get_choices($candidate, $this->sc);

			// get choice
			$choice = choose_word($choices, $this->type);

			// replace candidate string with choice
			$this->str = str_replace($candidate, $choice, $this->str);

		}

		return $this->str;
	}
}

//////////////
// how to use
/////////////

$spun = new Spun;

$spun->str = "This is a string that {includes|contains|holds} choices you can spin.";

$new_string = $spun->spin();