<?php
class Application_Model_Form_Match extends Zend_Form
{
    public function init()
    {
        /*basic form to search matches by round */
    	$this->setMethod('post');
        $this->setAction('search');
        $match = new Application_Model_Mapper_Match();
        $match_list = $match->getRoundList();
        $matchs = new Zend_Form_Element_Select('match');
        $matchs ->setLabel('Rodadas:');
        //bluid a combo box
        $matchs ->addMultiOptions($match_list);
        $this->addElement($matchs);
        //bluid a button submit
        $this->addElement('submit','pesquisar');
     }

}
?>