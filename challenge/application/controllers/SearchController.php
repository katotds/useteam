<?php
class SearchController extends Zend_Controller_Action
{
	/***************
	 *
	 * Controller of page search
	 *
	 *
	 *
	 */
    public function indexAction()
    {
    	//cath form round of matches
    	$matchForm = new Application_Model_Form_Match();
    	//cath form team of matches
        $teamForm = new Application_Model_Form_Team();
        $match = new Application_Model_Mapper_Match();
        $this->view->form = $teamForm;
        //send a form to view
        $this->view->assign('teamForm', $this->view->form);
        $this->view->form = $matchForm;
        //send a form to view
        $this->view->assign('matchForm', $this->view->form);
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
        	//if search by team
        	$id = $this->_request->getPost('team');
        	if ($id != '' ) {
                $teamInformation= new Application_Model_Mapper_Team();
               $row=$teamInformation->seachTeamById($id);
               $this->view->assign('teamName', $row["team"]);
               //cath seach matches by team
               $matchInformation = $match->seachMatchByTeam($id);
               $this->view->assign('match', $matchInformation);
		    }
		    $round = $this->_request->getPost('match');
		    //if search by round
        	if ($round!= '' ) {
               $matchInformation= new Application_Model_Mapper_Match();
               $this->view->assign('roundName', $round);
               //cath seach matches by round
               $matchInformation = $match->seachMatchByRound($round);
               $this->view->assign('match', $matchInformation);
		    }
        }
    }
}
?>