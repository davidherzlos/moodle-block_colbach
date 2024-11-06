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
 * View page for block_colbach
 *
 * @package block_colbach
 * @copyright 2024 Colegio de Bachilleres
 * @author David OC
 */

// Requerir config.php en paginas accesibles por url.
require('../../config.php');

// Recibir el numero de ID de la consulta.
$id = required_param('id', PARAM_INT);

// Unicamente usuarios logeados pueden ver esta pagina.
require_login();

// Setear el contexto de la pagina, puede ser de curso, actividad y en este caso de sistema.
$context = context_system::instance();
$PAGE->set_context($context);

// Obligatoriamente moodle necesita la url de la pagina actual.
$url = new \moodle_url('/blocks/colbach/view.php');
$url->param('id', $id);
$PAGE->set_url($url);

// La pagina necesita un layout (incourse, admin, default, course, report, etc).
$PAGE->set_pagelayout('standard');

// Setear el titulo del documento html.
$PAGE->set_title(get_string('viewpagetitle', 'block_colbach'));

// Heading de la pagina (titulo en H1).
$PAGE->set_heading(get_string('ticketnum', 'block_colbach'). $id);

// Agregamos migajas de pan.

// Nodo padre.
$previousurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/my';
$previousnode = $PAGE->navigation->add(
    get_string('alltickets', 'block_colbach'),
    new \moodle_url($previousurl),
    navigation_node::TYPE_CONTAINER
);

// Nodo actual.
$currentnode = $previousnode->add(
    get_string('ticket', 'block_colbach'),
    new \moodle_url($url),
);
$currentnode->make_active();

// Aqui comenzamos a generar output.
echo $OUTPUT->header();

// HTML del ticket.
$ticket = new \stdClass();
$ticket->username = "Carlos Ramirez";
$ticket->coursename = "Curso propedeutico";
$ticket->timecreated = '06 Noviembre 2024';
$ticket->status = 'En espera';
$ticket->title = "Problema con el curso";
$ticket->description = 'No puedo ingresar al curso propedeutico. Por favor ayuda.';
$html = $OUTPUT->render_from_template('block_colbach/ticket', $ticket);
echo $OUTPUT->box($html, 'generalbox center clearfix');

// Footer, importante no omitirlo y si se requiere ocultarlo, debe ser por css.
echo $OUTPUT->footer();
