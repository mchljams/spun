<?php

namespace Mchljams\Spun;

use Mchljams\Spun\Candidate;

/**
 * Spin string candidate.
 *
 * @copyright  2021 Michael James
 * @license    https://opensource.org/licenses/MIT   MIT
 * @link       https://github.com/mchljams/spun
 * @since      1.0.0
 */
class Candidates
{

    private $items = [];

    public function append(Candidate $candidate)
    {
        $this->items[] = $candidate;
    }


/**
 * Returns an array of the original candidate strings
 */
    public function candidates()
    {
        $candidates = [];

        foreach ($this->items as $item) {
            $candidates[] = $item->original();
        }

        return $candidates;
    }

/**
 * Returns an array of the choices from the candidates
 */
    public function choices()
    {
        $choices = [];

        foreach ($this->items as $item) {
            $choices[] = $item->choose();
        }

        return $choices;
    }
}
