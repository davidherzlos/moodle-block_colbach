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
 * Definiciones de Webservice para block_colbach.
 *
 * La URL del endpoint seria:
 * http://TUDOMINIO/webservice/rest/server.php
 *
 * Y los parametros serian:
 * wsfunction=block_example_get_tickets_by_user
 * userid=2
 * wstoken=d65cb2873b82a9c78b8c5eeb8b3fea95
 * moodlewsrestformat=json
 *
 * La URL completa seria:
 * http://TUDOMINIO/webservice/rest/server.php?wsfunction=block_example_get_tickets_by_user&userid=2&wstoken=d65cb2873b82a9c78b8c5eeb8b3fea95&moodlewsrestformat=json
 *
 *
 * @package    block_colbach
 * @copyright  2024 Colegio de Bachilleres MX
 * @author     Nombre Apellido <correo@bachilleres.edu.mx>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Definir funciones externas.
$functions = [
    'block_colbach_get_tickets_by_user' => [
        'classname' => 'block_colbach\external',
        'methodname' => 'get_tickets_by_user',
        'ajax' => true,
        'description' => 'Obtener todos los tickets para un usuario expecifico',
        'type' => 'read'
    ]
];


// Definir servicios para exponer las funciones externas.
$services = [
    'Servicios Colegio de Bachilleres' => [
        'functions' => [
            'block_colbach_get_tickets_by_user',
        ],
        'restrictedusers' => 0,
        'enabled' => 1,
    ]
];
