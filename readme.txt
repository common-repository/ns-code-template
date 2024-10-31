=== NS WordPress Plugin Template ===
Contributors: neversettle
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=RM625PKSQGCCY&rm=2
Tags: plugin, template, example, plugin template, model, reusable
Requires at least: 3.5
Tested up to: 4.9.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A simple, fully functional and reusable WordPress plugin template that does NOTHING except give you a huge head start on building a new plugin.

== Description ==

This plugin is designed to be used as starting point for a new plugin. It will save you the time of putting in place a file structure, adding common files, creating a basic plugin class, wiring common hooks that you might need, adding an admin menu item, and more. It uses many common, standard WordPress techniques for frequently needed basic plugin features. It is well commented with TODO items to know where to customize it for your own needs. 

= How to Use this Plugin Template =

1. Copy the entire folder to a new location and folder that you rename for your new plugin.
1. Rename any of the files in the structure that you want to "re-brand" for your plugin and make sure any code references pointing to those files are also updated.
1. Go through the code and follow the well-commented TODO items, renaming the class and variables and functions to suit your needs.
1. Add your own core functionality / graphics / etc. 
1. If you have a lot of common things that you do from plugin to plugin, add those to your main "template" version and they will be available every time you copy it to a new plugin.  

= Important Notes = 

* This plugin includes examples of how we implement a plugin sidebar in our own plugins and exmple widgets like our own mail-chimp newsletter subscription, etc. 
* You will have to either know how to modify these for your own needs or remove them completely.
* We cannot promise support for specific questions about what to modify in your scenario.  

Enjoy!

= Features =
Example techniques included in this Plugin Template

1. General file structure
1. Lots of comments and TODO items to help you know what to change
1. Using a class approach to building a plugin
1. Minimal variable updates by re-using class level variables for things like the plugin name and slug
1. Using common WordPress hooks and filters
1. Creating an admin menu item under the Settings menu
1. Implementing the WordPress Settings API
1. Very basic responsive settings page including a banner
1. Creating a Sidebar that has its own widget system and can pull data from a feed on your WordPress site (this is more of an advanced feature that we use on our own plugins and it requires additional know-how to tweak for your needs). It can also be removed completely if you don't need / want it.

== Installation ==

1. Log in to your WordPress site as an administrator
2. Use the built-in Plugins tools to install from the repository or unzip and Upload the plugin directory to /wp-content/plugins/ 
3. Activate the plugin through the 'Plugins' menu in WordPress
4. The current output of the plugin teamplate can be seen by going to Settings > NS Plugin Template

== Screenshots ==

Coming Soon (maybe... not much to see :)

== Frequently Asked Questions ==

= Is this plugin template supported? =
We'll try to answer any questions that come up in the support forum here on WP.org, but this plugin is really designed to save time for developers who are already familiar with building WordPress plugins. However, it can also be a great place to start if you've never created a plugin before, and there a ton of resources out there to help you along your way.   

== Changelog ==

= 1.0.1 =
* Updated email subscription form service in sidebar

= 1.0.0 =
* First public release

== Upgrade Notice ==

