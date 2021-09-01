<?php

//load all wordpress functions
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/wp-load.php' );

//define global variables
global $wpdb;

if ( isset( $_POST['removequote'] ) ) {

    //get the quote number from the post
    //remove the slashes from any data entry on the frontend
    $id = stripslashes($_POST['ID']);

    //if an id is passed from the frontend proceed
    if ($id) {
        //remove the entire entry from the db table
        //database row key and also ID = ID
        //value = form $id parsed from frontend
        $wpdb->delete( 'wp_daily_quotes', array( 'ID' => $id ) );
        //redirect to the uri post page
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    } else {
        $wpdb->print_error();
        die;
    }
};