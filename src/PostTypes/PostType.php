<?php

namespace RayTech\WPAbstractClasses\PostTypes;

class PostType extends AbstractPostType {
	public function __construct(string $type, $options)
	{
		$this->setPostType($type);
		parent::__construct();
		foreach($options as $key => $value) {
			$this->$key = $value;
		}
	}
}