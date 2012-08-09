<?php
class Application_Model_Mapper_Stadium
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
            $this->setDbTable('Application_Model_DbTable_Stadium');
        }
        return $this->_dbTable;
    }

    public function addAlbum($stadium)
	{
		$data = array('stadium' => $stadium);
	    $this->getDbTable()->insert($data);
	}
	public function seachStadium($stadium){
	   $table = new Application_Model_DbTable_Stadium();
       $query = $table->select()
                       ->from('stadium')
                       ->where('stadium = ?', $stadium);
       $row = $table->fetchRow($query);
       return $row;
	}
}
?>