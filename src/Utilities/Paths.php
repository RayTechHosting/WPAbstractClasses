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
 * @version    0.6.0
 * @since      0.1.0
 */

namespace RayTech\WPAbstractClasses\Utilities;

/**
 * This utility class will help with the paths for this packages.
 */
class Paths {

	/**
	 * Configuration Array from file
	 *
	 * @var mixed
	 */
	public $config;

	/**
	 * Constructor method
	 *
	 * @return void
	 */
	public function __construct() {
		$this->config = new Configuration();
	}

	/**
	 * Creates the right path depending on the usage type (plugin, theme).
	 * This is set with the constant RTABSTRACT_USAGE_TYPE with the value of plugin or theme.
	 *
	 * @return string
	 */
	public function getAssetsPath() {
		if ( 'plugin' === $this->config->data['implementation_type'] ) {
			return plugin_dir_url( __FILE__ ) . '/../../../assets';
		} elseif ( 'theme' === $this->config->data['implementation_type'] ) {
			return get_stylesheet_directory_uri() . '/vendor/raytechhosting/wpabstractclasses/assets';
		}
	}
}
