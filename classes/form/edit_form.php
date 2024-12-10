<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

namespace block_colbach\form;

use moodleform;

/**
 * Inquiry edit form.
 *
 * @package    block_colbach
 * @copyright  2024 Colegio de Bachilleres MX
 * @author     Nombre Apellido <correo@bachilleres.edu.mx>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class edit_form extends moodleform {

    /**
     * Form definition for edit form.
     */
    protected function definition() {
        $mform = $this->_form;

        // Header separador.
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->setType('general', PARAM_TEXT);

        // Nombre del ticket.
        $mform->addElement('text', 'title', 'title');
        $mform->setType('title', PARAM_TEXT);

        // Campo para descripcion (Moodle editor).
        $mform->addElement('editor', 'description', get_string('description', 'block_colbach'), []);
        $mform->setType('description', PARAM_RAW);

        $this->add_action_buttons();
    }
}

