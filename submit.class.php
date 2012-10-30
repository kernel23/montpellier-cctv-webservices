<?php
#
# Copyright 2012 tvass <kbour23@gmail.com>
#
# This file is part of montpellier-cctv-webservices.
# https://github.com/tvass/montpellier-cctv-webservices
#	
# This is free software: you can redistribute it and/or modify it under the
# terms of the GNU General Public License as published by the Free Software
# Foundation, either version 3 of the License, or (at your option) any later
# version.
#
# This is distributed in the hope that it will be useful, but WITHOUT ANY
# WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
# FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
# details.
#
# You should have received a copy of the GNU General Public License along
# withit. If not, see http://www.gnu.org/licenses/.
# 
#

class Submit {

	var $desc;
	var $lat;
	var $long;

	function __construct($myarray) {
		$this->desc = $myarray['desc'];
		$this->lat = $myarray['lat'];
		$this->long = $myarray['long'];
	}

	function validate() {

		$sec = 0;
		
		if (! preg_match("/^[a-zA-Z0-9\.\ \+êéàèìòù\']+$/",$this->desc))
		{ $sec=1; }

		if (! preg_match("/^(-?\d{1,2}\.\d{6})/",$this->lat))
		{ $sec=1; }

		if (! preg_match("/^(-?\d{1,2}\.\d{6})/",$this->long))
		{ $sec=1; }

		if($sec==1) {
			return false;
		}	
		else{
			return true;
		}
	}

	function save() 
	{
		include_once("conf.php");
		$db = mysql_connect($host, $user, $password)
		or die('Erreur de connexion '.mysql_error());
		 
		mysql_select_db($database,$db);
		
		$sql = "INSERT INTO submit
			VALUES(
				'',
				'".$this->lat."',
				'".$this->long."',
				'".addslashes($this->desc)."'
			)";
		mysql_query($sql)
		or die('Erreur SQL !'.mysql_error()); 

		mysql_close();
	}
}

?>
