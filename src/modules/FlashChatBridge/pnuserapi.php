<?php
function FlashChatBridge_userapi_getChatters()
{
	
	$chat_data_path = pnModGetVar('FlashChatBridge','server_data_path');
	
	$room = array ();
	$room ['connections'] = 0;
	$room ['logon_users'] = 0;
	$room ['room_numbers'] = 0;
	
	$online_file = $chat_data_path . "online.txt";
	
	if (! file_exists ( $online_file )) {
		return $room;
	}
	
	if (! $row = file ( $online_file )) {
		return $room;
	}
	
	$room_data = explode ( "|", $row [0] );
	
	if (count ( $room_data ) == 3) {
		$room ['connections'] = intval ( $room_data [0] );
		$room ['logon_users'] = intval ( $room_data [1] );
		$room ['room_numbers'] = intval ( $room_data [2] );
	}
	
	return $room;
}

function FlashChatBridge_userapi_getChatterList()
{
	
	$chat_data_path = pnModGetVar('FlashChatBridge','server_data_path').'default/';
	$userList = array();
	
	$d = dir ( $chat_data_path );
	while ( false !== ($entry = $d->read ()) ) {
		//$rest = substr ( $entry, 0, 5 );
		//if ($rest == "room_") {		
		$rest = substr ( $entry, 0, 6 );
		if ($rest == "room_1") {
			if (file_exists ( $chat_data_path . $entry )) {
				$f_users = file ( $chat_data_path . $entry );
				for($i = 0; $i < count ( $f_users ); $i ++) {
					$f_line = trim ( $f_users [$i] );
					if ($f_line != "") {
						$userList[] = $f_line;
					}
				}
			
			}
		}
	
	}
	$d->close ();
/*	
	if (count($userList) == 0) {
		$userList[] = __("keiner");
	}
*/
	return $userList;
}

?>