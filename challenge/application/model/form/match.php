<?php
class Application_Model_Form_Match extends Zend_Form
{
    public function init()
    {
    	$this->setMethod('post');
        $this->setAction('search');
        $match = new Application_Model_Mapper_Match();
        $match_list = $match->getRoundList();
        $matchs = new Zend_Form_Element_Select('match');
        $matchs ->setLabel('Rodadas:');
        $matchs ->addMultiOptions($match_list);
        $this->addElement($matchs);
        $this->addElement('submit','pesquisar');
     }

}
?>