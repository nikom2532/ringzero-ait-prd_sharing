<?php 
class String_Management{

	function startsWith($haystack, $needle)
	{
	    return $needle === "" || strpos($haystack, $needle) === 0;
	}
	function endsWith($haystack, $needle)
	{
	    return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
	}
}

