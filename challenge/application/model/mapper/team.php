<?php
class Application_Model_Mapper_Team
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
            $this->setDbTable('Application_Model_DbTable_Team');
        }
        return $this->_dbTable;
    }
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll(null,"team asc");
        $entries   = array();
        foreach ($resultSet as $row) {
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
    public function fetchAllPoints()
    {
        $resultSet = $this->getDbTable()->fetchAll(null,"points desc");
        $entries   = array();
        foreach ($resultSet as $row) {
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
    public function getTeamList()
    {
    	$view = new Zend_View();
        $resultSet = $this->getDbTable()->fetchAll(null,"team asc");
        $entries   = array();
        foreach ($resultSet as $row) {
            $entries[$row->id]=utf8_encode($row->team);
        }
        return $entries;
    }
    public function addTeam($team)
	{
		$data = array('team' => $team);
	    $this->getDbTable()->insert($data);
	}
	public function seachTeam($team){
       $query = $this->getDbTable()->select()
                       ->from('tbteam', array('id', 'team'))
                       ->where('team =?', html_entity_decode($team));
       $row = $this->getDbTable()->fetchRow($query);
       return $row;
	}
    public function seachTeamById($id){
       $query = $this->getDbTable()->select()
                       ->from('tbteam', array('id', 'team'))
                       ->where('id =?', $id);
       $row = $this->getDbTable()->fetchRow($query);
       return $row;
	}
	public function  updateTeam($team )
    {
         $data  = array(
            'wins' =>  $team->getWins(),
            'points'  =>  $team->getPoints(),
            'draws'  =>  $team->getDraws(),
            'losses'  =>  $team->getLosses()
        );
         $this->getDbTable()->update($data, 'id = '. (int)$team->getId());
    }

}
