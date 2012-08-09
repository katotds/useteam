<?php
class Application_Model_Stadium {
   private $_id,
	        $_stadium;
	public function __construct(){
	}
	public function bluidStadium($stadium){
		$this->setStadium($stadium);
	}
	public function getId(){
	   return $this->_id;
	}
	public function getStadium(){
	   return $this->_stadium;
	}
	public function setId($id)
    {
        $this->_id = (int) $id;
    }
	public function setStadium($stadium){
	   $this->_stadium= (string) $stadium;
	}
}