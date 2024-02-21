<?php
/**
 * The file that defines the Factory class.
 *
 * @package WPAbstractClasses
 * @subpackage Factory
 * @author Kevin Roy <royk@myraytech.net>
 * @copyright Copyright (c) 2023, RayTech Hosting
 */

namespace RayTech\WPAbstractClasses\Factory;

use RayTech\WPAbstractClasses\PostTypes\PostType;
use RayTech\WPAbstractClasses\Taxonomies\Taxonomy;
use RayTech\WPAbstractClasses\MetaBoxes\MetaBox;
use RayTech\WPAbstractClasses\Permalinks\Permalink;

/**
 * Class PostTypeFactory
 *
 * @package WPAbstractClasses
 */
class PostTypeFactory {
	/**
	 * Create a new instance of the class.
	 *
	 * @param string $post_type Post type name slug.
	 * @param mixed  $args All post type configuration arguments.
	 * @return object
	 */
	public static function create( string $post_type, mixed $args = [] ): object {
		$tags       = isset( $args['tags'] ) ? $args['tags'] : false;
		$cats       = isset( $args['categories']) ? $args['categories'] : false;
		if ( isset( $args['meta_boxes'] ) ) {
			$metaboxes  = $args['meta_boxes'];
		}
		if ( isset( $args['permalinks'] ) ) {
			$permalinks = $args['permalinks'];
		}
		unset( $args['tags'] );
		unset( $args['categories'] );
		unset( $args['meta_boxes'] );
		unset( $args['permalinks'] );

		$class = new PostType( $post_type, $args );
		if ( isset( $tags ) ) {
			$tags = new Taxonomy( $post_type, 'tag', $tags );
		}
		if ( isset( $cats ) ) {
			$cats = new Taxonomy( $post_type, 'category', $cats );
		}
		if ( isset( $permalinks ) && $permalinks) {
			new Permalink( $post_type );
		}
		if ( isset( $metaboxes ) ) {
			foreach ( $metaboxes as $name => $metabox ) {
				$metabox = new MetaBox( $post_type, $name, $metabox );
			}
		}
		return $class;
	}
}
