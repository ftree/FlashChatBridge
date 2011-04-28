<?php

function FlashChatBridge_adminapi_getlinks()
{
    $links = array();

    if (SecurityUtil::checkPermission('FlashChatBridge::', '::', ACCESS_ADMIN)) {
        $links[] = array('url' => pnModURL('FlashChatBridge', 'admin', 'main'), 
        				 'text' => __('Common Settings'));
        
        $links[] = array('url' => pnModURL('FlashChatBridge', 'admin', 'flashchatadmin'), 
        				 'text' => __('123FlashChat Settings'));        
    }

    return $links;
}    
?>