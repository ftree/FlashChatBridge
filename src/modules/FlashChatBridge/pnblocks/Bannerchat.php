<?php

/**
 * initialise block
 *
 */
function FlashChatBridge_Bannerchatblock_init()
{
    pnSecAddSchema('FlashChatBridge:Bannerchatblock:', '::');
}

/**
 * get information on block
 *
 * @return       array       The block information
 */
function FlashChatBridge_Bannerchatblock_info()
{
    // block informations
    return array('module'         => 'FlashChatBridge',
                 'text_type'      => 'BannerchatBlock',
                 'text_type_long' => 'Bannerchat',
                 'allow_multiple' => false,
                 'form_content'   => false,
                 'form_refresh'   => false,
                 'show_preview'   => false,
                 'admin_tableless' => true);
    

}

/**
 * display block
 *
 * @param        array       $blockinfo     a blockinfo structure
 * @return       output      the rendered bock
 */
function FlashChatBridge_Bannerchatblock_display($blockinfo)
{
    if (!SecurityUtil::checkPermission('FlashChatBridge:Bannerchatblock:', "::", ACCESS_READ)) {
        return false;
    }	
	
    if (!pnModAvailable('FlashChatBridge') || !pnUserLoggedIn() ) {
        return false;
    }

    $render = pnRender::getInstance('FlashChatBridge',false);

	$UserVars = pnUserGetVars(SessionUtil::getVar('uid'));

	$settings = pnModGetVar('FlashChatBridge');
	$settings['init_user'] 		= $UserVars['uname'];
	$settings['init_password'] 	= $UserVars['pass'];	      
	$settings['width'] 			= "100%";
	$settings['height']			= "150";	
	$render->assign('settings', $settings);
    
	$blockinfo['content'] = $render->fetch('flashchatbridge_user_chat_banner.htm');
	return pnBlockThemeBlock($blockinfo);

}