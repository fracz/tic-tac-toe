<?php
namespace TicTacToe;
	
abstract class Stage{
	protected $state;
	
	public function __construct($state){
		$this->state = is_array($state) ? $state : explode(',', trim($state));
		if(count($this->state) < 9)
			throw new \InvalidArgumentException("Cannot visualize input [$state].");
	}
}