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

namespace RayTech\BasicStarter\MetaBoxes;

use RayTech\BasicStarter\MetaBoxes\AbstractMetaBox;

/**
 * Example meta box class
 */
class ExampleMetaBox extends AbstractMetaBox {
	/**
	 * Get post type slug
	 *
	 * @inheritdoc
	 */
	protected function getPostType() {
		return 'staff';
	}

	/**
	 * Returns the name of the meta box
	 *
	 * @return string
	 */
	protected function getName() {
		return 'meta';
	}

	/**
	 * Returns the config array for building the meta box inputs
	 *
	 * @return array
	 */
	protected function getConfig() {
		return [
			'test_input'    => [
				'label' => __( 'Test text', 'basicstarter' ),
				'type'  => 'text',
			],
			'test_number'   => [
				'label' => __( 'Test number', 'basicstarter' ),
				'type'  => 'number',
				'attr'  => [
					'min' => '0',
					'max' => '120',
				],
			],
			'test_checkbox' => [
				'type'  => 'checkbox',
				'label' => __( 'Test checkbox', 'basicstarter' ),
			],
			'test_textarea' => [
				'label' => __( 'Test textarea', 'basicstarter' ),
				'type'  => 'textarea',

			],
			'test_media'    => [
				'label' => __( 'Test Media', 'basicstarter' ),
				'type'  => 'media',
			],
			'test_tel'      => [
				'label' => __( 'Test Tel', 'basicstarter' ),
				'type'  => 'tel',
			],
			'test_color'    => [
				'label' => __( 'Test color', 'basicstarter' ),
				'type'  => 'color',
			],
			'test_date'     => [
				'label' => __( 'Test Date', 'basicstarter' ),
				'type'  => 'date',
			],
			'test_url'      => [
				'label' => __( 'Test Url', 'basicstarter' ),
				'type'  => 'url',
			],
			'test_week'     => [
				'label' => __( 'Test Week', 'basicstarter' ),
				'type'  => 'week',
			],
			'test_month'    => [
				'label' => __( 'Test Month', 'basicstarter' ),
				'type'  => 'month',
			],
			'test_select'   => [
				'label' => __( 'Test Select', 'basicstarter' ),
				'type'  => 'select',
				'attr'  => [
					'options' => [
						'one' => 1,
						'two' => 2,
					],
				],
			],
		];
	}


}
