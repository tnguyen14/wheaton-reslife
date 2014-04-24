=== Wheaton ResLife ===
Contributors: tnguyen14
Tags: residential life, dorm, staff, building
Requires at least: 3.0.1
Tested up to: 3.9
Stable tag: 0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provide Custom Post Type support and other functionalities for Wheaton College Residential Life page

== Description ==

## Dependencies

This plugin requires [Super CPT](http://wordpress.org/plugins/super-cpt/) and [Posts 2 Posts](http://wordpress.org/plugins/posts-to-posts/) plugins.

## Custom Post Types

* Staff
* Building

## Fields

### Staff
* Description (default content editor)
* Email
* Title
* Major
* Classyear

### Building
* Description (default content editor)

## Taxonomies

### Quad
For both staff and buildings

### Attributes
For buildings

## Future

Super CPT currently does not support repeatable field, which makes it difficult to have building images and floor plans as separate custom fields.
For now, they can be added as galleries in the main editor.

@TODO: look for ways to implement repeater field.

== Installation ==

== Development Guide ==
https://wordpress.org/plugins/about/svn/
http://danielbachhuber.com/2012/09/30/git-in-my-subversion/

== Frequently Asked Questions ==

== Screenshots ==

== Changelog ==

= 0.2 =
Add meta fields for staff major and classyear.
Convert staff title into select field.

= 0.1 =
Initialize 2 custom post types for building and staff.