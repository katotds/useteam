<?php

class CommandController extends Zend_Controller_Action
{
	/********************
	 *
	 *
	 * Controller that fill matches informations
	 *
	 *
	 *
	 *
	 */
   function indexAction()
   {
        Zend_Loader::loadClass('Zend_Http_Client');
        $db=new Application_Model_Mapper_Match();
        //clean table match
        $db->deleteMatch();
        //loop  to cath championship rounds
        for($f=1;$f<=14;$f++){
	    try {
            //brings the information of all matches
	        $http = new Zend_Http_Client('http://esporte.uol.com.br/futebol/campeonatos/brasileiro/2012/serie-a/tabela-de-jogos/tabela-de-jogos-'.$f.'a-rodada.htm');
	        $response = $http->request();
	        //if it can bring
	        if ($response->isSuccessful()) {
	        	$file=fopen("text.txt","w");
	        	//cath all informations and safe in file
	        	fwrite($file,stripcslashes($response->getBody()));
	            fclose($file);
	        	unset($file);
	        	//other file to filter informations
	        	$results=fopen("tabela.txt","w");
	        	$file=file("text.txt");
	            $read=0;
	            //loop to cacth only math results
	            for($i=0;$i<count($file);$i++){
	            	$linha=trim($file[$i]);
	            	//begin of math results
	            	if($linha=='<div class="tabelajogo">'){
	            		$read=1;//flag to begin table results
	            	}//end of match results
	            	if($linha=='<!-- :::: -->'){
	            		  break;//stop loop when find end of table results
	            	}//strip html tags and save in file
	            	if($read==1 and strip_tags($linha)!=''){
	            		fwrite($results,strip_tags($linha)."\r\n");
	            	}
	             }
	             //close file
	             fclose($results);
	             //erase variant
	        	 unset($file);
	        	 //read the file of match informations
	        	 $file=file("tabela.txt");
	        	 $match= new Application_Model_Match();
	        	 $team = new Application_Model_Mapper_Team();
	        	 $separate = explode("ª",$file[0]);
	        	 //cath a round information
	        	 $round = $separate[0];
	        	 unset($separate);
	             for($i=0;$i<count($file);$i++){
	             	 $linha=trim($file[$i]);
		             if(preg_match("(.*ª RODADA -.*)", $linha)){
		             	       $separate = explode("-",$linha);
		             	       //cath date of match
		             	       $dates=$separate[1];
		             	       unset($separate);
		             	       $separate = explode("/",$dates);
		             	       //transform to date standart
		             	       $dates=$separate[2]."-".trim($separate[1])."-".trim($separate[0]);
		             	       unset($separate);
		            		   $stadium = new  Application_Model_Stadium();
		            		   //cath hour of match
		                       $hour =   $file[$i+2];
		                       //catch home team
		                       $teamHome = preg_replace("/\r\n/", "",$file[$i+3]);
		                       //catch score
		            	       $score = $file[$i+4];
		            	       //separate score teams
		            	       $separate=explode("x",$score);
		            	       //catch visitor team
		            	       $teamVisitor = preg_replace("/\r\n/", "",$file[$i+5]);
		            	       $stadium->bluidStadium($file[$i+6]);
		            	       $place = $file[$i+7];
		            	       //cath place of match
		            	       unset($stadium);
		            	       $i+=7;
                               $idHomeTeam='';
                               //cath a id home team
	                           $row=$team->seachTeam($teamHome);
	                           if($row['team']!=''){
  	                              $idHomeTeam=$row['id'];
	                           }
	                           $idVisitorTeam='';
	                           //catch a id visitor team
	                           $row=$team->seachTeam($teamVisitor);
	                           if($row['team']!=''){
  	                              $idVisitorTeam=$row['id'];
	                           }
	                           if($idHomeTeam!='' and $idVisitorTeam!=''){
	                           	  //build a math object
	                           	  $match->buildMatch($idHomeTeam,$idVisitorTeam,$separate[0],$separate[1],$round,$dates);
	                           	  //save a match
	                           	  $db->addMatch($match);
	                           }
		            	    }
		            	    else{
		            	       $stadium = new  Application_Model_Stadium();
		            	       //cath hour of match
		                       $hour =   $file[$i];
		                       //cath home team
	                           $teamHome = preg_replace("/\r\n/", "",$file[$i+1]);
	                           //cath a score
		            	       $score = $file[$i+2];
		            	        //separate score teams
		            	       $separate=explode("x",$score);
		            	       //catch visitor team
		            	       $teamVisitor = preg_replace("/\r\n/", "",$file[$i+3]);
		            	       $stadium->bluidStadium($file[$i+4]);
		            	       //cath place of match
		            	       $place = $file[$i+5];
		            	       unset($stadium);
		            	       $i+=5;
                               $idHomeTeam='';
                                  $idHomeTeam='';
                               //cath a id home team
	                           $row=$team->seachTeam($teamHome);
	                           if($row['team']!=''){
  	                              $idHomeTeam=$row['id'];
	                           }
	                           $idVisitorTeam='';
	                           //cath a id visitor team
	                           $row=$team->seachTeam($teamVisitor);
	                           if($row['team']!=''){
  	                              $idVisitorTeam=$row['id'];
	                           }
	                           if($idHomeTeam!='' and $idVisitorTeam!=''){
	                              //build a math object
	                           	  $match->buildMatch($idHomeTeam,$idVisitorTeam,$separate[0],$separate[1],$round,$dates);
	                           	  //save a match
	                           	  $db->addMatch($match);
	                           }
	            	    }
	             }
	        } else {
	            echo '<p>An error occurred</p>';
	        }
	    } catch (Zend_Http_Client_Exception $e) {
	        echo '<p>An error occurred (' .$e->getMessage(). ')</p>';
	    }
        }
    }
}