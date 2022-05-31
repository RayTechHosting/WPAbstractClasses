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
 * @author Kevin Roy <royk@myraytech.net>
 * @package WordPress
 * @subpackage Basic Starter
 * @since 0.1.0
 * @version 0.2.0
 */

namespace RayTech\BasicStarter\PostTypes;

use RayTech\BasicStarter\MetaBoxes\ExampleMetaBox;
use RayTech\BasicStarter\Permalinks\ExamplePermalink;
use RayTech\BasicStarter\Taxonomies\ExampleTag;

/**
 * Example custom post type class
 */
class ExamplePostType extends AbstractPostType {
	/**
	 * Constructor method to link all the custom post type classes like Tag, Categories, Permalink options and metaboxes.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		new ExampleTag();
		new ExamplePermalink();
		new ExampleMetaBox();
	}

	/**
	 * Returns custom post type string for setup.
	 *
	 * @access public
	 * @return string
	 */
	public function getPostType() {
		return 'example';
	}

	/**
	 * Grabs the labels.
	 *
	 * @access protected
	 * @return array
	 */
	protected function getLabels() {
		return [
			'name'               => _x( 'Examples', 'Post Type General Name', 'basicstarter' ),
			'singular_name'      => _x( 'Example', 'Post Type Singular Name', 'basicstarter' ),
			'menu_name'          => __( 'Examples', 'basicstarter' ),
			'parent_item_colon'  => __( 'Parent Example', 'basicstarter' ),
			'all_items'          => __( 'All Examples', 'basicstarter' ),
			'view_item'          => __( 'View Example', 'basicstarter' ),
			'add_new_item'       => __( 'Add New Example', 'basicstarter' ),
			'add_new'            => __( 'Add Example', 'basicstarter' ),
			'edit_item'          => __( 'Edit Example', 'basicstarter' ),
			'update_item'        => __( 'Update Example', 'basicstarter' ),
			'search_items'       => __( 'Search Example', 'basicstarter' ),
			'not_found'          => __( 'Not Found', 'basicstarter' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'basicstarter' ),
		];
	}
}
