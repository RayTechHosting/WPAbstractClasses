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

namespace RayTech\WPAbstractClasses\Taxonomies;

use RayTech\WPAbstractClasses\Traits\PostType;

/**
 * This class will help create default labels and customize labels.
 */
class Labels {
	use PostType;

	/**
	 * General name for the taxonomy, usually plural. The same as and overridden by $tax->label. Default 'Tags'/'Categories'.
	 *
	 * @var string
	 */
	private $name;

	/**
	 * Name for one object of this taxonomy. Default 'Tag'/'Category'.
	 *
	 * @var string
	 */
	private $singular_name;

	/**
	 * Default 'Search Tags'/'Search Categories'.
	 *
	 * @var string
	 */
	private $search_items;

	/**
	 * This label is only used for non-hierarchical taxonomies.
	 * Default 'Popular Tags'.
	 *
	 * @var string
	 */
	private $popular_items;

	/**
	 * Default 'All Tags'/'All Categories'.
	 *
	 * @var string
	 */
	private $all_items;

	/**
	 * This label is only used for hierarchical taxonomies. Default 'Parent Category'.
	 *
	 * @var string
	 */
	private $parent_item;

	/**
	 * The same as parent_item, but with colon : in the end.
	 *
	 * @var string
	 */
	private $parent_item_colon;

	/**
	 * Description for the Name field on Edit Tags screen.
	 * Default 'The name is how it appears on your site'.
	 *
	 * @var string
	 */
	private $name_field_description;

	/**
	 * Description for the Slug field on Edit Tags screen.
	 * Default 'The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers,
	 * and hyphens'.
	 *
	 * @var string
	 */
	private $slug_field_description;

	/**
	 * Description for the Parent field on Edit Tags screen.
	 * Default 'Assign a parent term to create a hierarchy.
	 * The term Jazz, for example, would be the parent of Bebop and Big Band'.
	 *
	 * @var string
	 */
	private $parent_field_description;

	/**
	 * Description for the Description field on Edit Tags screen.
	 * Default 'The description is not prominent by default; however, some themes may show it'.
	 *
	 * @var string
	 */
	private $desc_field_description;

	/**
	 * Default 'Edit Tag'/'Edit Category'.
	 *
	 * @var string
	 */
	private $edit_item;

	/**
	 * Default 'View Tag'/'View Category'.
	 *
	 * @var string
	 */
	private $view_item;

	/**
	 * Default 'Update Tag'/'Update Category'.
	 *
	 * @var string
	 */
	private $update_item;

	/**
	 * Default 'Add New Tag'/'Add New Category'.
	 *
	 * @var string
	 */
	private $add_new_item;

	/**
	 * Default 'New Tag Name'/'New Category Name'.
	 *
	 * @var string
	 */
	private $new_item_name;

	/**
	 * This label is only used for non-hierarchical taxonomies. Default 'Separate tags with commas', used in the meta box.
	 *
	 * @var string
	 */
	private $separate_items_with_commas;

	/**
	 * This label is only used for non-hierarchical taxonomies. Default 'Add or remove tags', used in the meta box when
	 * JavaScript is disabled.
	 *
	 * @var string
	 */
	private $add_or_remove_items;

	/**
	 * This label is only used on non-hierarchical taxonomies. Default 'Choose from the most used tags', used in the meta box.
	 *
	 * @var string
	 */
	private $choose_from_most_used;

	/**
	 * Default 'No tags found'/'No categories found', used in the meta box and taxonomy list table.
	 *
	 * @var string
	 */
	private $not_found;

	/**
	 * Default 'No tags'/'No categories', used in the posts and media list tables.
	 *
	 * @var string
	 */
	private $no_terms;

	/**
	 * This label is only used for hierarchical taxonomies. Default 'Filter by category', used in the posts list table.
	 *
	 * @var string
	 */
	private $filter_by_item;

	/**
	 * Label for the table pagination hidden heading.
	 *
	 * @var string
	 */
	private $items_list_navigation;

	/**
	 * Label for the table hidden heading.
	 *
	 * @var string
	 */
	private $items_list;

	/**
	 * Title for the Most Used tab. Default 'Most Used'.
	 *
	 * @var string
	 */
	private $most_used;

	/**
	 * Label displayed after a term has been updated.
	 *
	 * @var string
	 */
	private $back_to_items;

	/**
	 * Used in the block editor. Title for a navigation link block variation.
	 * Default 'Tag Link'/'Category Link'.
	 *
	 * @var string
	 */
	private $item_link;

	/**
	 * Used in the block editor. Description for a navigation link block variation. Default 'A link to a tag'/'A link
	 * to a category'.
	 *
	 * @var string
	 */
	private $item_link_description;

	/**
	 * This decides whether you wish to have a tag taxonomy or a category taxonomy.
	 *
	 * @var string
	 */
	private $type;

	/**
	 * Constructor method that creates the taxonomy and sets some defaults.
	 *
	 * @param string $post_type Post type slug.
	 * @param string $type Taxonomy Type.
	 */
	public function __construct( $post_type, $type ) {
		$types = [
			'category' => [
				'singular' => 'Category',
				'plural'   => 'Categories',
			],
			'tag'      => [
				'singular' => 'Tag',
				'plural'   => 'Tags',
			],
		];
		$this->setPostType( $post_type )->setType( $type );

		$this->setName( ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['plural'] );
		$this->setSingularName( ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['singular'] );
		/* translators:  Post type name and taxonomy type */
		$this->setSearchItems( sprintf( __( 'Search %1$s', 'rtabstract' ), ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['plural'] ) );
		/* translators:  Post type name and taxonomy type */
		$this->setAllItems( sprintf( __( 'All %1$ss', 'rtabstract' ), ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['plural'] ) );
		/* translators:  Post type name and taxonomy type */
		$this->setParentItem( sprintf( __( 'Parent %1$s', 'rtabstract' ), ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['singular'] ) );
		/* translators:  Post type name and taxonomy type */
		$this->setParentItemColon( sprintf( __( 'Parent %1$s ', 'rtabstract' ), ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['singular'] ) );
		/* translators:  Post type name and taxonomy type */
		$this->setEditItem( sprintf( __( 'Edit %1$s', 'rtabstract' ), ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['singular'] ) );
		/* translators:  Post type name and taxonomy type */
		$this->setUpdateItem( sprintf( __( 'Update %1$s', 'rtabstract' ), ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['singular'] ) );
		/* translators:  Post type name and taxonomy type */
		$this->setAddNewItem( sprintf( __( 'Add new %1$s', 'rtabstract' ), ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['singular'] ) );
		/* translators:  Post type name and taxonomy type */
		$this->setNewItemName( sprintf( __( 'New %1$s', 'rtabstract' ), ucfirst( $this->getPostType() ) . ' ' . $types[ $this->getType() ]['singular'] ) );
	}

	/**
	 * Converts the class properties to an array to pass to the register_taxonomy function.
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
	 * Get general name for the taxonomy, usually plural. The same as and overridden by $tax->label. Default 'Tags'/'Categories'.
	 *
	 * @return  string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set general name for the taxonomy, usually plural. The same as and overridden by $tax->label. Default 'Tags'/'Categories'.
	 *
	 * @param  string $name  General name for the taxonomy, usually plural. The same as and overridden by $tax->label. Default 'Tags'/'Categories'.
	 *
	 * @return  self
	 */
	public function setName( string $name ) {
		$this->name = $name;

		return $this;
	}

	/**
	 * Get name for one object of this taxonomy. Default 'Tag'/'Category'.
	 *
	 * @return  string
	 */
	public function getSingularName() {
		return $this->singular_name;
	}

	/**
	 * Set name for one object of this taxonomy. Default 'Tag'/'Category'.
	 *
	 * @param  string $singular_name  Name for one object of this taxonomy. Default 'Tag'/'Category'.
	 *
	 * @return  self
	 */
	public function setSingularName( string $singular_name ) {
		$this->singular_name = $singular_name;

		return $this;
	}

	/**
	 * Get default 'Search Tags'/'Search Categories'.
	 *
	 * @return  string
	 */
	public function getSearchItems() {
		return $this->search_items;
	}

	/**
	 * Set default 'Search Tags'/'Search Categories'.
	 *
	 * @param  string $search_items  Default 'Search Tags'/'Search Categories'.
	 *
	 * @return  self
	 */
	public function setSearchItems( string $search_items ) {
		$this->search_items = $search_items;

		return $this;
	}

	/**
	 * Get default 'Popular Tags'.
	 *
	 * @return  string
	 */
	public function getPopularItems() {
		return $this->popular_items;
	}

	/**
	 * Set default 'Popular Tags'.
	 *
	 * @param  string $popular_items  Default 'Popular Tags'.
	 *
	 * @return  self
	 */
	public function setPopularItems( string $popular_items ) {
		$this->popular_items = $popular_items;

		return $this;
	}

	/**
	 * Get default 'All Tags'/'All Categories'.
	 *
	 * @return  string
	 */
	public function getAllItems() {
		return $this->all_items;
	}

	/**
	 * Set default 'All Tags'/'All Categories'.
	 *
	 * @param  string $all_items  Default 'All Tags'/'All Categories'.
	 *
	 * @return  self
	 */
	public function setAllItems( string $all_items ) {
		$this->all_items = $all_items;

		return $this;
	}

	/**
	 * Get this label is only used for hierarchical taxonomies. Default 'Parent Category'.
	 *
	 * @return  string
	 */
	public function getParentItem() {
		return $this->parent_item;
	}

	/**
	 * Set this label is only used for hierarchical taxonomies. Default 'Parent Category'.
	 *
	 * @param  string $parent_item  This label is only used for hierarchical taxonomies. Default 'Parent Category'.
	 *
	 * @return  self
	 */
	public function setParentItem( string $parent_item ) {
		$this->parent_item = $parent_item;

		return $this;
	}

	/**
	 * Get the same as parent_item, but with colon : in the end.
	 *
	 * @return  string
	 */
	public function getParentItemColon() {
		return $this->parent_item_colon;
	}

	/**
	 * Set the same as parent_item, but with colon : in the end.
	 *
	 * @param  string $parent_item_colon  The same as parent_item, but with colon : in the end.
	 *
	 * @return  self
	 */
	public function setParentItemColon( string $parent_item_colon ) {
		$this->parent_item_colon = $parent_item_colon;

		return $this;
	}

	/**
	 * Get default 'The name is how it appears on your site'.
	 *
	 * @return  string
	 */
	public function getNameFieldDescription() {
		return $this->name_field_description;
	}

	/**
	 * Set default 'The name is how it appears on your site'.
	 *
	 * @param  string $name_field_description  Default 'The name is how it appears on your site'.
	 *
	 * @return  self
	 */
	public function setNameFieldDescription( string $name_field_description ) {
		$this->name_field_description = $name_field_description;

		return $this;
	}

	/**
	 * Get and hyphens'.
	 *
	 * @return  string
	 */
	public function getSlugFieldDescription() {
		return $this->slug_field_description;
	}

	/**
	 * Set and hyphens'.
	 *
	 * @param  string $slug_field_description  and hyphens'.
	 *
	 * @return  self
	 */
	public function setSlugFieldDescription( string $slug_field_description ) {
		$this->slug_field_description = $slug_field_description;

		return $this;
	}

	/**
	 * Get the term Jazz, for example, would be the parent of Bebop and Big Band'.
	 *
	 * @return  string
	 */
	public function getParentFieldDescription() {
		return $this->parent_field_description;
	}

	/**
	 * Set the term Jazz, for example, would be the parent of Bebop and Big Band'.
	 *
	 * @param  string $parent_field_description  The term Jazz, for example, would be the parent of Bebop and Big Band'.
	 *
	 * @return  self
	 */
	public function setParentFieldDescription( string $parent_field_description ) {
		$this->parent_field_description = $parent_field_description;

		return $this;
	}

	/**
	 * Get default 'The description is not prominent by default; however, some themes may show it'.
	 *
	 * @return  string
	 */
	public function getDescFieldDescription() {
		return $this->desc_field_description;
	}

	/**
	 * Set default 'The description is not prominent by default; however, some themes may show it'.
	 *
	 * @param  string $desc_field_description  Default 'The description is not prominent by default; however, some themes may show it'.
	 *
	 * @return  self
	 */
	public function setDescFieldDescription( string $desc_field_description ) {
		$this->desc_field_description = $desc_field_description;

		return $this;
	}

	/**
	 * Get default 'Edit Tag'/'Edit Category'.
	 *
	 * @return  string
	 */
	public function getEditItem() {
		return $this->edit_item;
	}

	/**
	 * Set default 'Edit Tag'/'Edit Category'.
	 *
	 * @param  string $edit_item  Default 'Edit Tag'/'Edit Category'.
	 *
	 * @return  self
	 */
	public function setEditItem( string $edit_item ) {
		$this->edit_item = $edit_item;

		return $this;
	}

	/**
	 * Get default 'View Tag'/'View Category'.
	 *
	 * @return  string
	 */
	public function getViewItem() {
		return $this->view_item;
	}

	/**
	 * Set default 'View Tag'/'View Category'.
	 *
	 * @param  string $view_item  Default 'View Tag'/'View Category'.
	 *
	 * @return  self
	 */
	public function setViewItem( string $view_item ) {
		$this->view_item = $view_item;

		return $this;
	}

	/**
	 * Get default 'Update Tag'/'Update Category'.
	 *
	 * @return  string
	 */
	public function getUpdateItem() {
		return $this->update_item;
	}

	/**
	 * Set default 'Update Tag'/'Update Category'.
	 *
	 * @param  string $update_item  Default 'Update Tag'/'Update Category'.
	 *
	 * @return  self
	 */
	public function setUpdateItem( string $update_item ) {
		$this->update_item = $update_item;

		return $this;
	}

	/**
	 * Get default 'Add New Tag'/'Add New Category'.
	 *
	 * @return  string
	 */
	public function getAddNewItem() {
		return $this->add_new_item;
	}

	/**
	 * Set default 'Add New Tag'/'Add New Category'.
	 *
	 * @param  string $add_new_item  Default 'Add New Tag'/'Add New Category'.
	 *
	 * @return  self
	 */
	public function setAddNewItem( string $add_new_item ) {
		$this->add_new_item = $add_new_item;

		return $this;
	}

	/**
	 * Get default 'New Tag Name'/'New Category Name'.
	 *
	 * @return  string
	 */
	public function getNewItemName() {
		return $this->new_item_name;
	}

	/**
	 * Set default 'New Tag Name'/'New Category Name'.
	 *
	 * @param  string $new_item_name  Default 'New Tag Name'/'New Category Name'.
	 *
	 * @return  self
	 */
	public function setNewItemName( string $new_item_name ) {
		$this->new_item_name = $new_item_name;

		return $this;
	}

	/**
	 * Get this label is only used for non-hierarchical taxonomies. Default 'Separate tags with commas', used in the meta box.
	 *
	 * @return  string
	 */
	public function getSeparateItemsWithCommas() {
		return $this->separate_items_with_commas;
	}

	/**
	 * Set this label is only used for non-hierarchical taxonomies. Default 'Separate tags with commas', used in the meta box.
	 *
	 * @param  string $separate_items_with_commas  This label is only used for non-hierarchical taxonomies. Default 'Separate tags with commas', used in the meta box.
	 *
	 * @return  self
	 */
	public function setSeparateItemsWithCommas( string $separate_items_with_commas ) {
		$this->separate_items_with_commas = $separate_items_with_commas;

		return $this;
	}

	/**
	 * Get javaScript is disabled.
	 *
	 * @return  string
	 */
	public function getAddOrRemoveItems() {
		return $this->add_or_remove_items;
	}

	/**
	 * Set javaScript is disabled.
	 *
	 * @param  string $add_or_remove_items  JavaScript is disabled.
	 *
	 * @return  self
	 */
	public function setAddOrRemoveItems( string $add_or_remove_items ) {
		$this->add_or_remove_items = $add_or_remove_items;

		return $this;
	}

	/**
	 * Get this label is only used on non-hierarchical taxonomies. Default 'Choose from the most used tags', used in the meta box.
	 *
	 * @return  string
	 */
	public function getChooseFromMostUsed() {
		return $this->choose_from_most_used;
	}

	/**
	 * Set this label is only used on non-hierarchical taxonomies. Default 'Choose from the most used tags', used in the meta box.
	 *
	 * @param  string $choose_from_most_used  This label is only used on non-hierarchical taxonomies. Default 'Choose from the most used tags', used in the meta box.
	 *
	 * @return  self
	 */
	public function setChooseFromMostUsed( string $choose_from_most_used ) {
		$this->choose_from_most_used = $choose_from_most_used;

		return $this;
	}

	/**
	 * Get default 'No tags found'/'No categories found', used in the meta box and taxonomy list table.
	 *
	 * @return  string
	 */
	public function getNotFound() {
		return $this->not_found;
	}

	/**
	 * Set default 'No tags found'/'No categories found', used in the meta box and taxonomy list table.
	 *
	 * @param  string $not_found  Default 'No tags found'/'No categories found', used in the meta box and taxonomy list table.
	 *
	 * @return  self
	 */
	public function setNotFound( string $not_found ) {
		$this->not_found = $not_found;

		return $this;
	}

	/**
	 * Get default 'No tags'/'No categories', used in the posts and media list tables.
	 *
	 * @return  string
	 */
	public function getNoTerms() {
		return $this->no_terms;
	}

	/**
	 * Set default 'No tags'/'No categories', used in the posts and media list tables.
	 *
	 * @param  string $no_terms  Default 'No tags'/'No categories', used in the posts and media list tables.
	 *
	 * @return  self
	 */
	public function setNoTerms( string $no_terms ) {
		$this->no_terms = $no_terms;

		return $this;
	}

	/**
	 * Get this label is only used for hierarchical taxonomies. Default 'Filter by category', used in the posts list table.
	 *
	 * @return  string
	 */
	public function getFilterByItem() {
		return $this->filter_by_item;
	}

	/**
	 * Set this label is only used for hierarchical taxonomies. Default 'Filter by category', used in the posts list table.
	 *
	 * @param  string $filter_by_item  This label is only used for hierarchical taxonomies. Default 'Filter by category', used in the posts list table.
	 *
	 * @return  self
	 */
	public function setFilterByItem( string $filter_by_item ) {
		$this->filter_by_item = $filter_by_item;

		return $this;
	}

	/**
	 * Get label for the table pagination hidden heading.
	 *
	 * @return  string
	 */
	public function getItemsListNavigation() {
		return $this->items_list_navigation;
	}

	/**
	 * Set label for the table pagination hidden heading.
	 *
	 * @param  string $items_list_navigation  Label for the table pagination hidden heading.
	 *
	 * @return  self
	 */
	public function setItemsListNavigation( string $items_list_navigation ) {
		$this->items_list_navigation = $items_list_navigation;

		return $this;
	}

	/**
	 * Get label for the table hidden heading.
	 *
	 * @return  string
	 */
	public function getItemsList() {
		return $this->items_list;
	}

	/**
	 * Set label for the table hidden heading.
	 *
	 * @param  string $items_list  Label for the table hidden heading.
	 *
	 * @return  self
	 */
	public function setItemsList( string $items_list ) {
		$this->items_list = $items_list;

		return $this;
	}

	/**
	 * Get title for the Most Used tab. Default 'Most Used'.
	 *
	 * @return  string
	 */
	public function getMostUsed() {
		return $this->most_used;
	}

	/**
	 * Set title for the Most Used tab. Default 'Most Used'.
	 *
	 * @param  string $most_used  Title for the Most Used tab. Default 'Most Used'.
	 *
	 * @return  self
	 */
	public function setMostUsed( string $most_used ) {
		$this->most_used = $most_used;

		return $this;
	}

	/**
	 * Get label displayed after a term has been updated.
	 *
	 * @return  string
	 */
	public function getBackToItems() {
		return $this->back_to_items;
	}

	/**
	 * Set label displayed after a term has been updated.
	 *
	 * @param  string $back_to_items  Label displayed after a term has been updated.
	 *
	 * @return  self
	 */
	public function setBackToItems( string $back_to_items ) {
		$this->back_to_items = $back_to_items;

		return $this;
	}

	/**
	 * Get default 'Tag Link'/'Category Link'.
	 *
	 * @return  string
	 */
	public function getItemLink() {
		return $this->item_link;
	}

	/**
	 * Set default 'Tag Link'/'Category Link'.
	 *
	 * @param  string $item_link  Default 'Tag Link'/'Category Link'.
	 *
	 * @return  self
	 */
	public function setItemLink( string $item_link ) {
		$this->item_link = $item_link;

		return $this;
	}

	/**
	 * Get to a category'.
	 *
	 * @return  string
	 */
	public function getItemLinkDescription() {
		return $this->item_link_description;
	}

	/**
	 * Set to a category'.
	 *
	 * @param  string $item_link_description  to a category'.
	 *
	 * @return  self
	 */
	public function setItemLinkDescription( string $item_link_description ) {
		$this->item_link_description = $item_link_description;

		return $this;
	}

	/**
	 * Get the value of type
	 *
	 * @return  string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Set the value of type
	 *
	 * @param  string $type Taxonomy type.
	 *
	 * @return  self
	 */
	public function setType( string $type ) {
		$this->type = $type;

		return $this;
	}
}
