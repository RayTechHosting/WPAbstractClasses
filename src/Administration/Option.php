<?php
/**
 * Copyright (C) 2020 RayTech Hosting <hosting@myraytech.net>
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
 * @version    0.1.6
 * @since      0.1.6
 */

namespace RayTech\WPAbstractClasses\Administration;

/**
 * Wrapper class for WordPress options
 */
class Option {
	/**
	 * Name of the option
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Option value
	 *
	 * @var mixed
	 */
	protected $value;

	/**
	 * Get name of the option
	 *
	 * @return  string
	 **/
	public function getName() {
		return $this->name;
	}

	/**
	 * Set name of the option
	 *
	 * @param  string $name Name of the option.
	 * @return self
	 */
	public function setName( string $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get option value
	 *
	 * @return  mixed
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Set option value
	 *
	 * @param  mixed $value Option value.
	 * @return self
	 */
	public function setValue( $value ) {
		$this->value = $value;

		return $this;
	}

	/**
	 * Adds a new option.
	 *
	 * @param  string|bool $autoload   Do you want the options on page load.
	 * @return bool
	 */
	public function add( $autoload = 'yes' ) {
		return add_option( $this->name, $this->value, '', $autoload );
	}

	/**
	 * Gets the option value from the database.
	 *
	 * @param  string $name Name of the option to retreive.
	 * @param  string $default Default value if nothing is retreived from db.
	 * @return self
	 */
	public static function get( $name, $default = '' ) {
		$value  = get_option( $name, $default );
		$option = new Option();
		$option->setName( $name )->setValue( $value );
		return $option->getValue();
	}

	/**
	 * Save the option in the database
	 *
	 * @param  string|bool $autoload Autload the option on WordPress start-up.
	 * @return bool
	 */
	public function save( $autoload = false ) {
		return update_option( $this->name, $this->value, $autoload );
	}

	/**
	 * Deletes the option from the database.
	 *
	 * @return bool
	 */
	public function delete() {
		return delete_option( $this->name );
	}
}
