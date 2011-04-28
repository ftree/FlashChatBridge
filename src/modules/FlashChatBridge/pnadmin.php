<?php
/**
 * Admin main page
 * @return HTML
 */
function FlashChatBridge_admin_main()
{
    // Security check
    if (!SecurityUtil::checkPermission( 'FlashChatBridge::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }

	$render = &pnRender::getInstance('FlashChatBridge', false);
	
	return $render->fetch('flashchatbridge_admin_main.htm');	
}

function FlashChatBridge_admin_modifyconfig()
{
    // Security check
    if (!SecurityUtil::checkPermission( 'FlashChatBridge::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }

	$render = &pnRender::getInstance('FlashChatBridge', false);

    $configvars = pnModGetVar('FlashChatBridge');
    
    $render->assign('settings', $configvars);	
	
	return $render->fetch('flashchatbridge_admin_modifyconfig.htm');
}

/**
 * Update 123FlashChat Settings
 *
 * @author Tree Florian
 * @return mixed true if successful, false if unsuccessful, error string otherwise
 */
function FlashChatBridge_admin_updateconfig() {

    // Security check
    if (!SecurityUtil::checkPermission( 'FlashChatBridge::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }

    // get settings from form - do before authid check
    $settings = FormUtil::getPassedValue('settings', null, 'POST');

    // if this form wasnt posted to redirect back
    if ($settings === NULL) {
        return pnRedirect(pnModURL('Settings', 'admin', 'modifyconfig'));
    }
/*
    // confirm the forms auth key
    if (!SecurityUtil::confirmAuthKey()) {
        return LogUtil::registerAuthidError();
    }
*/

	$lastchar = substr($settings['client_path'],-1);
	if ($lastchar != "\\" && $lastchar != "/" && $settings['client_path'] != "") {
		$settings['client_path'] = $settings['client_path']."/";
	}

	$settings['server_data_path'] = str_replace("\\","/",$settings['server_data_path']);
	$lastchar = substr($settings['server_data_path'],-1);
	if ($lastchar != "\\" && $lastchar != "/" && $settings['client_path'] != "") {
		$settings['server_data_path'] = $settings['server_data_path']."/";
	}	
	
	
	$settings['active_chat_standard'] 	= $settings['active_chat_standard'] == 1 ? 1 : 0;
	$settings['active_chat_html'] 		= $settings['active_chat_html'] 	== 1 ? 1 : 0;
	$settings['active_chat_avatar'] 	= $settings['active_chat_avatar'] 	== 1 ? 1 : 0;
	$settings['active_chat_live'] 		= $settings['active_chat_live'] 	== 1 ? 1 : 0;
	$settings['active_chat_pocket'] 	= $settings['active_chat_pocket'] 	== 1 ? 1 : 0;
	$settings['active_chat_lite'] 		= $settings['active_chat_lite'] 	== 1 ? 1 : 0;
	$settings['active_chat_banner'] 	= $settings['active_chat_banner'] 	== 1 ? 1 : 0;					

	
    // Write the vars
    //$configvars = pnModGetVar('FlashChatBridge');
    foreach($settings as $key => $value) {
    	pnModSetVar('FlashChatBridge',$key, $value);
    }    
    
    //$configvars = pnModGetVar('FlashChatBridge');
    // Let any other modules know that the modules configuration has been updated
    pnModCallHooks('module','updateconfig','FlashChatBridge', array('module' => 'FlashChatBridge'));

    return pnRedirect(pnModURL('FlashChatBridge', 'admin', 'modifyconfig'));    
    
}

/**
 * 123FlashChat Admin main page
 * @return HTML
 */
function FlashChatBridge_admin_flashchatadmin()
{
    // Security check
    if (!SecurityUtil::checkPermission( 'FlashChatBridge::', '::', ACCESS_ADMIN)) {
        return LogUtil::registerPermissionError();
    }
    	
	$render = &pnRender::getInstance('FlashChatBridge', false);
    
	$UserVars = pnUserGetVars(SessionUtil::getVar('uid'));
	
	$settings = pnModGetVar('FlashChatBridge');
	$settings['init_user'] = $UserVars['uname'];
	$settings['init_password'] = $UserVars['pass'];	    

	if ($settings['autosize'] == 1) {
		$settings['width'] = "100%";
		$settings['height']= "100%";
	}
	
	$render->assign('settings', $settings);	
	
	return $render->fetch('flashchatbridge_admin_flashchatadmin.htm');
}

?>
