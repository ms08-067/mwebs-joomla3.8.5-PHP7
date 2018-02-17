<?php
/**
 * @subpackage  com_jv
 * @author Hung Phan
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'cancel')
		{
			Joomla.submitform(task, document.getElementById('item-form'));
		}
		else if(document.formvalidator.isValid(document.id('item-form'))){
			Joomla.submitform(task, document.getElementById('item-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_jv&controller=product'); ?>" method="post" name="adminForm" id="item-form" class="form-validate">

<div class="form-inline form-inline-header">

<div class="control-group ">
<div class="control-label"><label>Project Name:</label></div>
<div class="controls">
<?php echo $this->form->getInput('name_project'); ?>
</div>
</div>

<div class="control-group ">
<div class="control-label"><label id="short_des_lbl">Short Description</label></div>
<div class="controls">
<?php echo $this->form->getInput('short_des'); ?>
</div>
</div>
</div>
<div class="form-horizontal">
<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_JV_PRODUCT_CONTENT', true)); ?>
		<div class="row-fluid">
			<div class="span9">
				<fieldset class="adminform">
					<?php echo $this->form->getInput('des'); ?>
					<?php
					//$editor = JFactory::getEditor();
					//echo $editor->display('des', "data-des", '100%', '450', '60', '20', false);
				?>
				</fieldset>
			</div>
<div class="span3">
<fieldset class="form-vertical">

<div class="control-group ">
<div class="control-label">
<label>Category</label>
</div>

<div class="controls">
<select aria-required="true" required="" name="id_categories_product" id="id_categories_product"  class="">
	<option value="0"> -- Select Templates --</option>
	<?php foreach($this->categories as $k => $v): ?>
	<option <?php echo isset($this->product->id_categories_product) && ($v->id == $this->product->id_categories_product) ? "Selected" : ""; ?> value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
	<?php endforeach;?>
</select>
<?php //echo $this->form->getInput('catid'); ?>

</div>
</div>

<div class="control-group ">

<div class="control-label">
<label id="publish_lbl" >Status</label>
</div>

<div class="controls">
<select name="publish" id="publish">
	<option <?php echo isset($this->product) && $this->product->publish == 1 ? "Selected" : ""; ?> value="1">Published</option>
	<option <?php echo isset($this->product) && $this->product->publish == 0 ? "Selected" : ""; ?> value="0">Unpublished</option>
</select>

</div>

</div>

<div class="control-group ">

<div class="control-label">
<label id="price_lbl" >Price</label>
</div>

<div class="controls">
<?php echo $this->form->getInput('price'); ?>
</div>

</div>
<div class="control-group ">

<div class="control-label">
<label id="price_lbl" >Version</label>
</div>

<div class="controls">
<?php echo $this->form->getInput('version'); ?>
</div>

</div>

</fieldset>
</div>
			
</div>
<?php echo JHtml::_('bootstrap.endTab'); ?>

<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'images', JText::_('COM_JV_PRODUCT_IMAGES', true)); ?>
<div class="row-fluid form-horizontal-desktop">
<div class="span5">
<div class="control-group ">
<div class="control-label"><label class="hasTooltip" id="img_thumb_lbl" >Images Thumb</label></div>
<div class="controls">
<?php echo $this->form->getInput('img_thumb'); ?>
</div>
</div>
<div class="control-group ">
<div class="control-label"><label  class="hasTooltip"  id="img_thumb_alt_lbl" >Alt images thumb</label></div>
<div class="controls">
<?php echo $this->form->getInput('img_thumb_alt'); ?>
</div>
</div>
<div class="control-group ">
<div class="control-label">
<label class="hasTooltip"  id="jform_images_image_fulltext-lbl"  aria-invalid="false">Images</label>
</div>
<div class="controls">
<?php echo $this->form->getInput('img'); ?>
</div>
</div>
<div class="control-group">
<div class="control-label">
<label class="hasTooltip" id="img_alt_lbl"  aria-invalid="false">Alt images full</label>
</div>
<div class="controls">
<?php echo $this->form->getInput('img_alt'); ?>
</div>
</div>
</div>

<div class="span7">

<div class="control-group">
<div class="control-label">
<label class="hasTooltip" id="link_item"  aria-invalid="false">Link Items</label>
</div>
<div class="controls">
<?php echo $this->form->getInput('link_item'); ?>
</div>
</div>

<div class="control-group">
<div class="control-label">
<label class="hasTooltip" id="link_item_outer"  aria-invalid="false">Link Items Outer</label>
</div>
<div class="controls">
<?php echo $this->form->getInput('link_item_outer'); ?>
</div>
</div>


<div class="control-group">
<div class="control-label">
<label class="hasTooltip" id="folder_item"  aria-invalid="false">Folder Items</label>
</div>
<div class="controls">
<?php echo $this->form->getInput('folder_item'); ?>
</div>
</div>

</div>

</div>
<?php echo JHtml::_('bootstrap.endTab'); ?>

<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'Notice', JText::_('COM_JV_PRODUCT_NOTICE', true)); ?>
<div class="row-fluid form-horizontal-desktop">
<div class="span10">

<?php echo $this->form->getInput('notice'); ?>

</div>
</div>
<?php echo JHtml::_('bootstrap.endTab'); ?>

<input type="hidden" name="task" value="" />		
<input type="hidden" name="id" value="<?php echo $this->id; ?>" />		
<?php echo JHtml::_('form.token'); ?>
</div>

</form>
