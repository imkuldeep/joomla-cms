<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_postinstall
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php if (empty($this->items)): ?>
<h2><?php echo JText::_('COM_POSTINSTALL_LBL_NOMESSAGES_TITLE') ?></h2>
<p><?php echo JText::_('COM_POSTINSTALL_LBL_NOMESSAGES_DESC') ?></p>
<button onclick="window.location='index.php?option=com_postinstall&view=messages&task=reset&eid=<?php echo $this->eid; ?>&<?php echo $this->token ?>=1'; return false;" class="btn btn-warning">
	<span class="icon icon-eye-open"></span>
	<?php echo JText::_('COM_POSTINSTALL_BTN_RESET') ?>
</button>
<?php else: ?>
<?php
	if ($this->eid == 700):
		echo JHtml::_('sliders.start', 'panel-sliders', array('useCookie' => '1'));
		echo JHtml::_('sliders.panel', JText::_('COM_POSTINSTALL_LBL_MESSAGES'), 'postinstall-panel-messages');
	else:
?>
	<h2><?php echo JText::_('COM_POSTINSTALL_LBL_MESSAGES') ?></h2>
<?php endif; ?>
	<?php foreach($this->items as $item): ?>
	<fieldset>
		<legend><?php echo JText::_($item->title_key) ?></legend>
		<p class="small">
			<?php echo JText::sprintf('COM_POSTINSTALL_LBL_SINCEVERSION', $item->version_introduced) ?>
		</p>
		<p><?php echo JText::_($item->description_key) ?></p>

		<div>
			<?php if ($item->type !== 'message'): ?>
			<button onclick="window.location='index.php?option=com_postinstall&view=messages&task=action&id=<?php echo $item->postinstall_message_id ?>&<?php echo $this->token ?>=1'; return false;" class="btn btn-primary">
				<?php echo JText::_($item->action_key) ?>
			</button>
			<?php endif; ?>
			<?php if (JFactory::getUser()->authorise('core.edit.state', 'com_postinstall')) : ?>
			<button onclick="window.location='index.php?option=com_postinstall&view=message&task=unpublish&id=<?php echo $item->postinstall_message_id ?>&<?php echo $this->token ?>=1'; return false;" class="btn btn-inverse btn-small">
				<?php echo JText::_('COM_POSTINSTALL_BTN_HIDE') ?>
			</a>
			<?php endif; ?>
		</div>
	</fieldset>
	<?php endforeach; ?>
<?php
	if ($this->eid == 700):
		echo JHtml::_('sliders.panel', JText::_('COM_POSTINSTALL_LBL_RELEASENEWS'), 'postinstall-panel-releasenotes');
?>
		<iframe width="100%" height="1000" src="http://www.joomla.org/announcements/release-news">
		</iframe>
<?php
	echo JHtml::_('sliders.end');
	endif;
?>
<?php endif; ?>
