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
 * This class has the basic functions for creating a taxonomy in WordPress
 * relating to a post type .
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
	private $types;

	/**
	 * What type of txonomy this taxonomy will be.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * A plural descriptive name for the taxonomy marked for translation.
	 *
	 * @var string
	 */
	private $label;

	/**
	 * An array of labels for this taxonomy. By default tag labels are used for non-hierarchical types and category
	 * labels for hierarchical ones.
	 *
	 * @var string[]
	 */
	private $labels;

	/**
	 * Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.
	 *
	 * @var bool
	 */
	private $public;

	/**
	 * Whether the taxonomy is publicly queryable.
	 *
	 * @var bool
	 */
	private $public_queryable;

	/**
	 * Whether to generate a default UI for managing this taxonomy.
	 *
	 * @var bool
	 */
	private $show_ui;

	/**
	 * Where to show the taxonomy in the admin menu. show_ui must be true.
	 *
	 * @var bool
	 */
	private $show_in_menu;

	/**
	 * True makes this taxonomy available for selection in navigation menus.
	 *
	 * @var bool
	 */
	private $show_in_nav_menus;

	/**
	 * Whether to include the taxonomy in the REST API. You will need to set this to true in order to use the taxonomy
	 * in your gutenberg metablock.
	 *
	 * @var bool
	 */
	private $show_in_rest;

	/**
	 * To change the base url of REST API route.
	 *
	 * @var string
	 */
	private $rest_base;

	/**
	 * REST API Controller class name.
	 *
	 * @var string
	 */
	private $rest_controller_class;

	/**
	 * Whether to allow the Tag Cloud widget to use this taxonomy.
	 *
	 * @var bool
	 */
	private $show_tagcloud;

	/**
	 * Whether to show the taxonomy in the quick/bulk edit panel.
	 *
	 * @var bool
	 */
	private $show_in_quick_edit;

	/**
	 * Provide a callback function name for the meta box display.
	 *
	 * @var callable
	 */
	private $meta_box_cb;

	/**
	 * Whether to allow automatic creation of taxonomy columns on associated post-types table.
	 *
	 * @var bool
	 */
	private $show_admin_column;

	/**
	 * Include a description of the taxonomy.
	 *
	 * @var string
	 */
	private $description;

	/**
	 * Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.
	 *
	 * @var bool
	 */
	private $hierarchical;

	/**
	 * A function name that will be called when the count of an associated $object_type, such as post, is updated.
	 * Works much like a hook.
	 *
	 * @var string
	 */
	private $update_count_callback;

	/**
	 * False to disable the query_var, set as string to use custom query_var instead of default which is $taxonomy, the
	 * taxonomy’s “name”. True is not seen as a valid entry and will result in 404 issues.
	 *
	 * @var bool|string
	 */
	private $query_var;

	/**
	 * Set to false to prevent automatic URL rewriting a.k.a. “pretty permalinks”. Pass an $args array to override
	 * default URL settings for permalinks as outlined below.
	 *
	 * @var bool|array
	 */
	private $rewrite;

	/**
	 * An array of the capabilities for this taxonomy.
	 *
	 * @var array
	 */
	private $capabilities;

	/**
	 * Whether this taxonomy should remember the order in which terms are added to objects.
	 *
	 * @var bool
	 */
	private $sort;

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
		// phpcs:disable
		$this
			->setLabels(
				[
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
				]
			)
			//phpcs:enable
			->setQueryVar( $this->getType() === 'tag' )
			->setHierarchical( $this->getType() === 'category' );

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
	 * Get a plural descriptive name for the taxonomy marked for translation.
	 *
	 * @return  string
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * Set a plural descriptive name for the taxonomy marked for translation.
	 *
	 * @param  string $label  A plural descriptive name for the taxonomy marked for translation.
	 *
	 * @return  self
	 */
	public function setLabel( string $label ) {
		$this->label = $label;

		return $this;
	}

	/**
	 * Get labels for hierarchical ones.
	 *
	 * @return  string[]
	 */
	public function getLabels() {
		return $this->labels;
	}

	/**
	 * Set labels for hierarchical ones.
	 *
	 * @param  string[] $labels  labels for hierarchical ones.
	 *
	 * @return  self
	 */
	public function setLabels( array $labels ) {
		$this->labels = $labels;

		return $this;
	}

	/**
	 * Get whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.
	 *
	 * @return  bool
	 */
	public function getPublic() {
		return $this->public;
	}

	/**
	 * Set whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.
	 *
	 * @param  bool $public  Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.
	 *
	 * @return  self
	 */
	public function setPublic( bool $public ) {
		$this->public = $public;

		return $this;
	}

	/**
	 * Get whether the taxonomy is publicly queryable.
	 *
	 * @return  bool
	 */
	public function getPublicQueryable() {
		return $this->public_queryable;
	}

	/**
	 * Set whether the taxonomy is publicly queryable.
	 *
	 * @param  bool $public_queryable  Whether the taxonomy is publicly queryable.
	 *
	 * @return  self
	 */
	public function setPublicQueryable( bool $public_queryable ) {
		$this->public_queryable = $public_queryable;

		return $this;
	}

	/**
	 * Get whether to generate a default UI for managing this taxonomy.
	 *
	 * @return  bool
	 */
	public function getShowUi() {
		return $this->show_ui;
	}

	/**
	 * Set whether to generate a default UI for managing this taxonomy.
	 *
	 * @param  bool $show_ui  Whether to generate a default UI for managing this taxonomy.
	 *
	 * @return  self
	 */
	public function setShowUi( bool $show_ui ) {
		$this->show_ui = $show_ui;

		return $this;
	}

	/**
	 * Get where to show the taxonomy in the admin menu. show_ui must be true.
	 *
	 * @return  bool
	 */
	public function getShowInMenu() {
		return $this->show_in_menu;
	}

	/**
	 * Set where to show the taxonomy in the admin menu. show_ui must be true.
	 *
	 * @param  bool $show_in_menu  Where to show the taxonomy in the admin menu. show_ui must be true.
	 *
	 * @return  self
	 */
	public function setShowInMenu( bool $show_in_menu ) {
		$this->show_in_menu = $show_in_menu;

		return $this;
	}

	/**
	 * Get true makes this taxonomy available for selection in navigation menus.
	 *
	 * @return  bool
	 */
	public function getShowInNavMenus() {
		return $this->show_in_nav_menus;
	}

	/**
	 * Set true makes this taxonomy available for selection in navigation menus.
	 *
	 * @param  bool $show_in_nav_menus  true makes this taxonomy available for selection in navigation menus.
	 *
	 * @return  self
	 */
	public function setShowInNavMenus( bool $show_in_nav_menus ) {
		$this->show_in_nav_menus = $show_in_nav_menus;

		return $this;
	}

	/**
	 * Get in your gutenberg metablock.
	 *
	 * @return  bool
	 */
	public function getShowInRest() {
		return $this->show_in_rest;
	}

	/**
	 * Set in your gutenberg metablock.
	 *
	 * @param  bool $show_in_rest  in your gutenberg metablock.
	 *
	 * @return  self
	 */
	public function setShowInRest( bool $show_in_rest ) {
		$this->show_in_rest = $show_in_rest;

		return $this;
	}

	/**
	 * Get to change the base url of REST API route.
	 *
	 * @return  string
	 */
	public function getRestBase() {
		return $this->rest_base;
	}

	/**
	 * Set to change the base url of REST API route.
	 *
	 * @param  string $rest_base  To change the base url of REST API route.
	 *
	 * @return  self
	 */
	public function setRestBase( string $rest_base ) {
		$this->rest_base = $rest_base;

		return $this;
	}

	/**
	 * Get REST API Controller class name.
	 *
	 * @return  string
	 */
	public function getRestControllerClass() {
		return $this->rest_controller_class;
	}

	/**
	 * Set rEST API Controller class name.
	 *
	 * @param  string $rest_controller_class  REST API Controller class name.
	 *
	 * @return  self
	 */
	public function setRestControllerClass( string $rest_controller_class ) {
		$this->rest_controller_class = $rest_controller_class;

		return $this;
	}

	/**
	 * Get whether to allow the Tag Cloud widget to use this taxonomy.
	 *
	 * @return  bool
	 */
	public function getShowTagCloud() {
		return $this->show_tagcloud;
	}

	/**
	 * Set whether to allow the Tag Cloud widget to use this taxonomy.
	 *
	 * @param  bool $show_tagcloud  Whether to allow the Tag Cloud widget to use this taxonomy.
	 *
	 * @return  self
	 */
	public function setShowTagCloud( bool $show_tagcloud ) {
		$this->show_tagcloud = $show_tagcloud;

		return $this;
	}

	/**
	 * Get whether to show the taxonomy in the quick/bulk edit panel.
	 *
	 * @return  bool
	 */
	public function getShowInQuickEdit() {
		return $this->show_in_quick_edit;
	}

	/**
	 * Set whether to show the taxonomy in the quick/bulk edit panel.
	 *
	 * @param  bool $show_in_quick_edit  Whether to show the taxonomy in the quick/bulk edit panel.
	 *
	 * @return  self
	 */
	public function setShowInQuickEdit( bool $show_in_quick_edit ) {
		$this->show_in_quick_edit = $show_in_quick_edit;

		return $this;
	}

	/**
	 * Set provide a callback function name for the meta box display.
	 *
	 * @param  callable $meta_box_cb  Provide a callback function name for the meta box display.
	 *
	 * @return  self
	 */
	public function setMetaBoxCallback( callable $meta_box_cb ) {
		$this->meta_box_cb = $meta_box_cb;

		return $this;
	}

	/**
	 * Get provide a callback function name for the meta box display.
	 *
	 * @return  callable
	 */
	public function getMetaBoxCallback() {
		return $this->meta_box_cb;
	}

	/**
	 * Get whether to allow automatic creation of taxonomy columns on associated post-types table.
	 *
	 * @return  bool
	 */
	public function getShowAdminColumn() {
		return $this->show_admin_column;
	}

	/**
	 * Set whether to allow automatic creation of taxonomy columns on associated post-types table.
	 *
	 * @param  bool $show_admin_column  Whether to allow automatic creation of taxonomy columns on associated post-types table.
	 *
	 * @return  self
	 */
	public function setShowAdminColumn( bool $show_admin_column ) {
		$this->show_admin_column = $show_admin_column;

		return $this;
	}

	/**
	 * Get include a description of the taxonomy.
	 *
	 * @return  string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Set include a description of the taxonomy.
	 *
	 * @param  string $description  Include a description of the taxonomy.
	 *
	 * @return  self
	 */
	public function setDescription( string $description ) {
		$this->description = $description;

		return $this;
	}

	/**
	 * Get is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.
	 *
	 * @return  bool
	 */
	public function getHierarchical() {
		return $this->hierarchical;
	}

	/**
	 * Set is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.
	 *
	 * @param  bool $hierarchical  Is this taxonomy hierarchical (have descendants) like categories or not hierarchical like tags.
	 *
	 * @return  self
	 */
	public function setHierarchical( bool $hierarchical ) {
		$this->hierarchical = $hierarchical;

		return $this;
	}

	/**
	 * Get works much like a hook.
	 *
	 * @return  string
	 */
	public function getUpdateCountCallback() {
		return $this->update_count_callback;
	}

	/**
	 * Set works much like a hook.
	 *
	 * @param  string $update_count_callback  Works much like a hook.
	 *
	 * @return  self
	 */
	public function setUpdateCountCallback( string $update_count_callback ) {
		$this->update_count_callback = $update_count_callback;

		return $this;
	}

	/**
	 * Get taxonomy’s “name”. True is not seen as a valid entry and will result in 404 issues.
	 *
	 * @return  bool|string
	 */
	public function getQueryVar() {
		return $this->query_var;
	}

	/**
	 * Set taxonomy’s “name”. True is not seen as a valid entry and will result in 404 issues.
	 *
	 * @param  bool|string $query_var  taxonomy’s “name”. True is not seen as a valid entry and will result in 404 issues.
	 *
	 * @return  self
	 */
	public function setQueryVar( $query_var ) {
		$this->query_var = $query_var;

		return $this;
	}

	/**
	 * Get default URL settings for permalinks as outlined below.
	 *
	 * @return  bool|array
	 */
	public function getRewrite() {
		return $this->rewrite;
	}

	/**
	 * Set default URL settings for permalinks as outlined below.
	 *
	 * @param  bool|array $rewrite  default URL settings for permalinks as outlined below.
	 *
	 * @return  self
	 */
	public function setRewrite( $rewrite ) {
		$this->rewrite = $rewrite;

		return $this;
	}

	/**
	 * Get an array of the capabilities for this taxonomy.
	 *
	 * @return  array
	 */
	public function getCapabilities() {
		return $this->capabilities;
	}

	/**
	 * Set an array of the capabilities for this taxonomy.
	 *
	 * @param  array $capabilities  An array of the capabilities for this taxonomy.
	 *
	 * @return  self
	 */
	public function setCapabilities( array $capabilities ) {
		$this->capabilities = $capabilities;

		return $this;
	}

	/**
	 * Get whether this taxonomy should remember the order in which terms are added to objects.
	 *
	 * @return  bool
	 */
	public function getSort() {
		return $this->sort;
	}

	/**
	 * Set whether this taxonomy should remember the order in which terms are added to objects.
	 *
	 * @param  bool $sort  Whether this taxonomy should remember the order in which terms are added to objects.
	 *
	 * @return  self
	 */
	public function setSort( bool $sort ) {
		$this->sort = $sort;

		return $this;
	}

	/**
	 * Get what type of txonomy this taxonomy will be.
	 *
	 * @return  string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Set what type of taxonomy this taxonomy will be.
	 *
	 * @param  string $type  What type of taxonomy this taxonomy will be.
	 *
	 * @return  self
	 */
	public function setType( string $type ) {
		$this->type = $type;

		return $this;
	}
}
