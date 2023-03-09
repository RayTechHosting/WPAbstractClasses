<?php
/**
 * Copyright (C) 2020 RayTech Hosting <royk@myraytech.net>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 *
 * @category   Library
 * @package    WordPress
 * @subpackage WPAbstractClasses
 * @author     Kevin Roy <royk@myraytech.net>
 * @license    GPL-v2 <https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html>
 * @version    0.2.0
 * @since      0.7.0
 */

namespace RayTech\WPAbstractClasses\Utilities;

use Symfony\Component\Yaml\Yaml;

/**
 * Configuration class for parsing the file .rtabstract.yml at root of theme or plugin
 */
class Configuration {

	/**
	 * Data array of config file
	 *
	 * @var mixed
	 */
	public $data;

	/**
	 * Parsing the config file from root of theme or plugin.
	 */
	public function __construct() {
		$this->data = Yaml::parseFile( '../../.rtabstract.yml' );
	}
}
