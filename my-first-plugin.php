<?php
/**
 * Plugin Name: My First Plugin
 * Description: Adds some content in end of each single post.
 * Version: 1.0
 * Author: Shubham
 * Author URI : shubham.com
*/

add_filter('the_content','my_function');

function my_function($content){
    if(is_single() && is_main_query()){
        return $content . '<p>My name is shubham</p>';
    }
    return $content;
}