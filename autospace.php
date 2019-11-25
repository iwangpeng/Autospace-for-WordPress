<?php
/**
 * Plugin Name: Autospace - Chinese
 * Plugin URI:  https://github.com/iwangpeng/Autospace-for-WordPress
 * Description: Autospace 可以帮助你在标题和正文的中英文之间自动插入空格，使排版更美观。
 * Version:     1.0
 * Author:      Wang Peng
 * Author URI:  https://github.com/iWangPeng
 */

add_filter( 'wp_insert_post_data', 'autospace_insert_post_data', 99, 2 );

function autospace_insert_post_data( $data , $postarr ) {
    $data['post_title'] = autospace_add_spaces_between_chinese_and_alphanum( $data['post_title'] );
    $data['post_content'] = autospace_add_spaces_between_chinese_and_alphanum( $data['post_content'] );
    return $data;
}

function autospace_add_spaces_between_chinese_and_alphanum( $content ) {
    $content = autospace_add_space_before_alphanum( $content );
    $content = autospace_add_space_after_alphanum( $content );
    return $content;
}

function autospace_add_space_before_alphanum( $content ) {
    return preg_replace( '/([\x{4e00}-\x{9fa5}]+)([A-Za-z0-9_]+)/u', '${1} ${2}', $content );
}

function autospace_add_space_after_alphanum( $content ) {
    return preg_replace( '/([A-Za-z0-9_]+)([\x{4e00}-\x{9fa5}]+)/u', '${1} ${2}', $content );
}