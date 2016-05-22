<?php

echo elgg_view_input("email",[
    'name' => 'mailing_list', 
    "label" => elgg_echo("group_mailing_integration:mailing-list"),
    "help" => elgg_echo("group_mailing_integration:mail-field-help"),
    "value" => isset($vars['entity'])? $vars['entity']->mailing_list : '',
]);

