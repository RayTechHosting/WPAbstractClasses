<?php
namespace RayTech\WPAbstractClasses\Utilities;

class Query {

	public function run($id, $args) {
		$query = new \WP_Query($args);
		$posts = $query->get_posts();
		$data = $this->pick_fields($id, $posts, $args['pick']);
		
		return $data;
	}

	protected function pick_fields($id, $posts, $list) {
		$array = [];
		$meta  = '';
		foreach ($posts as $post) {
			if(is_int($post)) {
				if(isset($list['meta']) ) {
					foreach ($list['meta'] as $meta_key) {
						$meta_data = get_post_meta($post, $meta_key, true) . ' ';
						if(is_string($meta_data) ) {
							$meta .= $meta_data;
						}
					}
					$array[$post] = rtrim($meta, ' ');
				}
			} else {
				if(isset($list['meta']) ) {
					foreach ($list['meta'] as $meta_key) {
						$meta_data = get_post_meta($post, $meta_key, true) . ' ';
						if(is_string($meta_data) ) {
							$meta .= $meta_data;
						}
					}
				}
				if(isset($list['field']) ) { 
					$field = $list['field'];
					var_dump($post->$field);
					$array[$post->ID] = $post->$field;
				}
			}
		}

		return $array;
	}
}
