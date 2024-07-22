# Changelog

All notable changes to this project will be documented in this file

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.11.7] - 2024-07-22

### Fixed

- Fixed issue where the Wordpress menu admin page was not able to add a new menu item.

## [0.11.6] - 2024-07-22

## [0.11.5] - 2024-06-10

### Fixed

- Fixed issue where code was not regenerated properly from last version.

## [0.11.4] - 2024-06-10

### Fixed

- Repeater js not making the button work.

## [0.11.3] - 2024-05-18

### Fixed

- Fixed the repeater not repeating all inputs elements.

## [0.11.2] - 2024-04-13

### Fixed

- Forgot to remove some old constants in abstract permalinks file.

## [0.11.1] - 2024-03-23

### Fixed

- Added missing type cast to the selected item loop for the select field
- Removed forgotten var_dump from tests.

## [0.11.0] - 2024-03-13

### Added

- Added a way to use queries to create options in a select input and fixed a missing check for the multiple option of a select input.

## [0.10.2] - 2024-03-11

### Add

- Added default for metabox columns

### Fixed

- Fixed categories and tags not working as expected

## [0.10.1] - 2024-02-21

### Added

- Added a few checks to make sure the post type et arguments is set before trying to register it with the factory.
- Added defaults to certain options that was missing the defaults

## [0.10.0] - 2023-12-17

### Added

- Permalink options available thru yaml configuration

## [0.9.0] - 2023-12-16

### Added

- Added a factory setup for using yaml file to configure everything from post types to meta fields

## [0.8.7] - 2023-04-24

### Fixed

- Fixed issue where checkboxes weren't saving properly

## [0.8.6] - 2023-04-20

### Fixed

- Fixed a foreach loop issue.

## [0.8.5] - 2023-04-18

### Fixed

- Fixed a but that would cause a fatal error on post meta array data save.
- Fixed wysiwyg display in meta box

## [0.8.4] - 2023-03-21

### Fixed

- Fixed a loop issue resulting in posts meta data to not be saved.

## [0.8.3] - 2023-03-19

### Fixed

- Fixed performance issue on saving meta box data.
- Fixed meta box data as array being empty to remove it.

## [0.8.2] - 2023-03-17

### FIxed

- Added some use statements to fix some bugs.

## [0.8.1] - 2023-03-09

### Fixed

- Configuration file path was not right

## [0.8.0] - 2023-03-09

### Added

- Configuration system reading a file at the root of a theme or plugin. filename: .rtabstract.yml

## [0.7.3] - 2023-03-07

### Fixed

- Change paths constant to a class property.

## [0.7.2] - 2023-03-07

### Fixed

- Fixed paths to assets linking to the right folder whether this package is used in a theme or a plugin

## [0.7.1] - 2023-02-08

### Fixed

- Fixed the AbstractPage Class to include creation sub-pages to custom ones

## [0.7.0] - 2023-02-06

### Added

- Added a Repeater field setup
- Added a Conditional field from other fields

### Fixed

- CSS style for metabox now loads properly

## [0.6.1] - 2022-11-22

### Changed

- Changed assets bundler from webpack to vite

### Fixed

- Fixed a bug with saving the wysiwyg editor string properly
- Fixed a bug with the media button and it js not loading.

## [0.6.0] - 2022-10-22

### Added

- Added Labels class to post type and taxonomies to simplify the process of creating or modifying labels
- A trait for post type methods and property to all abstract classes

### Changed

- The getPostType() method is no longer abstract needing to be created but needs to be set thru the setPostType() method
- The taxonomy getType() method is no longer abstract and can be set thru the setType() method instead

## [0.5.0] - 2022-10-18

### Added

- Added a prefix and a suffix to regular all field inputs except textarea, media, wysiwyg
- Metabox can now have multiple columns of input within the same metabox

### Fixed

- Media upload button doesn't open the media library

### Removed

- Examples will be redone in the wiki therefore removed from code base
- Documentation will be switched to the wiki therefore removed from code base

## [0.4.0] - 2022-10-3

### Added

- Full OOP setup for all abstract classes with getter and setter methods

## [0.3.5] - 2022-09-7

### Added

- Added Wysiwyg field input type to the list

### Changed

- Updated the constant name THEME_NAME to RTABSTRACT_THEME_NAME to follow wordpress guidelines

## [0.3.3] - 2022-06-14

### Fixed

- Fix typo in add_action making it unusable

## [0.3.2] - 2022-06-13

### Fixed

- Fix Meta data not saving on post save

## [0.3.0] - 2022-06-12

### Added

- Added an utility for encoding and decoding json strings for safely storing in the database
- Added the posibility to use a multiple select input

### Changed

- Changed type for 'datetime' input type from 'date' to 'datetime-local'

## [0.2.0] - 2022-06-04

### Added

- Added wrapper classes for options, settings, and site options to wordpress
- Added an abstract classes for creating Administration page

### Changed

- Minimum version of PHP was set to 7.4
