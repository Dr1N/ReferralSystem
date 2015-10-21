<?php
/**
 * Created on 01 06 2012 (11:57 AM)
 *
 */

class jqCaption
{
	public static function caption($labelTest, $useNewLines = false) {
		$labelTest = strip_tags($labelTest);
		$labelTest = str_replace(' *', '', $labelTest);
		if ($useNewLines)
			$labelTest = str_replace(' ', '<br /> ', $labelTest);
		return $labelTest;
	}
}