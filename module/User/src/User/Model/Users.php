<?php
namespace User\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class Users {
protected $sql;

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
        $this->sql = new Sql($this->adapter);
    }
    
    public function getData($columns, $table, $where, $limit, $offset, $order, $singleObject = false,$pagination = false){
    	$sql = new Sql($this->adapter);
    	$select = $sql->select($table);
    	$columns = empty($columns) ? array('*') : $columns;
    	
    	$select->columns($columns);
    	    	
    	if(!empty($where)){    		
    		$select->where($where);    		
    	}
    	
    	if(!empty($limit)){    		
    		$select->limit((int)$limit);
    	}
    	
    	if(!empty($offset)){
    		$select->offset((int)$offset);
    	}
    	
    	if(!empty($order)){
    		$select->order($order);
    	}
    	
    	if(true === $pagination){
    		$adapter = new \Zend\Paginator\Adapter\DbSelect($select, $sql);
    		$paginator = new \Zend\Paginator\Paginator($adapter);
    		#return $sql->getSqlStringForSqlObject($select);
    		return $paginator;
    	}    	
    	
    	$statement = $sql->prepareStatementForSqlObject($select);    	
    	$result = $statement->execute();
    	
		if(true === $singleObject){
			return $result->current();
		}
		return $result;
    }   
    
    public function addRecord($table,$values){
    	$insert = $this->sql->insert($table);
    	$insert->values($values);
    	$this->sql->prepareStatementForSqlObject($insert)->execute();
    }
    
    public function updateRecord($table, $values, $where){
    	$update = $this->sql->update($table);
    	$update->set($values);
    	$update->where($where);
    	$this->sql->prepareStatementForSqlObject($update)->execute();    	
    }
    
    public function deteleRecord($table,$where){
    	$delete = $this->sql->delete($table);
    	$delete->where($where);
    	$this->sql->prepareStatementForSqlObject($delete)->execute();
    }
    
    public function countRecord($table){
    	$query = $this->sql->select($table);
    	$query->columns(array('total' => new \Zend\Db\Sql\Expression('COUNT(*)')));
    	$count = $this->sql->prepareStatementForSqlObject($query)->execute()->current();
    	return (int) $count['total'];
    }
    
    public function encrytPassword($password){
    	return md5($password);
    }
     public function findByUserName($userName){
     	
     }
    
}