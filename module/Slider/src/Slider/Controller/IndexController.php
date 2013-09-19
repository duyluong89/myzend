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
        $data = $this->getModelResource()->getData(null,'slider', null, null,null,"order");   
        return new ViewModel(array('data'=>$data));
    }
    
    public function addAction(){
        if($this->getRequest()->isPost()){
        	//$this->redirect()->toRoute("slider");
            $this->form->setInputFilter($this->validate->getInputFilter());
            $this->form->setData($this->getRequest()->getPost());
            if ($this->form->isValid()) {
                $files = $this->params()->fromFiles('image');
            	$size = new Size(array('max'=>2000000)); //minimum bytes filesize
            	$adapter = new \Zend\File\Transfer\Adapter\Http();
            	$adapter->setValidators(array($size), $files['name']);
            	if (!$adapter->isValid()){ 
            	    $dataError = $adapter->getMessages();
            		$error = array();
            		foreach($dataError as $key=>$row)
            		{
            			$error[] = $row;
            		}
            		$this->form->setMessages(array('image'=>$error ));
            	} else {
            	    $adapter->setDestination('./assets');
            		if ($adapter->receive($files['name'])) {
            		  $this->validate->exchangeArray($this->form->getData());
            		  $post = array_merge($this->getRequest()->getPost()->toArray(),array('image'=>$files['name']));
            		  unset($post['addSlider']);
                      if(is_object($this->getModelResource()->addRecord('slider',$post))){
            		      $this->redirect()->toRoute('slider');
            		  }else{
            		      $this->form->setMessages(array('error'=>"can not insert" ));
            		  }
            		  
            		}else{
            			
            		}
            	}
            }
           
    }
    return new ViewModel(array('form'=>$this->form));
    }
    public function getModelResource()
    {
    	$sm = $this->getServiceLocator();
    	return $sm->get('Slider\Model\Slider');
    }
}