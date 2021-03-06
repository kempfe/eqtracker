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

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $npcMapper = $this->getServiceLocator()->get('DB\Mapper\Kill');
        $npcs = $npcMapper->getActiveNPCList();
        return ['npcs' => $npcs];
    }
    
    public function addKillAction(){
        
        $form = new \Application\Form\AddKillForm(null,['em' => $this->getServiceLocator()->get('doctrine_em')]);
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getServiceLocator()->get('doctrine_em')));
        $form->bind(new \DB\Entity\Kill);
        
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
        $mapper = $this->getServiceLocator()->get('DB\Mapper\Kill');
        $kill = $form->getData();
        $npc = $kill->getNPC();
        $mapper->cleanNPC($npc);
        $npc->setKill($kill);
        $spawnTime = clone $kill->getCrDate();
        $spawnTime->add(new \DateInterval("PT".$npc->getSpawnInterval()."M"));
        $kill->setSpawnTime($spawnTime);
        $kill->setSpawnInterval($npc->getSpawnWindow());
        
        $mapper->insert($kill);
        
        // Add to Kill Log
        $killLog = new \DB\Entity\KillLog();
        $killLog->setCrDate($kill->getCrDate());
        $killLog->setNpc($npc);
        $mapper->insert($killLog);
        
        return $this->redirect()->toRoute("home");
    }
    
    public function removeKillAction(){
        $npc = $this->params()->fromRoute("npc");
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\NPC");
        $npcEntity = $zoneMapper->getEntityRepository()->find($npc);
        
        $npcEntity->setKill(NULL);
        $zoneMapper->update($npcEntity);
        return $this->redirect()->toRoute("home"); 
    }
}
