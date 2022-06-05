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
 * Media input
 */
class Media extends AbstractInput {
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
		$this->setType( 'media' );
		$this->setInputID( $id );
		$this->setName( $name );
		$this->setValue( $value );
		$this->setAttributes( $attr );
	}

	/**
	 * Rendering method
	 *
	 * @access public
	 * @return void
	 */
	public function render() {
		{
			$image            = ' button">Upload image';
			$image_size       = 'full'; // It would be better to use thumbnail size here (150x150 or so).
			$display          = 'none'; // Display state ot the "Remove image" button.
			$image_attributes = wp_get_attachment_image_src( $this->getValue(), $image_size );

		if ( $image_attributes ) {

			// $image_attributes[0] - image URL
			// $image_attributes[1] - image width
			// $image_attributes[2] - image height

			$image   = '"><img src="' . esc_url( $image_attributes[0] ) . '" style="max-width:100px;display:block;" />';
			$display = 'inline-block';
		}

		echo '<div>
                <a href="#" id="' . esc_attr( $this->getInputId() ) . 's-image" class="' . esc_attr( THEME_NAME ) . '_upload_image_button' . $image . '</a>
                <input type="hidden" name="' . esc_attr( $this->getName() ) . '" id="' . esc_attr( $this->getInputId() ) . '" value="' . esc_attr( $this->getValue() ) . '" />
                <a href="#" class="' . esc_attr( THEME_NAME ) . '_remove_image_button" style="display:' . esc_attr( $display ) . '">Remove image</a>
            </div>';
		}
	}
}
