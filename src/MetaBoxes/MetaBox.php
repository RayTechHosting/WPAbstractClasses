<?php

namespace RayTech\WPAbstractClasses\MetaBoxes;

class MetaBox extends AbstractMetaBox {
	public function __construct($post_type, $name, $options = [])
	{
		$this->setHeader($options['label']);
		$this->setPostType($post_type);
		$this->setSlug($name);
		$this->setColumns(($options['columns'])? $options['columns'] : 1);
		unset($options['label']);
		unset($options['columns']);
		parent::__construct();
		foreach ( $options['fields'] as $key => $value ) {
			$this->config[$key] = $value;
		}
	}
}