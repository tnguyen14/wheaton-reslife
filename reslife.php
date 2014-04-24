<?php
/**
 * @package Wheaton_ResLife
 * @version 0.2
 */
/*
Plugin Name: Wheaton ResLife
Plugin URI: http://wordpress.org/plugins/wheaton-reslife
Description: Provide Custom Post Type support and other functionalities for Wheaton College Residential Life page
Author: Tri Nguyen
Version: 0.2
Author URI: http://tridnguyen.com/
*/

if ( ! defined( 'WR_PLUGIN_NAME' ) )
	define( 'WR_PLUGIN_NAME', 'Wheaton ResLife' );
if ( ! defined( 'WHEATON_RESLIFE' ) )
	define( 'WHEATON_RESLIFE', true );

/*
	Notify user to install Super CPT plugin
*/
function supercpt_notice() {
	if ( current_user_can ( 'install_plugins' ) )
		echo '<div class="error"><p>Plugin \'Super CPT\' is required for ' . WR_PLUGIN_NAME . '. Please <a href="http://wordpress.org/plugins/super-cpt/">install</a> it.</p></div>';
}

/*
	Notify user to install Posts 2 Posts plugin
*/
function p2p_notice() {
	if ( current_user_can ( 'install_plugins' ) )
		echo '<div class="error"><p>Plugin \'Posts 2 Posts\' is required for ' . WR_PLUGIN_NAME . '. Please <a href="http://wordpress.org/plugins/posts-to-posts/">install</a> it.</p></div>';
}

/*
	Initialize Custom Post Types required for this plugin, including
	reslife-staff and reslife-building
*/
function reslife_cpt_init() {
	$supercpt_exists = false;
	$p2p_exists = false;
	if ( ! class_exists( 'Super_Custom_Post_Type' ) ) {
		add_action( 'admin_notices', 'supercpt_notice' );
	} else {
		$supercpt_exists = true;
	}

	if ( P2P_PLUGIN_VERSION == 'P2P_PLUGIN_VERSION' ) {
		add_action( 'admin_notices', 'p2p_notice' );
	} {
		$p2p_exists = true;
	}

	if ( ! $supercpt_exists || ! $p2p_exists ) {
		return;
	}

	$staff = new Super_Custom_Post_Type( 'reslife-staff', 'Staff Member', 'Staff', array(
		'supports' => array( 'title', 'thumbnail', 'editor' )
	));
	$staff->set_icon( 'group' );
	$staff->add_meta_box( array(
		'id'	=> 'staff_info',
		'title'	=> 'Staff Information',
		'fields'	=> array(
			'email'	=> array(
				'type'	=> 'email',
				'default'	=> ''
			),
			'title'	=> array(
				'type'	=> 'select',
				'options'	=> array(
					'AC' => 'Area Coordinator (AC)',
					'RA' => 'Residential Advisor (RA)',
					'HR' => 'Head Resident (HR)',
					'SR' => 'Senior Resident (SR)'
				)
			),
			'classyear' => array(
				'type' => 'text',
				'default' => ''
			),
			'major' => array(
				'type' => 'text',
				'default' => ''
			)
		)
	));
	$building = new Super_Custom_Post_Type( 'reslife-building', 'Building', 'Buildings', array(
		'supports' => array( 'title', 'editor', 'thumbnail')
	));
	$building->set_icon( 'building' );
	$building->add_meta_box( array(
		'id'	=> 'building_info',
		'title'	=> 'Building Information',
		'fields'	=> array(
		)
	));

	$quad = new Super_Custom_Taxonomy( 'reslife-quad', 'Quad', 'Quads', 'category' );
	$quad->connect_post_types( array( 'reslife-staff', 'reslife-building' ) );

	$attributes = new Super_Custom_Taxonomy( 'reslife-attributes', 'Attribute', 'Attributes', 'category' );
	$attributes->connect_post_types( 'reslife-building' );
}

add_action( 'after_setup_theme', 'reslife_cpt_init' );

/*
	Create a 2-way connection between staff and building
*/
function reslife_connect_staff_buidling() {
	p2p_register_connection_type( array(
		'name' => 'reslife-building-to-staff',
		'from' => 'reslife-building',
		'to'	=> 'reslife-staff',
		'reciprocal'	=> true,
		'admin_box'	=> array(
			'show'	=> 'any',
			'context'	=> 'advanced'
		)
	) );
}
add_action( 'p2p_init', 'reslife_connect_staff_buidling' );

?>
