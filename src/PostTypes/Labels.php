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
 * @version    0.6.0
 * @since      0.6.0
 */

namespace RayTech\WPAbstractClasses\PostTypes;

use RayTech\WPAbstractClasses\Traits\PostType;

/**
 * This class can be used to modify the labels of a post type.
 */
class Labels {

	use PostType;

	/**
	 * General name for the post type, usually plural. The same and overridden by $post_type_object->label.
	 * Default is ‘Posts’ / ‘Pages’.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Name for one object of this post type. Default is ‘Post’ / ‘Page’.
	 *
	 * @var string
	 */
	private $singular_name;

	/**
	 * Default is ‘Add New’ for both hierarchical and non-hierarchical types.
	 * When internationalizing this string, please use a gettext context matching your post type.
	 * Example: _x( 'Add New', 'product', 'textdomain' );.
	 *
	 * @var string
	 */
	private $add_new;

	/**
	 * Label for adding a new singular item. Default is ‘Add New Post’ / ‘Add New Page’.
	 *
	 * @var string
	 */
	private $add_new_item;

	/**
	 * Label for editing a singular item. Default is ‘Edit Post’ / ‘Edit Page’.
	 *
	 * @var string
	 */
	private $edit_item;

	/**
	 * Label for the new item page title. Default is ‘New Post’ / ‘New Page’.
	 *
	 * @var string
	 */
	private $new_item;

	/**
	 * Label for viewing a singular item. Default is ‘View Post’ / ‘View Page’.
	 *
	 * @var string
	 */
	private $view_item;

	/**
	 * Label for viewing post type archives. Default is ‘View Posts’ / ‘View Pages’.
	 *
	 * @var string
	 */
	private $view_items;

	/**
	 * Label for searching plural items. Default is ‘Search Posts’ / ‘Search Pages’.
	 *
	 * @var string
	 */
	private $search_items;

	/**
	 * Label used when no items are found. Default is ‘No posts found’ / ‘No pages found’.
	 *
	 * @var string
	 */
	private $not_found;

	/**
	 * Label used when no items are in the Trash. Default is ‘No posts found in Trash’ / ‘No pages found in Trash’.
	 *
	 * @var string
	 */
	private $not_found_in_trash;

	/**
	 * Label used to prefix parents of hierarchical items. Not used on non-hierarchical post types. Default is ‘Parent Page:’.
	 *
	 * @var string
	 */
	private $parent_item_colon;

	/**
	 * Label to signify all items in a submenu link. Default is ‘All Posts’ / ‘All Pages’.
	 *
	 * @var string
	 */
	private $all_items;

	/**
	 * Label for archives in nav menus. Default is ‘Post Archives’ / ‘Page Archives’.
	 *
	 * @var string
	 */
	private $archives;

	/**
	 * Label for the attributes meta box. Default is ‘Post Attributes’ / ‘Page Attributes’.
	 *
	 * @var string
	 */
	private $attributes;

	/**
	 * Label for the media frame button. Default is ‘Insert into post’ / ‘Insert into page’.
	 *
	 * @var string
	 */
	private $insert_into_item;

	/**
	 * Label for the media frame filter. Default is ‘Uploaded to this post’ / ‘Uploaded to this page’.
	 *
	 * @var string
	 */
	private $uploaded_to_this_item;

	/**
	 * Label for the featured image meta box title. Default is ‘Featured image’.
	 *
	 * @var string
	 */
	private $featured_image;

	/**
	 * Label for setting the featured image. Default is ‘Set featured image’.
	 *
	 * @var string
	 */
	private $set_featured_image;

	/**
	 * Label for removing the featured image. Default is ‘Remove featured image’.
	 *
	 * @var string
	 */
	private $remove_featured_image;

	/**
	 * Label in the media frame for using a featured image. Default is ‘Use as featured image’.
	 *
	 * @var string
	 */
	private $use_featured_image;

	/**
	 * Label for the menu name. Default is the same as name.
	 *
	 * @var string
	 */
	private $menu_name;

	/**
	 * Label for the table views hidden heading. Default is ‘Filter posts list’ / ‘Filter pages list’.
	 *
	 * @var string
	 */
	private $filter_items_list;

	/**
	 * Label for the date filter in list tables. Default is ‘Filter by date’.
	 *
	 * @var string
	 */
	private $filter_by_date;

	/**
	 * Label for the table pagination hidden heading. Default is ‘Posts list navigation’ / ‘Pages list navigation’.
	 *
	 * @var string
	 */
	private $items_list_navigation;

	/**
	 * Label for the table hidden heading. Default is ‘Posts list’ / ‘Pages list’.
	 *
	 * @var string
	 */
	private $items_list;

	/**
	 * Label used when an item is published. Default is ‘Post published.’ / ‘Page published.’
	 *
	 * @var string
	 */
	private $item_published;

	/**
	 * Label used when an item is published with private visibility.
	 * Default is ‘Post published privately.’ / ‘Page published privately.’
	 *
	 * @var string
	 */
	private $item_published_privately;

	/**
	 * Label used when an item is switched to a draft.
	 * Default is ‘Post reverted to draft.’ / ‘Page reverted to draft.’
	 *
	 * @var string
	 */
	private $item_reverted_to_draft;

	/**
	 * Label used when an item is scheduled for publishing. Default is ‘Post scheduled.’ / ‘Page scheduled.’
	 *
	 * @var string
	 */
	private $item_scheduled;

	/**
	 * Label used when an item is updated. Default is ‘Post updated.’ / ‘Page updated.’
	 *
	 * @var string
	 */
	private $item_updated;

	/**
	 * Title for a navigation link block variation. Default is ‘Post Link’ / ‘Page Link’.
	 *
	 * @var string
	 */
	private $item_link;

	/**
	 * Description for a navigation link block variation. Default is ‘A link to a post.’ / ‘A link to a page.’
	 *
	 * @var string
	 */
	private $item_link_description;

	/**
	 * Constructor methods that starts the process of registering the post type and setting some defaults.
	 *
	 * @param string $post_type Desired post type name.
	 */
	public function __construct( string $post_type ) {
		$this->setPostType( $post_type );
		// phpcs:disable
		$this->setName( _x( ucfirst( $this->getPostType() ) . 's', 'Post Type General Name', 'rtabstract' ) );
		$this->setSingularName( _x( ucfirst( $this->getPostType() ), 'Post Type Singular Name', 'rtabstract' ) );
		$this->setMenuName( __( ucfirst( $this->getPostType() ) . 's', 'rtabstract' ) );
		$this->setParentItemColon( __( 'Parent ' . ucfirst( $this->getPostType() ), 'rtabstract' ) );
		$this->setAllItems( __( 'All ' . ucfirst( $this->getPostType() ) . 's', 'rtabstract' ) );
		$this->setViewItem( __( 'View ' . ucfirst( $this->getPostType() ), 'rtabstract' ) );
		$this->setAddNewItem( __( 'Add New ' . ucfirst( $this->getPostType() ), 'rtabstract' ) );
		$this->setAddNew( __( 'Add ' . ucfirst( $this->getPostType() ), 'rtabstract' ) );
		$this->setEditItem( __( 'Edit ' . ucfirst( $this->getPostType() ), 'rtabstract' ) );
		// $this->setUpdateItem(__( 'Update ' . ucfirst( $this->getPostType() ), 'rtabstract' ));
		$this->setSearchItems( __( 'Search ' . ucfirst( $this->getPostType() ), 'rtabstract' ) );
		$this->setNotFound( __( 'Not Found', 'rtabstract' ) );
		$this->setNotFoundInTrash( __( 'Not found in Trash', 'rtabstract' ) );
		//phpcs:enable
	}

	/**
	 * Converts the class properties to an array to pass to the register_post_type function.
	 *
	 * @return array
	 */
	public function toArray() {
		$config = [];
		foreach ( $this as $key => $value ) {
			if ( ! empty( $value ) ) {
				$config[ $key ] = $value;
			}
		}
		return $config;
	}

	/**
	 * Get default is ‘Posts’ / ‘Pages’.
	 *
	 * @return  string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set default is ‘Posts’ / ‘Pages’.
	 *
	 * @param  string $name  Default is ‘Posts’ / ‘Pages’.
	 *
	 * @return  self
	 */
	public function setName( string $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name for one object of this post type. Default is ‘Post’ / ‘Page’.
	 *
	 * @return  string
	 */
	public function getSingularName() {
		return $this->singular_name;
	}

	/**
	 * Set name for one object of this post type. Default is ‘Post’ / ‘Page’.
	 *
	 * @param  string $singular_name  Name for one object of this post type. Default is ‘Post’ / ‘Page’.
	 *
	 * @return  self
	 */
	public function setSingularName( string $singular_name ) {
		$this->singular_name = $singular_name;

		return $this;
	}

	/**
	 * Get example: _x( 'Add New', 'product', 'textdomain' );.
	 *
	 * @return  string
	 */
	public function getAddNew() {
		return $this->add_new;
	}

	/**
	 * Set example: _x( 'Add New', 'product', 'textdomain' );.
	 *
	 * @param  string $add_new  Example: _x( 'Add New', 'product', 'textdomain' );.
	 *
	 * @return  self
	 */
	public function setAddNew( string $add_new ) {
		$this->add_new = $add_new;

		return $this;
	}

	/**
	 * Get label for adding a new singular item. Default is ‘Add New Post’ / ‘Add New Page’.
	 *
	 * @return  string
	 */
	public function getAddNewItem() {
		return $this->add_new_item;
	}

	/**
	 * Set label for adding a new singular item. Default is ‘Add New Post’ / ‘Add New Page’.
	 *
	 * @param  string $add_new_item  Label for adding a new singular item. Default is ‘Add New Post’ / ‘Add New Page’.
	 *
	 * @return  self
	 */
	public function setAddNewItem( string $add_new_item ) {
		$this->add_new_item = $add_new_item;

		return $this;
	}

	/**
	 * Get label for editing a singular item. Default is ‘Edit Post’ / ‘Edit Page’.
	 *
	 * @return  string
	 */
	public function getEditItem() {
		return $this->edit_item;
	}

	/**
	 * Set label for editing a singular item. Default is ‘Edit Post’ / ‘Edit Page’.
	 *
	 * @param  string $edit_item  Label for editing a singular item. Default is ‘Edit Post’ / ‘Edit Page’.
	 *
	 * @return  self
	 */
	public function setEditItem( string $edit_item ) {
		$this->edit_item = $edit_item;

		return $this;
	}

	/**
	 * Get label for the new item page title. Default is ‘New Post’ / ‘New Page’.
	 *
	 * @return  string
	 */
	public function getNewItem() {
		return $this->new_item;
	}

	/**
	 * Set label for the new item page title. Default is ‘New Post’ / ‘New Page’.
	 *
	 * @param  string $new_item  Label for the new item page title. Default is ‘New Post’ / ‘New Page’.
	 *
	 * @return  self
	 */
	public function setNewItem( string $new_item ) {
		$this->new_item = $new_item;

		return $this;
	}

	/**
	 * Get label for viewing a singular item. Default is ‘View Post’ / ‘View Page’.
	 *
	 * @return  string
	 */
	public function getViewItem() {
		return $this->view_item;
	}

	/**
	 * Set label for viewing a singular item. Default is ‘View Post’ / ‘View Page’.
	 *
	 * @param  string $view_item  Label for viewing a singular item. Default is ‘View Post’ / ‘View Page’.
	 *
	 * @return  self
	 */
	public function setViewItem( string $view_item ) {
		$this->view_item = $view_item;

		return $this;
	}

	/**
	 * Get label for viewing post type archives. Default is ‘View Posts’ / ‘View Pages’.
	 *
	 * @return  string
	 */
	public function getViewItems() {
		return $this->view_items;
	}

	/**
	 * Set label for viewing post type archives. Default is ‘View Posts’ / ‘View Pages’.
	 *
	 * @param  string $view_items  Label for viewing post type archives. Default is ‘View Posts’ / ‘View Pages’.
	 *
	 * @return  self
	 */
	public function setViewItems( string $view_items ) {
		$this->view_items = $view_items;

		return $this;
	}

	/**
	 * Get label for searching plural items. Default is ‘Search Posts’ / ‘Search Pages’.
	 *
	 * @return  string
	 */
	public function getSearchItems() {
		return $this->search_items;
	}

	/**
	 * Set label for searching plural items. Default is ‘Search Posts’ / ‘Search Pages’.
	 *
	 * @param  string $search_items  Label for searching plural items. Default is ‘Search Posts’ / ‘Search Pages’.
	 *
	 * @return  self
	 */
	public function setSearchItems( string $search_items ) {
		$this->search_items = $search_items;

		return $this;
	}

	/**
	 * Get label used when no items are found. Default is ‘No posts found’ / ‘No pages found’.
	 *
	 * @return  string
	 */
	public function getNotFound() {
		return $this->not_found;
	}

	/**
	 * Set label used when no items are found. Default is ‘No posts found’ / ‘No pages found’.
	 *
	 * @param  string $not_found  Label used when no items are found. Default is ‘No posts found’ / ‘No pages found’.
	 *
	 * @return  self
	 */
	public function setNotFound( string $not_found ) {
		$this->not_found = $not_found;

		return $this;
	}

	/**
	 * Get label used when no items are in the Trash. Default is ‘No posts found in Trash’ / ‘No pages found in Trash’.
	 *
	 * @return  string
	 */
	public function getNotFoundInTrash() {
		return $this->not_found_in_trash;
	}

	/**
	 * Set label used when no items are in the Trash. Default is ‘No posts found in Trash’ / ‘No pages found in Trash’.
	 *
	 * @param  string $not_found_in_trash  Label used when no items are in the Trash. Default is ‘No posts found in Trash’ / ‘No pages found in Trash’.
	 *
	 * @return  self
	 */
	public function setNotFoundInTrash( string $not_found_in_trash ) {
		$this->not_found_in_trash = $not_found_in_trash;

		return $this;
	}

	/**
	 * Get label used to prefix parents of hierarchical items. Not used on non-hierarchical post types. Default is ‘Parent Page:’.
	 *
	 * @return  string
	 */
	public function getParentItemColon() {
		return $this->parent_item_colon;
	}

	/**
	 * Set label used to prefix parents of hierarchical items. Not used on non-hierarchical post types. Default is ‘Parent Page:’.
	 *
	 * @param  string $parent_item_colon  Label used to prefix parents of hierarchical items. Not used on non-hierarchical post types. Default is ‘Parent Page:’.
	 *
	 * @return  self
	 */
	public function setParentItemColon( string $parent_item_colon ) {
		$this->parent_item_colon = $parent_item_colon;

		return $this;
	}

	/**
	 * Get label to signify all items in a submenu link. Default is ‘All Posts’ / ‘All Pages’.
	 *
	 * @return  string
	 */
	public function getAllItems() {
		return $this->all_items;
	}

	/**
	 * Set label to signify all items in a submenu link. Default is ‘All Posts’ / ‘All Pages’.
	 *
	 * @param  string $all_items  Label to signify all items in a submenu link. Default is ‘All Posts’ / ‘All Pages’.
	 *
	 * @return  self
	 */
	public function setAllItems( string $all_items ) {
		$this->all_items = $all_items;

		return $this;
	}

	/**
	 * Get label for archives in nav menus. Default is ‘Post Archives’ / ‘Page Archives’.
	 *
	 * @return  string
	 */
	public function getArchives() {
		return $this->archives;
	}

	/**
	 * Set label for archives in nav menus. Default is ‘Post Archives’ / ‘Page Archives’.
	 *
	 * @param  string $archives  Label for archives in nav menus. Default is ‘Post Archives’ / ‘Page Archives’.
	 *
	 * @return  self
	 */
	public function setArchives( string $archives ) {
		$this->archives = $archives;

		return $this;
	}

	/**
	 * Get label for the attributes meta box. Default is ‘Post Attributes’ / ‘Page Attributes’.
	 *
	 * @return  string
	 */
	public function getAttributes() {
		return $this->attributes;
	}

	/**
	 * Set label for the attributes meta box. Default is ‘Post Attributes’ / ‘Page Attributes’.
	 *
	 * @param  string $attributes  Label for the attributes meta box. Default is ‘Post Attributes’ / ‘Page Attributes’.
	 *
	 * @return  self
	 */
	public function setAttributes( string $attributes ) {
		$this->attributes = $attributes;

		return $this;
	}

	/**
	 * Get label for the media frame button. Default is ‘Insert into post’ / ‘Insert into page’.
	 *
	 * @return  string
	 */
	public function getInsertIntoItem() {
		return $this->insert_into_item;
	}

	/**
	 * Set label for the media frame button. Default is ‘Insert into post’ / ‘Insert into page’.
	 *
	 * @param  string $insert_into_item  Label for the media frame button. Default is ‘Insert into post’ / ‘Insert into page’.
	 *
	 * @return  self
	 */
	public function setInsertIntoItem( string $insert_into_item ) {
		$this->insert_into_item = $insert_into_item;

		return $this;
	}

	/**
	 * Get label for the media frame filter. Default is ‘Uploaded to this post’ / ‘Uploaded to this page’.
	 *
	 * @return  string
	 */
	public function getUploadedToThisItem() {
		return $this->uploaded_to_this_item;
	}

	/**
	 * Set label for the media frame filter. Default is ‘Uploaded to this post’ / ‘Uploaded to this page’.
	 *
	 * @param  string $uploaded_to_this_item  Label for the media frame filter. Default is ‘Uploaded to this post’ / ‘Uploaded to this page’.
	 *
	 * @return  self
	 */
	public function setUploadedToThisItem( string $uploaded_to_this_item ) {
		$this->uploaded_to_this_item = $uploaded_to_this_item;

		return $this;
	}

	/**
	 * Get label for the featured image meta box title. Default is ‘Featured image’.
	 *
	 * @return  string
	 */
	public function getFeaturedImage() {
		return $this->featured_image;
	}

	/**
	 * Set label for the featured image meta box title. Default is ‘Featured image’.
	 *
	 * @param  string $featured_image  Label for the featured image meta box title. Default is ‘Featured image’.
	 *
	 * @return  self
	 */
	public function setFeaturedImage( string $featured_image ) {
		$this->featured_image = $featured_image;

		return $this;
	}

	/**
	 * Get label for setting the featured image. Default is ‘Set featured image’.
	 *
	 * @return  string
	 */
	public function getSetFeaturedImage() {
		return $this->set_featured_image;
	}

	/**
	 * Set label for setting the featured image. Default is ‘Set featured image’.
	 *
	 * @param  string $set_featured_image  Label for setting the featured image. Default is ‘Set featured image’.
	 *
	 * @return  self
	 */
	public function setSetFeaturedImage( string $set_featured_image ) {
		$this->set_featured_image = $set_featured_image;

		return $this;
	}

	/**
	 * Get label for removing the featured image. Default is ‘Remove featured image’.
	 *
	 * @return  string
	 */
	public function getRemoveFeaturedImage() {
		return $this->remove_featured_image;
	}

	/**
	 * Set label for removing the featured image. Default is ‘Remove featured image’.
	 *
	 * @param  string $remove_featured_image  Label for removing the featured image. Default is ‘Remove featured image’.
	 *
	 * @return  self
	 */
	public function setRemoveFeaturedImage( string $remove_featured_image ) {
		$this->remove_featured_image = $remove_featured_image;

		return $this;
	}

	/**
	 * Get label in the media frame for using a featured image. Default is ‘Use as featured image’.
	 *
	 * @return  string
	 */
	public function getUseFeaturedImage() {
		return $this->use_featured_image;
	}

	/**
	 * Set label in the media frame for using a featured image. Default is ‘Use as featured image’.
	 *
	 * @param  string $use_featured_image  Label in the media frame for using a featured image. Default is ‘Use as featured image’.
	 *
	 * @return  self
	 */
	public function setUseFeaturedImage( string $use_featured_image ) {
		$this->use_featured_image = $use_featured_image;

		return $this;
	}

	/**
	 * Get label for the menu name. Default is the same as name.
	 *
	 * @return  string
	 */
	public function getMenuName() {
		return $this->menu_name;
	}

	/**
	 * Set label for the menu name. Default is the same as name.
	 *
	 * @param  string $menu_name  Label for the menu name. Default is the same as name.
	 *
	 * @return  self
	 */
	public function setMenuName( string $menu_name ) {
		$this->menu_name = $menu_name;

		return $this;
	}

	/**
	 * Get label for the table views hidden heading. Default is ‘Filter posts list’ / ‘Filter pages list’.
	 *
	 * @return  string
	 */
	public function getFilterItemsList() {
		return $this->filter_items_list;
	}

	/**
	 * Set label for the table views hidden heading. Default is ‘Filter posts list’ / ‘Filter pages list’.
	 *
	 * @param  string $filter_items_list  Label for the table views hidden heading. Default is ‘Filter posts list’ / ‘Filter pages list’.
	 *
	 * @return  self
	 */
	public function setFilterItemsList( string $filter_items_list ) {
		$this->filter_items_list = $filter_items_list;

		return $this;
	}

	/**
	 * Get label for the date filter in list tables. Default is ‘Filter by date’.
	 *
	 * @return  string
	 */
	public function getFilterByDate() {
		return $this->filter_by_date;
	}

	/**
	 * Set label for the date filter in list tables. Default is ‘Filter by date’.
	 *
	 * @param  string $filter_by_date  Label for the date filter in list tables. Default is ‘Filter by date’.
	 *
	 * @return  self
	 */
	public function setFilterByDate( string $filter_by_date ) {
		$this->filter_by_date = $filter_by_date;

		return $this;
	}

	/**
	 * Get label for the table pagination hidden heading. Default is ‘Posts list navigation’ / ‘Pages list navigation’.
	 *
	 * @return  string
	 */
	public function getItemsListNavigation() {
		return $this->items_list_navigation;
	}

	/**
	 * Set label for the table pagination hidden heading. Default is ‘Posts list navigation’ / ‘Pages list navigation’.
	 *
	 * @param  string $items_list_navigation  Label for the table pagination hidden heading. Default is ‘Posts list navigation’ / ‘Pages list navigation’.
	 *
	 * @return  self
	 */
	public function setItemsListNavigation( string $items_list_navigation ) {
		$this->items_list_navigation = $items_list_navigation;

		return $this;
	}

	/**
	 * Get label for the table hidden heading. Default is ‘Posts list’ / ‘Pages list’.
	 *
	 * @return  string
	 */
	public function getItemsList() {
		return $this->items_list;
	}

	/**
	 * Set label for the table hidden heading. Default is ‘Posts list’ / ‘Pages list’.
	 *
	 * @param  string $items_list  Label for the table hidden heading. Default is ‘Posts list’ / ‘Pages list’.
	 *
	 * @return  self
	 */
	public function setItemsList( string $items_list ) {
		$this->items_list = $items_list;

		return $this;
	}

	/**
	 * Get label used when an item is published. Default is ‘Post published.’ / ‘Page published.’
	 *
	 * @return  string
	 */
	public function getItemPublished() {
		return $this->item_published;
	}

	/**
	 * Set label used when an item is published. Default is ‘Post published.’ / ‘Page published.’
	 *
	 * @param  string $item_published  Label used when an item is published. Default is ‘Post published.’ / ‘Page published.’.
	 *
	 * @return  self
	 */
	public function setItemPublished( string $item_published ) {
		$this->item_published = $item_published;

		return $this;
	}

	/**
	 * Get default is ‘Post published privately.’ / ‘Page published privately.’
	 *
	 * @return  string
	 */
	public function getItemPublishedPrivately() {
		return $this->item_published_privately;
	}

	/**
	 * Set default is ‘Post published privately.’ / ‘Page published privately.’
	 *
	 * @param  string $item_published_privately  Default is ‘Post published privately.’ / ‘Page published privately.’.
	 *
	 * @return  self
	 */
	public function setItemPublishedPrivately( string $item_published_privately ) {
		$this->item_published_privately = $item_published_privately;

		return $this;
	}

	/**
	 * Get default is ‘Post reverted to draft.’ / ‘Page reverted to draft.’
	 *
	 * @return  string
	 */
	public function getItemRevertedToDraft() {
		return $this->item_reverted_to_draft;
	}

	/**
	 * Set default is ‘Post reverted to draft.’ / ‘Page reverted to draft.’
	 *
	 * @param  string $item_reverted_to_draft  Default is ‘Post reverted to draft.’ / ‘Page reverted to draft.’.
	 *
	 * @return  self
	 */
	public function setItemRevertedToDraft( string $item_reverted_to_draft ) {
		$this->item_reverted_to_draft = $item_reverted_to_draft;

		return $this;
	}

	/**
	 * Get label used when an item is scheduled for publishing. Default is ‘Post scheduled.’ / ‘Page scheduled.’
	 *
	 * @return  string
	 */
	public function getItemScheduled() {
		return $this->item_scheduled;
	}

	/**
	 * Set label used when an item is scheduled for publishing. Default is ‘Post scheduled.’ / ‘Page scheduled.’
	 *
	 * @param  string $item_scheduled  Label used when an item is scheduled for publishing. Default is ‘Post scheduled.’ / ‘Page scheduled.’.
	 *
	 * @return  self
	 */
	public function setItemScheduled( string $item_scheduled ) {
		$this->item_scheduled = $item_scheduled;

		return $this;
	}

	/**
	 * Get label used when an item is updated. Default is ‘Post updated.’ / ‘Page updated.’
	 *
	 * @return  string
	 */
	public function getItemUpdated() {
		return $this->item_updated;
	}

	/**
	 * Set label used when an item is updated. Default is ‘Post updated.’ / ‘Page updated.’
	 *
	 * @param  string $item_updated  Label used when an item is updated. Default is ‘Post updated.’ / ‘Page updated.’.
	 *
	 * @return  self
	 */
	public function setItemUpdated( string $item_updated ) {
		$this->item_updated = $item_updated;

		return $this;
	}

	/**
	 * Get title for a navigation link block variation. Default is ‘Post Link’ / ‘Page Link’.
	 *
	 * @return  string
	 */
	public function getItemLink() {
		return $this->item_link;
	}

	/**
	 * Set title for a navigation link block variation. Default is ‘Post Link’ / ‘Page Link’.
	 *
	 * @param  string $item_link  Title for a navigation link block variation. Default is ‘Post Link’ / ‘Page Link’.
	 *
	 * @return  self
	 */
	public function setItemLink( string $item_link ) {
		$this->item_link = $item_link;

		return $this;
	}

	/**
	 * Get description for a navigation link block variation. Default is ‘A link to a post.’ / ‘A link to a page.’
	 *
	 * @return  string
	 */
	public function getItemLinkDescription() {
		return $this->item_link_description;
	}

	/**
	 * Set description for a navigation link block variation. Default is ‘A link to a post.’ / ‘A link to a page.’
	 *
	 * @param  string $item_link_description  Description for a navigation link block variation. Default is ‘A link to a post.’ / ‘A link to a page.’.
	 *
	 * @return  self
	 */
	public function setItemLinkDescription( string $item_link_description ) {
		$this->item_link_description = $item_link_description;

		return $this;
	}
}
