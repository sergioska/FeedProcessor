<?php

class Utils{

	public static function cutAndCleanDescription($sDesc){
		return substr(strip_tags($sDesc), 0, 300);
	}

}