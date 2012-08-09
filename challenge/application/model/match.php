<?php
class Application_Model_Match {
   private $_id,
	        $_idHomeTeam,
	        $_idVisitorTeam,
	        $_goalHomeTeam,
	        $_goalVisitorTeam,
	        $_round,
	        $_date;

	public function __construct(){
	}
    public function buildMatch($idHomeTeam,$idVisitorTeam,$goalHomeTeam,$goalVisitorTeam,$round,$date){
        $this->setIdHomeTeam($idHomeTeam);
        $this->setIdVisitorTeam($idVisitorTeam);
        $this->setGoalHomeTeam($goalHomeTeam);
        $this->setGoalVisitorTeam($goalVisitorTeam);
        $this->setRound($round);
        $this->setDate($date);
    }
	public function getId(){
	   return $this->_id;
	}
	public function getIdHomeTeam(){
	   return $this->_idHomeTeam;
	}
	public function getIdVisitorTeam(){
	   return $this->_idVisitorTeam;
	}
	public function getGoalHomeTeam(){
	   return $this->_goalHomeTeam;
	}
	public function getGoalVisitorTeam(){
	   return $this->_goalVisitorTeam;
	}
    public function getRound(){
	   return $this->_round;
	}
    public function getDates(){
	   return $this->_date;
	}
	public function setId($id)
    {
        $this->_id = (int) $id;
    }
	public function setIdHomeTeam($idHomeTeam)
    {
        $this->_idHomeTeam = (int) $idHomeTeam;
    }
 	public function setIdVisitorTeam($idVisitorTeam)
    {
        $this->_idVisitorTeam = (int) $idVisitorTeam;
    }
	public function setGoalHomeTeam($goalHomeTeam)
    {
        $this->_goalHomeTeam = (int) $goalHomeTeam;
    }
 	public function setGoalVisitorTeam($goalVisitorTeam)
    {
        $this->_goalVisitorTeam = (int) $goalVisitorTeam;
    }
    public function setRound($round){
    	$this->_round = (int) $round;
    }
    public function setDate($date){
    	$this->_date = (string) $date;
    }
    public function formateDate($date)
    {
       $separate = explode("-",$date);
       $date = $separate[2]."/".$separate[1]."/".$separate[0];
       return $date;
    }
}
?>
