<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('goal_admin_index', new Route(
    '/',
    array('_controller' => 'AppBundle:Goal:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('goal_admin_show', new Route(
    '/{id}/show',
    array('_controller' => 'AppBundle:Goal:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('goal_admin_new', new Route(
    '/new',
    array('_controller' => 'AppBundle:Goal:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('goal_admin_edit', new Route(
    '/{id}/edit',
    array('_controller' => 'AppBundle:Goal:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('goal_admin_delete', new Route(
    '/{id}/delete',
    array('_controller' => 'AppBundle:Goal:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
