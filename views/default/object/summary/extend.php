<?php
/**
 * Created by PhpStorm.
 * User: saeedi
 * Date: 2/10/2018
 * Time: 8:59 AM
 */

if (elgg_get_context() == "who_viewed_myprofile") {

    $entity = elgg_extract('entity', $vars);

    if (!elgg_instanceof($entity, 'user', 'member')) {
        $relationship = check_entity_relationship($entity->guid, "viewed_myprofile", elgg_get_logged_in_user_guid());
        $date = elgg_view_friendly_time($relationship->time_created);
        echo $date;
    }
}
