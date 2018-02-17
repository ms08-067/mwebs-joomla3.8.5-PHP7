<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 */
class JvViewProduct extends JViewLegacy
{
	function display($tpl = null)
	{
		$id	 	    = JRequest::getInt("id");
		if($id){
			$product = JvHelper::getProduct($id);
			$this->assignRef('product', $product);
			$fnc = 'display'.ucfirst($this->getLayout());		
			if (is_callable(array(&$this, $fnc))){
				$this->$fnc($tpl);
			}else{
				parent::display($tpl);
			}
		}
		else {
			$app =& JFactory::getApplication();
			$app->redirect('index.php?option=com_jv&view=products&Itemid=108');
		}
		
	}
	public function displayNotice($tpl=NULL){
	
		$id	 = JRequest::getInt("id");
		if($id){
			$product = JvHelper::getProduct($id);
			$this->assignRef('product', $product);
			parent::display($tpl);
		}
		else {
			$app =& JFactory::getApplication();
			$app->redirect('index.php?option=com_jv&view=products&Itemid=108');
		}
		
	}
	
	
}