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

class ZoneController extends AbstractActionController
{
    
    public function addAction(){
        
        $form = new \Application\Form\ZoneForm(null,['em' => $this->getServiceLocator()->get('doctrine_em')]);
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getServiceLocator()->get('doctrine_em')));
        $form->bind(new \DB\Entity\Zone);
        
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
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\Zone");
        $zoneMapper->insert($form->getData());
        
        return $this->redirect()->toRoute("zone");
    }
    
    public function listAction(){
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\Zone");
        $items = $zoneMapper->getEntityRepository()->findAll();
        
        return ['items' => $items];
    }
    
    public function deleteAction(){
        $zoneid = $this->params()->fromRoute("zoneid");
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\Zone");
        $zoneEntity = $zoneMapper->getEntityRepository()->find($zoneid);
        if(!$zoneEntity){
            return $this->redirect()->toRoute("zone");
        }
        $zoneMapper->remove($zoneEntity);
        return $this->redirect()->toRoute("zone");
    }
    
    public function editAction(){
        $zoneid = $this->params()->fromRoute("zoneid");
        $zoneMapper = $this->getServiceLocator()->get("DB\Mapper\Zone");
        $zoneEntity = $zoneMapper->getEntityRepository()->find($zoneid);
        $form = new \Application\Form\ZoneForm(null,['em' => $this->getServiceLocator()->get('doctrine_em')]);
        $form->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($this->getServiceLocator()->get('doctrine_em')));
        $form->bind($zoneEntity);
        
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
        
        return $this->redirect()->toRoute("zone");
    }
}
