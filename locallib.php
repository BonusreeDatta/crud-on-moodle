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
defined('MOODLE_INTERNAL') || die();
