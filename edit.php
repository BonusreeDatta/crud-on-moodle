


<?php

//create and edit both are happend here
require_once(__DIR__ . '/../../config.php');
require_once('./locallib.php');
require_once($CFG->dirroot . '/local/crud/classes/form/edit_form.php'); // Ensure the correct form class
require_login(); // Ensure user is logged in

$PAGE->set_url(new moodle_url('/local/crud/edit.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Edit'); // Corrected title parameter

echo $OUTPUT->header(); // Render the header

local_crud_info_save_and_delete();

echo $OUTPUT->footer(); // Render the footer
