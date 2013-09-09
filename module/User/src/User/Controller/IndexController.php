<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $itemTable;
    public function getItemTable()
    {
    	if (!$this->itemTable) {
    		$sm = $this->getServiceLocator();
    
    		$this->itemTable = $sm->get('User\Model\Users');
    	}
    	return $this->itemTable;
    }
    public function indexAction()
    {
        return new ViewModel(
            array('users'=>$this->getItemTable()->listItem())
            );
    }
    
    public function registerAction(){
    	
    }
    
    public function loginAction(){
        
    }
}
