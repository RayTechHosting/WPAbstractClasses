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
 * @version    0.3.0
 * @since      0.1.0
 */

namespace RayTech\WPAbstractClasses\Fields\Inputs;

use RayTech\WPAbstractClasses\Fields\AbstractInput;
use RayTech\WPAbstractClasses\Utilities\JsonEncoder;
use RayTech\WPAbstractClasses\Utilities\Query;

/**
 * Select input
 */
class Select extends AbstractInput {
	/**
	 * __construct
	 *
	 * @access public
	 * @param  int    $id    Input id.
	 * @param  string $name  Input name.
	 * @param  mixed  $value Input value.
	 * @param  array  $attr  Rest of input attributes.
	 * @return void
	 */
	public function __construct( $id, $name, $value, $attr ) {
		if ( isset( $attr['multiple'] ) && true === $attr['multiple'] ) {
			$this->setName( $name . '[]' );
		} else {
			$this->setName( $name );
		}
		$this->setInputID( $id );
		$this->setValue( $value );
		$this->setAttributes( $attr );
	}

	/**
	 * Rendering method.
	 *
	 * @return void
	 */
	public function render() {
		if ( null !== JsonEncoder::decode( $this->getValue(), true ) ) {
			$value = JsonEncoder::decode( $this->getValue(), true );
		} else {
			$value = $this->getValue();
		}
		if ( isset( $this->getAttributes()['prefix'] ) ) {
			echo esc_html( $this->getAttributes()['prefix'] );
		}
		echo '<select id="' . esc_attr( $this->getInputId() ) . '" name="' . esc_attr( $this->getName() ) . '"';
		if ( ! empty( $this->getAttributes() ) ) {
			foreach ( $this->getAttributes() as $attr => $attr_value ) {
				if ( 'options' === $attr || 'query' === $attr ) {
					continue;
				} elseif ( 'multiple' === $attr && true === $attr_value ) {
					echo ' multiple';
				} else {
					echo ' ' . esc_html( $attr ) . '="' . esc_attr( $attr_value ) . '"';
				}
			}
		}
		echo '>';

		if ( isset( $this->getAttributes()['query'] ) ) {
			$query = new Query();
			$options = $query->run( $this->getInputId(), $this->getAttributes()['query'] );
		} else {
			$options = $this->getAttributes()['options'];
		}
		foreach ( $options as $option => $label ) {
			echo '<option value="' . esc_attr( $option ) . '"';
			if ( is_array( $value ) ) {
				if ( in_array( (string) $option, $value, true ) ) {
					echo ' selected';
				}
			} elseif ( $value === $option ) {
				echo ' selected';
			}
			echo '>' . esc_html( $label ) . '</option>';
		}
	
		echo '</select>';
		if ( isset( $this->getAttributes()['suffix'] ) ) {
			echo esc_html( $this->getAttributes()['suffix'] );
		}
	}
}
