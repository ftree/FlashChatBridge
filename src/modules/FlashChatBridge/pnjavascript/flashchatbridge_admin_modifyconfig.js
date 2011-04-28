Event.observe(window, 'load', flashchatbridge_modifyconfig_init, false);

function flashchatbridge_modifyconfig_init()
{
    Event.observe('flashchatbridge_autosize_yes', 'click', flashchatbridge_autosize_onchange, false);
    Event.observe('flashchatbridge_autosize_no', 'click', flashchatbridge_autosize_onchange, false);
    //Event.observe('flashchatbridge_adv_settings', 'click', flashchatbridge_adv_settings_onchange, false);
    
    Event.observe('flashchatbridge_adv_settings_show', 'click', flashchatbridge_adv_settings_show, false);
    Event.observe('flashchatbridge_adv_settings_hide', 'click', flashchatbridge_adv_settings_hide, false);
    
    $('flashchatbridge_adv_settings_container_show').hide();
    
    if ( $('flashchatbridge_autosize_yes').checked) {
        $('flashchatbridge_autosize_container').hide();
    }
    
    if ( $('flashchatbridge_adv_settings').checked) {
    } else {
        $('flashchatbridge_adv_settings_container').hide();
    }
    
}
function flashchatbridge_adv_settings_show()
{
	switchdisplaystate('flashchatbridge_adv_settings_container_hide');
	switchdisplaystate('flashchatbridge_adv_settings_container_show');
	//$('flashchatbridge_adv_settings_container_hide').hide();
	//$('flashchatbridge_adv_settings_container_show').show();
}

function flashchatbridge_adv_settings_hide()
{
	switchdisplaystate('flashchatbridge_adv_settings_container_hide');
	switchdisplaystate('flashchatbridge_adv_settings_container_show');
	//$('flashchatbridge_adv_settings_container_show').hide();
	//$('flashchatbridge_adv_settings_container_hide').show();
}

function flashchatbridge_autosize_onchange()
{
    radioswitchdisplaystate('flashchatbridge_autosize', 'flashchatbridge_autosize_container', false);
}

function flashchatbridge_adv_settings_onchange()
{
	checkboxswitchdisplaystate('flashchatbridge_adv_settings', 'flashchatbridge_adv_settings_container', true);
}