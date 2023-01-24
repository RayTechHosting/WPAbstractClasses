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
 * @category   Wordpress_Plugin
 * @package    WordPress
 * @subpackage Si51_Extra_Widgets_Plugin
 * @author     Kevin Roy <royk@myraytech.net>
 * @license    GPL-v2 <https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html>
 * @version    GIT: 1.0.0
 * @link       https://raytechhosting.com
 * @since      1.0.0
 */

namespace RayTech\WPAbstractClasses\Utilities;

/**
 * Utility class for keeping KSes escape functions arguments handy.
 */
class KSesOptions {

	/**
	 * Retreives the corrent set of arguments.
	 *
	 * @return array
	 */
	public static function getImgOptions() {
		return [
			'img' => [
				'alt'     => [],
				'class'   => [],
				'id'      => [],
				'loading' => [],
				'src'     => [],
			],
		];

	}

/**
 * Undocumented function
 *
 * @return void
 */
	public function getSvgOPtions() {
		return [
			'svg'     => [
				'enable-background' => [],
				'id'                => [],
				'style'             => [],
				'version'           => [],
				'viewbox'           => [],
				'x'                 => [],
				'xmlns'             => [],
				'xmlns:link'        => [],
				'xml:space'         => [],
				'y'                 => [],
			],
			'g'       => [
				'transform' => [],
			],
			'ellipse' => [
				'cx' => [],
				'cy' => [],
				'rx' => [],
				'ry' => [],
			],
			'style'   => [
				'type' => [],
			],
			'text'    => [
				'transform' => [],
			],
			'path'    => [
				'd' => [],
			],
		];

	}

		/**
		 * Array of allowed html
		 *
		 * @return array
		 */
	public function getHtmlOptions() {
		return [
			'br'     => [],
			'p'      => [
				'class' => [],
				'id'    => [],
			],
			'strong' => [],
			'em'     => [],
			'ul'     => [
				'class' => [],
				'id'    => [],
			],
			'li'     => [
				'class' => [],
				'id'    => [],
			],
			'img'    => [
				'alt'     => [],
				'class'   => [],
				'id'      => [],
				'loading' => [],
				'src'     => [],
			],
			'span'   => [
				'class' => [],
				'id'    => [],
			],
			'a'      => [
				'href'  => [],
				'class' => [],
				'alt'   => [],
				'id'    => [],
			],
			'iframe' => [
				'title'           => [],
				'src'             => [],
				'width'           => [],
				'height'          => [],
				'frameborder'     => [],
				'allowfullscreen' => [],
			],
			'div' => [
				'class' => [],
				'id'    => [],
			]
		];
	}
}
