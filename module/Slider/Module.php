<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Slider;

use Slider\Model\SliderTable;
use Slider\Model\Slider;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
class Module
{
    public function getServiceConfig()
    {
    	return array(
    			'factories' => array(
    					'Slider\Model\SliderTable' => function($sm) {
    						$tableGateway  = $sm->get('SliderTableGateway');
    						$table = new SliderTable($tableGateway);
    						return $table;
    					},
    					'SliderTableGateway' => function($sm) {
    						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    						$resultSetPrototype = new ResultSet();
    						$resultSetPrototype->setArrayObjectPrototype(new Slider());
    						return new TableGateway('slider', $dbAdapter, null, $resultSetPrototype);
    					},
    			),
    			
    			
    	);
    }
}
