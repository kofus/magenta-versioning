<?php
namespace Kofus\Versioning;

return array(
    
    'controllers' => array(
        'invokables' => array(
            'Kofus\Versioning\Controller\Index' => 'Kofus\Versioning\Controller\IndexController',
            'Kofus\Versioning\Controller\Commit' => 'Kofus\Versioning\Controller\CommitController',
            'Kofus\Versioning\Controller\Release' => 'Kofus\Versioning\Controller\ReleaseController',
        )
    ),
    'user' => array(
        'controller_mappings' => array(
            'Kofus\Versioning\Controller\Index' => 'Kofus.Versioning'
        )
    ),
    
    'router' => array(
        'routes' => array(
            'kofus_versioning' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/:language/' . KOFUS_ROUTE_SEGMENT . '/versioning[/:controller[/:action[/:id]]]',
                    'constraints' => array(
                        'language' => '[a-z][a-z]'
                    ),
                    'defaults' => array(
                        'language' => 'de',
                        '__NAMESPACE__' => 'Kofus\Versioning\Controller',
                        'controller' => 'index',
                        'action' => 'index',
                    )
                )
            )
        )
    ),
    
    'controller_plugins' => array(
        'invokables' => array(
            'versioning' => 'Kofus\Versioning\Controller\Plugin\VersioningPlugin'
        )
    ),
    
    'service_manager' => array(
        'invokables' => array(
            'KofusVersioningService' => 'Kofus\Versioning\Service\VersioningService',
        )
    ),
    
    'view_helpers' => array(
        'invokables' => array(
            'versioning' => 'Kofus\Versioning\View\Helper\VersioningHelper',
        )
    ),
    
    
    'view_manager' => array(
        'controller_map' => array(
            'Kofus\Versioning' => true
        ),
        'module_layouts' => array(
            'Kofus\Versioning' => 'kofus/layout/admin'
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view'
        )
    ),
    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/' . str_replace('\\', '/', __NAMESPACE__) . '/Entity'
                )
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    
);


