<?php
	namespace TicTacToe;
	require 'src/Visualizer.php';
	
	$line = $argv[1];
	
	echo new Visualizer($line);
	
	$lineItems = explode(',', $line);
	$last = end($lineItems);
	if(is_numeric($last)){
		$lineItems[$last] = 'x';
		echo " ||\n ||\n \\/\n";
		echo new Visualizer($lineItems);
	}