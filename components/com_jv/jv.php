<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
define('DS', DIRECTORY_SEPARATOR);
// import joomla controller library
jimport('joomla.application.component.controller');

JLoader::register('JvHelper', JPATH_COMPONENT_ADMINISTRATOR.DS.'helpers'.DS.'jv.php');
JLoader::register('JvModelProduct', JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'product.php');

// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('Jv');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();