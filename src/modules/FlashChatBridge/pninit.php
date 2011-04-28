<?php

function FlashChatBridge_init()
{
	$host = pnServerGetVar('HTTP_HOST');
	$protocol = pnServerGetProtocol();
	$adress = pnServerGetVar('SERVER_ADDR');
	$server = $protocol.'://'.$host;
	
	pnModSetVar('FlashChatBridge', 'width', 800);
	pnModSetVar('FlashChatBridge', 'height', 600);
	pnModSetVar('FlashChatBridge', 'autosize', 0);
	pnModSetVar('FlashChatBridge', 'client_path', $server.':35555/');
	pnModSetVar('FlashChatBridge', 'server_data_path', 'somewhere/123flashchat/server/data/');
	pnModSetVar('FlashChatBridge', 'init_room', 1);
	pnModSetVar('FlashChatBridge', 'client_type', "standard");	
	pnModSetVar('FlashChatBridge', 'active_chat_standard', 1);
	pnModSetVar('FlashChatBridge', 'init_host', $adress);
	pnModSetVar('FlashChatBridge', 'init_port', '51127');
	pnModSetVar('FlashChatBridge', 'init_host_s', $adress);
	pnModSetVar('FlashChatBridge', 'init_port_s', '');
	pnModSetVar('FlashChatBridge', 'init_host_h', $adress	);
	pnModSetVar('FlashChatBridge', 'init_port_h', '');
		
    return true;
}

function FlashChatBridge_upgrade($oldversion)
{
    return true;
}

function FlashChatBridge_delete()
{
	
    // Lösche alle Modulvariablen
    pnModDelVar('FlashChatBridge');

    // Fertig
    return true;
}

?>