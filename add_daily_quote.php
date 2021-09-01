<?php

//load all wordpress functions
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/wp-load.php' );

//declare global variables to be able to use
global $_POST;
global $wpdb;

//check to make sure the quote post is not empty before progressing. 
if ( isset( $_POST['addquote'] ) ) {

    //create variables and ensure no slashes in input data
    $quote = stripslashes($_POST['quote']);
    $author = stripslashes($_POST['quote_author']);

    //set the data type to be strings
    $format = '%s';
    //create the data array to parse into the database
    $data = array(
        //set the key value pairs to parse into the database 
        //key = column name
        //value = data you are parsing into the db  
        'quote' => $quote,
        'author' => $author,
    );

    // wordpress prefix your new db table
    $table_name = $wpdb->prefix . 'daily_quotes';

    //insert sanatizes the data automatically so we don't have to.
    //make sure that no required variables are empty before progressing
    if ($table_name != null && $format != null && $data != null) {
        //parse the data into the database. 
        $wpdb->insert( $table_name, $data, $format );
        //redirect to referrer uri of the post
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    } else {
        //if insert fails, print the error
        $wpdb->print_error();
        die;
    }

    // $referrer = $_SERVER['HTTP_REFERER'];
    // header("Refresh: 0.1; URL='$referrer'");
};