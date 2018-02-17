<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<section id="product" class="container main">    
<div class="row gallery col-4">
<div class="span8">
<div itemtype="http://schema.org/Blog" itemscope="" class="blog">
<div class="well items-leading clearfix">
<!------------------------------------------------------------------------------------------------------------->
<div class="inner">
<?php if(!empty($this->product->img)): ?>
<div class="image">
<a target="_blank" rel="nofollow"  href="http://wrapbootstrap.com/preview/WB0573SK0" class="screenshot">
<img id="thing_image" width="100%" alt="<?php echo $this->product->img_alt; ?>" title="<?php echo $this->product->img_alt; ?>" src="<?php echo $this->product->img; ?>" />
</a>
<div class="wrap_link_demo">
	<a title="Live preview" rel="nofollow" href="<?php echo JRoute::_('http://joomlavi.net/demo/cus'.$this->product->id); ?>" target="_blank" class="btn primary live_preview"><span>Live preview</span></a>&nbsp;
</div>
</div>
<?php endif;?>
<div id="description">
<hr/>
	<?php echo $this->product->notice; ?>
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
<div class="info_wrapper">
<table class="attributes zebra-striped">
<tbody>
<tr class="first"><td class="key"><strong>Version:</strong></td>
<td class="value"><span id="creativework_version"><?php echo empty($this->product->version) ? "1.0": $this->product->version; ?></span></td></tr>
<tr>
<td class="key"><strong>Bootstrap:</strong></td>
<td class="value">Compatible with 3.2.x</td>
</tr>
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
<div class="item_cs"><a title="Clean Concept - Colorize Theme" href="javascript:void(0)">
<img width="252" height="158" src="//d85wutc1n854v.cloudfront.net/live/products/icons/WB0R48JC2.jpg?v=1.0.1"></a></div>
</div>

</aside>			
</div>        
</section>
	