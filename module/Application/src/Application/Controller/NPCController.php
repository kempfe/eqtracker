<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class NPCController extends AbstractActionController
{
    
    public function addAction(){
        
        $form = new \Application\Form\NPCForm(null,['em' => $this->getServiceLocator()->get('doctrine_em')]);
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getServiceLocator()->get('doctrine_em')));
        $form->bind(new \DB\Entity\NPC);
        
        $prg = $this->prg($this->url()->fromRoute(null,[],true), true);

        if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
            // returned a response to redirect us
            return $prg;
        } elseif ($prg === false) {
            // this wasn't a POST request, but there were no params in the flash messenger
            // probably this is the first time the form was loaded
            return array('form' => $form);
        }
        
        $form->setData($prg);
        
        if(!$form->isValid()){
            return array('form' => $form); 
        }
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\NPC");
        $zoneMapper->insert($form->getData());
        
        return $this->redirect()->toRoute("eqtracker/npc");
    }
    
    public function listAction(){
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\NPC");
        $items = $zoneMapper->getEntityRepository()->findAll();
        
        return ['items' => $items];
    }
    
    public function deleteAction(){
        $npc = $this->params()->fromRoute("npc");
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\NPC");
        $npcEntity = $zoneMapper->getEntityRepository()->find($npc);
        if(!$npcEntity){
            return $this->redirect()->toRoute("eqtracker/npc");
        }
        $zoneMapper->remove($npcEntity);
        return $this->redirect()->toRoute("eqtracker/npc");
    }
    
    public function editAction(){
        $npc = $this->params()->fromRoute("npc");
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\NPC");
        $npcEntity = $zoneMapper->getEntityRepository()->find($npc);
        $form = new \Application\Form\NPCForm(null,['em' => $this->getServiceLocator()->get('doctrine_em')]);
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getServiceLocator()->get('doctrine_em')));
        $form->bind($npcEntity);
        
        $prg = $this->prg($this->url()->fromRoute(null,[],true), true);

        if ($prg instanceof \Zend\Http\PhpEnvironment\Response) {
            // returned a response to redirect us
            return $prg;
        } elseif ($prg === false) {
            // this wasn't a POST request, but there were no params in the flash messenger
            // probably this is the first time the form was loaded
            return array('form' => $form);
        }
        
        $form->setData($prg);
        
        if(!$form->isValid()){
            return array('form' => $form); 
        }
        
        $zoneMapper->update($form->getData());
        
        return $this->redirect()->toRoute("eqtracker/npc");
    }
}
