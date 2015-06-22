<?php

namespace Application\Form;

class ZoneForm extends \Zend\Form\Form {
    
    
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->setInputFilter(new \Zend\InputFilter\InputFilter);
       
        $this->add([
            "name" => "name",
            "required" => true,
            "type" => "text",
            "attributes" => [
            ],
            "options" => [
                "label" => "Zone Name"
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