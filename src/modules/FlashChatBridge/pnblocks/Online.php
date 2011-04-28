<?php

/**
 * initialise block
 *
 */
function FlashChatBridge_Onlineblock_init()
{
    pnSecAddSchema('FlashChatBridge:Onlineblock:', '::');
}

/**
 * get information on block
 *
 * @return       array       The block information
 */
function FlashChatBridge_Onlineblock_info()
{
    // block informations
    return array('module'         => 'FlashChatBridge',
                 'text_type'      => 'OnlineBlock',
                 'text_type_long' => 'FlashChat Online User',
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
function FlashChatBridge_Onlineblock_display($blockinfo)
{
    if (!SecurityUtil::checkPermission('FlashChatBridge:Onlineblock:', "::", ACCESS_READ)) {
        return false;
    }	
	
    if (!pnModAvailable('FlashChatBridge') || !pnUserLoggedIn() ) {
        return false;
    }
    //pnModLoad("FlashChatBridge");

   
    $Users = pnModAPIFunc('FlashChatBridge',
						  'user',
						  'getChatterList');
	$count = count($Users);
	
    $render = pnRender::getInstance('FlashChatBridge',false);
   	$render->assign('Users', 		$Users);
   	$render->assign('Count', 		$count);
    
    $blockinfo['content'] = $render->fetch('flashchatbridge_block_online.htm');
	return pnBlockThemeBlock($blockinfo);

}