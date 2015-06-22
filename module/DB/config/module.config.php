<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'db_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\XmlDriver',
                'paths' => array(
                    __DIR__ .'/xml/doctrine',
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                  'DB\Entity' => 'db_entity'
                )
            )
        )
    ),
    'service_manager' => [
        'factories' => [
            
        ],
        'abstract_factories' => array(
            'DB\Factory\Mapper'
        )
    ],
    'router' => array(
        'routes' => array(
            )
    ),
   
    'controllers' => array(
        'invokables' => array(

        ),
    ),
    
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
