<?php
/**
 * Copyright (C) 2020 RayTech Hosting <hosting@myraytech.net>
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
 * @version    0.3.5
 * @since      0.2.0
 */

namespace RayTech\WPAbstractClasses\Administration;

/**
 * Wrapper class for WordPress options
 */
abstract class AbstractPage {
	/**
	 * Parent slugs for submenu pages
	 *
	 * @var array $slugs
	 */
	protected $slugs = [
		'dashboard'  => 'index.php',
		'posts'      => 'edit.php',
		'media'      => 'upload.php',
		'pages'      => 'edit.php?post_type=page',
		'comments'   => 'edit-comments.php',
		'appearance' => 'themes.php',
		'plugins'    => 'plugins.php',
		'users'      => 'users.php',
		'tools'      => 'tools.php',
		'settings'   => 'options-general.php',
		'network'    => 'settings.php',
		'custom'     => 'edit.php?post_type=',
	];

	/**
	 * Constructor method
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_menu', [$this, 'addPages'] );
	}

	/**
	 * Loop to create the configured array of pages.
	 *
	 * @return void
	 */
	public function addPages() {
		$page = $this->getConfig();
		if ( 'top' === $page['parent'] ) {
			add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['callable'], $page['icon'], $page['position'] );
		} else {
			add_submenu_page( $this->createParentSlug( $page['parent'] ), $page['page_name'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['position'] );
		}
	}

	/**
	 * Returns an array of config of where you wants pages added
	 *
	 * @return array
	 */
	protected function getConfig() {
		return [
			'parent'     => 'custom',
			'post_type'  => 'test',
			'page_name'  => 'Test',
			'menu_title' => 'Test',
			'capability' => 'manage_options',
			'menu_slug'  => 'test_dash',
			'position'   => 10,
			'fields'     => [
				'test_input' => [
					'label' => __( 'Test text', 'basicstarter' ),
					'type'  => 'text',
				],
			],
		];
	}

	/**
	 * Method to create parent slug parameter.
	 *
	 * @param string $parent    Parent slug config choice.
	 * @param string $post_type Post type required when using custom slug.
	 * @return void
	 */
	protected function createParentSlug( $parent, $post_type = '' ) {
		/**
		 * Parent slug to return.
		 *
		 * @var string $slug
		 */
		$slug = $this->slugs[ $parent ];

		if ( 'custom' === $parent ) {
			$slug .= $post_type;
		}

	}

	/**
	 * Page fields rendering function
	 *
	 * @param  array $page page data array.
	 * @return void
	 */
	public function render_fields( $page ) {

		wp_nonce_field( basename( __FILE__ ), $page['name'] . 's_meta_nonce' );

		foreach ( $page['fields'] as $meta_key => $value ) {
			echo '<p>
				<label for="' . esc_attr( $page['name'] . $meta_key ) . '">' . esc_html( $value['label'] ) . '</label>
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
				'wysiwyg'  => 'Wysiwyg',
			];
			$attr      = ( ! empty( $value['attr'] ) ) ? $value['attr'] : [];
			$fqcn      = $namespace . '\\' . $classes[ $value['type'] ];
			$input     = new $fqcn( esc_attr( $page['name'] . $meta_key ), esc_attr( $page['name'] . $meta_key ), esc_attr( Option::get( $meta_key ) ), $attr );
			$input->render();

			echo '</p>';

		}
	}
}
