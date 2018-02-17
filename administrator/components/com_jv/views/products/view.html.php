<?php

/**

 * @subpackage  com_jv

 */



defined('_JEXEC') or die;



/**

 * View class for a list of products.

 * @subpackage  com_jv

 */



class JvViewProducts extends JViewLegacy

{

	protected $items;



	protected $pagination;



	protected $state;





	public function display($tpl = null)

	{

		$mainframe = JFactory::getApplication();

		

		$filter_order      = $mainframe->getUserStateFromRequest( $context.$view.'filter_order','filter_order','id' );

		$filter_order_Dir  = $mainframe->getUserStateFromRequest( $context.$view.'filter_order_Dir','filter_order_Dir', '' );

		$lists['order'] 		= $filter_order;

		$lists['order_Dir'] 	= $filter_order_Dir;

		

		$products = new JvModelProduct();

		$limit = JRequest::getInt("limit");

		$products->_limit = ($limit <= 0) ? 10 : $limit;

		$this->assignRef('products', $products->getData($publish = 0));

		$this->assignRef('pagination', $products->getPagination($publish = 0));

		$this->assignRef('limit', $products->_limit);

		$this->assignRef('lists', $lists);

		$this->addToolbar();

		$this->sidebar = JHtmlSidebar::render();

		

		parent::display($tpl);

	}

	protected function addToolbar()

	{

			

		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title('JV Products List');

		JToolbarHelper::addNew('add');

		JToolbarHelper::deleteList('Are you sure you want to do this?', 'delete', 'Delete');

		JToolbarHelper::publish('publish', 'JTOOLBAR_PUBLISH', true);

		JToolbarHelper::unpublish('unpublish', 'JTOOLBAR_UNPUBLISH', true);

		JToolbarHelper::preferences('com_jv', '150', '570','Setting','administrator'.DS.'components'.DS.'com_jv' );

	}





}

