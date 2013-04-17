<?php

/**
 * function columnize
 * 	For each item in $items, function calls $function passing $obj, $params
 * 
 * @param array $items
 * @param string $function
 * @param mixed $obj
 * @param array $params
 * @param array $columnBreaks
 */
function columnize(&$items, $function, &$obj, $params=null, $columnBreaks = array('first' => 12, 'second' => 50)) {
	$itemIt = 0;
	$itemCount = 0;
	$count = count($items);
	if ($columnBreaks['first'] > $count) {
		$columnCount = 1;
	} else if ($columnBreaks['second'] > $count) {
		$columnCount = 2;
	} else {
		$columnCount = 3;
	}

	for ($i=0; $i<$columnCount; ++$i) {
		if (1 != $columnCount) {
			echo "<div class=\"column";
			echo $i + 1;
			echo "of$columnCount\">";
		}

		if ($columnCount - 1 > $i) {
			$itemCount += ceil($count/$columnCount);
		} else {
			$itemCount += $count - ($columnCount-1)*ceil($count/$columnCount);
		}

		for (;$itemIt<$itemCount; ++$itemIt) {
			if ($params) {
				call_user_func($function, $obj, $items, $itemIt, $params);
			} else {
				call_user_func($function, $obj, $items, $itemIt);
			}
		}

		if (1 != $columnCount) {
			echo '</div>';
		}
	}
	
	return $columnCount;
}
?>