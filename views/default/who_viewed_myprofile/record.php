<?php
/**
 * Created by PhpStorm.
 * User: saeedi
 * Date: 2/10/2018
 * Time: 8:42 AM
 */

if (elgg_is_logged_in()) {

    $logged_user = elgg_get_logged_in_user_guid();
    $target = elgg_get_page_owner_guid();

    if (is_numeric($target) && is_numeric($logged_user) && $logged_user != $target) {
        if (check_entity_relationship($logged_user, "viewed_myprofile", $target)) {
            remove_entity_relationship($logged_user, "viewed_myprofile", $target);
            add_entity_relationship($logged_user, "viewed_myprofile", $target);
        } else {
            add_entity_relationship($logged_user, "viewed_myprofile", $target);
        }
    }
}

