<?php
/*
	Plugin Name: NS WordPress Plugin Template
	Plugin URI: http://neversettle.it
	Description: A simple, fully functional WordPress plugin template that does NOTHING except give you a huge head start on building a new quality plugin.
	Text Domain: ns-plugin-template
	Author: Never Settle
	Author URI: http://neversettle.it
	Version: 1.0.1
	Tested up to: 4.9.8
	License: GPLv2 or later
*/

/*
	Copyright 2014 Never Settle (email : dev@neversettle.it)
	
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // exit if accessed directly!
}

require_once(plugin_dir_path(__FILE__).'ns-sidebar/ns-sidebar.php');

// TODO: rename this class
class NS_Plugin {
	
	var $path; 				// path to plugin dir
	var $wp_plugin_page; 	// url to plugin page on wp.org
	var $ns_plugin_page; 	// url to pro plugin page on ns.it
	var $ns_plugin_name; 	// friendly name of this plugin for re-use throughout
	var $ns_plugin_menu; 	// friendly menu title for re-use throughout
	var $ns_plugin_slug; 	// slug name of this plugin for re-use throughout
	var $ns_plugin_ref; 	// reference name of the plugin for re-use throughout
	
	function __construct(){		
		$this->path = plugin_dir_path( __FILE__ );
		// TODO: update to actual
		$this->wp_plugin_page = "http://wordpress.org/plugins/ns-wordpress-plugin-template";
		// TODO: update to link builder generated URL or other public page or redirect
		$this->ns_plugin_page = "http://neversettle.it/";
		// TODO: update this - used throughout plugin code and only have to update here
		$this->ns_plugin_name = "NS Plugin Template";
		// TODO: update this - used throughout plugin code and only have to update here
		$this->ns_plugin_menu = "NS Plugin Menu";
		// TODO: update this - used throughout plugin code and only have to update here
		$this->ns_plugin_slug = "ns-plugin-template";
		// TODO: update this - used throughout plugin code and only have to update here
		$this->ns_plugin_ref = "ns_plugin_template";
		
		add_action( 'plugins_loaded', array($this, 'setup_plugin') );
		add_action( 'admin_notices', array($this,'admin_notices'), 11 );
		add_action( 'network_admin_notices', array($this, 'admin_notices'), 11 );		
		add_action( 'admin_init', array($this,'register_settings_fields') );		
		add_action( 'admin_menu', array($this,'register_settings_page'), 20 );
		add_action( 'admin_enqueue_scripts', array($this, 'admin_assets') );
		
		// TODO: uncomment this if you want to add custom JS 
		//add_action( 'admin_print_footer_scripts', array($this, 'add_javascript'), 100 );
		
		// TODO: uncomment this if you want to add custom actions to run on deactivation
		//register_deactivation_hook( __FILE__, array($this, 'deactivate_plugin_actions') );
	}

	function deactivate_plugin_actions(){
		// TODO: add any deactivation actions here
	}
	
	/*********************************
	 * NOTICES & LOCALIZATION
	 */
	 
	 function setup_plugin(){
	 	load_plugin_textdomain( $this->ns_plugin_slug, false, $this->path."lang/" ); 
	 }
	
	function admin_notices(){
		$message = '';	
		if ( $message != '' ) {
			echo "<div class='updated'><p>$message</p></div>";
		}
	}

	function admin_assets($page){
	 	wp_register_style( $this->ns_plugin_slug, plugins_url("css/ns-custom.css",__FILE__), false, '1.0.0' );
	 	wp_register_script( $this->ns_plugin_slug, plugins_url("js/ns-custom.js",__FILE__), false, '1.0.0' );
		if( strpos($page, $this->ns_plugin_ref) !== false  ){
			wp_enqueue_style( $this->ns_plugin_slug );
			wp_enqueue_script( $this->ns_plugin_slug );
		}		
	}
	
	/**********************************
	 * SETTINGS PAGE
	 */
	
	function register_settings_fields() {
		// TODO: might want to update / add additional sections and their names, if so update 'default' in add_settings_field too
		add_settings_section( 
			$this->ns_plugin_ref.'_set_section', 	// ID used to identify this section and with which to register options
			$this->ns_plugin_name, 					// Title to be displayed on the administration page
			false, 									// Callback used to render the description of the section
			$this->ns_plugin_ref 					// Page on which to add this section of options
		);
		// TODO: update labels etc.
		// TODO: for each field or field set repeat this
		add_settings_field( 
			$this->ns_plugin_ref.'_field1', 	// ID used to identify the field
			'Setting Name', 					// The label to the left of the option interface element
			array($this,'show_settings_field'), // The name of the function responsible for rendering the option interface
			$this->ns_plugin_ref, 				// The page on which this option will be displayed
			$this->ns_plugin_ref.'_set_section',// The name of the section to which this field belongs
			array( 								// args to pass to the callback function rendering the option interface
				'field_name' => $this->ns_plugin_ref.'_field1'
			)
		);
		register_setting( $this->ns_plugin_ref, $this->ns_plugin_ref.'_field1');
	}	

	function show_settings_field($args){
		$saved_value = get_option( $args['field_name'] );
		// initialize in case there are no existing options
		if ( empty($saved_value) ) {
			echo '<input type="text" name="' . $args['field_name'] . '" value="Setting Value" /><br/>';
		} else {
			echo '<input type="text" name="' . $args['field_name'] . '" value="'.$saved_value.'" /><br/>';
		}
	}

	function register_settings_page(){
		add_submenu_page(
			'options-general.php',								// Parent menu item slug	
			__($this->ns_plugin_name, $this->ns_plugin_name),	// Page Title
			__($this->ns_plugin_menu, $this->ns_plugin_name),	// Menu Title
			'manage_options',									// Capability
			$this->ns_plugin_ref,								// Menu Slug
			array( $this, 'show_settings_page' )				// Callback function
		);
	}
	
	function show_settings_page(){
		?>
		<div class="wrap">
			
			<h2><?php $this->plugin_image( 'banner.png', __('ALT') ); ?></h2>
			
			<!-- BEGIN Left Column -->
			<div class="ns-col-left">
				<form method="POST" action="options.php" style="width: 100%;">
					<?php settings_fields($this->ns_plugin_ref); ?>
					<?php do_settings_sections($this->ns_plugin_ref); ?>
					<?php submit_button(); ?>
				</form>
			</div>
			<!-- END Left Column -->
						
			<!-- BEGIN Right Column -->			
			<div class="ns-col-right">
				<h3>Thanks for using <?php echo $this->ns_plugin_name; ?></h3>
				<?php ns_sidebar::widget( 'subscribe' ); ?>
				<?php ns_sidebar::widget( 'share', array('plugin_url'=>'http://neversettle.it/buy/wordpress-plugins/ns-fba-for-woocommerce/','plugin_desc'=>'Connect WordPress to Google Sheets!','text'=>'Would anyone else you know enjoy NS Google Sheets Connector?') ); ?>
				<?php ns_sidebar::widget( 'donate' ); ?>
				<?php ns_sidebar::widget( 'featured'); ?>
				<?php ns_sidebar::widget( 'links', array('ns-fba') ); ?>
				<?php ns_sidebar::widget( 'random'); ?>
				<?php ns_sidebar::widget( 'support' ); ?>
			</div>
			<!-- END Right Column -->
				
		</div>
		<?php
	}
	
	
	/*************************************
	 * FUNCTIONALITY
	 */
	
	// TODO: add additional necessary functions here
	
	/*************************************
	 * UITILITY
	 */
	 
	 function plugin_image( $filename, $alt='', $class='' ){
	 	echo "<img src='".plugins_url("/images/$filename",__FILE__)."' alt='$alt' class='$class' />";
	 }
	
}

new NS_Plugin();
