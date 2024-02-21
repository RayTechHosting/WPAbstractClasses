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

namespace RayTech\WPAbstractClasses\Fields;

/**
 * Abstract input class
 *
 * @abstract
 */
abstract class AbstractInput {

	/**
	 * Input type
	 *
	 * @var string
	 */
	private $type = '';

	/**
	 * Input name
	 *
	 * @var string
	 */
	private $name = '';

	/**
	 * Input value
	 *
	 * @var string
	 */
	private $value = '';

	/**
	 * Input identifier
	 *
	 * @var string
	 */
	private $input_id = '';

	/**
	 * Input attributes
	 *
	 * @var array
	 */
	private $attributes = [];

	/**
	 * Get input type
	 *
	 * @return string
	 */
	protected function getType() {
		return $this->type;
	}

	/**
	 * Set input type
	 *
	 * @param  string $value Input type.
	 * @return void
	 */
	protected function setType( $value ) {
		$this->type = $value;
	}

	/**
	 * Get input name
	 *
	 * @return string
	 */
	protected function getName() {
		return $this->name;
	}

	/**
	 * Set input name
	 *
	 * @param  string $value Input name.
	 * @return void
	 */
	protected function setName( $value ) {
		$this->name = $value;
	}

	/**
	 * Get input value
	 *
	 * @return string
	 */
	protected function getValue() {
		return $this->value;
	}

	/**
	 * Set input value
	 *
	 * @param  string $value Input value.
	 * @return void
	 */
	protected function setValue( $value ) {
		$this->value = $value;
	}

	/**
	 * Get input identifier.
	 *
	 * @return string
	 */
	protected function getInputId() {
		return $this->input_id;
	}

	/**
	 * Set input identifier
	 *
	 * @param  string $value Input id.
	 * @return void
	 */
	protected function setInputID( $value ) {
		$this->input_id = $value;
	}

	/**
	 * Get attributes array
	 *
	 * @return array
	 */
	protected function getAttributes() {
		return $this->attributes;
	}

	/**
	 * Set attributes
	 *
	 * @param  array $array Array of html attributes.
	 * @return void
	 */
	protected function setAttributes( $array ) {
		$this->attributes = $array;
	}

	/**
	 * Rendering method
	 *
	 * @return void
	 */
	public function render() {
		if ( isset( $this->getAttributes()['prefix'] ) ) {
			echo esc_html( $this->getAttributes()['prefix'] );
		}
		echo '<input type="' . esc_attr( $this->getType() ) . '" name="' . esc_attr( $this->getName() ) . '" id="' . esc_attr( $this->getInputId() ) . '"';
		if ( ! empty( $this->getValue() ) ) {
			echo 'value="' . esc_attr( $this->getValue() ) . '"';
		}
		if ( $this->getType() === 'checkbox' && $this->getValue() === 'on' ) {
			echo ' checked';
		}

		if ( null !== $this->getAttributes() ) {
			foreach ( $this->getAttributes() as $key => $value ) {
				echo ' ' . esc_html( $key ) . '="' . esc_attr( $value ) . '"';
			}
		}

		echo ' />';

		if ( isset( $this->getAttributes()['suffix'] ) ) {
			echo esc_html( $this->getAttributes()['suffix'] );
		}
	}
}
