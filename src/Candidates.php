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

    public function append(Candidate $candidate): void
    {
        $this->items[] = $candidate;
    }

    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Returns an array of the original candidate strings
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
