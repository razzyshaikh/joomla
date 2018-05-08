<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<div class="jd-modal-login pull-right">
	<ul class="jd-my-account">
		<li>
			<form action="<?php echo JRoute::_(JUri::getInstance()->toString(), true, $params->get('usesecure')); ?>" method="post" id="login-form">
			<?php if ($params->get('greeting')) : ?>
				<div class="login-greeting">
				<i class="fa fa-user-circle" aria-hidden="true"></i>
				<?php if ($params->get('name') == 0) : {
					echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
				} else : {
					echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
				} endif; ?>
				<i class="fa fa-angle-down" aria-hidden="true"></i>
				</div>
			<?php endif; ?>
			</form>
				<?php echo JFactory::getDocument()->getBuffer('modules', 'myprofile', array('style' => 'none')); ?>
		</li>
	</ul>
</div>

