<?php
class Application_Model_Form_Team extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
        $this->setAction('search');
        $team = new Application_Model_Mapper_Team();
        $team_list = $team->getTeamList();
        $teams = new Zend_Form_Element_Select('team');
        $teams ->setLabel('Times:');
        $teams ->addMultiOptions($team_list);
        $this->addElement($teams);
        $this->addElement('submit','pesquisar');
     }

}
?>