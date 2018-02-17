<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
// import Joomla controller library
jimport('joomla.application.component.controller');
/**
 * Hello World Component Controller
 */
class JvController extends JControllerLegacy
{
function getMoreProduct()
{
	$post = JRequest::get("post");
	$limitstart = $post["page"];
	//$limitstart = 5;
	settype($limitstart,"int");
	if( $limitstart > 1 ) {
		$products = new JvModelProduct();
		$products->_limit = 3;
		$products->_limitstart = ($limitstart - 1)*3;
		$listProduct = $products->getData();
		if(count($listProduct)){
			$i=0;$arr = array(); 
			foreach ($listProduct as $rows => $row) : 
				if(!empty($row->img_thumb)):
				$arr[$i] = 
					'<div class="span4">
						<div class="preview">
							<img style="width: 100%" alt=" " src="'.$row->img_thumb.'">
							<div class="overlay">
							</div>
							<div class="links">
								<a href="'.JRoute::_("index.php?option=com_jv&view=product&Itemid=108&id=".$row->id).'">
								View Detail
								</a>
								<a href="'.JRoute::_("http://www.mwebs.vn/demo/cus".$row->id).'" target="_blank">
								Live Preview
								</a>                                
							</div>
						</div>
						<div class="desc">
							<h5>'.$row->name_project.'</h5>
							<small>'.$row->short_des.'</small>
							<div class="price">$'.$row->price.'</div>
						</div>
							   
					</div>'; $i++;
					endif;
				endforeach; 
				echo json_encode($arr,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
				exit;
			}
			else {
				echo 0;exit;
			}
	}
	else {
	
		echo 0;exit;
	}
	
}
	
}