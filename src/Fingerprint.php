<?php
namespace Spun;

use Spun\Spun;

class Fingerprint {

  private $hash;
  private $sequence;

  function __construct(Spun $spun) {
    $this->hash = md5($spun->getStr());
    $this->sequence = $spun->getSequence();
	}

  public function compare($json) {
    $fingerprint = json_decode($json);
    if($fingerprint[0] == $this->hash) {
      return true;
    }

    return false;
  }

  public function get() {
    return json_encode(array($this->hash, $this->sequence));
  }

}
