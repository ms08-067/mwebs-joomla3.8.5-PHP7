<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_jv
 */
defined('_JEXEC') or die;
/**
 * @package     Joomla.Administrator
 * @subpackage  com_jv
 */
class JvTableCategories extends JTable
{
	var $id ;
	var $name ;
	var $published ;
	var $created_date ;
	public function __construct(&$db)
	{
		parent::__construct('#__jv_product_categories', 'id', $db);
	}
}
