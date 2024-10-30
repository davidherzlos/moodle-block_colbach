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

// Obligatoriamente moodle necesita la url de la pagina actual.
$PAGE->set_url('/blocks/colbach/view.php', ['id' => $id]);


