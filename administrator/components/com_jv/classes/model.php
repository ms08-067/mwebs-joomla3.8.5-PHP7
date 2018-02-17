<?php
/**
 * @version $Id: model.php 34 2011-09-23 06:20:16Z lnmtrung $
 */

jimport( 'joomla.application.component.model' );

abstract class JvModel extends JModelLegacy  {

	var $cascadeDelete = array();
	var $cascadeCopy = array();
	
	public function getTable($name = '', $prefix = 'TableJv', $options = array())
	{
		if (empty($name)) {
			$name = $this->getName();
		}
		if ($table = $this->_createTable($name, $prefix, $options)) {
			return $table;
		}
		JError::raiseError(0, JText::sprintf('JLIB_APPLICATION_ERROR_TABLE_NAME_NOT_SUPPORTED', $name));
		return null;
	}
	
	public static function getInstance($type, $prefix = '', $config = array())
	{
		$type		= preg_replace('/[^A-Z0-9_\.-]/i', '', $type);
		$modelClass	= $prefix.ucfirst($type);

		if (!class_exists($modelClass)) {
			jimport('joomla.filesystem.path');
			$path = JPath::find(
				JModel::addIncludePath(null, $prefix),
				JModel::_createFileName('model', array('name' => $type))
			);
			if (!$path) {
				$path = JPath::find(
					JModel::addIncludePath(null, ''),
					JModel::_createFileName('model', array('name' => $type))
				);
			}
			if ($path) {
				require_once $path;

				if (!class_exists($modelClass)) {
					JError::raiseWarning(0, JText::sprintf('JLIB_APPLICATION_ERROR_MODELCLASS_NOT_FOUND', $modelClass));
					return false;
				}
			}
			else {
				return false;
			}
		}

		return new $modelClass($config);
	}

	function buildQuery($query, $params = array()) {
		$this->getDBO();
		if (is_array($query)) {
			extract($query);
			
			if (is_array($select)) $select = implode(', ', $select);
			if (!$select) $select = '*';
			$select = "SELECT " . $select;
			
			if (is_array($from)) $from = implode(', ', $from);
			$from = "FROM " . $from;
			
			if (is_array($join)) $join = implode(' ', $join);
			
			if (is_array($where)) $where = implode(' OR ', $where);
			if ($where) $where = "WHERE " . $where;
			
			if (is_array($group)) $group = implode(', ', $group);
			if ($group) $group = "GROUP BY " . $group;
			
			if (is_array($having)) $having = implode(', ', $having);
			if ($having && $group) $having = "HAVING " . $having;
			
			if (is_array($order)) $order = implode(', ', $order);
			if ($order) $order = "ORDER BY " . $order;
		
			$query = $select.' '.$from.' '.$join.' '.$where.' '.$group.' '.$having.' '.$order;
		}
		
		if (!is_array($params)) $params = array();
		if (!empty($params)) {
			array_unshift($params, $query);
			return call_user_func_array('sprintf', $params);
		}
		else 
			return $query;
	}
	
	function insertid(){
		return $this->_db->insertid();
	}
	
	function getCols($col, $where = '', $order = '') {
		if ($where) $where = "WHERE $where";
		if ($order) $order = "ORDER BY $order";
		$tbl = $this->getTable();
		$this->_db->setQuery("SELECT `$col` FROM ".$tbl->getTableName().' '.$where.' '.$order);
		return $this->_db->loadResultArray();
	}
	function save($data) {
		$tbl = $this->getTable();
		$result = $tbl->save($data) ? $tbl : false;
		if (!$result) EveLog::error("DB Error: " . $tbl->getError());
		return $result;
	}
	
	function delete($id) {
		$id = (array)$id;
		if (!empty($id)) {
			JArrayHelper::toInteger($id);
			$id = implode(',', $id);
			
			$tbl = $this->getTable();
			$this->_db->setQuery("DELETE FROM ".$tbl->getTableName()." WHERE `".$tbl->getKeyName()."` IN ($id)");
			$result = $this->_db->query();
			
			EveLog::debug("Deleted ".$this->getName()." ID $id. Affected rows: $result");
			
			// delete dependent tables
			if (!empty($this->cascadeDelete)) {
				foreach ($this->cascadeDelete as $s) {
					list($mdlName, $fkey) = explode('.', $s, 2);
					
					$mdl = EveModel::getInstance($mdlName);
					$tbl = $mdl->getTable();
					$db = $childMdl->getDBO();
					
					$db->setQuery("SELECT `".$tbl->getKeyName()."` FROM ".$tbl->getTableName()." WHERE `$fkey` IN ($id)");
					$fid = $db->loadResultArray();
					
					$mdl->delete($fid);
				}
			}
			
			return $result;
		}
		return 0;
	}
	
	function copy($ids, $overwrite = array()) 
	{
		$return = array();
		$ids = (array)$ids;
		JArrayHelper::toInteger($ids);
		foreach ($ids as $id) 
		{
			$tbl = $this->getTable();
			if ($tbl->load($id)) {
				$data = $tbl->getProperties();
				unset($data['id']);
				
				// overwrite fields
				if (is_array($overwrite))
					foreach ($overwrite as $k => $v)
						$data[$k] = $v;
				
				// raise hook
				if ($this->beforeCopySaving($data) !== false) {
					if ($tbl = $this->save($data)) {
						$return[] = $tbl->id;
						
						// cascade copying
						if (!empty($this->cascadeCopy))
							foreach ($this->cascadeCopy as $s) 
							{
								list($mdlName, $fkey) = explode('.', $s, 2);
								
								$childMdl = EveModel::getInstance($mdlName);
								$childTbl = $childMdl->getTable();
								$childDBO = $childMdl->getDBO();
								
								$childDBO->setQuery("SELECT `".$childTbl->getKeyName()."` FROM ".$childTbl->getTableName()." WHERE `$fkey` = $id");
								$fid = $childDBO->loadResultArray();
							
								$childMdl->copy($fid, array(
									$fkey => $tbl->id
								));
							}
					}
					
				}
			}
			else 
			{
				// TODO copy failed
			}
		}
		
		return $return;
	}
	
	/**
	 * sub class may implement this hook
	 *
	 * @param $data $data
	 * @return boolean/void return false to stop saving
	 */
	function beforeCopySaving(&$data) {
	}
}
?>