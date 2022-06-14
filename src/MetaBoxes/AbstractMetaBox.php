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
 * @version    0.3.2
 * @since      0.1.0
 */

namespace RayTech\WPAbstractClasses\MetaBoxes;

use RayTech\WPAbstractClasses\Utilities\JsonEncoder;

/**
 * Metabox Abstract class
 *
 * @abstract
 */
abstract class AbstractMetaBox {


	/**
	 * Post type name class string.
	 *
	 * @var string $post_type_class
	 */
	protected $post_type_class = '';

	/**
	 * Post type name string.
	 *
	 * @var string $post_type_name
	 */
	protected $post_type_name = '';

	/**
	 * Values array
	 *
	 * @var array
	 */
	protected $values = [];

	/**
	 * Constructor method which sets some variable and adds action for the meta boxes.
	 */
	public function __construct() {
		$this->post_type_class = THEME_NAME . '-' . $this->getPostType() . '-';
		$this->post_type_name  = THEME_NAME . '_' . $this->getPostType();
		add_action( 'load-post.php', [$this, 'add_boxes_setup'] );
		add_action( 'load-post-new.php', [$this, 'add_boxes_setup'] );
	}

	/**
	 * Add actions for adding the meta box and saving the meta data.
	 *
	 * @return void
	 */
	public function add_boxes_setup() {
		add_action( 'add_meta_boxes', [$this, 'add_boxes'] );
		add_action( 'save_post', [$this, 'save_meta'], 10, 2 );
	}

	/**
	 * Returns the post type this meta box is associated with
	 *
	 * @return string
	 */
	abstract protected function getPostType();

	/**
	 * Returns the name of the meta box
	 *
	 * @return string
	 */
	abstract protected function getName();

	/**
	 * This method is required and sets the needed inputs and their attributes for the meta box.
	 *
	 * @return array
	 */
	abstract protected function getConfig();

	/**
	 * Add meta boxes to the admin edit page of the post type.
	 *
	 * @return void
	 */
	public function add_boxes() {
		add_meta_box( $this->post_type_class . $this->getName(), ucfirst( $this->getName() ), [ $this, 'meta_boxes' ], $this->getPostType() );
	}

	/**
	 * Meta boxes rendering function
	 *
	 * @param  WP_Post $post post data object.
	 * @return void
	 */
	public function meta_boxes( $post ) {

		wp_nonce_field( basename( __FILE__ ), $this->post_type_name . 's_meta_nonce' );

		foreach ( $this->getConfig() as $meta_key => $value ) {
			echo '<p>
				<label for="' . esc_attr( $this->post_type_class . $meta_key ) . '">' . esc_html( $value['label'] ) . '</label>
				<br />';
			$namespace = '\\RayTech\\WPAbstractClasses\\Fields\\Inputs';
			$classes   = [
				'checkbox' => 'Checkbox',
				'color'    => 'Color',
				'date'     => 'Date',
				'datetime' => 'DateTime',
				'email'    => 'Email',
				'file'     => 'File',
				'hidden'   => 'Hidden',
				'media'    => 'Media',
				'month'    => 'Month',
				'number'   => 'Number',
				'password' => 'Password',
				'radio'    => 'Radio',
				'range'    => 'Range',
				'select'   => 'Select',
				'tel'      => 'Telephone',
				'text'     => 'Text',
				'textarea' => 'TextArea',
				'time'     => 'Time',
				'url'      => 'Url',
				'week'     => 'Week',
			];
			$attr      = ( ! empty( $value['attr'] ) ) ? $value['attr'] : [];
			$fqcn      = $namespace . '\\' . $classes[ $value['type'] ];
			$input     = new $fqcn( $this->post_type_class . $meta_key, $this->post_type_class . $meta_key, get_post_meta( $post->ID, $this->post_type_class . $meta_key, true ), $attr );
			$input->render();

			echo '</p>';

		}
	}

	/**
	 * Save the meta box's post metadata.
	 *
	 * @param  int     $post_id Post Id.
	 * @param  WP_Post $post    Post Object.
	 * @return int
	 */
	public function save_meta( $post_id, $post ) {

		/**
	* Verify the nonce before proceeding.
*/
		if ( ! isset( $_POST[ $this->post_type_name . 's_meta_nonce' ] ) || ! wp_verify_nonce( $_POST[ $this->post_type_name . 's_meta_nonce' ], basename( __FILE__ ) ) ) {
			return $post_id;
		}

		/* Get the post type object. */
		$post_type = get_post_type_object( $post->post_type );

		/* Check if the current user has permission to edit the post. */
		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}

		$config = $this->getConfig();
		$values = array_keys($config);

		foreach ( $values as $meta_key ) {
			if ( ! is_array( $_POST[ $this->post_type_class . $meta_key ] ) ) {
				/* Get the posted data and sanitize it for use as an HTML class. */
				$new_meta_value = ( isset( $_POST[ $this->post_type_class . $meta_key ] ) ? filter_input( INPUT_POST, $this->post_type_class . $meta_key, FILTER_SANITIZE_SPECIAL_CHARS ) : '' );
			} else {
				$new_meta_value = JsonEncoder::encode( $_POST[ $this->post_type_class . $meta_key ] );
			}
			/* Get the meta value of the custom field key. */
			$meta_value = get_post_meta( $post_id, $this->post_type_class . $meta_key, true );

			/* If a new meta value was added and there was no previous value, add it. */
			if ( $new_meta_value && '' === $meta_value ) {
				add_post_meta( $post_id, $this->post_type_class . $meta_key, $new_meta_value, true );
			} elseif ( $new_meta_value && $new_meta_value !== $meta_value ) { // If the new meta value does not match the old value, update it.
				update_post_meta( $post_id, $this->post_type_class . $meta_key, $new_meta_value );
			} elseif ( '' === $new_meta_value && $meta_value ) { // If there is no new meta value but an old value exists, delete it.
				delete_post_meta( $post_id, $meta_key, $meta_value );
			}
		}
	}
}
