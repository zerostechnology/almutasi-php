<?php

namespace Almutasi\Support;

use DateTime;

class Helper
{
	public static function iso8601(int $timestamp = 0)
	{
		$timestamp = empty($timestamp) ? time() : $timestamp;
		
		$dt = new DateTime();
		return $dt->setTimestamp($timestamp)->format('Y-m-d\TH:i:sP');
	}
}