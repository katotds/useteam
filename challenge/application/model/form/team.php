<?php
class Application_Model_Form_Team extends Zend_Form
{
    public function init()
    {
        /*basic form to seach matches by team*/
    	$this->setMethod('post');
        $this->setAction('search');
        $team = new Application_Model_Mapper_Team();
        $team_list = $team->getTeamList();
        $teams = new Zend_Form_Element_Select('team');
        $teams ->setLabel('Times:');
        //bluid a combo box
        $teams ->addMultiOptions($team_list);
        $this->addElement($teams);
        //bluid a button submit
        $this->addElement('submit','pesquisar');
     }

}
?>