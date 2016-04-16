<?php

class Gitlab_Sync {
	
	protected $_storage;
	
	function __construct() {
		
		$this->_storage = new Gitlab_Storage();
		
	}
	
	function update() {
		
		$storage = $this->_storage;
		
		$new_request = file_get_contents("php://input");
		$new_request = json_decode( $new_request, true );
		
		$storage = new Gitlab_Storage();
		$storage->set( "last", $storage->get("current") );
		$storage->set( "current", $new_request['after'] );
		
	}

	function pull() {
		
		$storage = $this->_storage;
		
		$current = $storage->get("current");
		$last = $storage->get("last");
		
		if ( $current != $last ) {
			exec("cd " . dirname(__FILE__) . " && cd .. && git pull");
			return $current;
		}
		
		return $last;
		
	}

}