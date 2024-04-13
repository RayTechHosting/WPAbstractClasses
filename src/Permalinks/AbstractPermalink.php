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

namespace RayTech\WPAbstractClasses\Permalinks;

use RayTech\WPAbstractClasses\Traits\PostType;
use RayTech\WPAbstractClasses\Utilities\Configuration;

/**
 * Abstract permalink class.
 *
 * @abstract
 */
abstract class AbstractPermalink {

	use PostType;
	/**
	 * Post type name
	 *
	 * @access protected
	 * @var    string
	 */
	protected $post_type_name = '';

	/**
	 * Configuration
	 *
	 * @access protected
	 * @var    Configuration
	 */
	protected $config;

	/**
	 * Constructor method
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->config         = new Configuration();
		$this->post_type_name = $this->config->data['theme_name'] . '-' . $this->getPostType();
		add_action( 'load-options-permalink.php', [$this, 'loadPermalinks'] );
	}

	/**
	 * Loading permalinks
	 *
	 * @access public
	 * @return void
	 */
	public function loadPermalinks() {
		add_option( $this->post_type_name . '_base' );
		add_option( $this->post_type_name . '_cat' );
		if ( isset( $_POST[ $this->post_type_name . '_base' ] ) && isset( $_POST[ $this->post_type_name . '_nonce_base' ] ) && wp_verify_nonce( $_POST[ $this->post_type_name . '_nonce_base' ], $this->config->data['theme_name'] . $this->post_type_name . '_base' ) ) {
			update_option( $this->post_type_name . '_base', sanitize_title_with_dashes( $_POST[ $this->post_type_name . '_base' ] ) );
		}
		if ( isset( $_POST[ $this->post_type_name . '_cat' ] ) && isset( $_POST[ $this->post_type_name . '_nonce_cat' ] ) && wp_verify_nonce( $_POST[ $this->post_type_name . '_nonce_cat' ], $this->config->data['theme_name'] . $this->post_type_name . '_cat' ) ) {
			update_option( $this->post_type_name . '_cat', sanitize_title_with_dashes( $_POST[ $this->post_type_name . '_cat' ] ) );
		}
		// phpcs:ignore
		add_settings_field( $this->post_type_name . '_base', __( ucfirst( $this->getPostType() ) . 's single', 'basicstarter' ), [$this, 'permalinks_field_callback'], 'permalink', 'optional' );
		// phpcs:ignore
		add_settings_field( $this->post_type_name . '_cat', __( ucfirst( $this->getPostType() ) . 's archive', 'basicstarter' ), [$this, 'permalinks_cat_field_callback'], 'permalink', 'optional' );
	}

	/**
	 * Permalinks field callback
	 *
	 * @access public
	 * @return void
	 */
	public function permalinks_field_callback() {
		$value = get_option( $this->post_type_name . '_base' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="' . esc_attr( $this->post_type_name ) . '_base" id="' . esc_attr( $this->post_type_name ) . '_base" class="regular-text" />';
		wp_nonce_field( $this->config->data['theme_name'] . $this->post_type_name . '_base', $this->post_type_name . '_nonce_base' );
	}

	/**
	 * Permalinks category field callback
	 *
	 * @access public
	 * @return void
	 */
	public function permalinks_cat_field_callback() {
		$value = get_option( $this->post_type_name . '_cat' );
		echo '<input type="text" value="' . esc_attr( $value ) . '" name="' . esc_attr( $this->post_type_name ) . '_cat" id="' . esc_attr( $this->post_type_name ) . '_cat" class="regular-text" />';
		wp_nonce_field( $this->config->data['theme_name'] . $this->post_type_name . '_cat', esc_attr( $this->post_type_name ) . '_nonce_cat' );
	}
}
