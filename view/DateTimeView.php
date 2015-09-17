<?php
date_default_timezone_set("Europe/Stockholm");
class DateTimeView {


	public function show() {
		
		$timeString = date("l") . ', the '. date("j") . 'th of ' . date("F") . ' ' . date("o") . ', The time is ' . date("G:i");
		
		return '<p>' . $timeString . '</p>';
	}
}