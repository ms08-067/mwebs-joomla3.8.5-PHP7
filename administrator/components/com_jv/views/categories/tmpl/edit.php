<?php
/**
 * @package     Joomla.Administrator
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
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
		else if(document.formvalidator.isValid(document.id('adminForm'))){
			Joomla.submitform(task, document.getElementById('adminForm'));
		}
	}
</script>
<?php //echo "<pre>";print_r($this->categories); ?>
<form action="<?php echo JRoute::_('index.php?option=com_jv&controller=categories'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">
<div id="j-sidebar-container" class="span2">
<div id="sidebar">
<div class="sidebar-nav">
	<ul id="submenu" class="nav nav-list">
		<li>
			<a href="index.php?option=com_jv&amp;controller=products">Products</a>
		</li>
		<li class="active">
			<a href="index.php?option=com_jv&amp;controller=categories">Categories</a>
		</li>
   </ul>
</div>
</div>
</div>

<div class="span10">

<div class="control-group ">
<div class="control-label"><label>Categories Name:</label></div>
<div class="controls">
<input type="text" aria-required="true" required="" size="40" class="input-xlarge input-large-text" value="<?php echo isset($this->categories->name) && $this->categories->name ? $this->categories->name : ""; ?>" id="name" name="name" aria-invalid="true">
</div>
</div>

<div class="control-group ">

<div class="control-label">
<label id="publish_lbl">Status</label>
</div>

<div class="controls">

<select name="published" id="published">
	<option <?php echo isset($this->categories->published) && $this->categories->published == 1 ? "Selected" : ""; ?> value="1">Published</option>
	<option <?php echo isset($this->categories->published) && $this->categories->published == 0 ? "Selected" : ""; ?> value="0">Unpublished</option>
</select>

</div>
</div>
</div>
<input type="hidden" name="id" value="<?php echo $this->categories->id; ?>" />
<input type="hidden" name="task" value="" />
<?php echo JHtml::_('form.token'); ?>

</form>
