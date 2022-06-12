# RayTech Hosting WordPress Abstract Classes

This package provides the OOP abstract wrapper PHP classes for using in wordpress to help speed development.

## Install

Install using composer is the method supported by this package.

```bash
  composer require raytechhosting/wpabstractclasses
```

## Usage

All you need to do to use these classes is to have composer autoload the classes and then reference them using a use statement and after that you can extend the abstract classes for different type of data.

Here is a list of the data types that have Abstract Classes:

| Data Type  | Abstract class                                         |
|------------|--------------------------------------------------------|
| Post Type  | RayTech\WPAbstractClasses\PostTypes\AbstractPostType   |
| Permalink  | RayTech\WPAbstractClasses\Permalinks\AbstractPermalink |
| Taxonomy   | RayTech\WPAbstractClasses\Taxonomies\AbstractTaxonomy  |
| Meta Box   | RayTech\WPAbstractClasses\MetaBoxes\AbstractMetaBox    |
| Admin page | RayTech\WPAbstractClasses\Administration\AbstractPage  |

Here is a list of the data types that have Wrapper Classes:

| Data Type       | Wrapper Classes                                     |
|-----------------|-----------------------------------------------------|
| Settings API    | RayTech\WPAbstractClasses\Administration\Setting    |
| Options API     | RayTech\WPAbstractClasses\Administration\Option     |
| Site Option API | RayTech\WPAbstractClasses\Administration\SiteOption |

Also some utilities:

| Utility | Class                                       |
|---------|---------------------------------------------|
| Encoder | RayTech\WPAbstractClasses\Utilities\Encoder |

### Examples

You can refer to the examples folder for more details.
