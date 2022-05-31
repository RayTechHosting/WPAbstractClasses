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
 * @since 0.2.0
 * @version 0.2.0
 */

namespace RayTech\BasicStarter\Taxonomies;

/**
 * Example tag class
 */
class ExampleTag extends AbstractTaxonomy {
	/**
	 * Get post type slug
	 *
	 * @inheritdoc
	 */
	protected function getPostType() {
		return 'example';
	}

	/**
	 * Gets the taxonomy type
	 *
	 * @inheritdoc
	 */
	protected function getType() {
		return 'tag';
	}

	/**
	 * Prepares all the labels for the configuration
	 *
	 * @access protected
	 * @return array
	 */
	protected function getLabels() {
		return [
			'name'              => _x( 'Example Tags', 'taxonomy general name', 'basicstarter' ),
			'singular_name'     => _x( 'Example Tag', 'taxonomy singular name', 'basicstarter' ),
			'search_items'      => __( 'Search Tags', 'basicstarter' ),
			'all_items'         => __( 'All Example Tags', 'basicstarter' ),
			'parent_item'       => __( 'Parent Example Tag', 'basicstarter' ),
			'parent_item_colon' => __( 'Parent Example Tag:', 'basicstarter' ),
			'edit_item'         => __( 'Edit Example Tag', 'basicstarter' ),
			'update_item'       => __( 'Update Example Tag', 'basicstarter' ),
			'add_new_item'      => __( 'Add New Example Tag', 'basicstarter' ),
			'new_item_name'     => __( 'New Example Tag', 'basicstarter' ),
			'menu_name'         => __( 'Example Tags', 'basicstarter' ),
		];
	}
}
