<?php

defined('MOODLE_INTERNAL') || die();

function xmldb_local_crud_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager(); // Load database manager
    
    if ($oldversion < 2024050700) {
        // Define new field to be added to the crud_data table
        $table = new xmldb_table('crud_data');
       // $field = new xmldb_field('password', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, null);
        $field = new xmldb_field('password', XMLDB_TYPE_CHAR, '255', null, XMLDB_NOTNULL, null, '');

        // Conditionally add the field to the table
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Update plugin version
        upgrade_plugin_savepoint(true, 2024050700, 'local', 'crud');
    }

    return true;
}
