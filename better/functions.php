<?php
// Genreate Random name for the image
	function randomname($number) {
		$charcators = "1234456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
		$str = "";
		for($i = 0 ; $i < $number ; $i++) {
			$random = rand(0 , strlen($charcators) - 1);
			$str .= $charcators[$random];
		}
		return $str;

	}
