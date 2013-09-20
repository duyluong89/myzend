<?php
namespace Slider\Model;
use Zend\Db\TableGateway\TableGateway;

class SliderTable {
protected $tableGateway;
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    public function fetchAll()
    {
    	$resultSet = $this->tableGateway->select();
    	return $resultSet;
    }
   public function getById($id){
     $row = $this->tableGateway->select(array('id' => (int) $id));
      return (!$row) ? $row : false;
   }
    
}