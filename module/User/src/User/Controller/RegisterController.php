<?php
namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class RegisterController extends AbstractActionController
{
    private $form;
    private $validate;
    
    public function __construct(){
    	$this->form = new \User\Form\AddUsers();
    	$this->validate = new \User\Model\FilterUser();
    }
    function indexAction(){
        $msg = "";
        if($this->getRequest()->isPost()){ 
        	#$form->get('submit')->setValue('Add');
        	$this->form->setInputFilter($this->validate->getInputFilter());
        	$this->form->setData($this->getRequest()->getPost());
        
        	if ($this->form->isValid()) {
        	    $this->redirect()->toRoute('home');
        	}else{
        		$msg="Invalid";
        	}
        }
        
        return new ViewModel(array('form'=>$this->form,'msg'=>$msg));
    }
    public function getModelResource()
    {
    	$sm = $this->getServiceLocator();
    	return $sm->get('StickyNotes\Model\GlobalModel');
    }
}