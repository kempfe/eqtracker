<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ]
                ],
            ],
            'eqtracker' =>[
                'type' => 'literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ]
                ],
            'may_terminate' => true,
                'child_routes' => [
                    'parser' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/parser',
                            'defaults' => [
                                'controller' => 'Application\Controller\Parser',
                                'action' => 'index'
                            ]
                        ]
                    ],
                    'addkill' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/addkill',
                            'defaults' => [
                                'controller' => 'Application\Controller\Index',
                                'action' => 'addKill'
                            ]
                        ]
                    ],
                    'removekill' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/removekill/:npc',
                            'defaults' => [
                                'controller' => 'Application\Controller\Index',
                                'action' => 'removeKill'
                            ]
                        ]
                    ],
                    'zone' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/zone',
                            'defaults' => [
                                'controller' => 'Application\Controller\Zone',
                                'action' => 'list'
                            ]
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'add' => [
                                'type' => 'literal',
                                'options' => [
                                    'route' => '/add',
                                    'defaults' => [
                                        'controller' => 'Application\Controller\Zone',
                                        'action' => 'add'
                                    ]
                                ]
                            ],
                            'edit' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '/edit/:zoneid',
                                    'defaults' => [
                                        'controller' => 'Application\Controller\Zone',
                                        'action' => 'edit'
                                    ]
                                ]
                            ],
                            'delete' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '/delete/:zoneid',
                                    'defaults' => [
                                        'controller' => 'Application\Controller\Zone',
                                        'action' => 'delete'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'npc' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/npc',
                            'defaults' => [
                                'controller' => 'Application\Controller\NPC',
                                'action' => 'list'
                            ]
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'add' => [
                                'type' => 'literal',
                                'options' => [
                                    'route' => '/add',
                                    'defaults' => [
                                        'action' => 'add'
                                    ]
                                ]
                            ],
                            'edit' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '/edit/:npc',
                                    'defaults' => [
                                        'action' => 'edit'
                                    ]
                                ]
                            ],
                            'delete' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '/delete/:npc',
                                    'defaults' => [
                                        'action' => 'delete'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ),
    ),
    'service_manager' => array(

    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Zone' => 'Application\Controller\ZoneController',
            'Application\Controller\NPC' => 'Application\Controller\NPCController',
            'Application\Controller\Parser' => 'Application\Controller\ParserController',
            'Application\Controller\Facebook' => 'Application\Controller\FacebookController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
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
