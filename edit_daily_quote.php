<?php

//load all wordpress functions
require_once( $_SERVER[ 'DOCUMENT_ROOT' ] . '/wp-load.php' );

//get access to the global variables
global $_POST;
global $wpdb;

//check if there is any value in the correct update form post. If so proceed
if ( isset( $_POST['editquotes'] ) ) {

    //remove the slashes from any data entry on the frontend
    $id = stripslashes($_POST['id']);
    $updated_quote = stripslashes($_POST['quote-to-update']);

    // wordpress prefix your new db table
    $table_name = $wpdb->prefix . 'daily_quotes';

    //if the new $id variable is not empty then proceed
    if ($id != null) {
        //What columns in the database table are we updating? Specify them in a new variable 
        $data_update = array('quote' => $updated_quote);
        //Where do we want to make these updates? Specify them by parsing the id and comparing it to the id in the database
        $data_where = array('id' => $id);
        //call the update method on the $wpdb class. Pass in the required arugments, table, data, where.
        $wpdb->update($table_name , $data_update, $data_where);
        //redirect to the referrer uri where the request was sent from.
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
    } else {
        $wpdb->print_error();
        die;
    }
};