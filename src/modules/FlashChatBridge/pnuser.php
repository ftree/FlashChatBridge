<?php

/**
 * User main page
 * @return HTML
 */
function FlashChatBridge_user_main()
{
    // perform permission check
    if (!SecurityUtil::checkPermission('FlashChatBridge::', '::', ACCESS_READ)) {
        return LogUtil::registerPermissionError();
    }    
    
	$render = &pnRender::getInstance('FlashChatBridge', false);
	
	$UserVars = pnUserGetVars(SessionUtil::getVar('uid'));

    $Users = pnModAPIFunc('FlashChatBridge',
						  'user',
						  'getChatterList');
	$count = count($Users);	
	
	$settings = pnModGetVar('FlashChatBridge');
	$settings['init_user'] = $UserVars['uname'];
	$settings['init_password'] = $UserVars['pass'];	    

	if ($settings['autosize'] == 1) {
		$settings['width'] = "100%";
		$settings['height']= "100%";
	}
	
	$render->assign('settings', $settings);	
	$render->assign('Users', 	$Users);
   	$render->assign('Count', 	$count);
   	
	return $render->fetch('flashchatbridge_user_main.htm');
	
}

function FlashChatBridge_user_showChat()
{
    // perform permission check
    if (!SecurityUtil::checkPermission('FlashChatBridge::', '::', ACCESS_READ)) {
        return LogUtil::registerPermissionError();
    }  
    	
    $popup 	= FormUtil::getPassedValue('popup', false);
	
	// Security check
	$render = &pnRender::getInstance('FlashChatBridge', false);
	
	$UserVars = pnUserGetVars(SessionUtil::getVar('uid'));
    $client_type = FormUtil::getPassedValue('client_type', 'standard');	
	
	$settings = pnModGetVar('FlashChatBridge');
	$settings['init_user'] = $UserVars['uname'];
	$settings['init_password'] = $UserVars['pass'];	    

	if ($settings['autosize'] == 1) {
		$settings['width'] = "100%";
		$settings['height']= "100%";
	}

	if ($popup) {
		$settings['width'] = "100%";
		$settings['height']= "100%";
		
		$render->assign('settings', $settings);
		$chat = $render->fetch("flashchatbridge_user_chat_$client_type.htm");						
		
		$render->assign('chat', 	$chat);		
		echo $render->fetch('flashchatbridge_user_popup.htm');
		exit; 
	} else {
		$render->assign('settings', $settings);
		return $render->fetch("flashchatbridge_user_chat_$client_type.htm");	
	}
	
}

?>
