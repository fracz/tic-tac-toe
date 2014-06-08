<?php
	namespace TicTacToe;
	require 'src/WinChecker.php';

	const INPUT = 'wins.txt';
	const X = 'x';
	const O = 'o';
	const NONE = '_';
	
	$input = file_get_contents(INPUT);
	$xWins = [];
	
	foreach(explode("\n", $input) as $line){
		if(!trim($line)) continue;
		$line = str_replace('b', NONE, $line);
		$winChecker = new WinChecker($line);
		$lineItems = explode(',', $line);
		array_pop($lineItems);
		if($winChecker->xWins()){
			$xWins[] = $lineItems;
		}
	}

    $stages = file_get_contents('all.txt');

    foreach(explode("\n", $stages) as $line){
        if(!trim($line)) continue;
        $winChecker = new WinChecker($line);
        if($winChecker->xWins() || $winChecker->oWins()) continue;
        $stage = explode(',', trim($line));
        $bestMove = 0;
        $bestSupport = -1;
        for($i = 0; $i < 9; $i++){
            if($stage[$i] != NONE) continue;
            $stage[$i] = X;
            $support = 0;
            foreach($xWins as $xWin){
                $match = true;
                for($j = 0; $j < 9; $j++){
                    if($stage[$j] != NONE && $stage[$j] != $xWin[$j]){
                        $match = false;
                        break;
                    }
                }
                if($match) ++ $support;
            }
            if($support > $bestSupport) {
                $bestSupport = $support;
                $bestMove = $i;
            }
            $stage[$i] = NONE;
        }
		$counts = array_count_values($stage);
		if(!isset($counts[O]))$counts[O] = 0;
		if(!isset($counts[X]))$counts[X] = 0;
		$kalaFix = abs($counts[O] - $counts[X]) <= 1;
        if($bestSupport >= 0 && $kalaFix)
            echo implode(',', $stage) . ',' . $bestMove . PHP_EOL;
    }