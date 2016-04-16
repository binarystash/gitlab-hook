<?php

//Include files
require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'class-gitlab-storage.php' );
require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'class-gitlab-sync.php' );

//Get vars
$action = isset( $_GET['action'] ) ? $_GET['action'] : $argv[1];
$gs = new GitlabSync();

switch ( $action ) {
	
	case "update": 
		$gs->update();
		break;
		
	case "pull":
		$gs->pull();
		break;
		
}