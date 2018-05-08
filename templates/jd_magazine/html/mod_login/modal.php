<?php
/**
* @package		Joomla.Site
* @subpackage	mod_login
* @copyright	Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
* @license		GNU General Public License version 2 or later; see LICENSE.txt
*/

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('bootstrap.tooltip');

$user = JFactory::getUser();

require_once JPATH_SITE . '/components/com_users/helpers/route.php';


$usersConfig = JComponentHelper::getParams('com_users');

?>
<div class="jd-modal-login pull-right">
	<span class="jd-login">
	<!-- Button trigger modal -->
		<?php //echo JText::_('HELLOCUSTOMER'); ?>
		<a href="#" data-toggle="modal" data-target="#login">
			<span class="info-content">
				<?php echo JText::_('JD_LOGIN'); ?>
			</span>
		</a>  
    </span>

	<!--Modal-->
	<div id="login" class="modal fade popup_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<div class="user_icon" align="center">
						<i class="fa fa-user-circle-o" aria-hidden="true"></i>
					</div>
					<h2 class="title" align="center"><?php echo ($user->id>0) ? JText::_('MY_ACCOUNT') : JText::_('JLOGIN'); ?></h2>
					<?php if ($params->get('pretext')) : ?>
						<div class="form-group pretext" align="center">
							<p><?php echo $params->get('pretext'); ?></p>
						</div>
					<?php endif; ?>
				</div>
				<div class="modal-body">

<form action="<?php echo JRoute::_(JUri::getInstance()->toString(), true, $params->get('usesecure')); ?>" method="post" id="login-form">
	
	<div id="form-login-username" class="form-group">
		<?php if (!$params->get('usetext')) : ?>
			<input id="modlgn-username" type="text" name="username" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
		<?php else: ?>
			<input id="modlgn-username" type="text" name="username" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?>" />
		<?php endif; ?>
	</div>
	<div id="form-login-password" class="form-group">
		<div class="controls">
			<?php if (!$params->get('usetext')) : ?>
				<input id="modlgn-passwd" type="password" name="password" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
			<?php else: ?>
				<input id="modlgn-passwd" type="password" name="password" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD') ?>" />
			<?php endif; ?>
		</div>
	</div>
	<?php if (count($twofactormethods) > 1): ?>
	<div id="form-login-secretkey" class="form-group">
		<?php if (!$params->get('usetext')) : ?>
			<div class="input-group">
				<span class="input-group-addon hasTooltip" title="<?php echo JText::_('JGLOBAL_SECRETKEY_HELP'); ?>">
					<i class="icon-help"></i>
				</span>
				<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
			</div>
		<?php else: ?>
			<div class="input-group">
				<input id="modlgn-secretkey" autocomplete="off" type="text" name="secretkey" class="form-control" tabindex="0" size="18" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY') ?>" />
			</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>

	<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
	<div id="form-login-remember" class="form-group">
		<div class="checkbox">
			<label for="modlgn-remember"><input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label>
		</div>
	</div>
	<?php endif; ?>

	<div id="form-login-submit" class="form-group text-center">
		<button type="submit" tabindex="0" name="Submit" class="btn btn-primary"><?php echo JText::_('JLOGIN') ?></button>
	</div>

	<ul class="form-links">
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind&Itemid=' . UsersHelperRoute::getRemindRoute()); ?>">
			<?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
			<span>/</span>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset&Itemid=' . UsersHelperRoute::getResetRoute()); ?>">
			<?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>
		</li>
	</ul>
	
	<?php if ($usersConfig->get('allowUserRegistration')) : ?>
	<div class="or-section">
		<span>or</span>
	</div>
		<div class="creat_btn" align="center">
			<a class="btn" align="center"  href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=' . UsersHelperRoute::getRegistrationRoute()); ?>"><?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
		</div>
	<?php endif; ?>
	
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>

	<?php if ($params->get('posttext')) : ?>
		<div class="posttext form-group">
			<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>

				</div>
				<!--/Modal body-->

				<!--/Modal footer-->
			</div> <!-- Modal content-->
		</div> <!-- /.modal-dialog -->
	</div><!--/Modal-->
</div>