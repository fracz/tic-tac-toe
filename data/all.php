<?php
$chars = ['_','x','o'];
for($i = 0; $i < 19683; ++$i)
{
    $c = $i;
	$board = [];
    for ($j = 0; $j < 9; $j++)
    {
        $board[] = $chars[$c % 3];
        $c /= 3;
    }
	echo implode(',', $board);
	echo PHP_EOL;
}