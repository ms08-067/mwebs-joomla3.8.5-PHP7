<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_jv
 */

defined('_JEXEC') or die;
JHtml::_('behavior.tabstate');
define('DS', DIRECTORY_SEPARATOR);


JLoader::register('JvModel', JPATH_COMPONENT_ADMINISTRATOR.DS.'classes'.DS.'model.php');
JLoader::register('JvTableProduct', JPATH_COMPONENT_ADMINISTRATOR.DS.'tables'.DS.'product.php');
JLoader::register('JvHelper', dirname(__FILE__) . DS . 'helpers' . DS . 'jv.php');
JLoader::register('JvModelProduct', dirname(__FILE__) . DS . 'models' . DS . 'product.php');
JLoader::register('JvModelCategories', dirname(__FILE__) . DS . 'models' . DS . 'categories.php');

$controllerName = JRequest::getVar('controller');
if ($controllerName == '') {
	$view = JRequest::getCmd('view');
	if ($view && file_exists(JPATH_COMPONENT_ADMINISTRATOR.'controllers/'.strtolower($view).'.php'))
		$controllerName = $view;
}
$path = $controllerName ? JPATH_COMPONENT_ADMINISTRATOR.'/controllers/'.strtolower($controllerName).'.php' : JPATH_COMPONENT_ADMINISTRATOR.'/controller.php';

if (!file_exists($path))
	$path = JPATH_COMPONENT_ADMINISTRATOR.'/controller.php';

require_once $path;
$className = "JvController$controllerName";
//echo $className;exit;
$controller = new $className();

$controller->execute(JRequest::getCmd('task'));
//$controller = JControllerLegacy::getInstance('Jv');
$controller->redirect();

