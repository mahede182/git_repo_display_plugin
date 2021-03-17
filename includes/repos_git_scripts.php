<?php
function repos_git_script_and_css()
{
    // wp_enqueue_style( 'repos_git',plugins_url().'/repos_git/css/repos_git.css');
    wp_enqueue_style('repos_main_style',plugins_url().'/repos_git/css/repos_git.css');
    wp_enqueue_script( 'repos_main_js',plugins_url().'/repos_git/js/main.js' );
}
    add_action( 'wp_enqueue_scripts','repos_git_script_and_css');

?>