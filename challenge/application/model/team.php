<?php
class Application_Model_Team {
   private $_id,
	        $_team,
	        $_points,
	        $_losses,
	        $_wins,
	        $_drams;

	public function __construct(){
	}
	public function getId(){
	   return $this->_id;
	}
	public function getTeam(){
	   return $this->_team;
	}
	public function getPoints(){
	   return $this->_points;
	}
	public function getLosses(){
	   return $this->_losses;
	}
	public function getWins(){
	   return $this->_wins;
	}
	public function getDraws(){
	   return $this->_draws;
	}
	public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function setTeam($team)
    {
        $this->_team = (string) $team;
        return $this;
    }
    public function setPoints($points)
    {
        $this->_points = (int) $points;
        return $this;
    }
    public function setLosses($losses)
    {
        $this->_losses = (int) $losses;
        return $this;
    }
    public function setWins($wins)
    {
        $this->_wins = (int) $wins;
        return $this;
    }
    public function setDraws($draws)
    {
        $this->_draws = (int) $draws;
        return $this;
    }
}