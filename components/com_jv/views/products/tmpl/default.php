<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//echo "<pre>";print_r($this->products);exit;
?>
<section class="title">
        <div class="container">
            <div class="row-fluid">
                
            </div>
        </div>
</section>
<section id="portfolio" class="container main">    
<div id="plist" class="row gallery col-4">
<?php $i=0; foreach ($this->products as $rows => $row) : $i++;?>
<?php if(!empty($row->img_thumb)):?>

<div class="span4">
	<div class="preview">
		<!--<a href="<?php //echo JRoute::_('index.php?option=com_jv&view=product&Itemid=108&id='.$row->id); ?>">-->
		<img style="width: 100%" alt=" " src="<?php echo $row->img_thumb;?>">
		<!--</a>-->
		<div class="links">
			<a href="<?php echo JRoute::_('index.php?option=com_jv&view=product&Itemid=108&id='.$row->id); ?>">
			View Detail
			</a>
			
			<?php if(empty($row->link_item_outer)): ?>
				<a href="<?php echo JRoute::_("http://www.mwebs.vn/demo/". (empty($row->folder_item) ? "cus".$row->id : $row->folder_item)); ?>" target="_blank">
			<?php else:?>
				<a href="<?php echo JRoute::_( $row->link_item_outer ); ?>" target="_blank">
			<?php endif; ?>
			
			Live Preview 
			</a>                                
		</div>
	</div>
	<div class="desc">
		<h5><?php echo $row->name_project; ?></h5>
		<small><?php echo $row->short_des; ?></small>
		<div class="price <?php echo ($row->price) ? "": "priceFree" ?>"><?php echo ($row->price) ? "$".$row->price: "FREE"; ?></div>
	</div>
	<!---->
	                
</div>
<?php endif;?>
<!--/Item 1--> 
<?php endforeach;?> 

</div>
<div class="divshowmore">
<!--<a id="showmore" rel="5" class="more-jobs-link span4" href="javascript:void(0);">Show More</a> -->
<?php 
//echo "<pre>";print_r($this->pagination);
echo $this->pagination->getListFooter(); 
?>	


</div>
</section>
