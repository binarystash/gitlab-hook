<?php

class GitlabStorage {
	
	protected $_data;
	protected $_filename;
	
	function __construct() {
		
		$this->_filename = dirname(__FILE__). DIRECTORY_SEPARATOR . "/json/gitstorage.json";

		if ( file_exists( $this->_filename ) ) {
			$data = file_get_contents( $this->_filename );
			$this->_data = json_decode( $data, true );
		}
		else {
			file_put_contents( $this->_filename, "" );
		}
		
	}
	
	function set($option,$value) {
		$this->_data[$option] = $value;
		file_put_contents( $this->_filename, json_encode( $this->_data ) );
	}
	
	function get($option) {
		if ( isset( $this->_data[$option] ) ) {
			return $this->_data[$option];
		}
		else {
			return null;
		}
	}
	
}