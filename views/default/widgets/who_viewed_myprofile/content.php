<?php
/**
 * Created by PhpStorm.
 * User: saeedi
 * Date: 2/10/2018
 * Time: 8:55 AM
 */

$widget = elgg_extract('entity', $vars);

if (!elgg_instanceof($widget, '', 'widget'))
    return false;

$options = [
    'type' => 'user',
    'full_view' => false,
    'relationship' => 'viewed_myprofile',
    'inverse_relationship' => true,
    'relationship_guid' => $widget->owner_guid,
    'limit' => $widget->num_display,
    'pagination' => false
];

$content = elgg_list_entities_from_relationship($options);

if (!$content) {
    $content = elgg_echo("who_viewed_myprofile:nobody");
}

echo $content;

