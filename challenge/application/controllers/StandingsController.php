<?php
class StandingsController extends Zend_Controller_Action
{
    public function indexAction()
    {
       $to = $this->_request->getQuery('to');
       $from = $this->_request->getQuery('from');
       $dateValidator = new Zend_Validate_Date('yyyy-MM-dd');

       if ($to != '' and $from!='') {
       	       if($dateValidator->isValid($to) and $dateValidator->isValid($from)){
                  $match= new Application_Model_Mapper_Match();
                  $match->populateMatchStandingsBetweenDates($to,$from);
                  $team= new Application_Model_Mapper_Team();
                  $teamInformation=$team->fetchAllPoints();
                  $this->view->assign('team', $teamInformation);

                  $body = $this->getRequest()->getRawBody();
                  $data = Zend_Json::decode($body);
                  $this->getResponse()->setHeader('Content-Type', 'text/x-json');
                  $this->getResponse()->setBody($data);
       	       }
       	       else{
       	       	  echo"<h1>Data inválida!</h1>";
       	       }

  	    }
        else{

               $match= new Application_Model_Mapper_Match();
               $match->populateMatchStandings();
               $team= new Application_Model_Mapper_Team();
               $teamInformation=$team->fetchAllPoints();
               $this->view->assign('team', $teamInformation);

               $body = $this->getRequest()->getRawBody();
               $data = Zend_Json::decode($body);
               $this->getResponse()->setHeader('Content-Type', 'text/x-json');
               $this->getResponse()->setBody($data);
        }
    }
}
?>
