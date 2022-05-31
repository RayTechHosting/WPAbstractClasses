# RayTech Hosting WordPress Abstract Classes

This package provides the OOP abstract wrapper PHP classes for using in wordpress to help speed development.

## Install

Install using composer is the method supported by this package.

```bash
  composer require raytechhosting/wpabstractclasses
```

## Usage

All you need to do to use these classes is to have composer autoload the classes and then reference them using a use statement and after that you can extend the abstract classes for different type of data.

Here is a list of the data types:

| Data Type   | Abstract class                                        |
|-------------|-------------------------------------------------------|
| Post Type   | RayTech\WPAbstractClasses\PostType\AbstractPostType   |
| Permalink   | RayTech\WPAbstractClasses\Permalink\AbstractPermalink |
| Taxonomy    | RayTech\WPAbstractClasses\Taxonomy\AbstractTaxonomy   |
| Meta Box    | RayTech\WPAbstractClasses\MetaBox\AbstractMetaBox     |

### Examples

You can refer to the examples folder for more details.
