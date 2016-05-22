
<?php

function pull_group_mailing_list($hook, $type, $return, $params) {
    $ia = elgg_set_ignore_access(true);
    $groups = elgg_get_entities_from_metadata([
        "type" => "group",
        "metadata_names" => ['mailing_list'],
        "limit" => false, //no limit for results
    ]);
    foreach ($groups as $group) {
        echo "cronned ".$group->mailing_list."\n";
    }
    elgg_set_ignore_access($ia);
	return $return;
};

function group_mailing_integration_save($event, $type, $group) {
    //do some sanitization other than browser if you want
    $group->mailing_list = get_input("mailing_list");
};

function group_mailing_integration_init() {
    elgg_register_plugin_hook_handler('cron', 'fiveminute', 'pull_group_mailing_list');
    elgg_extend_view('groups/edit/tools', 'group_mailing_integration/groups_mailbox_field', 400);

    elgg_register_event_handler('create', 'group', 'group_mailing_integration_save');
    elgg_register_event_handler('update', 'group', 'group_mailing_integration_save');
	
};

elgg_register_event_handler('init', 'system', 'group_mailing_integration_init');

