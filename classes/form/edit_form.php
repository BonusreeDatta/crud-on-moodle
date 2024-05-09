<?php
require_once("$CFG->libdir/formslib.php");

class crud_form extends moodleform {
       function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 

        $mform->addElement('hidden', 'id', get_string('id'));
        $mform->setType('id', PARAM_INT);
        $mform->setDefault('id', $this->_customdata['id']);

       
        $mform->addElement('text', 'name', get_string( 'name')  );
        $mform->setType('name', PARAM_TEXT);
        $mform->setDefault('name', $this->_customdata['name']);

        $mform->addElement('text', 'password', get_string( 'password')  );
        $mform->setType('password', PARAM_TEXT);
        

        $mform->addElement('text', 'email', get_string('email'), 'maxlength="100" size="25" ');
        $mform->setType('email', PARAM_NOTAGS);
        $mform->addRule('email', get_string('missingemail'), 'required', null, 'server');
        // Set default value by using a passed parameter
        $mform->setDefault('email',$this->_customdata['email']);

        $this->add_action_buttons();
    }                           // Close the function
}        