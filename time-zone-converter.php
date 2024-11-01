<?php
/**
 * Plugin Name: Time Zone Converter
 * Plugin URI: https://websolutionideas.com/
 * Description: Time Zone Converter allows users to convert and compare time in different time zones.
 * Version: 1.0.2
 * Author: Vikas Sharma
 * Author URI: https://websolutionideas.com/vikas/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: time-zone-converter
 *
 * Time Zone Converter
 * Copyright (C) 2021, Vikas Sharma <vikas@websolutionideas.com>
 *
 * 'Time Zone Converter' is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * 'Time Zone Converter' is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with 'Time Zone Converter'. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 *
 */

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

// Store plugin file location.
define( 'TIMEZONE_PLUGIN_FILE', __FILE__ );
define( 'TIMEZONE_PLUGIN_DIR', __DIR__ );

require_once __DIR__ . '/classes/class-timezone-converter.php';
require_once __DIR__ . '/classes/class-timezone-functions.php';

// Initiate classes.
new Timezone_Converter();
new Timezone_Functions();
