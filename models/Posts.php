<?php

	require_once("Model.php");

class Posts extends Model
{

	protected $error;

	function __construct()
	{
		parent::__construct();
	}

	public function getAllPosts(){

    	$this->res = $this->connect->prepare("SELECT * FROM posts"); 
  		$this->res->execute();
   		$this->res = $this->res->fetchAll();
      	return $this->res;
	}

	private function Validate($title, $message){

		$error_words = ['лес','wood','иерархия', 'маргарин', '<i>', '<section>'];

		$title = strtolower(trim($title));
		$message = strtolower(trim($message));

		$title = explode(" ", $title);
		$message = explode(" ", $message);

		$titleError = array_intersect($title, $error_words);
		$messageError = array_intersect($message, $error_words);

		foreach ($title as $elem) {
			$Urls =  preg_match('/^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/',$elem);
		}
		foreach ($message as $elem) {
			$Urls =  preg_match('/^(https?:\/\/)?([\w\.]+)\.([a-z]{2,6}\.?)(\/[\w\.]*)*\/?$/',$elem);
		}

		if(isset($Urls)){
			$this->error = [0 => "Не можно постить ссылки"];
			return false;
		}


		if($titleError){
			$this->error = $titleError;
			return false;
		}
		elseif($messageError){
			$this->error = $messageError;
			return false;
		}
		else{
			return true;
		}

	}

	public function addPost($title,$message){	

		if($this->Validate($title, $message)){
			$this->res = $this->connect->prepare("INSERT INTO `posts` (`id`, `title`, `text`) VALUES (NULL, '$title', '$message')");
			$this->res->execute();
		}

		else{
				foreach ($this->error as $error) {

				echo "<p class='text-danger'>Недопустмое значение - ".htmlspecialchars($error)."</p>";
				} 
		}

	}
}