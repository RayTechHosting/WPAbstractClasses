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
 * @version    0.7.0
 * @since      0.7.0
 */

namespace RayTech\WPAbstractClasses\Fields\Inputs;

use Exception;

class Repeater {

	/**
	 * Configuration array for the repeater.
	 *
	 * @var array $config
	 */
	private $config = [];

	public function __construct() {

	}

	public function addInput( $type = 'text', $label = '', $id = '', $attr = [] ) {
		if ( isset( $this->config[ $id ] ) ) {
			throw new Exception( 'An input with this id was already declared, please confirm your ids' );
		}
		$this->config[ $id ] = [
			'type'  => $type,
			'label' => $label,
			'attr'  => $attr,
		];
	}

	public function render() {

		$classes = scandir( './' );
		var_dump( $classes );

	}
}
