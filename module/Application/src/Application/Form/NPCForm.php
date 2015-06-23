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
                "label" => "NPC Name"
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
            "type" => "select",
            "attributes" => [
            ],
            "options" => [
                "label" => "Spawn Interval",
                "value_options" => [
                     720 => "12 Hours",
                     1440 => "24 Hours",
                     2880 => "2 Days",
                     4320 => "3 Days",
                     10080 => "7 Days",
                ]
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
            "required" => false,
            "type" => "select",
            "attributes" => [
            ],
            "options" => [
                "value_options" => [
                    0 => "== No Window",
                     360 => "6 Hours",
                     480 => "8 Hours",
                     720 => "12 Days",
                     1440 => "1 Day",
                ],
                "label" => "Spawn Window"
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