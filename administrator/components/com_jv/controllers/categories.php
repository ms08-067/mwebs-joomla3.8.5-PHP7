<?php
/**
 * @subpackage  com_jv
 */
defined('_JEXEC') or die;
/**
 * products list controller class.
 * @subpackage  com_jv
 * @since       1.6
 */
class JvControllerCategories extends JControllerLegacy
{
	
	//protected $view;
	function __construct($config = array())
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		JRequest::setVar( 'view'  , 'categories');
		parent::__construct($config);
		
	}
	
	public function display($cachable = false, $urlparams = false) {		
		
		parent::display();
	}
	
	public function delete(){
	
		$post = JRequest::get('post');
		//echo "<pre>";print_r($post);
		
		$modelCategories = $this->getModel("categories");
		$modelCategories->delete($post['cid']);
		$this->setRedirect( 'index.php?option=com_jv&controller=categories',"You has been deleted product id ".implode(",",$post['cid']));
	}
	
	public function apply(){
	
		$post = JRequest::get("post");
		if(count($post)){

			$model = $this->getModel("Categories");
			$post['created_date'] = date("Y-m-d H:i:s");
			if($post["id"]){
				
				$db = JFactory::getDbo();
				$obj = new stdClass();
				$obj->id = $post["id"];
				$obj->name = $post["name"];
				$obj->published = $post["published"];
				$obj->created_date = $post["created_date"];
				$db->updateObject('#__jv_product_categories', $obj,'id');
				$this->setRedirect( 'index.php?option=com_jv&controller=categories&layout=edit&id='.$post["id"],"Save Successful ID ".$post["id"]);
			
			}
			else {
			
				$id = $model->store($post,"categories");
				$this->setRedirect( 'index.php?option=com_jv&controller=categories&layout=edit&id='.$id,"Save Successful ID ".$id);
			}
			
		
		}
		return true;
	}
	
	public function save(){
	
		$post = JRequest::get("post");
		if(count($post)){
		
			$model = $this->getModel("Categories");
			$post['created_date'] = date("Y-m-d H:i:s");
			if($post["id"]){
				$db = JFactory::getDbo();
				$obj = new stdClass();
				$obj->id = $post["id"];
				$obj->name = $post["name"];
				$obj->published = $post["published"];
				$obj->created_date = $post["created_date"];
				$db->updateObject('#__jv_product_categories', $obj,'id');
				$this->setRedirect( 'index.php?option=com_jv&controller=categories',"Save Successful ID ".$post["id"]);
			}
			else {
				$id = $model->store($post,"categories");
				$this->setRedirect( 'index.php?option=com_jv&controller=categories',"Save Successful ID ".$id);
			}
		}
		return true;
	}
	
	public function  add() {
		$this->setRedirect( 'index.php?option=com_jv&controller=categories&layout=edit');
	}
	
	public function getModel($name = 'categories', $prefix = 'JvModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}


}
