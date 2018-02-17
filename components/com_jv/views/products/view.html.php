<?php

// No direct access to this file

defined('_JEXEC') or die('Restricted access');



// import Joomla view library

jimport('joomla.application.component.view');



/**

 * View class for the JV Component

 */

class JvViewProducts extends JViewLegacy

{

	function display($tpl = null)

	{

		$products = new JvModelProduct();

		$products->_limit = 12;

		$products->_limitstart = JRequest::getInt("limitstart");		

		
		$list_products = $products->getData($publish = 1);
		$this->assignRef('products', $list_products);

		$pagination = $products->getPagination($publish = 1);
		$this->assignRef('pagination', $pagination);

		

		parent::display($tpl);

		

	}

	

}