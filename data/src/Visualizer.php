<?php
namespace TicTacToe;
require_once 'stage.php';

class Visualizer extends Stage{
	public function render(){
		$r = PHP_EOL;
		$r .= $this->state[0] . $this->state[2] . $this->state[2] . PHP_EOL;
		$r .= $this->state[3] . $this->state[4] . $this->state[5] . PHP_EOL;
		$r .= $this->state[6] . $this->state[7] . $this->state[8] . PHP_EOL;
		$r .= PHP_EOL;
		return $r;
	}
	
	public function __toString(){
		return $this->render();
	}
}