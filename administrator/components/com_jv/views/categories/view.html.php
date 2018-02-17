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
 * View class for a list of products.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_jv
 * @since       1.6
 */

class JvViewCategories extends JViewLegacy
{
	protected $items;

	protected $pagination;

	protected $state;


	public function display($tpl = null)
	{
		$categories = new JvModelCategories();
		$this->assignRef('categories', $categories->getData());
		$this->addToolbar();
		$fnc = 'display'.ucfirst($this->getLayout());
		//echo "<pre>";print_r($categories->getData());
		if (is_callable(array(&$this, $fnc))){
		
			$this->$fnc($tpl);
		}else{
			parent::display($tpl);
		}
		
		
	}
	public function displayEdit($tpl=NULL){
		
		$id	 = JRequest::getInt("id");
		if($id){
			$categories = JvHelper::getCategories($id);
			$this->assignRef('categories', $categories);
		}
		parent::display($tpl);
	}
	
	protected function addToolbar()
	{
		$bar = JToolBar::getInstance('toolbar');
		$id	 = JRequest::getInt("id");
		JToolbarHelper::title(($id ? 'JV Edit Categories '.$id : 'JV New Categories'));
		//var_dump($this->getLayout());
		
		switch($this->getLayout()){
		
			case 'edit':
				JToolbarHelper::apply('apply');
				JToolbarHelper::save('save');
				JToolbarHelper::save2new('save2new');
				JToolbarHelper::cancel('cancel');
				break;
			case 'default':
				JToolbarHelper::addNew('add');
				JToolbarHelper::deleteList('Are you sure you want to do this?', 'delete', 'Delete');
				break;
			
		}
		
	}
	
}
