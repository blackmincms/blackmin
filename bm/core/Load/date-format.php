<?php	
/**
*	"Black Min" 
*	
*	For the full copyright and license information, please view the LICENSE
*	file that was distributed with this source code.
*
*	@package BlackMin
*	
*	#plik: 2.0
*
*	This function a format data
*/
	
	function data_format($datetime, $foramt_czasu) {
		
		$date = date_create($datetime);
		
		$datetime_format = date_format($date, $foramt_czasu);
		
		return $datetime_format;
		
	};