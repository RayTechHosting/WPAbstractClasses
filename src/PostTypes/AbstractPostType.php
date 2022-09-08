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
 * @version    0.1.0
 * @since      0.1.0
 */

namespace RayTech\WPAbstractClasses\PostTypes;

/**
 * Abstract class to utilize to create new post types for WordPress.
 *
 * @abstract
 */
abstract class AbstractPostType {

	/**
	 * Post type name slug
	 *
	 * @access protected
	 * @var string
	 */
	protected $post_type_name = '';

	/**
	 * Constructor method add the required action for registering the post type.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->post_type_name = RTABSTRACT_THEME_NAME . '_' . $this->getPostType() . '';
		add_action( 'init', [ $this, 'registerPostType' ] );
	}

	/**
	 * Returns the post type non-capitalize string
	 *
	 * @abstract
	 * @access protected
	 * @return string
	 */
	abstract protected function getPostType();

	/**
	 * Register post type
	 *
	 * @access public
	 * @return void
	 */
	public function registerPostType() {
		register_post_type( $this->getPostType(), $this->getConfig() );
	}

	/**
	 * Grabs the labels.
	 *
	 * @access protected
	 * @return array
	 */
	protected function getLabels() {
		return [
			'name'               => _x( ucfirst( $this->getPostType() ) . 's', 'Post Type General Name', 'basicstarter' ),
			'singular_name'      => _x( ucfirst( $this->getPostType() ), 'Post Type Singular Name', 'basicstarter' ),
			'menu_name'          => __( ucfirst( $this->getPostType() ) . 's', 'basicstarter' ),
			'parent_item_colon'  => __( 'Parent ' . ucfirst( $this->getPostType() ), 'basicstarter' ),
			'all_items'          => __( 'All ' . ucfirst( $this->getPostType() ) . 's', 'basicstarter' ),
			'view_item'          => __( 'View ' . ucfirst( $this->getPostType() ), 'basicstarter' ),
			'add_new_item'       => __( 'Add New ' . ucfirst( $this->getPostType() ), 'basicstarter' ),
			'add_new'            => __( 'Add ' . ucfirst( $this->getPostType() ), 'basicstarter' ),
			'edit_item'          => __( 'Edit ' . ucfirst( $this->getPostType() ), 'basicstarter' ),
			'update_item'        => __( 'Update ' . ucfirst( $this->getPostType() ), 'basicstarter' ),
			'search_items'       => __( 'Search ' . ucfirst( $this->getPostType() ), 'basicstarter' ),
			'not_found'          => __( 'Not Found', 'basicstarter' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'basicstarter' ),
		];
	}

	/**
	 * Get Configuration array
	 *
	 * @access protected
	 * @return array
	 */
	protected function getConfig() {
		$slug = get_option( $this->post_type_name . '_base' );
		if ( ! $slug ) {
			$slug = $this->getPostType();
		}
		$cat_slug = get_option( $this->post_type_name . '_cat' );
		if ( ! $cat_slug ) {
			$cat_slug = $this->getPostType() . 's';
		}
		return [
			'labels'             => $this->getLabels(),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'has_archive'        => $cat_slug,
			'rewrite'            => [
				'slug'  => $slug,
				'pages' => true,
			],
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies'         => [ $this->getPostType() . 's_category', $this->getPostType() . 's_tags'],
			'supports'           => ['title', 'editor', 'thumbnail'],
			'delete_with_user'   => false,
		];
	}

}
