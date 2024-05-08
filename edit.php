<?php
require_once(__DIR__ . '/../../config.php');
require_once('./locallib.php');
require_once($CFG->dirroot . '/local/crud/classes/form/edit_form.php'); // Ensure the correct form class
require_login(); // Ensure user is logged in

$PAGE->set_url(new moodle_url('/local/crud/edit.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title('Edit'); // Corrected title parameter

echo $OUTPUT->header(); // Render the header

global $DB;

// Check if there's an ID to determine if it's a create or edit operation
$record_id = optional_param('id', null, PARAM_INT); // Optional ID parameter

$record = null; // Initialize record as null
$customdata = []; // Initialize custom data array

if ($record_id) {
    // If there's an ID, it's an edit operation
    $record = $DB->get_record('crud_data', ['id' => $record_id]);

    if (!$record) {
        // If the record does not exist, handle appropriately
        redirect(new moodle_url('/local/crud/index.php')); // Redirect to main page
    }

    // Set custom data for the form
    $customdata = (array) $record; // Cast record to an array for form initialization
}

// Initialize the form
$form = new crud_form(null, $customdata); // Pass custom data to the form

if ($form->is_cancelled()) {
    redirect(new moodle_url('/local/crud/index.php')); // Handle form cancellation
} elseif ($data = $form->get_data()) {
    if ($record_id) {
        // Edit operation, update the existing record
        $data->id = $record_id; // Ensure the record ID is set
        $DB->update_record('crud_data', $data); // Update the record in the database
    } else {
        // Create operation, insert a new record
        $DB->insert_record('crud_data', $data); // Insert a new record
    }
    
    // Redirect after save operation
    redirect(new moodle_url('/local/crud/index.php'));
} else {
    // Display the form
    $form->display();
}

echo $OUTPUT->footer(); // Render the footer
