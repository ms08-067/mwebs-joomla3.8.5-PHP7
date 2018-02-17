<?php



defined('_JEXEC') or die();

jimport('joomla.application.component.model');  

class JvModelProduct extends JModelAdmin

{

    var $_data;

	var $_id;

	var $_total = null;

	var $_pagination = null;

	var $_limit = null;

	var $_limitstart = null;

	public $filter_state;

	public $sort_field;

	public $sort_field_oder =  null;

	

	function __construct(){

	

		parent::__construct();

		$params = JComponentHelper::getParams("com_jv");

		$sort_field = $params->get('sort_field');

		$this->sort_field = empty($sort_field) ? "id" : $sort_field;

		

		$sort_field_oder = $params->get('sort_field_oder');

		$this->sort_field_oder = empty($sort_field_oder) ? "DESC" : $sort_field_oder;

		

		$mainframe = JFactory::getApplication();

		$context = JRequest::getCmd('option');

		$view = JRequest::getCmd('view');

		

		$this->_limit = $mainframe->getUserStateFromRequest( $context.$view.'limit', 'limit', $mainframe->getCfg('list_limit'), 0);

		$this->_limitstart = $mainframe->getUserStateFromRequest( $context.$view.'limitstart', 'limitstart', 0 );

		$this->setState('limit', $this->_limit);

		$this->setState('limitstart', $this->_limitstart);

		$filter_state = $this->filter_state;

		

	}

	

	public function getForm($data = array(), $loadData = true)

	{

		$form = $this->loadForm('com_jv.product', 'product', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))

		{

			return false;

		}

		return $form;

	}

	

	public function getTotal($publish = 0){

		

		if (empty($this->_total)){

			$query = $this->_buildQuery($publish);

			$this->_total = $this->_getListCount($query);

		}

		return $this->_total;

	}

	

	public function getPagination($publish = 0){

	

		if (empty($this->_pagination))

		{

			jimport('joomla.html.pagination');

			$this->_pagination = new JPagination( $this->getTotal($publish), $this->_limitstart, $this->_limit );

		}

		return $this->_pagination;

	}

	

	function getData($publish = 0){

		if (empty($this->_data)){

			$query = $this->_buildQuery($publish);

			$this->_db->setQuery( $query, $this->_limitstart, $this->_limit );

			$this->_data = $this->_db->loadObjectList();

		}

		return $this->_data;

	}

	

	function _buildQuery($publish = 0){

	

		$mainframe = JFactory::getApplication();

		$context = JRequest::getCmd('option');

		$view = JRequest::getCmd('view');

		

		

		$filter_order     = $mainframe->getUserStateFromRequest( $context.$view.'filter_order_author','filter_order', $this->sort_field);

		$filter_order_Dir = $mainframe->getUserStateFromRequest( $context.$view.'filter_order_Dir',  'filter_order_Dir', $this->sort_field_oder );

		$orderby 	= ' ORDER BY '.$filter_order.' '.$filter_order_Dir;

		

		if($publish) $where = " WHERE p.publish = 1 ";

		$query = ' SELECT p.*,c.name AS categories FROM #__jv_product as p LEFT JOIN #__jv_product_categories AS c ON p.id_categories_product = c.id'

		. $where

		. ' ORDER BY '.$filter_order.' '.$filter_order_Dir;

		

		return $query;

	}	

	

	function delete(&$cid = array()){

		if (count( $cid )){

			JArrayHelper::toInteger($cid);

			$cids = implode( ',', $cid );

			$query = 'DELETE FROM #__jv_product'

				. ' WHERE id IN ( '.$cids.' )';

			$this->_db->setQuery( $query );

			if(!$this->_db->query()) {

				$this->setError($this->_db->getErrorMsg());

				return false;

			}

		}

		return true;

	}

	

	function publish(&$cid = array(), $publish = 1){

	

		if (count( $cid ))

		{

			JArrayHelper::toInteger($cid);

			$cids = implode( ',', $cid );

			$query = 'UPDATE #__jv_product'

				. ' SET publish = '.(int) $publish

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

	

  	function getItem($id = 0){

	

  		$query = 'SELECT * FROM #__jv_product WHERE id = '.$id;

		$this->_db->setQuery($query);

		return $this->_db->loadObject();

  	

	}

    

}