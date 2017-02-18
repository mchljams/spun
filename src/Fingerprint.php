<?php
namespace Mchljams\Spun;

use Mchljams\Spun\Spun;

class Fingerprint
{
    // hashed string from spun object
    private $hash;
    // sequence array from spun object
    private $sequence;

    public function __construct(Spun $spun)
    {
        // hash the string from the spun object
        $this->hash = md5($spun->getStr());
        // set the sequence form the spun object
        $this->sequence = $spun->getSequence();
    }

    public function compare($json)
    {
        // convert the json back to array
        $fingerprint = json_decode($json);
        // compare the hash (in the first index) of the input
        // hash of the fingerprint of the instance of the fingerprint
        if ($fingerprint[0] == $this->hash) {
            // if the fingerprints match return true
            return true;
        }
        // if the fingerprints dont match return false
        return false;
    }

    public function get()
    {
        // return a json encoded array with the has in the first
        // index and the sequence in the secon index
        return json_encode(array($this->hash, $this->sequence));
    }
}
