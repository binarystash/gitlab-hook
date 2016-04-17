<?php
/**
 * trigger.php
 * 
 * This file serves as the controller
 * @author Binarystash <binarystash01@gmail.com>
 * @version 1.0.0
 * @license https://opensource.org/licenses/MIT MIT
 */

//Include files
require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'class-gitlab-storage.php' );
require_once( dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'class-gitlab-sync.php' );

//Get vars
$action = isset( $_GET['action'] ) ? $_GET['action'] : $argv[1];
$gs = new Gitlab_Sync();

switch ( $action ) {
	
	case "update": 
		$gs->update();
		break;
		
	case "pull":
		$gs->pull();
		break;
		
}