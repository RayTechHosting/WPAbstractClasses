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
 * @version    0.1.6
 * @since      0.1.6
 */

namespace RayTech\WPAbstractClasses\Administration;

/**
 * Setting wrapper class
 */
class Setting {

	/**
	 * Slug-name to identify the field. Used in the 'id' attribute of tags.
	 *
	 * @var string $id
	 **/
	protected $id;

	/**
	 * Formatted title of the field. Shown as the label for the field during output.
	 *
	 * @var string $title
	 **/
	protected $title;

	/**
	 * The slug-name of the settings page on which to show the section.
	 *
	 * @var string $page
	 **/
	protected $page;

	/**
	 * The slug-name of the section of the settings page in which to show the box.
	 *
	 * @var string $section
	 **/
	protected $section = 'default';

	/**
	 * A settings group name. Should correspond to an allowed option key name.
	 * Default allowed option key names include 'general', 'discussion', 'media', 'reading', 'writing', and 'options'.
	 *
	 * @var string $group
	 **/
	protected $group = 'general';

	/**
	 * Get setting identifier.
	 *
	 * @return string
	 **/
	public function getId() {
		return $this->id;
	}

	/**
	 * Set setting identifier.
	 *
	 * @param string $id Setting identifier.
	 * @return self
	 **/
	public function setId( string $id ) {
		$this->id = $id;

		return $this;
	}

	/**
	 * Get setting title
	 *
	 * @return string
	 **/
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Set setting title
	 *
	 * @param string $title Setting title.
	 * @return self
	 **/
	public function setTitle( string $title ) {
		$this->title = $title;

		return $this;
	}

	/**
	 * Get the options page to show the box in.
	 *
	 * @return string
	 **/
	public function getPage() {
		return $this->page;
	}

	/**
	 * Set the options page to show the box in.
	 *
	 * @param string $page Option page string.
	 * @return self
	 **/
	public function setPage( string $page ) {
		$this->page = $page;

		return $this;
	}

	/**
	 * Get the options page section to show the box in.
	 *
	 * @return string
	 **/
	public function getSection() {
		return $this->section;
	}

	/**
	 * Set the options page section to show the box in.
	 *
	 * @param string $section Settings field section.
	 * @return self
	 **/
	public function setSection( string $section ) {
		$this->section = $section;

		return $this;
	}

	/**
	 * Wrapper function to WordPress add_settings_field function.
	 *
	 * @param callable $callback Callback function to echo HTML for the field.
	 * @param array    $args     Arguments array to pass to the WordPress function.
	 * @return void
	 **/
	public function add_field( callable $callback, array $args = [] ) {
		add_settings_field( $this->id, $this->title, $callback, $this->page, $this->section, $args );
	}

	/**
	 * Wrapper function to WordPress add_section function.
	 *
	 * @param callable $callback Callback function to echo HTML for the section.
	 * @return void
	 **/
	public function add_section( callable $callback ) {
		add_settings_section( $this->id, $this->title, $callback, $this->page );
	}

	/**
	 * Wrapper function to WordPress register_setting function.
	 *
	 * @param array $args Arguments array to pass data to the WordPress function.
	 * @return void
	 **/
	public function register( $args ) {
		register_setting( $this->group, $this->title, $args );
	}

	/**
	 * Wrapper function to WordPress unregister_setting function.
	 *
	 * @param callable $deprecated Deprecation function.
	 * @return void
	 **/
	public function unregister( callable $deprecated ) {
		unregister_setting( $this->group, $this->title, $deprecated );
	}

	/**
	 * Wrapper method to WordPress settings_fields to render fields
	 *
	 * @return void
	 **/
	public function render_hidden_fields() {
		settings_fields( $this->group );
	}

	/**
	 * Wraper method for WordPress do_settings_section function to render settings
	 * fields in a section in the specified page.
	 *
	 * @return void
	 **/
	public function render_sections() {
		do_settings_sections( $this->page );
	}

	/**
	 * Wraper method for WordPress do_settings_fields function to render settings
	 * fields in specified section in the specified page.
	 *
	 * @return void
	 **/
	public function render_fields() {
		do_settings_fields( $this->page, $this->section );
	}

	/**
	 * Add a setting error thru the WordPress function
	 *
	 * @param string $code    Slug-name to identify the error. Used as prt of 'id' attribute in HTML output.
	 * @param string $message The formatted message text to display to the user.
	 * @param string $type    Message type, controls HTML class. Possible values include 'error', 'success', 'warning', 'info'.
	 * @return void
	 **/
	public function add_error( string $code, string $message, string $type = 'error' ) {
		add_settings_error( $this->title, $code, $message, $type );
	}

	/**
	 * Wrapper method to the WordPress function get_settings_errors which checks for errors in the $wp_settings_error array.
	 *
	 * @param  bool $sanitize Whether to re-sanitize the setting value before returning errors.
	 * @return void
	 **/
	public function get_errors( bool $sanitize = false ) {
		get_settings_errors( $this->title, $sanitize );
	}

	/**
	 * Outputs errors in divs.
	 *
	 * @param  bool $sanitize       Whether to re-sanitize the setting value before returning errors.
	 * @param  bool $hide_on_update If set to true errors will not be shown if the settings page has already been submitted.
	 * @return void
	 */
	public function errors( bool $sanitize = false, bool $hide_on_update = false ) {
		settings_errors( $this->title, $sanitize, $hide_on_update );
	}
}
