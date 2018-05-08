<?php
/**
* @package		EasyBlog
* @copyright	Copyright (C) 2010 - 2017 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<div class="eb-pager <?php echo $this->isMobile() ? 'is-mobile' : '';?>">
	<div class="eb-pager-wrap">
		<?php if($data->previous->link) { ?>
			<div class="eb-pager__pre-link-main">
				<a href="<?php echo EB::uniqueLinkSegments($data->previous->link); ?>" rel="prev" class="disabled eb-pager__pre-link">
					<i class="fa fa-angle-left" aria-hidden="true"></i><span class="prev">Prev</span>
				</a>
			</div>
		<?php } else { ?>
			<div class="eb-pager__pre-link-main">
				<a href="javascript:void(0);" class="eb-pager__pre-link">
					<i class="fa fa-angle-left" aria-hidden="true"></i><span class="prev">Prev</span>
				</a>
			</div>
		<?php } ?>

		<div class="eb-pager__link-list">
			<?php foreach ($data->pages as $page) { ?>
				<?php if ($page->link) { ?>
					<a href="<?php echo EB::uniqueLinkSegments($page->link); ?>"><?php echo $page->text;?></a>
				<?php } else { ?>
					<a class="disabled active"><?php echo $page->text;?></a>
				<?php } ?>
			<?php } ?>
		</div>
		
		<?php if($data->next->link) { ?>
			<div class="eb-pager__next-link-main">
				<a href="<?php echo EB::uniqueLinkSegments( $data->next->link ); ?>" rel="next" class="disabled eb-pager__next-link">
					<span class="next">Next</span><i class="fa fa-angle-right" aria-hidden="true"></i>
				</a>
			</div>
		<?php } else { ?>
			<div class="eb-pager__next-link-main">
				<a href="javascript:void(0);" class="eb-pager__next-link">
					<span class="next">Next</span><i class="fa fa-angle-right" aria-hidden="true"></i>
				</a>
			</div>
		<?php } ?>
	</div>	
	
</div>
