<?php
class StandingsController extends Zend_Controller_Action
{
    /**********************
	 *
	 *
	 * Controller that fill standings of team
	 *
	 *
	 *
	 */
    public function indexAction()
    {
       $to = $this->_request->getQuery('to');
       $from = $this->_request->getQuery('from');
       //build validator of date
       $dateValidator = new Zend_Validate_Date('yyyy-MM-dd');
       //if two dates aren´t empty
       if ($to != '' and $from!='') {
       	       if($dateValidator->isValid($to) and $dateValidator->isValid($from)){
                  $match= new Application_Model_Mapper_Match();
                  //insert into table team information of win,lost,draw and point
                  $match->populateMatchStandingsBetweenDates($to,$from);
                  $team= new Application_Model_Mapper_Team();
                  //cath all teams order by point
                  $teamInformation=$team->fetchAllPoints();
                  $this->view->assign('team', $teamInformation);
                  //transform to json
                  $body = $this->getRequest()->getRawBody();
                  $data = Zend_Json::decode($body);
                  $this->getResponse()->setHeader('Content-Type', 'text/x-json');
                  $this->getResponse()->setBody($data);
       	       }
       	       else{
       	       	//if not true data
       	       	  echo"<h1>Data inválida!</h1>";
       	       }

  	    }
        else{

               $match= new Application_Model_Mapper_Match();
               //insert into table team information of win,lost,draw and point
               $match->populateMatchStandings();
               $team= new Application_Model_Mapper_Team();
               //cath all teams order by point
               $teamInformation=$team->fetchAllPoints();
               $this->view->assign('team', $teamInformation);
               //transform to json
               $body = $this->getRequest()->getRawBody();
               $data = Zend_Json::decode($body);
               $this->getResponse()->setHeader('Content-Type', 'text/x-json');
               $this->getResponse()->setBody($data);
        }
    }
}
?>

