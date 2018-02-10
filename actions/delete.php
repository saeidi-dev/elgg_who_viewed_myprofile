<?php
/**
 * Created by PhpStorm.
 * User: saeedi
 * Date: 2/10/2018
 * Time: 9:08 AM
 */

$guid = get_input('guid');
$target = elgg_get_logged_in_user_guid();

if(check_entity_relationship($guid, "viewed_myprofile", $target)){
    remove_entity_relationship($guid, "viewed_myprofile", $target);
}

