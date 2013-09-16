<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Slider\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\File\Size;

class IndexController extends AbstractActionController
{
    private $form;
    private $validate;
    
    public function __construct(){
    	$this->form = new \Slider\Form\AddSlider("slider");
    	$this->validate = new \Slider\Model\FilterSlider();
    }
    
    public function indexAction()
    {
        
        return new ViewModel();
    }
    
    public function addAction(){
        
        if($this->getRequest()->isPost()){
        	$this->redirect()->toRoute("slider");
        	$post = array_merge_recursive(
        			$this->getRequest()->getPost()->toArray(),
        			$this->getRequest()->getFiles()->toArray()
        	);
        	
        $this->form->setData($post);
        if ($this->form->isValid()) {
        	 
        	$size = new Size(array('min'=>2000000)); //minimum bytes filesize
        	 
        	$adapter = new \Zend\File\Transfer\Adapter\Http();
        	$adapter->setValidators(array($size), $File['image']);
        	if (!$adapter->isValid()){ 
        		$dataError = $adapter->getMessages();
        		$error = array();
        		foreach($dataError as $key=>$row)
        		{
        			$error[] = $row;
        		}
        		$this->form->setMessages(array('fileupload'=>$error ));
        	} else {
        		$adapter->setDestination(dirname(__DIR__).'/assets');
        		if ($adapter->receive($File['image'])) {
        		    die('ss');
        			$this->validate->exchangeArray($this->form->getData());
        			//echo 'Profile Name '.$profile->profilename.' upload '.$profile->fileupload;
        		}
        	}
        }
       
    }
    return new ViewModel(array('form'=>$this->form));
}
}