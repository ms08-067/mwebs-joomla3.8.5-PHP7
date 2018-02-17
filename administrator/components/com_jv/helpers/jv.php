<?php
// No direct access to this file
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
class JvHelper
{
	public function getCountProductByIdCategory($id=0){
		
		$db = JFactory::getDbo();
		$sql = "SELECT count(*) as total FROM #__jv_product WHERE id_categories_product=".$id;
		$db->setQuery($sql);
		return $db->loadObject();
	}
	
	public function getProduct($id = 0){
		
		$db = JFactory::getDbo();
		
		if($id)
			 $sql = "SELECT * FROM #__jv_product WHERE id = ".$id;
		else $sql = "SELECT * FROM #__jv_product WHERE 1";
		
		$db->setQuery($sql);
		if($id) return $db->loadObject();
		else return $db->loadObjectList();
	}
	public function getCategories($id = 0){
		
		$db = JFactory::getDbo();
		if($id)
			 $sql = "SELECT * FROM #__jv_product_categories WHERE id = ".$id;
		else $sql = "SELECT * FROM #__jv_product_categories WHERE 1";
		$db->setQuery($sql);
		
		if($id) return $db->loadObject();
		else return $db->loadObjectList();
		
	}
	public function getProductRelated($id_categories,$id_product){
		
		$db = JFactory::getDbo();
		$sql = "SELECT * FROM #__jv_product WHERE publish = 1 AND id_categories_product = ".$id_categories. " AND id <>".$id_product." ORDER BY id DESC ";
		$db->setQuery($sql);
		return $db->loadObjectList();
		
	}
	public function getProductBeside($id_categories,$id_product){
		
		$db = JFactory::getDbo();
		$sql = "SELECT * FROM #__jv_product WHERE publish = 1 AND id_categories_product <> ".$id_categories. " AND id <>".$id_product." ORDER BY id DESC ";
		$db->setQuery($sql);
		return $db->loadObject();
		
	}
	
}