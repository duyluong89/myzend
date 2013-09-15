<?php
namespace User\Form;
use Zend\Form\Form;
class AddUsers extends Form{
    public function __construct($name = null){
    	parent::__construct("user");
    	$this->setAttribute("Method", "POST");
    	$this->add(array(
    	    'name'=>'username',
    	    'attributes'=>array(
    	        'type'=>'text'    
    	    )
    	    
    	));
    	$this->add(array(
    	    'name'=>'password',
    	    'attributes'=>array(
    	        'type'=>'password',
    	        'class'=>'text required'
    	)
    	));
    	$this->add(array(
    	    'name'=>'firstName',
    	    'attributes'=>array(
    	        'type'=>'text',
    	        'class'=>'text required'
    	)
    	));
    	$this->add(array(
    	    'name'=>'lastName',
    	    'attributes'=>array(
    	        'type'=>'text',
    	        'class'=>'text required'
    	)
    	));
    	
    	$this->add(array(
    	    'name'=>'gender',
    	    'attributes'=>array(
    	        'type'=>'text'
    	)
    	));
    	$this->add(array(
    	    'name'=>'birthday',
    	    'attributes'=>array(
    	        'type'=>'text'
    	)
    	));
    	$this->add(array(
    			'name'=>'address',
    			'attributes'=>array(
    					'type'=>'text'
    			)
    	));
    	$this->add(array(
    			'name'=>'phoneNumber',
    			'attributes'=>array(
    					'type'=>'text'
    			)
    	));
    	$this->add(array(
    			'name'=>'email',
    			'attributes'=>array(
    					'type'=>'email'
    			)
    	));
    	$this->add(array(
    			'name'=>'companyName',
    			'attributes'=>array(
    					'type'=>'text'
    			)
    	));
    	$this->add(array(
    			'name'=>'companyAddress',
    			'attributes'=>array(
    					'type'=>'text'
    			)
    	));
    	$this->add(array(
    			'name'=>'companyPhone',
    			'attributes'=>array(
    					'type'=>'text'
    			)
    	));
    	$this->add(array(
    			'name'=>'dateCreate',
    			'attributes'=>array(
    					'type'=>'hidden',
    			        'value'=>time()
    			)
    	));
    	$this->add(array(
    			'name'=>'privilege',
    			'attributes'=>array(
    					'type'=>'hidden',
    					'value'=>100
    			)
    	));
    	$this->add(array(
    			'name'=>'state',
    			'attributes'=>array(
    					'type'=>'hidden',
    					'value'=>0
    			)
    	));
    	
    	$this->add(array(
    			'name'=>'addUser',
    			'attributes'=>array(
    					'type'=>'submit',
    					'value'=>"Register",
    			        'class'=>"btn btn-success"
    			)
    	));
    	 
    	
    }
}