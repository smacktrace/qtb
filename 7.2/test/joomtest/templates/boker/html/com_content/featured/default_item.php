<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.beez3
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$params =& $this->item->params;
$images = json_decode($this->item->images);
$app = JFactory::getApplication();
$canEdit = $this->item->params->get('access-edit');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');




?>




<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
<div class="system-unpublished">
<?php endif; ?>



<div class="article-blog" data-scrollReveal="enter from the top after 0.3s ease-out">
<?php if ($params->get('show_publish_date')) : ?>	
	<aside>
		<time datetime="<?php echo JHtml::_('date', $this->item->publish_up, 'Y-m-d'); ?>">
			<div class="day"><?php echo JHtml::_('date', $this->item->publish_up, JText::_('d M Y')); ?></div>
		</time>
	</aside>
	
<?php endif; ?>

    <h2 class="article-header-blog">
		<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>"> <?php echo $this->escape($this->item->title); ?></a>
				<?php else : ?>
				<?php echo $this->escape($this->item->title); ?>
				<?php endif; ?>
	</h2>
	
	<?php if ($canEdit ||  $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
	<ul class="actions">
		<?php if ($params->get('show_print_icon')) : ?>
		<li class="print-icon">

			<?php echo JHtml::_('icon.print_popup', $this->item, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($params->get('show_email_icon')) : ?>
		<li class="email-icon">
			<?php echo JHtml::_('icon.email', $this->item, $params); ?>
		</li>
		<?php endif; ?>
		<?php if ($canEdit) : ?>
		<li class="edit-icon">
			<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
		</li>
		<?php endif; ?>
	</ul>
<?php endif; ?>
	
	
			
			
<?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date'))  or ($params->get('show_parent_category')) or ($params->get('show_hits'))) : ?>
<div class="block-info">
	
	<span class="article-info">
	
        <dt class="article-info-term"><?php echo JText::_('COM_CONTENT_ARTICLE_INFO'); ?></dt>
<?php endif; ?>




               <?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
					<?php $title = $this->escape($this->item->parent_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';?>
					<?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
						<dt class="parent-category-name"><?php echo JText::sprintf('COM_CONTENT_PARENT', '</dt><dd class="parent-category-name" >' . $url . '</dd>'); ?>
					<?php else : ?>
						<dt class="parent-category-name"><?php echo JText::sprintf('COM_CONTENT_PARENT', '</dt><dd class="parent-category-name">' . $title . '</dd>'); ?>
					<?php endif; ?>
				<?php endif; ?>


                <?php if ($params->get('show_category')) : ?>
					<?php $title = $this->escape($this->item->category_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';?>
					<?php if ($params->get('link_category') and $this->item->catslug) : ?>
					<dt class="category-name"><?php echo JText::sprintf('COM_CONTENT_CATEGORY', '</dt><dd class="category-name">' . $url . '</dd>'); ?>
					<?php else : ?>
					<dt class="category-name"><?php echo JText::sprintf('COM_CONTENT_CATEGORY', '</dt><dd class="category-name">' . $title . '</dd>'); ?>
					<?php endif; ?>
				<?php endif; ?>
				
				
				<?php if ($params->get('show_create_date')) : ?>
				     <dt class="create"><?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', '</dt><dd class="create">' . JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC3')) . '</dd>'); ?>
				<?php endif; ?>


                <?php if ($params->get('show_modify_date')) : ?>
				    <dt class="modified"><?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', '</dt><dd class="modified">' . JHtml::_('date', $this->item->modified, JText::sprintf('DATE_FORMAT_LC3')) . '</dd>'); ?>
				<?php endif; ?>

    
	        
	            <?php if ($params->get('show_author') && !empty($this->item->author )) : ?>
				<?php $author = $this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author; ?>
				<?php if (!empty($this->item->contactid) && $params->get('link_author') == true): ?>
					<?php
						$needle = 'index.php?option=com_contact&view=contact&id=' . $this->item->contactid;
						$menu = JFactory::getApplication()->getMenu();
						$item = $menu->getItems('link', $needle, true);
						$cntlink = !empty($item) ? $needle . '&Itemid=' . $item->id : $needle;
					?>
					<dt class="createdby"><?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', '</dt><dd class="createdby">' . JHtml::_('link', JRoute::_($cntlink), $author) . '</dd>'); ?>
				<?php else: ?>
					<dt class="createdby"><?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', '</dt><dd class="createdby">' . $author . '</dd>'); ?>
				<?php endif; ?>
				
			
				<?php endif; ?>
	
	
	
	
	<?php if ($params->get('show_hits')) : ?>
				<dt class="hits"><?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', '</dt><dd class="hits">' . $this->item->hits . '</dd>'); ?>
				<?php endif; ?>
	

    <?php if (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits')))
	:?>
	

		</span>
	</div>	
	
		
	
<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>

<?php endif; ?>
<?php endif; ?>
	
	
	
	
   
 
   
   
   <?php if ($params->get('show_title')) : ?>
			<?php  if (isset($images->image_intro) and !empty($images->image_intro)) : ?>
			<?php $imgfloat = (empty($images->float_intro)) ? $params->get('float_intro') : $images->float_intro; ?>
			
			<div class="pull-item-image">
              <a data-rel="prettyPhoto" href="<?php echo htmlspecialchars($images->image_intro); ?>" class="portfolio-blog-featured">		
				<img 
				
				
				src="<?php echo htmlspecialchars($images->image_intro); ?>" alt="<?php echo htmlspecialchars($images->image_intro_alt); ?>" />
				
			
                               <span class="overlays">
                            <span class="content">
                                <i class="fa fa-search"></i>
								<div class="image-caption">
								<?php 
								if ($images->image_intro_caption): echo htmlspecialchars($images->image_intro_caption) ;
                                   
								endif; ?>
								</div>
                            </span>
                        </span>
                                       
				</a>  
			</div>
		<div class="item-separator"></div>	
	<?php endif; ?>
		<?php endif; ?>
   
		
 

	

<div class="separator"></div>	
	<div class="content-text">
	    <?php if (!$params->get('show_intro')) : ?>
		<?php echo $this->item->event->afterDisplayTitle; ?>
		<?php endif; ?>
		<?php echo $this->item->event->beforeDisplayContent; ?>
		<?php echo $this->item->introtext; ?>
		</div>
	
<div class="separator"></div>

<?php echo $this->item->event->afterDisplayContent; ?>




		
		
		
		
		
		<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
?>





<p class="readmore">
				<a href="<?php echo $link; ?>">
					<?php if (!$params->get('access-view')) :
						echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
					elseif ($readmore = $this->item->alternative_readmore) :
						echo $readmore;
						if ($params->get('show_readmore_title', 0) != 0) :
							echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
						endif;
					elseif ($params->get('show_readmore_title', 0) == 0) :
						echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
					else :
						echo JText::_('COM_CONTENT_READ_MORE');
						echo JHtml::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
					endif; ?></a>
		</p>
<?php endif; ?>

	
	<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
	<div class="tag-article"><span>tags:</span>
		<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
	</div>
	<?php endif; ?>

		
		
		
		
		<div class="clr"></div>

	

</div>


