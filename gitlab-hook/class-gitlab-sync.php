<?php

class GitlabSync {
	
	protected $_storage;
	
	function __construct() {
		
		$this->_storage = new GitlabStorage();
		
	}
	
	function update() {
		
		$storage = $this->_storage;
		
		$new_request = file_get_contents("php://input");
		$new_request = json_decode( $new_request, true );
		
		$storage = new GitlabStorage();
		$storage->set( "last", $storage->get("current") );
		$storage->set( "current", $new_request['after'] );
		
	}

	function pull() {
		
		$storage = $this->_storage;
		
		$current = $storage->get("current");
		$last = $storage->get("last");
		
		if ( $current != $last ) {
			exec("cd " . dirname(__FILE__) . " && cd .. && git pull");
		}
		
	}

}