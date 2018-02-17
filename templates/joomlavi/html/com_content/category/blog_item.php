<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;		
?>
<?php
// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
$canEdit = $this->item->params->get('access-edit');
JHtml::_('behavior.framework');
?>
<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00' )) : ?>
	<div class="system-unpublished">
<?php endif; ?>

<?php echo JLayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
<?php 
$output = new stdClass;
$itemURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));

$websiteURL = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https://".$_SERVER['HTTP_HOST'] : "http://".$_SERVER['HTTP_HOST'];

$output->itemURL = $websiteURL.$itemURL;
$output->disqusIdentifier = substr(md5("mwebs"), 0, 10).'_id'.$this->item->id; 

?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') ); ?>

<?php if ($useDefList) : ?>
<div class="blog-meta clearfix">
	<p class="pull-left">
	  <i class="icon-user"></i> By <a href=""><?php echo $this->item->author ?></a> | <span class="pull_cate"><i class="icon-folder-close"></i> Category <a href="index.php?option=com_content&view=category&layout=blog&id=<?php echo $this->item->catid;?>"><?php echo $this->item->category_title; ?></a> |</span> <i class="icon-calendar"></i> <?php echo date("M jS, Y",strtotime($this->item->publish_up));?>
  </p>
  <p class="pull-right"><i class="icon-comment pull"></i> 
  <a data-disqus-identifier="<?php echo $output->disqusIdentifier;?>" href="<?php echo $output->itemURL; ?>#disqus_thread">Comment</a></p>
</div>

<?php endif; ?>

<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>


<?php if (!$params->get('show_intro')) : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>
<div class="jvcontent">
<?php echo $this->item->event->beforeDisplayContent; ?> <?php echo $this->item->introtext; ?>
</div>
<?php if ($useDefList) : ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
<?php  endif; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JUri($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif; ?>

	<p class="readmore"><a class="btn btn-link" href="<?php echo $link; ?>">
	Read More <i class="icon-angle-right"></i>
	</a>
	</p>

<?php endif; ?>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != '0000-00-00 00:00:00' )) : ?>
</div>
<?php endif; ?>

<?php echo $this->item->event->afterDisplayContent; ?>
