<?php
class db {
	public $conn = NULL;
	public $result = NULL;
	public $host="localhost";
	public $user="joomlavi";
	public $pass="IdWcMZdN";
	public $database="joomlavi_karaoke";
	//public $user="root";
	//public $pass="";
	//public $database="karaoke";
	private $author="Hung Phan";
	protected $version="1.0";
	function __construct(){
		$this->conn = mysql_connect($this->host, $this->user, $this->pass);
		mysql_select_db($this -> database, $this->conn);
		mysql_query("set names 'utf8'"); 	 
	} 
	function getdata($sql) {
		if (is_resource($this->conn)) {
		   if (is_resource($this->result)) mysql_free_result($this->result);
		   $this->result = mysql_query( $sql, $this->conn  );
		}
	}
	
	function addToList($post){
		
		//Insert to casi table	
		
		if($post['casi'] !=''){
			$q = "SELECT count(id) as num,id FROM casi WHERE tencs = '".$post['casi']."'";
			$rows = mysql_query($q);
			$row = mysql_fetch_assoc($rows);
			
			if($row['num'] == 0){
				
				$query = "INSERT INTO casi (id,tencs) VALUES ('','".$post['casi']."')";
				mysql_query($query) or die(mysql_error());
				$idCaSi = mysql_insert_id();
			}
			else {
				$idCaSi = $row['id'];
			}
			
		}
		
		//Insert to list table
		$sql = "INSERT INTO list (id, maBH, tenBH, casi, nhacsi, loiBH,idCaSi) 
		                   VALUES ('', '".intval($post['mabh'])."', '".$post['tenbh']."', '".$post['casi']."', '".$post['nhacsi']."', '".$post['loibh']."','".$idCaSi."')";
	    mysql_query($sql) or die(mysql_error()) ;
			
		
	}
	
	function listBH(){
	
		//$result = array();
		$sql = "SELECT id,mabh,tenbh,casi,nhacsi,loibh,member FROM list WHERE 1 ORDER BY tenbh";
	    $rs = mysql_query($sql) or die(mysql_error());
		return $rs;
	}
	function listCaSi(){
	
		//$result = array();
		$sql = "SELECT id,tencs FROM casi WHERE 1";
	    
		$rs = mysql_query($sql) or die(mysql_error());
		
		return $rs;
	}
	function detail($id){
	
		//$result = array();
		$sql = "SELECT casi,id,mabh,tenbh,nhacsi,loibh,member FROM list WHERE id='".$id."'";
	    
		$rs = mysql_query($sql) or die(mysql_error());
		
		return $rs;
	}
	function updateBH($mabh,$id){
		
		$sql = "UPDATE list SET mabh = '".$mabh."' WHERE id='".$id."'";
		$result = mysql_query($sql) or die(mysql_error());
		return (mysql_affected_rows() > 0) ? 1 : 0; 
		
	}
	function stripUnicode($str){
	   if(!$str) return false;
			$unicode = array(
				 'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
				 'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
				 'd'=>'đ',
				 'D'=>'Đ',
				 'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
				  'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
				  'i'=>'í|ì|ỉ|ĩ|ị',	  
				  'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
				 'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
				  'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
				 'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
				  'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
				 'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
				 'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
			   );
			   
	    foreach($unicode as $khongdau=>$codau) {
			$arr=explode("|",$codau);
		    $str = str_replace($arr,$khongdau,$str);
	    }
		return $str;
	}
	function convert(){
	
		/*
		$sql = "SELECT DISTINCT casi FROM list WHERE 1";
		$rows = mysql_query($sql) or die(mysql_error());
		while($row = mysql_fetch_assoc($rows)){
			
			if($row['casi'] != ''){
			
				$q = "INSERT INTO casi (id,tencs) VALUES ('','".$row['casi']."')";
				mysql_query($q);
			}
			
		}
		
		$sql = "SELECT * FROM casi WHERE 1";
		$rows = mysql_query($sql) or die(mysql_error());
		while($row = mysql_fetch_assoc($rows)){
			
			$q = "UPDATE list SET idCaSi='".$row['id']."' WHERE casi='".$row['tencs']."'";
			mysql_query($q);
		}
		*/
	}
} //class db
?>