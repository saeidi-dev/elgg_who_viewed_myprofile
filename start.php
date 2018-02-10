<?php
/**
 * Created by PhpStorm.
 * User: saeedi
 * Date: 2/10/2018
 * Time: 8:38 AM
 */

elgg_register_event_handler('init', 'system', 'who_viewed_myprofile_init');

/**
 * Initialize
 */
function who_viewed_myprofile_init()
{

    elgg_register_page_handler('who_viewed_myprofile', 'who_viewed_myprofile_page_handler');

    elgg_extend_view("profile/wrapper", "who_viewed_myprofile/record");

    elgg_register_plugin_hook_handler('register', 'menu:entity', 'who_viewed_myprofile_menu_setup');
    elgg_register_plugin_hook_handler('register', 'menu:river', 'who_viewed_myprofile_river_menu_setup');

    if (elgg_is_logged_in()) {
        $item = new ElggMenuItem('who_viewed_myprofile', elgg_echo('who_viewed_myprofile'), 'who_viewed_myprofile');
        elgg_register_menu_item('site', $item);
    }

    // register actions
    $action_path = elgg_get_plugins_path() . 'who_viewed_myprofile/actions';
    elgg_register_action('who_viewed_myprofile/delete', "$action_path/delete.php");

    // add a blog widget
    $context = ['profile', 'dashboard', 'other_context'];
    elgg_register_widget_type('who_viewed_myprofile', elgg_echo('who_viewed_myprofile:whoviewedthisprofile'), elgg_echo('who_viewed_myprofile:widget:description'), ['whc_thewire', 'profile'], $context);
}


/**
 * who viewed myprofile page handler
 * @param $page
 * @return bool
 */
function who_viewed_myprofile_page_handler($page)
{

    gatekeeper();

    if (empty($page[0])) {
        $page[0] = 'who_viewed';
    }

    if ($page[0] == 'who_viewed') {
        echo elgg_view_resource('who_viewed_myprofile/who_viewed_myprofile');
    }

    return true;
}


function who_viewed_myprofile_menu_setup($hook, $type, $return, $params)
{

    if (elgg_in_context('widgets'))
        return $return;

    if (!elgg_in_context('who_viewed_myprofile'))
        return $return;

    $entity = elgg_extract('entity', $params);

    if (!($entity instanceof ElggUser))
        return $return;

    if ($entity->canDelete()) {
        $options = [
            'name' => 'delete_view',
            'text' => elgg_echo('delete'), //elgg_view_icon('delete')
            'title' => elgg_echo('delete'),
            'href' => "action/who_viewed_myprofile/delete?guid={$entity->getGUID()}", //elgg_add_action_tokens_to_url("action/river/delete?id={$entity->getGUID()}")
            'confirm' => elgg_echo('deleteconfirm'),
        ];

        $return[] = ElggMenuItem::factory($options);
    }

    return $return;

}

/**
 * Add button to river actions
 */
function who_viewed_myprofile_river_menu_setup($hook, $type, $return, $params)
{
    if (!elgg_is_logged_in() || elgg_in_context('widgets')) {
        return;
    }

    $item = elgg_extract('item', $params);
    /* @var ElggRiverItem $item */

    $entity = $item->getObjectEntity();
    if (!$entity)
        return;

    $return[] = ElggMenuItem::factory(array(
        'name' => 'delete_view',
        'text' => elgg_echo('delete'), //elgg_view_icon('delete')
        'title' => elgg_echo('delete'),
        'href' => elgg_add_action_tokens_to_url("/action/who_viewed_myprofile/delete?guid={$entity->guid}"),
        'confirm' => elgg_echo('deleteconfirm'),
    ));

    return $return;
}

