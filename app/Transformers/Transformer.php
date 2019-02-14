<?php
namespace API\Transformers;

use Response;

/**
 * Class Transformer.
 *
 * @package API\Transformer
 *
 * @author Rami Badran <ramibadran.82@gmail.com>
 */
class Transformer extends Respond{ 
	/**
	 * @var Manager
	 */
	private $fractal;
	
	/**
	 * @var $statusCode
	 */
	public $statusCode; 
	
	/**
	 * @var $customMsg
	 */
	public $customMsg;
	
	/**
	 * @var $customCode
	 */
	public $customCode; 
	
	/**
	 * @var $header
	 */
	public $header = array('Content-Type'=> 'application/json','header'	=>'data-needed');
	
	function __construct($item, $itemTranformer, $fractal){
		$this->item            = $item;
		$this->itemTransformer = $itemTranformer;
		$this->fractal         = $fractal;
	}

	public function setStatusCode($stausCode){
		$this->statusCode = $stausCode;
	}
	
	public function getStatusCode(){
		return $this->statusCode;
	}

	public function setCustomCode($customCode){
		$this->customCode = $customCode;
	}
	
	public function getCustomCode(){
		return $this->customCode;
	}
	
	public function setCustomMessage($customMsg){
		$this->customMsg = $customMsg;
	}
	
	public function getCustomMessage(){
		return $this->customMsg;
	}
	
	public function getHeader(){
		return $this->header;
	}
	
	public function setHeader($headers){
		$this->header = array_merge($this->header,$headers);
	}
	
	public function respond($type='item'){
		
		return Response::json([
				'header'		 => $this->getHeader(),
				'custom_message' => $this->getCustomMessage(),
				'custom_code'    => $this->getCustomCode(),
				'data'           => $this->scope($this->item, $this->itemTransformer, $this->fractal,$type),
		], $this->getStatusCode(), $this->getHeader());
	}
}