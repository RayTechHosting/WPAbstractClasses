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

use Exception;
use RayTech\WPAbstractClasses\Utilities\Fields as Utils;
use RayTech\WPAbstractClasses\Utilities\JsonEncoder;

/**
 * Class for making a set of input able to be repeated by the user for multiple things.
 */
class Repeater {

	/**
	 * Repeated Fields configuration array.
	 *
	 * @var array $config
	 */
	private $config = [];

	/**
	 * Constructor method to add in scripts.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue'] );
		add_filter( 'script_loader_tag', [$this, 'add_type_attribute'], 10, 3 );
	}

	/**
	 * Filter method for scripts.
	 *
	 * @param string $tag    Script HTML.
	 * @param string $handle Script handle name.
	 * @param string $src    Script source attribute.
	 * @return string
	 */
	public function add_type_attribute( $tag, $handle, $src ) {
		// if not your script, do nothing and return original $tag.
		if ( 'extra-repeater-js' !== $handle ) {
			return $tag;
		}
		// change the script tag by adding type="module" and return it.
		// phpcs:ignore
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
		return $tag;
	}

	/**
	 * Method to enqueue the script files.
	 *
	 * @return void
	 */
	public function admin_enqueue() {
		wp_enqueue_script( 'extra-repeater', plugin_dir_url( __FILE__ ) . '/../../../assets/dist/js/repeater.js', ['jquery'], '0.1.0', true );
		wp_enqueue_style( 'extra-repeater', plugin_dir_url( __FILE__ ) . '/../../../assets/dist/css/repeater.css', [], '0.7.0', 'all' );
	}

	/**
	 * Grab the configuration array of the repeated fields.
	 *
	 * @return array
	 */
	public function getConfig() {
		return $this->config;
	}

	/**
	 * Adds an input to the configuration array
	 *
	 * @throws Exception Error when an id has already been declared.
	 * @param string $type Input field type.
	 * @param string $label Label for the input field.
	 * @param string $id HTML id.
	 * @param array  $attr An array of all the other attributes you need on that input.
	 * @return void
	 */
	public function addInput( string $type, string $label, string $id, array $attr = null ) {
		if ( isset( $this->config[ $id ] ) ) {
			throw new Exception( 'An input with this id was already declared, please confirm your ids' );
		}
		$this->config[ $id ] = [
			'type'  => $type,
			'label' => $label,
			'attr'  => $attr,
		];
	}

	/**
	 * Rendering function for the repeated fields.
	 *
	 * @param string  $id Input id attribute.
	 * @param string  $post_type WordPress post type.
	 * @param string  $meta_key Meta key string.
	 * @param array   $fields Fields configuration array.
	 * @param boolean $blank Whether to load values or not.
	 * @return void
	 */
	public static function render( string $id, string $post_type, string $meta_key, array $fields, bool $blank = false ) {
		$loop   = 0;
		$name   = RTABSTRACT_THEME_NAME . '-' . $post_type . '-' . $meta_key;
		$values = JsonEncoder::decode( get_post_meta( $id, $name, true ), true );

		if ( $blank ) {
			echo '<div>';
			echo '<div class="float-right close"><button type="button">X</button></div>';
			foreach ( $fields as $input_key => $field ) {

				$fqcn = Utils::getFqcn( $field['type'] );
				if ( null !== $field['attr'] ) {
					$attr = array_merge( $field['attr'], ['data-input-key' => $input_key] );
				} else {
					$attr = ['data-input-key' => $input_key];
				}
				echo '<p>
				<label for="' . esc_attr( $name . '-' . $input_key ) . '">' . esc_html( $field['label'] ) . '</label>';
				$input = new $fqcn(
					$name . '-blank',
					$name . '-blank',
					'',
					$attr
				);
				$input->render();
				echo '</p>';
			}
			echo '<hr /></div>';
		} else {
			if ( empty( $values ) ) {
				echo '<div>';
				echo '<div class="float-right close"><button type="button">X</button></div>';
				foreach ( $fields as $input_key => $field ) {
					$fqcn = Utils::getFqcn( $field['type'] );
					if ( null !== $field['attr'] ) {
						$attr = array_merge( $field['attr'], ['data-input-key' => $input_key] );
					} else {
						$attr = ['data-input-key' => $input_key];
					}
					echo '<div>
					<label for="' . esc_attr( $name . '-' . $input_key ) . '-0">' . esc_html( $field['label'] ) . '</label>';
					$input = new $fqcn(
						$name . '-' . $input_key . '-0',
						$name . '[0][' . $input_key . ']',
						'',
						$attr
					);
					$input->render();
					echo '</div>';
				}
				echo '<hr /></div>';
			} else {
				foreach ( $values as $value ) {
					echo '<div>';
					echo '<div class="float-right close"><button type="button">X</button></div>';
					if ( is_array( $value ) ) {
						foreach ( $fields as $input_key => $field ) {
							$fqcn = Utils::getFqcn( $field['type'] );
							if ( null !== $field['attr'] ) {
								$attr = $field['attr'];
							} else {
								$attr = null;
							}

							echo '<div>
							<label for="' . esc_attr( $name . '-' . $input_key . '-' . $loop ) . '">' . esc_html( $field['label'] ) . '</label>';
							$input = new $fqcn(
								$name . '-' . $input_key . '-' . $loop,
								$name . '[' . $loop . '][' . $input_key . ']',
								$value[ $input_key ],
								$attr
							);
							$input->render();
							echo '</div>';
						}
					}
					echo '<hr /></div>';
					$loop++;
				}
			}
		}
	}
}
