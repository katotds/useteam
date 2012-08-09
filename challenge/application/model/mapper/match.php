<?php
class Application_Model_Mapper_Match
{
	/*****************************/
	/*
	 *
	 * Class to work with match informaions in the data table
	 *
	 *
	 */
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    //function to work a table match
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
        	//set to a table match
            $this->setDbTable('Application_Model_DbTable_Match');
        }
        return $this->_dbTable;
    }
    //function to insert a math in to a data table
    public function addMatch($match)
	{
		$data = array('idHomeTeam' => $match->getIdHomeTeam(),
		              'idVisitorTeam' => $match->getIdVisitorTeam(),
		              'goalHomeTeam'=> $match->getGoalHomeTeam(),
		              'goalVisitorTeam'=> $match->getGoalVisitorTeam(),
		              'round'=>$match->getRound(),
		              'date'=>$match->getDates());
	    $this->getDbTable()->insert($data);
	}
	//function to delete a math
	public function deleteMatch(){
		$this->getDbTable()->delete("");
	}
	//function to search matches by team id
	public function seachMatchByTeam($idTeam){
		       $query = $this->getDbTable()->select()
		               ->from(array('b' => 'tbteam'),array('home'=>'b.team'))
                       ->joinInner(array('a' => 'tbmatch'),'a.idHomeTeam=b.id',array('a.id','a.goalHomeTeam','a.goalVisitorTeam','a.date','a.round','a.idHomeTeam','a.idVisitorTeam'))
                       ->joinInner(array('c' => 'tbteam'),'c.id=a.idVisitorTeam',array('visitor'=>'c.team'))
                       ->where("b.id =". $idTeam ." or c.id =". $idTeam )
                       ->order('a.round')
                       ->setIntegrityCheck(false);
       return $this->getDbTable()->fetchAll($query);
	}
	//function to search matches of team by dates
    public function seachMatchByTeamBetweenDates($idTeam,$beginDate,$endDate){
		       $query = $this->getDbTable()->select()
		               ->from(array('b' => 'tbteam'),array('home'=>'b.team'))
                       ->joinInner(array('a' => 'tbmatch'),'a.idHomeTeam=b.id',array('a.id','a.goalHomeTeam','a.goalVisitorTeam','a.date','a.round','a.idHomeTeam','a.idVisitorTeam'))
                       ->joinInner(array('c' => 'tbteam'),'c.id=a.idVisitorTeam',array('visitor'=>'c.team'))
                       ->where("b.id =". $idTeam ." or c.id =". $idTeam." and date BETWEEN ".$beginDate." AND ".$endDate)
                       ->order('a.round')
                       ->setIntegrityCheck(false);
       return $this->getDbTable()->fetchAll($query);
	}
	//function to search matches of team by round
	public function seachMatchByRound($round){
		       $query = $this->getDbTable()->select()
		               ->from(array('b' => 'tbteam'),array('home'=>'b.team'))
                       ->joinInner(array('a' => 'tbmatch'),'a.idHomeTeam=b.id',array('a.id','a.goalHomeTeam','a.goalVisitorTeam','a.date','a.round'))
                       ->joinInner(array('c' => 'tbteam'),'c.id=a.idVisitorTeam',array('visitor'=>'c.team'))
                       ->where("a.round =". $round)
                       ->order('a.round')
                       ->setIntegrityCheck(false);
                return $this->getDbTable()->fetchAll($query);
	}
	//function to bring all matches
	public function seachMatchAll(){
		       $query = $this->getDbTable()->select()
		               ->from(array('b' => 'tbteam'),array('home'=>'b.team'))
                       ->joinInner(array('a' => 'tbmatch'),'a.idHomeTeam=b.id',array('a.id','a.goalHomeTeam','a.goalVisitorTeam','a.date','a.round'))
                       ->joinInner(array('c' => 'tbteam'),'c.id=a.idVisitorTeam',array('visitor'=>'c.team'))
                       ->order('a.round')
                       ->setIntegrityCheck(false);
               return $this->getDbTable()->fetchAll($query);
	}
	//function to populate combo box round
	public function getRoundList(){
       $query = $this->getDbTable()->select()
                       ->from('tbmatch', array('distinct (round)'))
                       ->order('round');
        $resultSet = $this->getDbTable()->fetchAll($query);
        $entries   = array();
        foreach ($resultSet as $row) {
        	//build a combo box with round
            $entries[$row->round]=$row->round;
        }
        return $entries;
	}
	//function do populate a table of team with standings
	public function populateMatchStandings(){
		   $team = new Application_Model_Mapper_Team();
		   //cath all teams
		   $teamList=$team->fetchAll();
		   $prosGoal= null;
		   $agaistGoal=null;
		   if(count($teamList)>0){
		   	   foreach($teamList as $row){
		   	   	   //begin team statistics by 0
		   	   	   $row->setWins(0);
		   	   	   $row->setLosses(0);
		   	   	   $row->setPoints(0);
		   	   	   $row->setDraws(0);
		   	   	   //catch all matches by team
		           $championship = $this->seachMatchByTeam($row->getId());
		           foreach ($championship as $match) {
		             //if a team is a visitor team goals of visitor team it is
		           	  $prosGoal=$match['goalVisitorTeam'];
		           	  $agaistGoal=$match['goalHomeTeam'];
		           	  //if a team is a home team goals of home team it is
		           	  if($match['idHomeTeam']==$row->getId()){
		           	  	 $prosGoal=$match['goalHomeTeam'];
		           	  	 $agaistGoal=$match['goalVisitorTeam'];
		           	  }
		           	  //if team win
		           	  if($agaistGoal<$prosGoal){
		           	  	$row->setWins($row->getWins()+1);
		           	  	$row->setPoints($row->getPoints()+3);
		           	  }//if team lost
		           	  elseif($agaistGoal>$prosGoal){
		           	  	$row->setLosses($row->getLosses()+1);
		           	  }//if team draw
		           	  else{
		           	  	$row->setDraws($row->getDraws()+1);
		           	  	$row->setPoints($row->getPoints()+1);
		           	  }
		           }
		           //update table team
		           $team->updateTeam($row);
		   	   }
		   }
	}
    //function do populate a table of team with standings by dates
	public function populateMatchStandingsBetweenDates($to,$from){
		   $team = new Application_Model_Mapper_Team();
		    //cath all teams
		   $teamList=$team->fetchAll();
		   $prosGoal= null;
		   $agaistGoal=null;
		   if(count($teamList)>0){
		   	   foreach($teamList as $row){
		   	   	   //begin team statistics by 0
		   	   	   $row->setWins(0);
		   	   	   $row->setLosses(0);
		   	   	   $row->setPoints(0);
		   	   	   $row->setDraws(0);
		   	   	   //catch all matches by team
		           $championship = $this->seachMatchByTeamBetweenDates($row->getId(),$to,$from);
		           foreach ($championship as $match) {
		           	  //if a team is a visitor team goals of visitor team it is
		           	  $prosGoal=$match['goalVisitorTeam'];
		           	  $agaistGoal=$match['goalHomeTeam'];
		           	  //if a team is a home team goals of home team it is
		           	  if($match['idHomeTeam']==$row->getId()){
		           	  	 $prosGoal=$match['goalHomeTeam'];
		           	  	 $agaistGoal=$match['goalVisitorTeam'];
		           	  }
		           	   //if team win
		           	  if($agaistGoal<$prosGoal){
		           	  	$row->setWins($row->getWins()+1);
		           	  	$row->setPoints($row->getPoints()+3);
		           	  }//if team lost
		           	  elseif($agaistGoal>$prosGoal){
		           	  	$row->setLosses($row->getLosses()+1);
		           	  }//if team draw
		           	  else{
		           	  	$row->setDraws($row->getDraws()+1);
		           	  	$row->setPoints($row->getPoints()+1);
		           	  }
		           }
		           //update table team
		           $team->updateTeam($row);
		   	   }
		   }
	}
}

