<?php
class energy_import extends WP_Import
{
    function check()
    {
    //you can add any extra custom functions after the importing of demo coment is done
    	global $current_user;
        $user_id = $current_user->ID;
             add_user_meta($user_id, 'energy_import_activate', 'true', true);
    }
}