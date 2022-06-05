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
 * @version    0.2.0
 * @since      0.2.0
 */

namespace RayTech\WPAbstractClasses\Administration;

/**
 * Wrapper class for WordPress options
 */
abstract class AbstractPage {

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
		foreach ( $this->getConfig() as $page ) {
			if ( 'top' === $page['parent'] ) {
				add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['callable'], $page['icon'], $page['position'] );
			} else {
				add_submenu_page( $this->createParentSlug( $page['parent'] ), $page['page_name'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['position'] );
			}
		}
	}

	/**
	 * Returns an array of config of where you wants pages added
	 *
	 * @return array
	 */
	protected function getConfig() {
		return [
			[
				'parent'     => 'dashboard',
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
			],
		];
	}

	/**
	 * Method to create parent slug parameter.
	 *
	 * @param string $parent Parent slug config choice.
	 * @return void
	 */
	protected function createParentSlug( $parent ) {
		/**
		 * Parent slug to return.
		 *
		 * @var string $slug
		 */
		$slug = '';
		switch ( $parent ) {
			case 'dashboard':
				$slug = 'index.php';
				break;
			case 'posts':
				$slug = 'edit.php';
				break;
			case 'media':
				$slug = 'upload.php';
				break;
			case 'pages':
				$slug = 'edit.php?post_type=page';
				break;
			case 'comments':
				$slug = 'edit-comments.php';
				break;
			case 'appearance':
				$slug = 'themes.php';
				break;
			case 'plugins':
				$slug = 'plugins.php';
				break;
			case 'users':
				$slug = 'users.php';
				break;
			case 'tools':
				$slug = 'tools.php';
				break;
			case 'settings':
				$slug = 'options-general.php';
				break;
			case 'network':
				$slug = 'settings.php';
				break;
			case 'custom':
			default:
				$slug = 'edit.php?post_type=' . $parent;
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
			];
			$attr      = ( ! empty( $value['attr'] ) ) ? $value['attr'] : [];
			$fqcn      = $namespace . '\\' . $classes[ $value['type'] ];
			$input     = new $fqcn( esc_attr( $page['name'] . $meta_key ), esc_attr( $page['name'] . $meta_key ), esc_attr( Option::get( $meta_key ) ), $attr );
			$input->render();

			echo '</p>';

		}
	}
}
