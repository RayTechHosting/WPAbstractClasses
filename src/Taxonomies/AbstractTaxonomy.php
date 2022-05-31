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

namespace RayTech\WPAbstractClasses\Taxonomies;

/**
 * This class has the basic functions for creating a taxonomy in WordPress relating to a post type .
 *
 * @abstract
 */
abstract class AbstractTaxonomy {
	/**
	 * Type strings array
	 *
	 * @access protected
	 * @var array $types
	 */
	protected $types = [];

	/**
	 * Constructor method helping setup a few things
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->types = [
			'category' => [
				'singular' => 'Category',
				'plural'   => 'Categories',
			],
			'tag'      => [
				'singular' => 'Tag',
				'plural'   => 'Tags',
			],
		];
		add_action( 'init', [ $this, 'registerTaxonomy' ] );
	}

	/**
	 * Set the post getType() for this taxonomy
	 *
	 * @abstract
	 * @access protected
	 * @return string
	 */
	abstract protected function getPostType();

	/**
	 * Set the getType() of taxonomy (tag or category).
	 *
	 * @abstract
	 * @access protected
	 * @return string
	 */
	abstract protected function getType();

	/**
	 * Register the actual taxonomy
	 *
	 * @access public
	 * @return void
	 */
	public function registerTaxonomy() {
		register_taxonomy( $this->getPostType() . '_' . $this->getType(), $this->getPostType(), $this->getConfig() );
	}

	/**
	 * Configure you taxonomy by overriding this method
	 *
	 * @access protected
	 * @link https://developer.wordpress.org/reference/functions/register_taxonomy/#arguments
	 * @return array
	 */
	protected function getConfig() {
		return [
			'labels'       => $this->getLabels(),
			'hierarchical' => ( $this->getType() === 'category' ) ? true : false,
			'query_var'    => ( $this->getType() === 'tag' ) ? true : false,
		];
	}

	/**
	 * Prepares all the labels for the configuration
	 *
	 * @access protected
	 * @example "examples/ExampleTag.php" 56 14 Example of tags label.
	 * @return array
	 */
	protected function getLabels() {
		return [
			'name'              => _x( ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['plural'], 'taxonomy general name', 'basicstarter' ),
			'singular_name'     => _x( ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['singular'], 'taxonomy singular name', 'basicstarter' ),
			'search_items'      => __( 'Search ' . ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['plural'], 'basicstarter' ),
			'all_items'         => __( 'All ' . ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['plural'], 'basicstarter' ),
			'parent_item'       => __( 'Parent ' . ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['singular'], 'basicstarter' ),
			'parent_item_colon' => __( 'Parent ' . ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['singular'] . ':', 'basicstarter' ),
			'edit_item'         => __( 'Edit ' . ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['singular'], 'basicstarter' ),
			'update_item'       => __( 'Update ' . ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['singular'], 'basicstarter' ),
			'add_new_item'      => __( 'Add New ' . ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['singular'], 'basicstarter' ),
			'new_item_name'     => __( 'New ' . ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['singular'], 'basicstarter' ),
			'menu_name'         => __( ucfirst( $this->getPostType() ) . ' ' . $this->types[ $this->getType() ]['plural'], 'basicstarter' ),
		];
	}
}
