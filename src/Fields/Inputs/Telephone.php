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
 * @since      0.1.0
 */

namespace RayTech\WPAbstractClasses\Fields\Inputs;

use RayTech\WPAbstractClasses\Fields\AbstractInput;

/**
 * Telephone input
 */
class Telephone extends AbstractInput {
	/**
	 * __construct
	 *
	 * @access public
	 * @param  int    $id    Input id.
	 * @param  string $name  Input name.
	 * @param  string $value Input value.
	 * @param  array  $attr  Rest of input attributes.
	 * @return void
	 */
	public function __construct( $id, $name, $value, $attr ) {
		$this->setType( 'tel' );
		$this->setName( $name );
		$this->setInputID( $id );
		$this->setValue( $value );
		$this->setAttributes( $attr );
	}
}
