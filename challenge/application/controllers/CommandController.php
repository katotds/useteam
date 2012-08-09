<?php

class CommandController extends Zend_Controller_Action
{
   function indexAction()
   {
        Zend_Loader::loadClass('Zend_Http_Client');
        $db=new Application_Model_Mapper_Match();
        $db->deleteMatch();
        for($f=1;$f<=14;$f++){
	    try {
	    	echo "<h1>Rodada $f</h1>";
	    	$albums = new Application_Model_Mapper_Command();
	    	$stadium = new  Application_Model_Stadium();
	        $http = new Zend_Http_Client('http://esporte.uol.com.br/futebol/campeonatos/brasileiro/2012/serie-a/tabela-de-jogos/tabela-de-jogos-'.$f.'a-rodada.htm');
	        $response = $http->request();
	        if ($response->isSuccessful()) {
	        	$file=fopen("text.txt","w");
	        	fwrite($file,stripcslashes($response->getBody()));
	            fclose($file);
	        	unset($file);
	        	$results=fopen("tabela.txt","w");
	        	$file=file("text.txt");
	            // print $response->getBody();
	            $read=0;
	            for($i=0;$i<count($file);$i++){
	            	$linha=trim($file[$i]);
	            	if($linha=='<div class="tabelajogo">'){
	            		$read=1;
	            	}
	            	if($linha=='<!-- :::: -->'){
	            		  break;
	            	}
	            	if($read==1 and strip_tags($linha)!=''){
	            		fwrite($results,strip_tags($linha)."\r\n");
	            	}
	             }
	             fclose($results);
	        	 unset($file);
	        	 $file=file("tabela.txt");
	        	 $match= new Application_Model_Match();
	        	 $team = new Application_Model_Mapper_Team();
	        	 $separate = explode("ª",$file[0]);
	        	 $round = $separate[0];
	        	 unset($separate);
	             for($i=0;$i<count($file);$i++){
	             	 $linha=trim($file[$i]);
		             if(preg_match("(.*ª RODADA -.*)", $linha)){
		             	       $separate = explode("-",$linha);
		             	       $dates=$separate[1];
		             	       unset($separate);
		             	       $separate = explode("/",$dates);
		             	       $dates=$separate[2]."-".trim($separate[1])."-".trim($separate[0]);
		             	       unset($separate);
		            		   $stadium = new  Application_Model_Stadium();
		                       $hour =   $file[$i+2];
		                       $teamHome = preg_replace("/\r\n/", "",$file[$i+3]);
		            	       $score = $file[$i+4];
		            	       $separate=explode("x",$score);
		            	       $teamVisitor = preg_replace("/\r\n/", "",$file[$i+5]);
		            	       $stadium->bluidStadium($file[$i+6]);
		            	       $place = $file[$i+7];
		            	       unset($stadium);
		            	       $i+=7;
                               $idHomeTeam='';
	                           $row=$team->seachTeam($teamHome);
	                           if($row['team']!=''){
  	                              $idHomeTeam=$row['id'];
	                           }
	                           $idVisitorTeam='';
	                           $row=$team->seachTeam($teamVisitor);
	                           if($row['team']!=''){
  	                              $idVisitorTeam=$row['id'];
	                           }
	                           if($idHomeTeam!='' and $idVisitorTeam!=''){
	                           	  $match->buildMatch($idHomeTeam,$idVisitorTeam,$separate[0],$separate[1],$round,$dates);
	                           	  $db->addMatch($match);
	                           }
		            	    }
		            	    else{
		            	       $stadium = new  Application_Model_Stadium();
		                       $hour =   $file[$i];
	                           $teamHome = preg_replace("/\r\n/", "",$file[$i+1]);
		            	       $score = $file[$i+2];
		            	       $separate=explode("x",$score);
		            	       $teamVisitor = preg_replace("/\r\n/", "",$file[$i+3]);
		            	       $stadium->bluidStadium($file[$i+4]);
		            	       $place = $file[$i+5];
		            	       unset($stadium);
		            	       $i+=5;
                               $idHomeTeam='';
                                  $idHomeTeam='';
	                           $row=$team->seachTeam($teamHome);
	                           if($row['team']!=''){
  	                              $idHomeTeam=$row['id'];
	                           }
	                           $idVisitorTeam='';
	                           $row=$team->seachTeam($teamVisitor);
	                           if($row['team']!=''){
  	                              $idVisitorTeam=$row['id'];
	                           }
	                           if($idHomeTeam!='' and $idVisitorTeam!=''){
	                           	  $match->buildMatch($idHomeTeam,$idVisitorTeam,$separate[0],$separate[1],$round,$dates);
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