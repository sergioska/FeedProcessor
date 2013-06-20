<?php

namespace Acme\FeedProcessorBundle\Service\Libs;

/**
 * 
 * Xslt Processor class
 * @author sergiosicari
 *
 */
class XslProcessor{
	
	private $_xslFile;
    private $_aHelpers;

    public function __construct($stylesheet) {
        $this->_xslFile = $stylesheet;
        $this->_aHelpers = array();
        $aHelper = glob(__DIR__ . "/../XslHelpers/*.php");
        // load php helper
        foreach($aHelper as $helper)
            require_once($helper);
    }
    
    /**
     * @return string A single SQL query string.
     */
    public function transformXml($xmlFile) { 
        $aParamsKeyValue = array(); 
        // set xsl parameters if exists ...
        if(strpos($xmlFile, "&")!==false){    
    	   $aParams = explode("&", $xmlFile);
    	   foreach($aParams as $param){
    		  $aTmp = explode("=", $param);
    		  $aParamsKeyValue[$aTmp[0]] = $aTmp[1];
    	   }
        }    	

        $oDomDocument = new \DOMDocument();
        if(false === ($xml = $oDomDocument->load($xmlFile))) {
            throw new Exception("Unable to load {$xmlFile}");
        }

        $oXslDocument = new \DOMDocument();
        
        if(false === ($stylesheet = $oXslDocument->loadXML(file_get_contents($this->_xslFile)))) {
            throw new Exception("Unable to load {$this->_xslFile}");
        }
        $processor = new \XSLTProcessor();
        $processor->importStylesheet($oXslDocument);
                
    	$nParams = count($aParamsKeyValue);
    	$i=0;
        foreach($aParamsKeyValue as $key => $value){
        	if($i>1)	
        		$processor->setParameter(NULL, $key, $value);
        	$i++;
        }
        
        // register php helper functions
        $processor->registerPHPFunctions();
        
        if(false === ($transformationResult = $processor->transformToXML($oDomDocument))) {
            throw new Exception("Transformation of {$xmlFile} failed");        
        }
                
        if(!is_string($transformationResult) || strlen($transformationResult) == 0) {
            throw new Exception("Xsl transformation for {$xmlFile} returned no result");
        }                
                 
        return $transformationResult;
        
    }
    
}