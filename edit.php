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
 * Edit page for block_colbach
 *
 * @package block_colbach
 * @copyright 2024 Colegio de Bachilleres
 * @author David OC
 */

// Requerir config.php en paginas accesibles por url.
require('../../config.php');

// Recibir el numero de ID de la consulta.
$id = optional_param('id', null, PARAM_INT);

// Unicamente usuarios logeados pueden ver esta pagina.
require_login();

// Setear el contexto de la pagina, puede ser de curso, actividad y en este caso de sistema.
$context = context_system::instance();
$PAGE->set_context($context);

// Obligatoriamente moodle necesita la url de la pagina actual.
$url = new \moodle_url('/blocks/colbach/edit.php');
if ($id) {
    $url->param('id', $id);
}
$PAGE->set_url($url);

// La pagina necesita un layout (incourse, admin, default, course, report, etc).
$PAGE->set_pagelayout('standard');

// Heading de la pagina (titulo en H1).
$PAGE->set_heading('New ticket');

// Nodo padre.
$previousurl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/my';
$previousnode = $PAGE->navigation->add(
    get_string('alltickets', 'block_colbach'),
    new \moodle_url($previousurl),
    navigation_node::TYPE_CONTAINER
);

// Agregamos migajas de pan.

// Nodo actual.
$currentnode = $previousnode->add(
    get_string('ticket', 'block_colbach'),
    new \moodle_url($url),
);
$currentnode->make_active();

// Aqui comenzamos a generar output.
echo $OUTPUT->header();

// Creamos una instancia del moodleform.
$mform = new \block_colbach\form\edit_form();

// Y creamos un flujo para controlar el moodleform en la pagina.
if ($mform->is_cancelled()) {
    // El moodle form es cancelado.
    redirect('/my');
} else if ($data = $mform->get_data()) {
    // El usuario manda datos para guardar en la db.
    $record = new \stdClass();
    $record->title = $data->title;
    $record->description = $data->description['text'];
    $record->status = 'inbox';
    $record->userid = $USER->id;
    $record->usermodified = $USER->id;
    $record->timecreated = time();
    $record->timemodified = time();

    // Si el registro es exitoso, entonces mandar una notificacion.
    $id = $DB->insert_record('block_colbach_inquiries', $record, true);
    if (is_numeric($id)) {
        echo $OUTPUT->notification('Created!', \core\output\notification::NOTIFY_SUCCESS);
    }

    // Desplegar el boton de continuar.
    echo $OUTPUT->continue_button(new moodle_url('/my'));
} else {
    // El usuario no cancela ni envia datos para crear un registro.

    // Caso 1: si el id fue pasado como parametro, buscar en la db.
    $record = $DB->get_record('block_colbach_inquiries', ['id' => $id]);
    if (!$record) {
        // Caso 2: crear un registro vacio.
        $record = new \stdClass();
    } else {
        // Crear las propiedades para el editor de moodle (description).
        $description = $record->description;
        $record->description = new stdClass();
        $record->description->text = $description;
        $record->description->format = FORMAT_HTML;
    }

    // Cargar datos por defecto y desplegar formulario.
    $mform->set_data($record);
    $mform->display();
}

echo $OUTPUT->footer();

