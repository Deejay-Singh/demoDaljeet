<?php
Router::mapResources(array('Api'));
Router::parseExtensions( 'json', 'xml' );
Router::connect('/dashboard', array('controller' => 'dashboard', 'action' => 'index'));
//Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/reset/*', array('controller' => 'users', 'action' => 'reset'));
Router::connect('/about', array('controller' => 'pages', 'action' => 'display', 'about'));
Router::connect('/terms', array('controller' => 'pages', 'action' => 'display', 'terms'));
Router::connect('/contact', array('controller' => 'pages', 'action' => 'display', 'contact'));
Router::connect('/jobs', array('controller' => 'pages', 'action' => 'display', 'jobs'));
Router::connect('/', array('controller' => 'users', 'action' => 'login'));
CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
