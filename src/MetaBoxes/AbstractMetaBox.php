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
 * @version    0.6.0
 * @since      0.1.0
 */

namespace RayTech\WPAbstractClasses\MetaBoxes;

use Exception;
use RayTech\WPAbstractClasses\Fields\Repeater;
use RayTech\WPAbstractClasses\Traits\PostType;
use RayTech\WPAbstractClasses\Utilities\Fields;
use RayTech\WPAbstractClasses\Utilities\JsonEncoder;
use RayTech\WPAbstractClasses\Utilities\Paths;

/**
 * Meta box Abstract class
 *
 * @abstract
 */
abstract class AbstractMetaBox {

	use PostType;
	/**
	 * Configuration array of the input fiels in the meta box
	 *
	 * @var array $config
	 */
	private $config;

	/**
	 * Amount of columns to seperate the meta box in.
	 *
	 * @var int $columns
	 */
	private $columns;

	/**
	 * This will set the label of the header of the meta box.
	 *
	 * @var string
	 */
	private $header = '';

	/**
	 * The slug of the meta box.
	 *
	 * @var string
	 */
	private $slug = 'meta';

	/**
	 * Post type name class string.
	 *
	 * @var string $post_type_class
	 */
	private $post_type_class;

	/**
	 * Post type name string.
	 *
	 * @var string $post_type_name
	 */
	private $post_type_name;

	/**
	 * Constructor method which sets some variable and adds action for the meta boxes.
	 */
	public function __construct() {
		$this->post_type_class = RTABSTRACT_THEME_NAME . '-' . $this->getPostType() . '-';
		$this->post_type_name  = RTABSTRACT_THEME_NAME . '_' . $this->getPostType();
		add_action( 'load-post.php', [$this, 'add_boxes_setup'] );
		add_action( 'load-post-new.php', [$this, 'add_boxes_setup'] );
		add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue'] );
		add_filter( 'script_loader_tag', [$this, 'add_type_attribute'], 10, 3 );
	}

	/**
	 * Filter to load javascripts as module.
	 *
	 * @param string $tag    HTML script tag string.
	 * @param string $handle JS loading handle.
	 * @param string $src   URL of loading script.
	 * @return string
	 */
	public function add_type_attribute( $tag, $handle, $src ) {
		// if not your script, do nothing and return original $tag.
		if ( 'rtabstract-conditional' !== $handle ) {
			return $tag;
		}
		// change the script tag by adding type="module" and return it.
		// phpcs:ignore
		$tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
		return $tag;
	}

	/**
	 * Enqueues scripts and styles for the admin panel
	 *
	 * @return void
	 */
	public function admin_enqueue() {
		$path = new Paths();
		wp_enqueue_script( 'rtabstract-conditional', $path->getAssetsPath() . '/dist/js/conditional.js', ['jquery'], '0.7.0', true );
		wp_enqueue_style( 'rtabstract-style', $path->getAssetsPath() . '/dist/css/style.css', [], '0.7.0' );
		wp_enqueue_script( 'rtabstract-media', $path->getAssetsPath() . '/dist/js/jquery.mediaupload.js', ['jquery'], '0.7.0', true );
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
	 * This method is required and sets the needed inputs and their attributes for the meta box.
	 *
	 * @return array
	 */
	protected function getConfig() {
		return $this->config;
	}

	/**
	 * Add meta boxes to the admin edit page of the post type.
	 *
	 * @return void
	 */
	public function add_boxes() {
		add_meta_box( $this->post_type_class . $this->getSlug(), esc_html( ucfirst( $this->getHeader() ) ), [ $this, 'meta_boxes' ], $this->getPostType() );
	}

	/**
	 * Adds an input to the meta box configuration.
	 *
	 * @param string $type HTML input type.
	 * @param string $label Sets the label of the input.
	 * @param string $id    Sets the HTML attributes id and name with this variable linking it to the label.
	 * @param array  $attr An array of all the other possible HTML attributes.
	 * @throws Exception Throws Exception when an HTML id is doubled by mistake.
	 * @return void
	 */
	protected function addInput( $type = 'text', $label = '', $id = '', $attr = [] ) {
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
	 * Meta boxes rendering function
	 *
	 * @param  WP_Post $post post data object.
	 * @return void
	 */
	public function meta_boxes( $post ) {
		wp_nonce_field( basename( __FILE__ ), $this->post_type_name . 's_meta_nonce' );
		echo '<div class="grid grid-cols-' . esc_attr( $this->getColumns() ) . ' gap-2">';
		foreach ( $this->getConfig() as $meta_key => $value ) {
			echo '<div id="' . esc_attr( $this->post_type_class . $meta_key ) . '">
				<label for="' . esc_attr( $this->post_type_class . $meta_key ) . '">' . esc_html( $value['label'] ) . '</label>
				<br />';

			$attr = ( ! empty( $value['attr'] ) ) ? $value['attr'] : [];
			$fqcn = Fields::getFqcn( $value['type'] );
			if ( isset( $attr['conditions'] ) ) {
				echo "<div class='condition' data-conditions='" . esc_js( addslashes( wp_json_encode( $attr['conditions'] ) ) ) . "' >";
			}
			if ( isset( $attr['fields'] ) && 'repeater' === $value['type'] ) {
				Repeater::render( $post->ID, $this->getPostType(), $meta_key, $attr['fields'] );
				echo '<button class="repeater_add" data-meta_key="' . esc_attr( $this->post_type_class . $meta_key ) . '">';
				/* translators: button for adding a repeated set of fields */
				printf( esc_html__( 'Add %s', 'rtabstract' ), esc_html( $value['label'] ) );
				?></button></div>
					<div id="rtabstract_repeater_<?php echo esc_attr( $this->post_type_class . $meta_key ); ?>" class="hidden">
						<?php Repeater::render( $post->ID, $this->getPostType(), $meta_key, $attr['fields'], true ); ?>
					</div>
				<?php
			} elseif ( isset( $attr['repeat'] ) ) {
				$repeat = $attr['repeat'] + 1;
				unset( $attr['repeat'] );
				for ( $loop = 1; $loop < $repeat; $loop++ ) {
					$input = new $fqcn( $this->post_type_class . $meta_key . '-' . $loop, $this->post_type_class . $meta_key . '-' . $loop, get_post_meta( $post->ID, $this->post_type_class . $meta_key, true ), $attr );
					$input->render();
				}
			} else {
				$input = new $fqcn( $this->post_type_class . $meta_key, $this->post_type_class . $meta_key, get_post_meta( $post->ID, $this->post_type_class . $meta_key, true ), $attr );
				$input->render();
			}

			echo '</div>';
		}
		if ( 'repeater' !== $value['type'] ) {
			echo '</div>';
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

		// Verify the nonce before proceeding.
		if ( ! isset( $_POST[ $this->post_type_name . 's_meta_nonce' ] ) || ! wp_verify_nonce( $_POST[ $this->post_type_name . 's_meta_nonce' ], basename( __FILE__ ) ) ) {
			return $post_id;
		}

		// Get the post type object.
		$post_type = get_post_type_object( $post->post_type );

		// Check if the current user has permission to edit the post.
		if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
			return $post_id;
		}

		$config = $this->getConfig();
		$values = array_keys( $config );

		foreach ( $values as $meta_key ) {
			if ( 'wysiwyg' === $config[ $meta_key ]['type'] ) {
				$new_meta_value = ( isset( $_POST[ $this->post_type_class . $meta_key ] ) ? filter_input( INPUT_POST, $this->post_type_class . $meta_key, FILTER_UNSAFE_RAW ) : '' );
			} elseif ( isset( $_POST[ $this->post_type_class . $meta_key ] ) && ! is_array( $_POST[ $this->post_type_class . $meta_key ] ) ) {
				$new_meta_value = ( isset( $_POST[ $this->post_type_class . $meta_key ] ) ? filter_input( INPUT_POST, $this->post_type_class . $meta_key, FILTER_SANITIZE_SPECIAL_CHARS ) : '' );
			} else {
				if ( isset( $_POST[ $this->post_type_class . $meta_key ] ) ) {
					$new_meta_value = JsonEncoder::encode( $_POST[ $this->post_type_class . $meta_key ] );
				}
			}
			// Get the meta value of the custom field key.
			$meta_value = get_post_meta( $post_id, $this->post_type_class . $meta_key, true );

			if ( isset( $new_meta_value ) ) {
				// If a new meta value was added and there was no previous value, add it.
				if ( $new_meta_value && '' === $meta_value ) {
					add_post_meta( $post_id, $this->post_type_class . $meta_key, $new_meta_value, true );
				} elseif ( $new_meta_value && $new_meta_value !== $meta_value ) { // If the new meta value does not match the old value, update it.
					update_post_meta( $post_id, $this->post_type_class . $meta_key, $new_meta_value );
				} elseif ( '' === $new_meta_value && $meta_value ) { // If there is no new meta value but an old value exists, delete it.
					delete_post_meta( $post_id, $this->post_type_class . $meta_key, $meta_value );
				}
			}
		}
	}

	/**
	 * Get the slug of the meta box.
	 *
	 * @return  string
	 */
	public function getSlug() {
		return $this->slug;
	}

	/**
	 * Set the slug of the meta box.
	 *
	 * @param  string $slug  The slug of the meta box.
	 *
	 * @return  self
	 */
	public function setSlug( string $slug ) {
		$this->slug = $slug;

		return $this;
	}

	/**
	 * Get amount of columns to seperate the meta box in.
	 *
	 * @return  int
	 */
	public function getColumns() {
		return $this->columns;
	}

	/**
	 * Set amount of columns to seperate the meta box in.
	 *
	 * @param  int $columns  Amount of columns to seperate the meta box in.
	 *
	 * @return  self
	 */
	public function setColumns( int $columns ) {
		$this->columns = $columns;

		return $this;
	}

	/**
	 * Get this will set the label of the header of the meta box.
	 *
	 * @return  string
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * Set this will set the label of the header of the meta box.
	 *
	 * @param  string $header  This will set the label of the header of the meta box.
	 *
	 * @return  self
	 */
	public function setHeader( string $header ) {
		$this->header = $header;

		return $this;
	}
}
