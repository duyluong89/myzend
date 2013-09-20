<?php
namespace Slider\Model;

class Slider{
	
    public $id;
    public $title;
    public $image;
    public $desciption;
    public $url;
    public $order;
    public $state;
    
    public function exchangeArray($data)
    {
    	$this->id     = (isset($data['id'])) ? $data['id'] : null;
    	$this->title  = (isset($data['title'])) ? $data['title'] : null;
    	$this->image = (isset($data['image'])) ? $data['image'] : null;
    	$this->desciption = (isset($data['description'])) ? $data['description'] : null;
    	$this->url = (isset($data['url'])) ? $data['url'] : null;
    	$this->order = (isset($data['order'])) ? $data['order'] : 0;
    	$this->state = (isset($data['state'])) ? $data['state'] : 0;
    }
    
}