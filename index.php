<?php
/*
Plugin Name: Skydrive
Description: Plugin to display users skydrive account content
Author: Jeff Marx, Alvin Grant, Alexis Hancock
*/


add_action( 'wp_enqueue_style', 'skydrive_stylesheet');
function skydrive_stylesheet() {
        wp_enqueue_style( 'skydrive-style', plugins_url('style.css?version=1.0', __FILE__) );
}

add_action( 'wp_enqueue_scripts', 'skydrive_script');
function skydrive_script(){
	wp_enqueue_scripts( 'skydrive_script', plugins_url('script.js?version=1.0', __FILE__) );
}

add_action( 'admin_menu', 'skydrive_menu' );
function register_skydrive_settings() {
	//register our settings
	register_setting( 'skydrive-personal', 'client_key' );
	register_setting( 'skydrive-personal', 'client_secret' );
	register_setting( 'skydrive-personal', 'redirect_uri' );
}

//call register settings function
add_action( 'admin_init', 'register_skydrive_settings' );

function skydrive_menu() {
	add_options_page( 'Skydrive Personal', 'Skydrive', 'manage_options', 'skydrive', 'skydrive_options' );
}

function skydrive_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

?>