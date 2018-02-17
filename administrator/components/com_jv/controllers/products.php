<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_jv
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * products list controller class.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_jv
 * @since       1.6
 */
class JvControllerProducts extends JControllerLegacy
{
	
	//protected $view;
	function __construct($config = array())
	{
		
		$view = JRequest::getVar("view");
		//echo "<pre>";print_r(JRequest::get("post"));
		switch($view){
			case 'categories':
				JRequest::setVar( 'view'  , 'categories');
				break;
			default:
				JRequest::setVar( 'view'  , 'products');
				break;
		}
		
		parent::__construct($config);
		
	}
	
	public function display($cachable = false, $urlparams = false) {		
		parent::display();
	
	}
	
	public function delete(){
	
		$post = JRequest::get('post');
		$modelProducts = $this->getModel("product");
		if( count($post['cid']) &&  count($post['cid']) <= 2 ){
			$modelProducts->delete($post['cid']);
			$this->setRedirect( 'index.php?option=com_jv&controller=products',"You has been deleted product id ".implode(",",$post['cid']));
		}
		else if(count(($post['cid'])) > 2) {
			$this->setRedirect( 'index.php?option=com_jv&controller=products',"Deny  product total delete than two. ID  ".implode(",",$post['cid']),"Warning");
		}
		return true;
	}
	public function publish() {
	
		$post = JRequest::get('post');
		if(count($post["cid"])) {
		
			$modelProducts = $this->getModel("product");
			$modelProducts->publish($post['cid']);
			$this->setRedirect( 'index.php?option=com_jv&controller=products',"Updated successful for ID ".implode(",",$post['cid']));
		}
		else {
		
			$this->setRedirect( 'index.php?option=com_jv&controller=products',"Please chose item");
		}
	}
	public function unpublish() {
	
		$post = JRequest::get('post');
		if(count($post["cid"])) {
		
			$modelProducts = $this->getModel("product");
			$modelProducts->publish($post['cid'],$publish = 0);
			$this->setRedirect( 'index.php?option=com_jv&controller=products',"Updated successful for ID ".implode(",",$post['cid']));
		}
		else {
		
			$this->setRedirect( 'index.php?option=com_jv&controller=products',"Please chose item");
		}
	}
	public function  add() {
	
		$this->setRedirect( 'index.php?option=com_jv&controller=product');
	}
	
	public function getModel($name = 'product', $prefix = 'JvModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}


}
