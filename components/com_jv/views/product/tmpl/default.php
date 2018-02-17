<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<section id="product" class="container main">    
<div class="row gallery col-4 row-fluid">
<div class="span8">
<div class="blog">
<div class="well items-leading clearfix">
<!------------------------------------------------------------------------------------------------------------->
<div class="inner">
<?php if(!empty($this->product->img)): ?>
<div class="image">
<a onclick="document.getElementById('order').submit(); return false;" target="_blank" rel="nofollow" href="#" class="screenshot">
<img id="thing_image" width="100%" alt="<?php echo $this->product->img_alt; ?>" title="<?php echo $this->product->img_alt; ?>" src="<?php echo $this->product->img; ?>" />
</a>
<div class="wrap_link_demo">

	<?php if(empty($this->product->link_item_outer)): ?>
		<a title="Live preview" rel="nofollow" href="<?php echo JRoute::_("http://www.mwebs.vn/demo/". (empty($this->product->folder_item) ? "cus".$this->product->id : $this->product->folder_item)); ?>" target="_blank" class="btn primary live_preview">
	<?php else:?>
		<a title="Live preview" rel="nofollow" href="<?php echo JRoute::_($this->product->link_item_outer); ?>" target="_blank" class="btn primary live_preview">
	<?php endif;?>
	
	<span>Live preview</span></a>&nbsp;
	<?php if($this->product->price):?>
	<a onclick="document.getElementById('order').submit(); return false;" rel="nofollow" title="Purchase now using PayPal" href="#" class="btn">Purchase now »</a>
	<?php else:?>
	<a target="_blank" title="Download free" href="<?php echo JURI::root()."demo/".$this->product->folder_item;?>.zip" class="btn">Download free »</a>
	<?php endif;?>
</div>
</div>
<?php endif;?>

<div id="description">
<hr />
	<?php echo $this->product->des; ?>
</div>
<?php 
	$product_related = JvHelper::getProductRelated($this->product->id_categories_product,$this->product->id);
	if(count($product_related)):
?>

<h2 id="seller_items_header">Product Related</h2>

<ul id="seller_items">
<?php for($i = 0; $i < 4; $i++):
if(!empty($product_related[$i]->img)) {  
?>
<li>
<a title="<?php echo $product_related[$i]->name_project; ?>" href="<?php echo JRoute::_('index.php?option=com_jv&view=product&Itemid=108&id='.$product_related[$i]->id); ?>">
<img style="width: 90%;" src="<?php echo $product_related[$i]->img; ?>"></a>
</li>
<?php 
}
endfor; ?>
</ul>
<?php endif; ?>
</div>
<!-------------------------------------------------------------------------------------------------------------->				
</div><!-- end items-leading -->
</div>
</div><!--Item 3-->
<aside class="span4">
<div class="search">
	<h2><?php echo $this->product->name_project; ?></h2>
</div>
<div class="product_info">                    

<?php if($this->product->price):?>
<a onclick="document.getElementById('order').submit(); return false;" rel="nofollow" href="#" class="btn primary btn-xlarge" id="buynow"><span id="offer_price">$<?php echo $this->product->price;?></span></a>                       
<?php else:?>
<a href="<?php echo JURI::root()."demo/".$this->product->folder_item;?>.zip" class="btn primary btn-xlarge" id="buynow">Download Free</a>
<?php endif;?>

<div class="info_wrapper">
<table class="attributes zebra-striped">
<tbody>
<tr class="first"><td class="key"><strong>Version:</strong></td>
<td class="value"><span  id="creativework_version"><?php echo empty($this->product->version) ? "1.0": $this->product->version; ?></span></td></tr>
<tr>
<td class="key"><strong>Short des:</strong></td>
<td class="value"><?php echo $this->product->short_des; ?></td>
</tr>
<?php if(!empty($this->product->update_date)): ?>
<tr>
<td class="key"><strong>Last Updated:</strong></td>
<td class="value"><?php echo date("M d, Y",strtotime($this->product->update_date)); ?></td>
</tr>
<?php endif;?>
<?php if(!empty($this->product->folder_item)): ?>
<tr>
<td class="key"><strong>Item:</strong></td>
<td class="value"><?php echo $this->product->folder_item; ?></td>
</tr>
<?php endif;?>
<tr>
<td class="key"><strong>Categories:</strong></td>
<td class="value">
	<ul>
	<li><a title="<?php echo JvHelper::getCategories($this->product->id_categories_product)->name; ?>" href="javascript:void(0)"><span id="offer_category"><?php echo JvHelper::getCategories($this->product->id_categories_product)->name; ?></span></a></li>
	</ul>
</td>
</tr>

</tbody>
</table>
</div>
<div class="info_wrapper">
</div><br/>
<p class="item_cs_header"><strong>Other Product</strong></p>
<div class="item_cs"><a title="<?php echo JvHelper::getProductBeside($this->product->id_categories_product,$this->product->id)->name_project; ?>" href="<?php echo JRoute::_('index.php?option=com_jv&view=product&Itemid=108&id='.JvHelper::getProductBeside($this->product->id_categories_product,$this->product->id)->id); ?>">
<img width="300" src="<?php echo JvHelper::getProductBeside($this->product->id_categories_product,$this->product->id)->img_thumb; ?>"></a></div>
</div>

</aside>			
</div>        
</section>

<form id="order" target="top" method="post" action="https://www.paypal.com/cgi-bin/webscr" class="paypal-button" >
<div class="hide" id="errorBox"></div>
<input type="hidden" name="button" value="buynow">
<input type="hidden" name="item_name" value="<?php echo $this->product->name_project;?>">
<input type="hidden" name="item_number" value="<?php echo $this->product->folder_item;?>">
<input type="hidden" name="quantity" value="1">
<input type="hidden" name="amount" value="<?php echo $this->product->price;?>">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="shipping" value="0">
<input type="hidden" name="tax" value="0">
<input type="hidden" name="cpp_logo_image" value="http://www.mwebs.vn/templates/joomlavi/images/logo.png">
<input type="hidden" name="return" value="<?php echo JRoute::_('http://www.mwebs.vn/index.php?option=com_jv&view=product&Itemid=108&layout=notice&id='.$this->product->id); ?>">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="R738Z27BNXEYJ">
<input type="hidden" name="bn" value="JavaScriptButton_buynow">
<input type="hidden" name="env" value="www">
</form>
	