<?php
/**
 * Created by PhpStorm.
 * User: saeedi
 * Date: 2/10/2018
 * Time: 8:55 AM
 */

$widget = elgg_extract('entity', $vars);

// set default value
if (!isset($widget->num_display)) {
	$widget->num_display = 5;
}

echo elgg_view('object/widget/edit/num_display', [
	'entity' => $widget,
	'options' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
	'label' => elgg_echo('who_viewed_myprofile:numbertodisplay'),
]);
