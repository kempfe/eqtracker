<?php

namespace Application\Form;

class ParserForm extends \Zend\Form\Form {
    
    
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->setInputFilter(new \Zend\InputFilter\InputFilter);
       
        $this->add([
            "name" => "file",
            "required" => true,
            "type" => "file",
            "attributes" => [
            ],
            "options" => [
                "label" => "Log File"
            ],
        ]);
        
        
    }
    
    
    public function add($elementOrFieldset, array $flags = array()) {
        parent::add($elementOrFieldset, $flags);
        $zf = $elementOrFieldset;
        unset($zf['type']);
        $this->getInputFilter()->add($zf);
        return;
    }
    
}