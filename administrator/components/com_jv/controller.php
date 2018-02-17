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
 * Component Controller
 * @subpackage  com_jv
 */
class JvController extends JControllerLegacy
{
	
	/*
	public function __construct($default = array()) {
	
		parent::__construct($default);
		$view = empty(JRequest::getVar("view")) ? "products": JRequest::getVar("view");
		$input = JFactory::getApplication()->input;
        $input->set('view', $view);
	}
	
	/**
	 * Method to display a view.
	 * @param   boolean			If true, the view output will be cached	 
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$view   = $this->input->get('view', 'products');
		$id     = $this->input->getInt('id');
		
		parent::display();
		return $this;
	}
}
