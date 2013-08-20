<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'pagination' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[:p]',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            ),
            'commentcamarche' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/comment-ca-marche',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'commentcamarche',
                    ),
                ),
            ),
            'jeuxconcours' => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/jeux-concours',
                    'defaults' => array(
                        'controller'    => 'Application\Controller\Index',
                        'action'        => 'jeuxconcours',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'pagination' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:p]',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                                'action'     => 'jeuxconcours',
                            ),
                        ),
                    ),
                ),
            ),
            'activity' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/mon-compte/mon-activite[/:filter]',
                    'constraints' => array(
                        'filter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'activity',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'pagination' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:p]',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                                'action'     => 'activity',
                            ),
                        ),
                    ),
                ),
            ),
            'badges' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/mon-compte/mes-badges',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'badges',
                    ),
                ),
            ),
            'sponsorfriends' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/mon-compte/sponsor-friends',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'sponsorfriends',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'fbshare' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/fbshare',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                                'action'     => 'fbshare',
                            ),
                        ),
                    ),
                    'tweet' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/tweet',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                                'action'     => 'tweet',
                            ),
                        ),
                    ),
                    'google' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/google',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                                'action'     => 'google',
                            ),
                        ),
                    ),
                ),
            ),
            'contact' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/contactez-nous',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'contact',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'contactconfirmation' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/confirmation',
                            'defaults' => array(
                                'controller' => 'Application\Controller\Index',
                                'action'     => 'contactconfirmation',
                            ),
                        ),
                    ),
                ),
            ),

             'zfcadmin' => array(
                'child_routes' => array(
                    'applicationadmin' => array(
                    'type' => 'Literal',
                    'priority' => 1000,
                        'options' => array(
                        'route' => '/application-admin',
                            'defaults' => array(
                                'controller' => 'applicationadmin',
                                'action' => 'index',
                            ),
                        ),
                        'child_routes' =>array(
                            'statistics' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/statistics',
                                    'defaults' => array(
                                        'controller' => 'applicationadmin',
                                        'action' => 'index',
                                    ),
                                ),
                            ),
                            'download' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/download',
                                    'defaults' => array(
                                        'controller' => 'applicationadmin',
                                        'action'     => 'download',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),

            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'core_layout' => array(
        'Application' => array(
            'default_layout' => 'layout/homepage-2columns-right',
            'children_views' => array(
                'col_right'  => 'common/column-right.phtml',
            ),
            'controllers' => array(
                'Application\Controller\Index'   => array(
                    'default_layout' => 'layout/1column',
                    'actions' => array(
                        'index' => array(
                            'default_layout' => 'layout/homepage-2columns-right',
                            'children_views' => array(
                                'col_right'  => 'application/common/column_right.phtml',
                            ),
                        ),
                        'commentcamarche' => array(
                            'default_layout' => 'layout/2columns-left',
                            'children_views' => array(
                                'col_left'  => 'adfab-user/layout/col-user.phtml',
                            ),
                        ),
                        'jeuxconcours' => array(
                            'default_layout' => 'layout/jeuxconcours-2columns-right',
                            'children_views' => array(
                                'col_right'  => 'application/common/column_right.phtml',
                            ),
                        ),
                        'activity' => array(
                            'default_layout' => 'layout/2columns-left',
                            'children_views' => array(
                                'col_left'  => 'adfab-user/layout/col-user.phtml',
                            ),
                        ),
                        'prizecategories' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'application/common/column_right.phtml',
                            ),
                        ),
                        'badges' => array(
                            'default_layout' => 'layout/2columns-left',
                            'children_views' => array(
                                'col_left'  => 'adfab-user/layout/col-user.phtml',
                            ),
                        ),
                        'sponsorfriends' => array(
                            'default_layout' => 'layout/2columns-left',
                            'children_views' => array(
                                'col_left'  => 'adfab-user/layout/col-user.phtml',
                            ),
                        ),
                        'contact' => array(
                            'default_layout' => 'layout/2columns-left',
                            'children_views' => array(
                                'col_left'  => 'adfab-user/layout/col-user.phtml',
                            ),
                        ),
                        'contactconfirmation' => array(
                            'default_layout' => 'layout/2columns-left',
                            'children_views' => array(
                                'col_left'  => 'adfab-user/layout/col-user.phtml',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'nav' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'phpArray',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.php'
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'applicationadmin' => 'Application\Controller\Admin\StatisticsController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'XHTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'              		=> __DIR__ . '/../view/layout/1column.phtml',
            //'layout/homepage-2columns-right'    => __DIR__ . '/../view/layout/homepage-2columns-right.phtml',
            //'layout/2columns-right'      		=> __DIR__ . '/../view/layout/2columns-right.phtml',
            //'application/index/index'    		=> __DIR__ . '/../view/application/index/index.phtml',
            'application/index/activity' 		=> __DIR__ . '/../view/application/user/activity.phtml',
            'application/index/badges'   		=> __DIR__ . '/../view/application/user/badges.phtml',
            'application/index/sponsorfriends'  => __DIR__ . '/../view/application/user/sponsorfriends.phtml',
            'application/statistics/index'  	=> __DIR__ . '/../view/application/admin/statistics/index.phtml',
            'error/404'                  		=> __DIR__ . '/../view/error/404.phtml',
            'error/index'                		=> __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view/admin',
            __DIR__ . '/../view/frontend',
        ),
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Comment ça marche ?',
                'route' => 'commentcamarche',
            ),
            array(
                'label' => 'Mon activité',
                'route' => 'activity',
            ),
            array(
                'label' => 'Mes badges et mes points',
                'route' => 'badges',
            ),
            array(
                'label' => 'Parrainer mes amis',
                'route' => 'sponsorfriends',
            ),
            array(
                'label' => 'Jeux concours',
                'route' => 'jeuxconcours',
            ),
            'pagination' => array(
                'label' => 'Jeux concours',
                'route'=> '/:p',
                'controller' => 'Application\Controller\Index',
                'action'     => 'jeuxconcours',
            ),
            array(
                'label' => 'Contactez-nous',
                'route' => 'contact',
            ),
            array(
                'label' => 'Contactez-nous',
                'route' => 'confirmation',
                'controller' => 'Application\Controller\Index',
                'action'     => 'contactconfirmation',
            ),
            array(
                'label' => 'Thématiques',
                'route' => 'thematiques[/:prizecategoryname][/:prizecategory]',
                'controller' => 'Application\Controller\Index',
                'action'     => 'prizecategories',
            ),
        ),
        'admin' => array(
            'applicationadmin' => array(
                'label' => 'Statistiques',
                'route' => 'zfcadmin/applicationadmin/statistics',
                'resource' => 'application',
                'privilege' => 'list',

                ),
             ),
    ),
);
