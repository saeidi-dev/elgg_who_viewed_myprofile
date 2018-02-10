<?php
/**
 * Created by PhpStorm.
 * User: saeedi
 * Date: 2/10/2018
 * Time: 8:45 AM
 */

$title = elgg_echo('who_viewed_myprofile');

$options = [
    'type' => 'user',
    'full_view' => false,
    'relationship' => 'viewed_myprofile',
    'inverse_relationship' => true,
    'relationship_guid' => elgg_get_logged_in_user_guid()
];

$content = elgg_list_entities_from_relationship($options);

if (!$content) {
    $content = elgg_echo("who_viewed_myprofile:nobody");
}

$params = [
    'content' => $content,
    'title' => $title,
    'filter' => '',
    'filter_override' => "",
];

$body = elgg_view_layout('content', $params);

echo elgg_view_page($title, $body);
