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

/*
 * Main block class for block_colbach
 *
 * @package block_colbach
 * @copyright 2024 Colegio de Bachilleres
 * @author David OC
 */
class block_colbach extends \block_base {

    public function init() {
        $this->title = 'Contacto Colbach';
    }

    public function get_content() {

        // Solo usuarios reales pueden acceder al bloque.
        if (!isloggedin() || isguestuser()) {
            return;
        }

        // Si ya existe el contenido, retorna el contenido.
        if ($this->content !== null) {
            return $this->content;
        }

        // De lo contrario generar el contenido.
        $this->content = new \stdClass();
        $this->content->text = $this->get_html();
        $this->content->footer = '';

        return $this->content;
    }

    private function get_html() {
        global $OUTPUT, $DB;
        $tickets = array_values($DB->get_records('block_colbach_inquiries'));
        return $OUTPUT->render_from_template('block_colbach/ticketlist', ['tickets' => $tickets]);
    }
}
