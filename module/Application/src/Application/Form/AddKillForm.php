<?php

namespace Application\Form;

class AddKillForm extends \Zend\Form\Form {
    
    
    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);
        $this->setInputFilter(new \Zend\InputFilter\InputFilter);
        
        $this->add(array(
           'name' => 'npc',
           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
           'options' => array(
                'object_manager'     => $options['em'],
                'target_class'       => 'DB\Entity\NPC',
                'property' => 'name',
               'label' => 'NPC'
            ), 
        ));
        
        $this->add([
            "name" => "crDate",
            "required" => true,
            "type" => "text",
            "attributes" => [
                "class" => "timepicker"
            ],
            "options" => [
                "label" => "Kill Time"
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