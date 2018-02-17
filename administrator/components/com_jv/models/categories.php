<?php
defined('_JEXEC') or die();
jimport('joomla.application.component.model');  

class JvModelCategories extends JModelAdmin
{
    var $_data;
	var $_id;
	var $_total = null;
	var $_pagination = null;
	var $_limit = null;
	var $_limitstart = null;
	
	function __construct(){
	
		parent::__construct();
		
		
		$mainframe = &JFactory::getApplication();
		$context = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		
		$this->_limit = $mainframe->getUserStateFromRequest( $context.$view.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);
		$this->_limitstart = $mainframe->getUserStateFromRequest( $context.$view.'limitstart', 'limitstart', 0 );
		$this->setState('limit', $this->_limit);
		$this->setState('limitstart', $this->_limitstart);
		
	}

	function getData(){
	
		if (empty($this->_data)){
			$query = $this->_buildQuery();
			$this->_db->setQuery( $query, $this->_limitstart, $this->_limit );
			//echo $query;
			$this->_data = $this->_db->loadObjectList();
		}
		return $this->_data;
	}
	
	function getTotal(){
		if (empty($this->_total)){
			$query = $this->_buildQuery();
			$this->_total = $this->_getListCount($query);
		}
		return $this->_total;
	}
	
	function getPagination(){
		if (empty($this->_pagination))
		{
			jimport('joomla.html.pagination');
			$this->_pagination = new JPagination( $this->getTotal(), $this->_limitstart, $this->_limit );
		}
		return $this->_pagination;
	}
	function _buildQuery(){
		
		$mainframe = &JFactory::getApplication();
		$context = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$orderby 			= $this->_buildContentOrderBy();
		$search 			= $mainframe->getUserStateFromRequest( $context.$view.'search','search','','string');
		$filter_state 		= $mainframe->getUserStateFromRequest( $context.$view.'published','published',-1,'int');
		$filter_user 		= $mainframe->getUserStateFromRequest( $context.$view.'created_id','created_id',-1,'int');
		
		$search 			= JString::strtolower( $search );
		$where = array();
		
	
		
		$where 		= ( count( $where ) ? ' WHERE ' . implode( ' AND ', $where ) : '' );
		
		$query = ' SELECT c.* FROM #__jv_product_categories as c'
		. $orderby;
		
		return $query;
	}
	
	function _buildContentOrderBy(){
		
		$mainframe = &JFactory::getApplication();
		$context = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		//$filter_order     = $mainframe->getUserStateFromRequest( $context.$view.'filter_order_author','filter_order','id' );
		//$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.$view.'filter_order_Dir',  'filter_order_Dir', '' );
		//$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
		$orderby 	= ' ORDER BY id DESC';
		//echo $orderby;
		return $orderby;
	}
    
	function delete($cid = array()){
		$result = false;
		if (count( $cid )){
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
			$query = 'DELETE FROM #__jv_product_categories'
				. ' WHERE id IN ( '.$cids.' )';
			$this->_db->setQuery( $query );
			if(!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}
 
	function publish($cid = array(), $publish = 1){
		$user 	=& JFactory::getUser();
		if (count( $cid ))
		{
			JArrayHelper::toInteger($cid);
			$cids = implode( ',', $cid );
			$query = 'UPDATE #__jv_product_categories'
				. ' SET published = '.(int) $publish
				. ' WHERE id IN ( '.$cids.' )'
			;
			$this->_db->setQuery( $query );
			if (!$this->_db->query()) {
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
		}
		return true;
	}
    
     //save to table $nametable
    function store($post,$tablename){
        
    	$product = JTable::getInstance($tablename, 'JvTable');
        $product->load();
        $product->bind($post);
		if ($product->store()) {
			return $product->id;
		} else {
			
			return 0;
		}
  	}
  	public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_jv.product', 'product', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}
  	function getItem($id){
	
  		$query = 'SELECT * FROM #__jv_product WHERE id = '.$id;
		$this->_db->setQuery($query);
		return $this->_db->loadObject();
  	
	}
	
  	function getPaging( $total, $limitstart, $limit )
   	{
      	// Lets load the content if it doesn't already exist
      	jimport('joomla.html.pagination');
        $this->_pagination = new JPagination( $total, $limitstart, $limit );
         
      	return $this->_pagination;
    }
    
}