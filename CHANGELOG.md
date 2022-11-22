# Changelog

All notable changes to this project will be documented in this file

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
