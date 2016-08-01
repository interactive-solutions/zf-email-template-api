<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

use InteractiveSolutions\EmailTemplateApi\Controller\EmailTemplateCollectionController;
use InteractiveSolutions\EmailTemplateApi\Controller\EmailTemplateResourceController;
use InteractiveSolutions\EmailTemplateApi\Factory\Controller\EmailTemplateCollectionControllerFactory;
use InteractiveSolutions\EmailTemplateApi\Factory\Controller\EmailTemplateResourceControllerFactory;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            EmailTemplateResourceController::class   => EmailTemplateResourceControllerFactory::class,
            EmailTemplateCollectionController::class => EmailTemplateCollectionControllerFactory::class,
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'interactive-solutions/email-template-api' => __DIR__ . '/../view'
        ]
    ],

    'router' => [
        'routes' => [
            'interactive-solutions' => [
                'type'    => Literal::class,
                'options' => [
                    'route' => '/interactive-solutions',
                ],

                'may_terminate' => false,
                'child_routes'  => [

                    'email-templates' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/email-templates',
                            'defaults' => [
                                'controller' => EmailTemplateCollectionController::class,
                            ],
                        ],

                        'may_terminate' => true,
                        'child_routes'  => [
                            'resource' => [
                                'type'    => Segment::class,
                                'options' => [
                                    'route'    => '/:id',
                                    'defaults' => [
                                        'controller' => EmailTemplateResourceController::class,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
