<?php

namespace Acme\FeedProcessorBundle\Service;

use Acme\FeedProcessorBundle\Service\Libs\XslProcessor;

class FeedManager{

	private $_sXslFile;
	private $_sXmlFile;
	

	function __construct() {
            $this->_sXslFile = '';
            $this->_sXmlFile = '';	
	}

	public function setXsl($sFile){
		$this->_sXslFile = $sFile;
	}

	public function setFeed($sFile){
		$this->_sXmlFile = $sFile;
	}

	public function process(){
		try{
			$xslProcessor = new XslProcessor($this->_sXslFile);
			$res = $xslProcessor->transformXml(strtolower($this->_sXmlFile));
		}catch(Exception $e){
			return $e->getMessage();
		}
		return $res;
	}

}