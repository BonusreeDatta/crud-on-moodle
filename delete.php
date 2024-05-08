<?php
require_once(__DIR__.'/../../config.php');
require_login(); // Ensure user is logged in

$PAGE->set_url(new moodle_url('/local/crud/delete.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Delete Record');

global $DB;

// Retrieve the record ID from the POST request
$record_id = required_param('id', PARAM_INT); // Get the record ID from the form data

// Check permissions to delete
//require_capability('local/crud:delete', context_system::instance()); // Ensure the user has the right permissions

// Fetch the record to delete
$record = $DB->get_record('crud_data', ['id' => $record_id]);

if (!$record) {
    print_error('Record not found'); // Handle case where the record does not exist
}

// Delete the record
$DB->delete_records('crud_data', ['id' => $record_id]); // Perform the deletion

// Redirect to a suitable page after deletion
redirect(new moodle_url('/local/crud/index.php'));

echo $OUTPUT->footer(); // Render the footer
