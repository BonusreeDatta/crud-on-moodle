<?php
require_once(__DIR__.'/../../config.php');
require_once('./locallib.php');
require_login(); // Ensure user is logged in

$PAGE->set_url(new moodle_url(url: '/local/crud/index.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_crud'));

echo $OUTPUT->header();

local_Crud_table_display();


echo $OUTPUT->footer();
