<?php

$parent_directory = dirname(__FILE__);

require_once($parent_directory."/../gitlab-hook/class-gitlab-storage.php");

class Gitlab_Storage_test extends PHPUnit_Framework_TestCase
{
   
	public $gitlab_storage;
   
	function setUp() {
		
		$this->gitlab_storage = new Gitlab_Storage();

	}

	public function testGetterSetter() {
		$this->gitlab_storage->set("testValue","A test value");
		$this->assertTrue( $this->gitlab_storage->get("testValue") == 'A test value' );
	}
	
	public function testPurge() {
		$this->gitlab_storage->purge("testValue");
		$this->assertTrue( $this->gitlab_storage->get("testValue") == null );
	}


}