<?php 
/*
Plugin Name: UberMenu - Conditional Category
Plugin URI: www.doofmars.de
Description: Simple plug-in to add extra in category option to uber menus ubermenu-conditionals addon.
Author: Doofmars
Version: 0.1
Author URI: www.doofmars.de
*/

//Register the custom Conditional option
add_filter( 'ubermenu_conditionals_options' , 'register_conditional_category' );

function register_conditional_category( $ops ){
	if( !isset( $ops['custom'] ) ) $ops['custom'] = array();
	$ops['custom']['conditional_category'] = array(         //conditional_category is used to identify this condition
		'name'  => 'In Category',    //This name will appear in the settings panel
		'desc'  => 'Required Parameter: Category ID or list of IDs ' //The condition's description
	);
	return $ops;
}
 
//Add our custom conditional test
add_filter( 'ubermenu_conditionals_custom_condition' , 'conditional_category_test' , 10 , 3 );
function conditional_category_test( $display_on, $condition , $param ){
	//Only apply for this specific condition
	if( $condition == 'conditional_category' ){
		//test if we have multiple categories selected
		if( is_array($param) ) {
			foreach ($param as $category) {
				//Test actual condition
				if( is_single() && in_category( $category ) ){
					return true;
				}
			}
		} else {
			if( is_single() && in_category( $param ) ){
				return true;
			}
		}
	}
	return false;
}

 ?>