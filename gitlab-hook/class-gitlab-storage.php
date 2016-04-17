<?php
/**
 * class-gitlab-storage.php
 * 
 * This class uses a JSON file for data storage/retrieval
 * @author Binarystash <binarystash01@gmail.com>
 * @version 1.0.0
 * @license https://opensource.org/licenses/MIT MIT
 */

class Gitlab_Storage {
	
	protected $_filename;
	
	function __construct() {
		
		$this->_filename = dirname(__FILE__). DIRECTORY_SEPARATOR . "/json/gitstorage.json";

		if ( !file_exists( $this->_filename ) ) {
			file_put_contents( $this->_filename, "" );
		}
		
	}
	
	private function _read_from_file() {
		
		return json_decode( file_get_contents( $this->_filename ), true );
		
	}
	
	private function _save_to_file( $array ) {
		
		$a = file_put_contents( $this->_filename, json_encode( $array ) );

	}

	function set($option,$value) {
		
		$data = $this->_read_from_file();
		
		$data[$option] = $value;
		
		$this->_save_to_file( $data );
		
	}
	
	function get($option) {
		
		$data = $this->_read_from_file();
		
		if ( isset( $data[$option] ) ) {
			return $data[$option];
		}
		else {
			return null;
		}
		
	}
	
	function purge($option) {
		
		$data = $this->_read_from_file();
		
		if ( isset( $data[$option] ) ) {
			unset( $data[$option] );
		}
		
		$this->_save_to_file( $data );
		
	}
	
}