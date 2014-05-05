<?php
namespace TicTacToe;

require_once 'stage.php';
class WinChecker extends Stage {
	public function xWins(){
		return $this->charWins('x');
	}
	
	public function oWins(){
		return $this->charWins('o');
	}
	
	private function charWins($char){
		return $this->checkCharInStates($char, 0, 1, 2) ||
			$this->checkCharInStates($char, 3, 4, 5) ||
			$this->checkCharInStates($char, 6, 7, 8) ||
			$this->checkCharInStates($char, 0, 3, 6) ||
			$this->checkCharInStates($char, 1, 4, 7) ||
			$this->checkCharInStates($char, 2, 5, 8) ||
			$this->checkCharInStates($char, 0, 4, 8) ||
			$this->checkCharInStates($char, 2, 4, 6);
	}
	
	private function checkCharInStates($char, $state1, $state2, $state3){
		return $this->state[$state1] == $char &&
			$this->state[$state2] == $char &&
			$this->state[$state3] == $char;
	}
}