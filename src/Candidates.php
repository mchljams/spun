<?php

namespace Mchljams\Spun;

use Mchljams\Spun\Candidate;

/**
 * Object to collect candidate objects.
 *
 * @copyright  2021 Michael James
 * @license    https://opensource.org/licenses/MIT   MIT
 * @link       https://github.com/mchljams/spun
 * @since      1.0.0
 */
class Candidates
{
    /** @var array */
    private $items = [];

    /**
     * Add a candidate to the collection
     *
     * @return void
     */
    public function append(Candidate $candidate): void
    {
        $this->items[] = $candidate;
    }

    /**
     * Count the candidates added to the collection
     *
     * @return int The number of candidates in the collection
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Returns an array of the original candidate strings
     *
     * @return array An array of the original candidate strings
     */
    public function all(): array
    {
        $candidates = [];

        foreach ($this->items as $item) {
            $candidates[] = $item->original();
        }

        return $candidates;
    }

    /**
     * Returns an array of the choices from the candidates
     *
     * @return array An array of the choices made from the original candidate strings
     */
    public function choices(): array
    {
        $choices = [];

        foreach ($this->items as $item) {
            $choices[] = $item->choose();
        }

        return $choices;
    }
}
