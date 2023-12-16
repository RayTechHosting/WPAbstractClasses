<?php

namespace RayTech\WPAbstractClasses\Factory;

use RayTech\WPAbstractClasses\PostTypes\PostType;
use RayTech\WPAbstractClasses\Taxonomies\Taxonomy;
use RayTech\WPAbstractClasses\MetaBoxes\MetaBox;

class PostTypeFactory {
	/**
	 * Create a new instance of the class.
	 *
	 * @param string $post_type_name
	 *
	 * @return object
	 */
	public static function create(string $post_type, mixed $args = []): object {
		$tags      = $args['tags'];
		$cats      = $args['categories'];
		$metaboxes = $args['meta_boxes'];
		unset($args['tags']);
		unset($args['categories']);
		unset($args['meta_boxes']);
		$postType  = new PostType($post_type, $args);
		if ( $tags ) {
			$tags = new Taxonomy($post_type, 'tag');
		}
		if ( $cats ) {
			$cats = new Taxonomy($post_type, 'category');
		}
		if( $metaboxes ) {
			foreach( $metaboxes as $name => $metabox ) {
				$metabox = new MetaBox($post_type, $name, $metabox);
			}
		}
		return $postType;
	}
}