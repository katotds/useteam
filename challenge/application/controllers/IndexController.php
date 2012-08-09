<?php
class IndexController extends Zend_Controller_Action
{
	function init()
	{
		$this->initView();
	}
	function indexAction()
	{
		//build a title
		$this->view->title = "useInternational programming challenge";
		$this->view->baseUrl = $this->_request->getBaseUrl();
		//show the title
		$this->render();
	}
}