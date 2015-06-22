<?php

namespace Application\Form;

class NPCForm extends \Zend\Form\Form {
    
    
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
        
        $this->add(array(
           'name' => 'zone',
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
                'object_manager'     => $options['em'],
                'target_class'       => 'DB\Entity\Zone',
                'property' => 'name',
               'label' => 'Zone'
            ), 
        ));
        
        $this->add([
            "name" => "spawnInterval",
            "required" => true,
            "type" => "text",
            "attributes" => [
            ],
            "options" => [
                "label" => "Spawn Interval (in minutes)"
            ],
        ]);
        
        $this->add([
            "name" => "spawnType",
            "required" => true,
            "type" => "select",
            "attributes" => [
            ],
            "options" => [
                "label" => "Spawn Type",
                "value_options" => [
                    'WINDOW' => "Windowed Spawn Type",
                    'FIX' => "Fixed Spawn Type",
                ]
            ],
        ]);
        
        $this->add([
            "name" => "spawnWindow",
            "required" => true,
            "type" => "text",
            "attributes" => [
            ],
            "options" => [
                "label" => "Spawn Window (in minutes)"
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