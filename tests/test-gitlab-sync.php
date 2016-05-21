<?php

class Gitlab_Sync_test extends PHPUnit_Framework_TestCase
{
   
	public $gitlab_storage;
	public $gitlab_sync;
   
	function setUp() {
		
		$this->gitlab_storage = new Gitlab_Storage();
		$this->gitlab_sync = new Gitlab_Sync();
		
	}

	public function testUpdate() {
		
		$this->gitlab_storage->set("current",1);
		
		$data = json_encode(array(
			'after'=>2
		));
		
		$ch = curl_init("http://localhost/tests/trigger-update.php");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Leight: ' . strlen($data)
		));
		
		curl_exec($ch);
		
		$this->assertTrue( $this->gitlab_storage->get("last") == '1' );
		$this->assertTrue( $this->gitlab_storage->get("current") == '2' );
		
		$this->gitlab_storage->purge("last");
		$this->gitlab_storage->purge("current");
		
	}
	
	public function testPull() {
		
		$this->gitlab_storage->set("current",1);
		$this->gitlab_storage->set("last",1);
		
		$this->assertTrue( $this->gitlab_sync->pull() == '1' );
		
		$this->gitlab_storage->set("current",2);
		$this->gitlab_storage->set("last",1);
		
		$this->assertTrue( $this->gitlab_sync->pull() == '2' );
		
		$this->gitlab_storage->purge("last");
		$this->gitlab_storage->purge("current");
		
	}


}