<?php
class Application_Model_Mapper_Team
{
	/*******************************/
	/*
	 * Class to work with team informaions in the data table
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
	//function to work a table team
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
        	//set to table team
            $this->setDbTable('Application_Model_DbTable_Team');
        }
        return $this->_dbTable;
    }
    //function to catch all teams
    public function fetchAll()
    {
    	//catch all team order by team
        $resultSet = $this->getDbTable()->fetchAll(null,"team asc");
        $entries   = array();
        foreach ($resultSet as $row) {
        	//buid a object team
            $entry = new Application_Model_Team();
            $entry->setId($row->id)
                  ->setTeam($row->team)
                  ->setPoints($row->points)
                  ->setLosses($row->losses)
                  ->setWins($row->wins)
                  ->setDraws($row->draws);
            $entries[] = $entry;
        }
        return $entries;
    }
    //function all teams by points
    public function fetchAllPoints()
    {
    	//catch all teams order by decreasing points
        $resultSet = $this->getDbTable()->fetchAll(null,"points desc");
        $entries   = array();
        foreach ($resultSet as $row) {
        	//build a object team
            $entry = new Application_Model_Team();
            $entry->setId($row->id)
                  ->setTeam($row->team)
                  ->setPoints($row->points)
                  ->setLosses($row->losses)
                  ->setWins($row->wins)
                  ->setDraws($row->draws);
            $entries[] = $entry;
        }
        return $entries;
    }
    //function to build a combo box team
    public function getTeamList()
    {
    	$view = new Zend_View();
    	//catch all teams
        $resultSet = $this->getDbTable()->fetchAll(null,"team asc");
        $entries   = array();
        foreach ($resultSet as $row) {
            //build a combo box id and team
            $entries[$row->id]=utf8_encode($row->team);
        }
        return $entries;
    }
    //function to insert team
    public function addTeam($team)
	{
		//insert a team
		$data = array('team' => $team);
	    $this->getDbTable()->insert($data);
	}
	//function to search all teams by a name of team
	public function seachTeam($team){
       $query = $this->getDbTable()->select()
                       ->from('tbteam', array('id', 'team'))
                       ->where('team =?', html_entity_decode($team));
       $row = $this->getDbTable()->fetchRow($query);
       return $row;
	}
	//function to search all team by id
    public function seachTeamById($id){
       $query = $this->getDbTable()->select()
                       ->from('tbteam', array('id', 'team'))
                       ->where('id =?', $id);
       $row = $this->getDbTable()->fetchRow($query);
       return $row;
	}
	//function to update a team information
	public function  updateTeam($team )
    {
    	//update wins,points,draws and losses
         $data  = array(
            'wins' =>  $team->getWins(),
            'points'  =>  $team->getPoints(),
            'draws'  =>  $team->getDraws(),
            'losses'  =>  $team->getLosses()
        );
         $this->getDbTable()->update($data, 'id = '. (int)$team->getId());
    }

}

