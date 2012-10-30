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

include_once("submit.class.php");

function SendOk() {
	header('HTTP/1.1 200 OK');
}

function SendKo() {
	header('HTTP/1.1 403 Forbidden');
}

try {	
	$mySubmit = new Submit($_POST);

	if($mySubmit->validate()){
		$mySubmit->save();	
		SendOk();
	}else{
		SendKo();
	}
}
catch (Exception $e) {
	SendKo();
}

?>
