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

/**
 * Clase para servicios externos for block_colbach.
 *
 * @package    block_colbach
 * @copyright  2024 Colegio de Bachilleres MX
 * @author     Nombre Apellido <correo@bachilleres.edu.mx>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_colbach;

class external extends \external_api {

    /**
     * * Implementacion de la funcion externa.
     */
    public static function get_tickets_by_user($userid) {
        global $DB;

        // Validacion de parametros recibidos.
        $params = self::validate_parameters(self::get_tickets_by_user_parameters(), ['userid' => $userid]);

        if (empty($params['userid'])) {
            throw new \invalid_parameter_exception('El user ID no fue expecificado');
        }

        // Validacion del usuario.
        if (!$DB->record_exists('user', ['id' => $params['userid']])) {
            throw new \moodle_exception("El usuario no existe en la base de datos");
        }

        // Validar el context del request.
        $context = \context_user::instance($params['userid']);
        self::validate_context($context);

        // Retornar los datos de la base de datos o retornar vacio.
        $tickets = $DB->get_records('block_colbach_inquiries', ['userid' => $params['userid']]);

        if (empty($tickets)) {
            return [];
        }

        foreach ($tickets as $id => $ticket) {
            $ticket->email = $DB->get_record('user', ['id' => $ticket->userid])->email;
        }

        return array_values($tickets);

    }

    /**
     * Definicion de parametros para la funcion externa.
     */
    public static function get_tickets_by_user_parameters() {
        return new \external_function_parameters([
            'userid' => new \external_value(PARAM_INT, 'User ID', VALUE_REQUIRED),
        ]);
    }

    /**
     * Definicion de retornos para la funcion externa.
     */
    public static function get_tickets_by_user_returns() {
        return new \external_multiple_structure(
            new \external_single_structure(
                [
                    'id' => new \external_value(PARAM_INT, 'ID ticket'),
                    'title' => new \external_value(PARAM_TEXT, 'Titulo'),
                    'description' => new \external_value(PARAM_RAW, 'Descripcion'),
                    'email' => new \external_value(PARAM_TEXT, 'Email'),
                    'status' => new \external_value(PARAM_TEXT, 'Status'),
                    'usermodified' => new \external_value(PARAM_INT, 'Modificado por usuario'),
                    'timecreated' => new \external_value(PARAM_INT, 'Creado'),
                    'timemodified' => new \external_value(PARAM_INT, 'Modificado'),
                ]
            )
        );
    }
}
