<?php
class SearchController extends Zend_Controller_Action
{
    public function indexAction()
    {
    	$matchForm = new Application_Model_Form_Match();
        $teamForm = new Application_Model_Form_Team();
        $match = new Application_Model_Mapper_Match();
        $teste = new Zend_Form_SubForm();
        $this->view->form = $teamForm;
        $this->view->assign('teamForm', $this->view->form);
        $this->view->form = $matchForm;
        $this->view->assign('matchForm', $this->view->form);
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
        	$id = $this->_request->getPost('team');
        	if ($id != '' ) {
                $teamInformation= new Application_Model_Mapper_Team();
               $row=$teamInformation->seachTeamById($id);
               $this->view->assign('teamName', $row["team"]);
               $matchInformation = $match->seachMatchByTeam($id);
               $this->view->assign('match', $matchInformation);
		    }
		    $round = $this->_request->getPost('match');
        	if ($round!= '' ) {
               $matchInformation= new Application_Model_Mapper_Match();
               $this->view->assign('roundName', $round);
               $matchInformation = $match->seachMatchByRound($round);
               $this->view->assign('match', $matchInformation);
		    }
        }
    }
}
?>