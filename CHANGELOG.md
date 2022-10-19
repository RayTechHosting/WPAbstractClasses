# Changelog

All notable changes to this project will be documented in this file

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.4.1] - 2022-10-18

### Fixed

- Media upload button doesn't open the media library

### Removed

- Examples will be redone in the wiki therefore removed from code base
- Documentation will be switched to the wiki therefore removed from code base

## [0.4.0] - 2022-10-3

### Added

- Full OOP setup for all abstract classes with getter and setter methods
- Metabox can now have multiple columns of input within the same metabox

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