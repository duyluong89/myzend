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
        if($this->getRequest()->isPost()){ 
        	$this->form->setInputFilter($this->validate->getInputFilter());
        	$this->form->setData($this->getRequest()->getPost());
        
        	if ($this->form->isValid()) {
        	    $data = array(
        	        'username'=>$this->getRequest()->getPost("username"),
        	        'password'=>$this->getModelResource()->encrytPassword($this->getRequest()->getPost('password')),
        	        'firstName'=>$this->getRequest()->getPost('firsName'),
        	        'lastName'=>$this->getRequest()->getPost('lastName'),
        	        'gender'=>$this->getRequest()->getPost('gender'),
        	        'birthday'=>$this->getRequest()->getPost('birthday'),
        	        'address'=>$this->getRequest()->getPost('address'),
        	        'email'=>$this->getRequest()->getPost('email'),
        	        'phoneNumber'=>$this->getRequest()->getPost('phoneNumber'),
        	        'companyName'=>$this->getRequest()->getPost('companyName'),
        	        'companyAddress'=>$this->getRequest()->getPost('companyAddress'),
        	        'companyPhone'=>$this->getRequest()->getPost('companyPhone'),
        	        'dateCreate'=>time(),
        	        'lastVisit'=>time(),
        	        'privilege'=>$this->getRequest()->getPost('privilege'),
        	        'state'=>$this->getRequest()->getPost('state'),
        	    );
        	     $this->getModelResource()->addRecord("user",$data); 
        	     $this->redirect()->toRoute('home');
        	        
        	}
        }
        
        return new ViewModel(array('form'=>$this->form));
    }
    
    public function getModelResource()
    {
    	$sm = $this->getServiceLocator();
    	return $sm->get('User\Model\Users');
    }
}