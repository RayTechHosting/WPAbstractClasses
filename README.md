# RayTech Hosting WordPress Abstract Classes

This package provides the OOP abstract wrapper PHP classes for using in wordpress to help speed development.

## Install

Install using composer is the method supported by this package.

```bash
  composer require raytechhosting/wpabstractclasses
```

## Usage

Start by creating a file '.rtabstract.yml' at the root of your theme or plugin folder.
Here is an example of how to setup the file.

```yaml
implementation_type: theme
theme_name: theme-name
theme_version: 1.0.0
post_types:
  portfolio:
    tags: true
    categories: true
    supports: 
      - title
      - editor
      - thumbnail
    meta_boxes:
      meta:
        columns: 3
        label: Meta
        fields:
          name:
            type: text
            label: Name
          test:
            type: repeater
            label: Tester
            attr:
              fields:
                tester:
                  type: number
                  label: Tester
```
