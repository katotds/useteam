<?php
class Application_Model_Mapper_Match
{
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

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Match');
        }
        return $this->_dbTable;
    }

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
	public function deleteMatch(){
		$this->getDbTable()->delete();
	}
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
	public function seachMatchAll(){
		       $query = $this->getDbTable()->select()
		               ->from(array('b' => 'tbteam'),array('home'=>'b.team'))
                       ->joinInner(array('a' => 'tbmatch'),'a.idHomeTeam=b.id',array('a.id','a.goalHomeTeam','a.goalVisitorTeam','a.date','a.round'))
                       ->joinInner(array('c' => 'tbteam'),'c.id=a.idVisitorTeam',array('visitor'=>'c.team'))
                       ->order('a.round')
                       ->setIntegrityCheck(false);
               return $this->getDbTable()->fetchAll($query);
	}
	public function getRoundList(){
       $query = $this->getDbTable()->select()
                       ->from('tbmatch', array('distinct (round)'))
                       ->order('round');
        $resultSet = $this->getDbTable()->fetchAll($query);
        $entries   = array();
        foreach ($resultSet as $row) {
            $entries[$row->round]=$row->round;
        }
        return $entries;
	}
	public function populateMatchStandings(){
		   $team = new Application_Model_Mapper_Team();
		   $teamList=$team->fetchAll();
		   $prosGoal= null;
		   $agaistGoal=null;
		   if(count($teamList)>0){
		   	   foreach($teamList as $row){
		   	   	   $row->setWins(0);
		   	   	   $row->setLosses(0);
		   	   	   $row->setPoints(0);
		   	   	   $row->setDraws(0);
		           $championship = $this->seachMatchByTeam($row->getId());
		           foreach ($championship as $match) {
		           	  $prosGoal=$match['goalVisitorTeam'];
		           	  $agaistGoal=$match['goalHomeTeam'];
		           	  if($match['idHomeTeam']==$row->getId()){
		           	  	 $prosGoal=$match['goalHomeTeam'];
		           	  	 $agaistGoal=$match['goalVisitorTeam'];
		           	  }
		           	  if($agaistGoal<$prosGoal){
		           	  	$row->setWins($row->getWins()+1);
		           	  	$row->setPoints($row->getPoints()+3);
		           	  }
		           	  elseif($agaistGoal>$prosGoal){
		           	  	$row->setLosses($row->getLosses()+1);
		           	  }
		           	  else{
		           	  	$row->setDraws($row->getDraws()+1);
		           	  	$row->setPoints($row->getPoints()+1);
		           	  }
		           }
		           $team->updateTeam($row);
		   	   }
		   }
	}
	public function populateMatchStandingsBetweenDates($to,$from){
		   $team = new Application_Model_Mapper_Team();
		   $teamList=$team->fetchAll();
		   $prosGoal= null;
		   $agaistGoal=null;
		   if(count($teamList)>0){
		   	   foreach($teamList as $row){
		   	   	   $row->setWins(0);
		   	   	   $row->setLosses(0);
		   	   	   $row->setPoints(0);
		   	   	   $row->setDraws(0);
		           $championship = $this->seachMatchByTeamBetweenDates($row->getId(),$to,$from);
		           foreach ($championship as $match) {
		           	  $prosGoal=$match['goalVisitorTeam'];
		           	  $agaistGoal=$match['goalHomeTeam'];
		           	  if($match['idHomeTeam']==$row->getId()){
		           	  	 $prosGoal=$match['goalHomeTeam'];
		           	  	 $agaistGoal=$match['goalVisitorTeam'];
		           	  }
		           	  if($agaistGoal<$prosGoal){
		           	  	$row->setWins($row->getWins()+1);
		           	  	$row->setPoints($row->getPoints()+3);
		           	  }
		           	  elseif($agaistGoal>$prosGoal){
		           	  	$row->setLosses($row->getLosses()+1);
		           	  }
		           	  else{
		           	  	$row->setDraws($row->getDraws()+1);
		           	  	$row->setPoints($row->getPoints()+1);
		           	  }
		           }
		           $team->updateTeam($row);
		   	   }
		   }
	}
}
