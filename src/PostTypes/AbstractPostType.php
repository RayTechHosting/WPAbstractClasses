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
 * @version    0.3.6
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
	private $post_type_name;

	/**
	 * Name of the post type shown in the menu. Usually plural.
	 *
	 * @var string
	 */
	private $label;

	/**
	 * An array of labels for this post type.
	 *
	 * @var string[]
	 */
	private $labels;

	/**
	 * This variable sets the publicly viewable settings.
	 *
	 * @access protected
	 * @var bool
	 */
	private $public;

	/**
	 * This variable constrols whether the post type is publicly queriable.
	 *
	 * @var bool
	 */
	private $publicly_queriable;

	/**
	 * Description of the post type.
	 *
	 * @var string
	 */
	private $description;

	/**
	 * This variable sets wether or not the post is hierarchical.
	 *
	 * @var bool
	 */
	private $hierarchical;

	/**
	 * Whether to exclude posts with this post type from front end search results.
	 *
	 * @var bool
	 */
	private $exclude_from_search;

	/**
	 * Whether to generate and allow a UI for managing this post type in the admin.
	 *
	 * @var bool
	 */
	private $show_ui;

	/**
	 * Undocumented variable
	 *
	 * @var bool|string
	 */
	private $show_in_menu;

	/**
	 * Makes this post type available for selection in navigation menus.
	 *
	 * @var bool
	 */
	private $show_in_nav_menus;

	/**
	 * Makes this post type available via the admin bar.
	 *
	 * @var bool
	 */
	private $show_in_admin_bar;

	/**
	 * Whether to include the post type in the REST API.
	 *
	 * @var bool
	 */
	private $show_in_rest;

	/**
	 * To change the base URL of REST API route.
	 *
	 * @var string
	 */
	private $rest_base;

	/**
	 * To change the namespace URL of REST API route.
	 *
	 * @var string
	 */
	private $rest_namespace;

	/**
	 * REST API controller class name.
	 *
	 * @var string
	 */
	private $rest_controller_class;

	/**
	 * The position in the menu order the post type should appear.
	 *
	 * @var integer
	 */
	private $menu_position;

	/**
	 * The URL to the icon to be used for this menu. Pass a base64-encoded SVG using a data URI,
	 * which will be colored to match the color scheme -- this should begin with 'data:image/svg+xml;
	 * base64,'. Pass the name of a Dashicons helper class to use a font icon, e.g.
	 * 'dashicons-chart-pie'. Pass 'none' to leave div.wp-menu-image empty so an icon can be added via
	 * CSS. Defaults to use the posts icon.
	 *
	 * @var string
	 */
	private $menu_icon;

	/**
	 * The string to use to build the read, edit, and delete capabilities.
	 *
	 * @var string|array
	 */
	private $capability_type;

	/**
	 * Array of capabilities for this post type.
	 *
	 * @var string[]
	 */
	private $capabilities;

	/**
	 * Whether to use the internal default meta capability handling.
	 *
	 * @var bool
	 */
	private $map_meta_cap;

	/**
	 * Core feature(s) the post type supports.
	 *
	 * @var array
	 */
	private $supports;

	/**
	 * Provide a callback function that sets up the meta boxes for the edit form.
	 *
	 * @var callable
	 */
	private $register_meta_box_cb;

	/**
	 * An array of taxonomy identifiers that will be registered for the post type.
	 *
	 * @var string[]
	 */
	private $taxonomies;

	/**
	 * Whether there should be post type archives, or if a string, the archive slug to use.
	 *
	 * @var bool|string
	 */
	private $has_archive;

	/**
	 * Triggers the handling of rewrites for this post type. To prevent rewrite, set to false.
	 *
	 * @var bool|array
	 */
	private $rewrite;

	/**
	 * Sets the query_var key for this post type.
	 *
	 * @var string|bool
	 */
	private $query_var;

	/**
	 * Whether to allow this post type to be exported.
	 *
	 * @var bool
	 */
	private $can_export;

	/**
	 * Whether to delete posts of this type when deleting a user.
	 *
	 * @var bool
	 */
	private $delete_with_user;

	/**
	 * Array of blocks to use as the default initial state for an editor session.
	 *
	 * @var array
	 */
	private $template;

	/**
	 * Whether the block template should be locked if $template is set.
	 *
	 * @var string|false
	 */
	private $template_lock;

	/**
	 * Constructor method add the required action for registering the post type.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$slug = get_option( $this->post_type_name . '_base' );
		if ( ! $slug ) {
			$slug = $this->getPostType();
		}
		$cat_slug = get_option( $this->post_type_name . '_cat' );
		if ( ! $cat_slug ) {
			$cat_slug = $this->getPostType() . 's';
		}
		$this
			->setPublic( true )
			->setPubliclyQueriable( true )
			->setShowUi( true )
			->setShowInMenu( true )
			->setShowInNavMenus( true )
			->setQueryVar( true )
			->setRewrite( [ 'slug' => $slug, 'pages' => true ] )
			->setHierarchical( false )
			->setHasArchive( $cat_slug )
			->setMenuPosition( null )
			->setSupports( [ 'title', 'editor', 'thumbnail' ] )
			->setDeleteWithUser( false );
		//phpcs:disable
		$this->setLabels(
			[
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
			]
		);
		
		$this->post_type_name = \RTABSTRACT_THEME_NAME . '_' . $this->getPostType() . '';
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
	 * Get Configuration array
	 *
	 * @access protected
	 * @return array
	 */
	protected function getConfig() {
		$config = [];
		foreach ( $this as $key => $value ) {
			if(!empty($value)) {
				$config[$key] = $value;
			}
		}
		return $config;
	}


	/**
	 * Get an array of labels for this post type.
	 *
	 * @return  string[]
	 */
	public function getLabels() {
		return $this->labels;
	}

	/**
	 * Set an array of labels for this post type.
	 *
	 * @param  string[] $labels  An array of labels for this post type.
	 *
	 * @return  self
	 */
	public function setLabels( array $labels ) {

		$this->labels = $labels;

		return $this;
	}

	/**
	 * Get name of the post type shown in the menu. Usually plural.
	 *
	 * @return  string
	 */ 
	public function getLabel()
	{
		return $this->label;
	}

	/**
	 * Set name of the post type shown in the menu. Usually plural.
	 *
	 * @param  string  $label  Name of the post type shown in the menu. Usually plural.
	 *
	 * @return  self
	 */ 
	public function setLabel(string $label)
	{
		$this->label = $label;

		return $this;
	}

	/**
	 * Get this variable sets the publicly viewable settings.
	 *
	 * @return  bool
	 */ 
	public function getPublic()
	{
		return $this->public;
	}

	/**
	 * Set this variable sets the publicly viewable settings.
	 *
	 * @param  bool  $public  This variable sets the publicly viewable settings.
	 *
	 * @return  self
	 */ 
	public function setPublic(bool $public)
	{
		$this->public = $public;

		return $this;
	}

	/**
	 * Get this variable constrols whether the post type is publicly queriable.
	 *
	 * @return  bool
	 */ 
	public function getPubliclyQueriable()
	{
		return $this->publicly_queriable;
	}

	/**
	 * Set this variable constrols whether the post type is publicly queriable.
	 *
	 * @param  bool  $publicly_queriable  This variable constrols whether the post type is publicly queriable.
	 *
	 * @return  self
	 */ 
	public function setPubliclyQueriable(bool $publicly_queriable)
	{
		$this->publicly_queriable = $publicly_queriable;

		return $this;
	}

	/**
	 * Get description of the post type.
	 *
	 * @return  string
	 */ 
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Set description of the post type.
	 *
	 * @param  string  $description  Description of the post type.
	 *
	 * @return  self
	 */ 
	public function setDescription(string $description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Get this variable sets wether or not the post is hierarchical.
	 *
	 * @return  bool
	 */ 
	public function getHierarchical()
	{
		return $this->hierarchical;
	}

	/**
	 * Set this variable sets wether or not the post is hierarchical.
	 *
	 * @param  bool  $hierarchical  This variable sets wether or not the post is hierarchical.
	 *
	 * @return  self
	 */ 
	public function setHierarchical(bool $hierarchical)
	{
		$this->hierarchical = $hierarchical;

		return $this;
	}

	/**
	 * Get whether to exclude posts with this post type from front end search results.
	 *
	 * @return  bool
	 */ 
	public function getExcludeFromSearch()
	{
		return $this->exclude_from_search;
	}

	/**
	 * Set whether to exclude posts with this post type from front end search results.
	 *
	 * @param  bool  $exclude_from_search  Whether to exclude posts with this post type from front end search results.
	 *
	 * @return  self
	 */ 
	public function setExcludeFromSearch(bool $exclude_from_search)
	{
		$this->exclude_from_search = $exclude_from_search;

		return $this;
	}

	/**
	 * Get whether to generate and allow a UI for managing this post type in the admin.
	 *
	 * @return  bool
	 */ 
	public function getShowUi()
	{
		return $this->show_ui;
	}

	/**
	 * Set whether to generate and allow a UI for managing this post type in the admin.
	 *
	 * @param  bool  $show_ui  Whether to generate and allow a UI for managing this post type in the admin.
	 *
	 * @return  self
	 */ 
	public function setShowUi(bool $show_ui)
	{
		$this->show_ui = $show_ui;

		return $this;
	}

	/**
	 * Get undocumented variable
	 *
	 * @return  bool|string
	 */ 
	public function getShowInMenu()
	{
		return $this->show_in_menu;
	}

	/**
	 * Set undocumented variable
	 *
	 * @param  bool|string  $show_in_menu  Undocumented variable
	 *
	 * @return  self
	 */ 
	public function setShowInMenu($show_in_menu)
	{
		$this->show_in_menu = $show_in_menu;

		return $this;
	}

	/**
	 * Get makes this post type available for selection in navigation menus.
	 *
	 * @return  bool
	 */ 
	public function getShowInNavMenus()
	{
		return $this->show_in_nav_menus;
	}

	/**
	 * Set makes this post type available for selection in navigation menus.
	 *
	 * @param  bool  $show_in_nav_menus  Makes this post type available for selection in navigation menus.
	 *
	 * @return  self
	 */ 
	public function setShowInNavMenus(bool $show_in_nav_menus)
	{
		$this->show_in_nav_menus = $show_in_nav_menus;

		return $this;
	}

	/**
	 * Get makes this post type available via the admin bar.
	 *
	 * @return  bool
	 */ 
	public function getShowInAdminBar()
	{
		return $this->show_in_admin_bar;
	}

	/**
	 * Set makes this post type available via the admin bar.
	 *
	 * @param  bool  $show_in_admin_bar  Makes this post type available via the admin bar.
	 *
	 * @return  self
	 */ 
	public function setShowInAdminBar(bool $show_in_admin_bar)
	{
		$this->show_in_admin_bar = $show_in_admin_bar;

		return $this;
	}

	/**
	 * Get whether to include the post type in the REST API.
	 *
	 * @return  bool
	 */ 
	public function getShowInRest()
	{
		return $this->show_in_rest;
	}

	/**
	 * Set whether to include the post type in the REST API.
	 *
	 * @param  bool  $show_in_rest  Whether to include the post type in the REST API.
	 *
	 * @return  self
	 */ 
	public function setShowInRest(bool $show_in_rest)
	{
		$this->show_in_rest = $show_in_rest;

		return $this;
	}

	/**
	 * Get to change the base URL of REST API route.
	 *
	 * @return  string
	 */ 
	public function getRestBase()
	{
		return $this->rest_base;
	}

	/**
	 * Set to change the base URL of REST API route.
	 *
	 * @param  string  $rest_base  To change the base URL of REST API route.
	 *
	 * @return  self
	 */ 
	public function setRestBase(string $rest_base)
	{
		$this->rest_base = $rest_base;

		return $this;
	}

	/**
	 * Get to change the namespace URL of REST API route.
	 *
	 * @return  string
	 */ 
	public function getRestNamespace()
	{
		return $this->rest_namespace;
	}

	/**
	 * Set to change the namespace URL of REST API route.
	 *
	 * @param  string  $rest_namspace  To change the namespace URL of REST API route.
	 *
	 * @return  self
	 */ 
	public function setRestNamespace(string $rest_namespace)
	{
		$this->rest_namespace = $rest_namespace;

		return $this;
	}

	/**
	 * Get rEST API controller class name.
	 *
	 * @return  string
	 */ 
	public function getRestControllerClass()
	{
		return $this->rest_controller_class;
	}

	/**
	 * Set rEST API controller class name.
	 *
	 * @param  string  $rest_controller_class  REST API controller class name.
	 *
	 * @return  self
	 */ 
	public function setRestControllerClass(string $rest_controller_class)
	{
		$this->rest_controller_class = $rest_controller_class;

		return $this;
	}

	/**
	 * Get the position in the menu order the post type should appear.
	 *
	 * @return  integer
	 */ 
	public function getMenuPosition()
	{
		return $this->menu_position;
	}

	/**
	 * Set the position in the menu order the post type should appear.
	 *
	 * @param  integer  $menu_position  The position in the menu order the post type should appear.
	 *
	 * @return  self
	 */ 
	public function setMenuPosition($menu_position)
	{
		$this->menu_position = $menu_position;

		return $this;
	}

	/**
	 * Get cSS. Defaults to use the posts icon.
	 *
	 * @return  string
	 */ 
	public function getMenuIcon()
	{
		return $this->menu_icon;
	}

	/**
	 * Set cSS. Defaults to use the posts icon.
	 *
	 * @param  string  $menu_icon  CSS. Defaults to use the posts icon.
	 *
	 * @return  self
	 */ 
	public function setMenuIcon(string $menu_icon)
	{
		$this->menu_icon = $menu_icon;

		return $this;
	}

	/**
	 * Get the string to use to build the read, edit, and delete capabilities.
	 *
	 * @return  string|array
	 */ 
	public function getCapabilityType()
	{
		return $this->capability_type;
	}

	/**
	 * Set the string to use to build the read, edit, and delete capabilities.
	 *
	 * @param  string|array  $capability_type  The string to use to build the read, edit, and delete capabilities.
	 *
	 * @return  self
	 */ 
	public function setCapabilityType(mixed $capability_type)
	{
		$this->capability_type = $capability_type;

		return $this;
	}

	/**
	 * Get array of capabilities for this post type.
	 *
	 * @return  string[]
	 */ 
	public function getCapabilities()
	{
		return $this->capabilities;
	}

	/**
	 * Set array of capabilities for this post type.
	 *
	 * @param  string[]  $capabilities  Array of capabilities for this post type.
	 *
	 * @return  self
	 */ 
	public function setCapabilities(array $capabilities)
	{
		$this->capabilities = $capabilities;

		return $this;
	}

	/**
	 * Get core feature(s) the post type supports.
	 *
	 * @return  array
	 */ 
	public function getSupports()
	{
		return $this->supports;
	}

	/**
	 * Set core feature(s) the post type supports.
	 *
	 * @param  array  $supports  Core feature(s) the post type supports.
	 *
	 * @return  self
	 */ 
	public function setSupports(array $supports)
	{
		$this->supports = $supports;

		return $this;
	}

	/**
	 * Get provide a callback function that sets up the meta boxes for the edit form.
	 *
	 * @return  callable
	 */ 
	public function getRegisterMetaBoxCb()
	{
		return $this->register_meta_box_cb;
	}

	/**
	 * Set provide a callback function that sets up the meta boxes for the edit form.
	 *
	 * @param  callable  $register_meta_box_cb  Provide a callback function that sets up the meta boxes for the edit form.
	 *
	 * @return  self
	 */ 
	public function setRegisterMetaBoxCb(callable $register_meta_box_cb)
	{
		$this->register_meta_box_cb = $register_meta_box_cb;

		return $this;
	}

	/**
	 * Get an array of taxonomy identifiers that will be registered for the post type.
	 *
	 * @return  string[]
	 */ 
	public function getTaxonomies()
	{
		return $this->taxonomies;
	}

	/**
	 * Set an array of taxonomy identifiers that will be registered for the post type.
	 *
	 * @param  string[]  $taxonomies  An array of taxonomy identifiers that will be registered for the post type.
	 *
	 * @return  self
	 */ 
	public function setTaxonomies(array $taxonomies)
	{
		$this->taxonomies = $taxonomies;

		return $this;
	}

	/**
	 * Get whether there should be post type archives, or if a string, the archive slug to use.
	 *
	 * @return  bool|string
	 */ 
	public function getHasArchive()
	{
		return $this->has_archive;
	}

	/**
	 * Set whether there should be post type archives, or if a string, the archive slug to use.
	 *
	 * @param  bool|string  $has_archive  Whether there should be post type archives, or if a string, the archive slug to use.
	 *
	 * @return  self
	 */ 
	public function setHasArchive($has_archive)
	{
		$this->has_archive = $has_archive;

		return $this;
	}

	/**
	 * Get triggers the handling of rewrites for this post type. To prevent rewrite, set to false.
	 *
	 * @return  bool|array
	 */ 
	public function getRewrite()
	{
		return $this->rewrite;
	}

	/**
	 * Set triggers the handling of rewrites for this post type. To prevent rewrite, set to false.
	 *
	 * @param  bool|array  $rewrite  Triggers the handling of rewrites for this post type. To prevent rewrite, set to false.
	 *
	 * @return  self
	 */ 
	public function setRewrite($rewrite)
	{
		$this->rewrite = $rewrite;

		return $this;
	}

	/**
	 * Get whether to allow this post type to be exported.
	 *
	 * @return  bool
	 */ 
	public function getCanExport()
	{
		return $this->can_export;
	}

	/**
	 * Set whether to allow this post type to be exported.
	 *
	 * @param  bool  $can_export  Whether to allow this post type to be exported.
	 *
	 * @return  self
	 */ 
	public function setCanExport(bool $can_export)
	{
		$this->can_export = $can_export;

		return $this;
	}

	/**
	 * Get whether to delete posts of this type when deleting a user.
	 *
	 * @return  bool
	 */ 
	public function getDeleteWithUser()
	{
		return $this->delete_with_user;
	}

	/**
	 * Set whether to delete posts of this type when deleting a user.
	 *
	 * @param  bool  $delete_with_user  Whether to delete posts of this type when deleting a user.
	 *
	 * @return  self
	 */ 
	public function setDeleteWithUser(bool $delete_with_user)
	{
		$this->delete_with_user = $delete_with_user;

		return $this;
	}

	/**
	 * Get array of blocks to use as the default initial state for an editor session.
	 *
	 * @return  array
	 */ 
	public function getTemplate()
	{
		return $this->template;
	}

	/**
	 * Set array of blocks to use as the default initial state for an editor session.
	 *
	 * @param  array  $template  Array of blocks to use as the default initial state for an editor session.
	 *
	 * @return  self
	 */ 
	public function setTemplate(array $template)
	{
		$this->template = $template;

		return $this;
	}

	/**
	 * Get whether the block template should be locked if $template is set.
	 *
	 * @return  string|false
	 */ 
	public function getTemplateLock()
	{
		return $this->template_lock;
	}

	/**
	 * Set whether the block template should be locked if $template is set.
	 *
	 * @param  string|false  $template_lock  Whether the block template should be locked if $template is set.
	 *
	 * @return  self
	 */ 
	public function setTemplateLock($template_lock)
	{
		$this->template_lock = $template_lock;

		return $this;
	}

	/**
	 * Get sets the query_var key for this post type.
	 *
	 * @return  string|bool
	 */ 
	public function getQueryVar()
	{
		return $this->query_var;
	}

	/**
	 * Set sets the query_var key for this post type.
	 *
	 * @param  string|bool  $query_var  Sets the query_var key for this post type.
	 *
	 * @return  self
	 */ 
	public function setQueryVar($query_var)
	{
		$this->query_var = $query_var;

		return $this;
	}

	/**
	 * Get whether to use the internal default meta capability handling.
	 *
	 * @return  bool
	 */ 
	public function getMapMetaCap()
	{
		return $this->map_meta_cap;
	}

	/**
	 * Set whether to use the internal default meta capability handling.
	 *
	 * @param  bool  $map_meta_cap  Whether to use the internal default meta capability handling.
	 *
	 * @return  self
	 */ 
	public function setMapMetaCap(bool $map_meta_cap)
	{
		$this->map_meta_cap = $map_meta_cap;

		return $this;
	}
}
