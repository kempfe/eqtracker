<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace DB;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        
        
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig(){
        return array(
            'aliases' => array(
                'doctrine_em' => 'Doctrine\ORM\EntityManager'
            ),
            'factories' => array(
                'SiteMapper' => function($sm){
                    $service =  new Mapper\Site();
                    $service->setServiceLocator($sm);
                    return $service;
                },
                'PageMapper' => function($sm){
                    $service =  new Mapper\Page();
                    $service->setServiceLocator($sm);
                    return $service;
                },
                'LangMapper' => function($sm){
                    $service =  new Mapper\Lang();
                    $service->setServiceLocator($sm);
                    return $service;
                },
                'Translator' => function($sm){
                    $translate = new \Zend\I18n\Translator\Translator();
                }
            )
        );
        
    }
}
