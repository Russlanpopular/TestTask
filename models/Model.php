<?php

abstract Class Model 
{

	protected $host = 'localhost';
	protected $dbname = 'posts';
	protected $user = 'root';
	protected $pass = '';
	public  $connect = null;
	public  $res;
	


	public function __construct(){

	try {
			$this->connect = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
			$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connect->exec("set names utf8");
	    }

	catch(PDOException $e){

	    	echo "Connection failed: " . $e->getMessage();
	    }
	}

     function __destruct() {
        $this->connect = null;
     }


}