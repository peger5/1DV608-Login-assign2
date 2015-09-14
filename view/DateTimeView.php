<?php

class DateTimeView {


	public function show() {
		date_default_timezone_set("Europe/Stockholm");
		$timeString = date("l") . ', the '. date("j") . 'th of ' . date("F") . ' ' . date("o") . ', The time is ' . date("G:i");
		
		return '<p>' . $timeString . '</p>';
	}
}