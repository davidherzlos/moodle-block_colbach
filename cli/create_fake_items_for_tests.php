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
 * Cli script of block_colbach
 *
 * @package block_colbach
 * @copyright 2024 Colegio de Bachilleres
 * @author David OC
 */

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/clilib.php');

// Abrir sesion del usuario administrador.
cron_setup_user();

$tickets = [
    (object) [
        'title' => 'Problema con el curso propedeutico',
        'description' => 'Por favor ayuda',
        'status' => 'inbox',
        'userid' => $USER->id,
        'usermodified' => $USER->id,
        'timecreated' => time(),
        'timemodified' => time(),
    ],
    (object) [
        'title' => 'Problema con el curso propedeutico',
        'description' => 'Por favor ayuda',
        'status' => 'inbox',
        'userid' => $USER->id,
        'usermodified' => $USER->id,
        'timecreated' => time(),
        'timemodified' => time(),
    ],
    (object) [
        'title' => 'Problema con el curso propedeutico',
        'description' => 'Por favor ayuda',
        'status' => 'inbox',
        'userid' => $USER->id,
        'usermodified' => $USER->id,
        'timecreated' => time(),
        'timemodified' => time(),
    ],
];

$DB->insert_records('block_colbach_inquiries', $tickets);

