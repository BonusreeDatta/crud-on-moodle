<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version information
 *
 * @package    local_Crud
 * @copyright  2024 Bonusree
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
//table display function is here
 function local_Crud_table_display() {
    global $DB, $OUTPUT;
    global $DB;
    $infoCrud=$DB->get_records('crud_data');

    //var_dump($infoCrud);    
   
        $templatecontext = (object) [
        'display' => array_values($infoCrud),
        'editurl' => new moodle_url('/local/crud/edit.php'),
        'deleteurl' => new moodle_url('/local/crud/delete.php'),
    ];

    echo $OUTPUT->render_from_template('local_crud/mytemplate', $templatecontext);


}
function  local_crud_info_save_and_delete()
{
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
}
defined('MOODLE_INTERNAL') || die();
