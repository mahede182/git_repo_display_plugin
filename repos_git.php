<?php
/*
plugin name: Repos github
plugin URI: www.github.com/mahede182/
description: this is my sample work. and dedicated as whole github user.
and also thanks who complete the github. it's blessing for the developer life.
version: 1.0.0
Author: Mahede 
Author URI: http://www.github.com/mahede182
*/ 


// exit if accessed  directly
if(!defined('ABSPATH')){
    exit;
}



// link all file in working derectory includes
require_once(plugin_dir_path( __FILE__ ).'/includes/repos_git_classes.php');
require_once(plugin_dir_path(__FILE__).'/includes/repos_git_scripts.php');



// register the widget
function repos_git_widget(){
    register_widget( 'WP_repos_git' );
}
add_action('widgets_init','repos_git_widget');