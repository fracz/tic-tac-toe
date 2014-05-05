<?php
	namespace TicTacToe;
	require 'src/WinChecker.php';

	const INPUT = 'wins.txt';
	const X = 'x';
	const O = 'o';
	const NONE = '_';
	
	$input = file_get_contents(INPUT);
	$results = [];
	
	foreach(explode("\n", $input) as $line){
		if(!trim($line)) continue;
		$line = str_replace('b', NONE, $line);
		$winChecker = new WinChecker($line);
		$lineItems = explode(',', $line);
		array_pop($lineItems);
		if($winChecker->xWins()){
			for($i = 0; $i < 9; $i++){
				if($lineItems[$i] != X) continue;
				$lineItems[$i] = NONE;
				$wc = new WinChecker($lineItems);
				if(!$wc->xWins()){
					$results[] = implode(',', $lineItems) . ',' . $i;
				}
				$lineItems[$i] = X;
			}
		}
		else{
			for($i = 0; $i < 9; $i++){
				if($lineItems[$i] != O) continue;
				$lineItems[$i] = NONE;
				$wc = new WinChecker($lineItems);
				if(!$wc->oWins()){
					$results[] = implode(',', $lineItems) . ',' . $i;
				}
				$lineItems[$i] = O;
			}
		}
	}
	shuffle($results);
	file_put_contents('data.txt', implode(PHP_EOL, $results));