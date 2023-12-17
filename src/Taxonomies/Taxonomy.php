<?php

namespace RayTech\WPAbstractClasses\Taxonomies;

class Taxonomy extends AbstractTaxonomy {
	public function __construct(string $type,string $taxType, $options = null )
	{
		$this->setPostType($type);
		$this->setType($taxType);
		parent::__construct();
		if ( ! is_null( $options ) && is_array( $options ) ) {
			foreach($options as $key => $value) {
				$this->$key = $value;
			}
		}
	}
}