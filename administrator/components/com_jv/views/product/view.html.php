<?php
/**
 * @subpackage  com_jv
 *
 */
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
class JvViewProduct extends JViewLegacy
{
	
	public function __construct($config = array())
	{
		parent::__construct($config);
		
	}
	public function display($tpl = null)
	{
		$this->form	= $this->get('Form');
		
		$id	 	    = JRequest::getInt("id");
		
		if($id){
			
			$product = JvHelper::getProduct($id);
			if(!empty($product)){
				
				$this->form->setValue("name_project", "" , $product->name_project);
				$this->form->setValue("short_des", "" ,  $product->short_des);
				$this->form->setValue("des", "" , $product->des);
				$this->form->setValue("notice", "" , $product->notice);
				$this->form->setValue("price", "" , $product->price);
				$this->form->setValue("version", "" , $product->version);
				$this->form->setValue("img_thumb", "" , $product->img_thumb);
				$this->form->setValue("img_thumb_alt", "" , $product->img_thumb_alt);
				$this->form->setValue("img_alt", "" , $product->img_alt);
				$this->form->setValue("img", "" , $product->img);
				$this->form->setValue("link_item", "" , $product->link_item);
				$this->form->setValue("link_item_outer", "" , $product->link_item_outer);
				$this->form->setValue("folder_item", "" , $product->folder_item);
				$this->assignRef('product', $product);
				
			}
		}
		
		$this->assignRef('categories', JvHelper::getCategories());
		$this->assignRef('id', $id);
		$this->addToolbar();
		parent::display($tpl);
		
	}
	
	protected function addToolbar()
	{
		
		$user		= JFactory::getUser();
		$id	 	    = JRequest::getInt("id");
		
		JToolbarHelper::title(($id ? 'JV Edit Product '.$id : 'JV New Product'));		
		JToolbarHelper::apply('apply');
		JToolbarHelper::save('save');
		JToolbarHelper::save2new('save2new');
		JToolbarHelper::cancel('cancel');
		
	}
	
	
}
