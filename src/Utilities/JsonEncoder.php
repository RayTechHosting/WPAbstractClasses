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
 * @since      0.3.0
 */

namespace RayTech\WPAbstractClasses\Utilities;

/**
 * Encoder class to help save data into the database as json object or arrays.
 */
class JsonEncoder {

	/**
	 * Decoding function for this json encoding
	 *
	 * @static
	 * @param string  $data Json string of data.
	 * @param boolean $as_array Switch between array or object.
	 * @return mixed
	 */
	public static function decode( $data, bool $as_array = false ) {
		return json_decode( stripslashes( stripslashes( $data ) ), $as_array );
	}

	/**
	 * Encoding function for json in db
	 *
	 * @static
	 * @param array|object $data Array or object of data.
	 * @return mixed
	 */
	public static function encode( $data ) {
		return addslashes( wp_json_encode( $data, JSON_UNESCAPED_UNICODE ) );
	}

}
