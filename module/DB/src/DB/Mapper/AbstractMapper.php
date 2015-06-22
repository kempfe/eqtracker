<?php

namespace DB\Mapper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Doctrine\ORM\EntityRepository;

class AbstractMapper implements ServiceLocatorAwareInterface{
    
    protected $sm;
    protected $entityName = '';   
    protected $em;
    
    const EVENT_POST_INSERT = 'postInsert';
    const EVENT_PRE_INSERT = 'preInsert';
    const EVENT_PRE_UPDATE = 'preUpdate';
    const EVENT_POST_UPDATE = 'postUpdate';
    
    public function getServiceLocator() {
        return $this->sm;
    }
    
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
        $this->sm = $serviceLocator;
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getEntityRepository(){
        return  $this->getEntityManager()->getRepository($this->entityName);
    }
    
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager(){
        return $this->getServiceLocator()->get('doctrine_em');
    }
    
    public function addAggregate(ListenerAggregateInterface $aggregate){
        $this->getEventManager()->attachAggregate($aggregate);
        return $this;
    }
    
    /**
     * 
     * @return  \Zend\EventManager\EventManager
     */
    public function getEventManager(){
        if(empty($this->em)){
            $this->em = new \Zend\EventManager\EventManager();
        }
        return $this->em;
    }
    
    public function insert($entity){
        $this->getEventManager()->trigger(self::EVENT_PRE_INSERT,__CLASS__,['entity' => $entity]);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(self::EVENT_POST_INSERT,__CLASS__,['entity' => $entity]);
        return $entity;
    }
    
    public function update($entity){
        $this->getEventManager()->trigger(self::EVENT_PRE_INSERT,__CLASS__,['entity' => $entity]);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        $this->getEventManager()->trigger(self::EVENT_POST_INSERT,__CLASS__,['entity' => $entity]);
        return $entity;
    }
    
}