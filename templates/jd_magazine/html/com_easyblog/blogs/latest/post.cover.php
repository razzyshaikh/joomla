<?php
/**
* @package      EasyBlog
* @copyright    Copyright (C) 2010 - 2017 Stack Ideas Sdn Bhd. All rights reserved.
* @license      GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Unauthorized Access');
?>
<?php if ($post->image && $this->params->get('post_image', true) || (!$post->image && $post->usePostImage() && $this->params->get('post_image', true))
		|| (!$post->image && !$post->usePostImage() && $this->params->get('post_image_placeholder', false) && $this->params->get('post_image', true))) { ?>

	<div class="eb-post-thumb<?php echo $this->config->get('cover_width_full') ? " is-full" : " is-" . $this->config->get('cover_alignment')?>">
		<?php if (!$this->config->get('cover_crop', false)) { ?>
			<a href="<?php echo $post->getPermalink();?>" class="eb-post-image"
				style="
					<?php if ($this->config->get('cover_width_full')) { ?>
					width: 100%;
					<?php } else { ?>
					width: <?php echo $this->config->get('cover_width') ? $this->config->get('cover_width') : '260';?>px;
					<?php } ?>"
			>
				<img itemprop="image" src="<?php echo $post->getImage($this->config->get('cover_size', 'large'), true, false, $this->config->get('cover_firstimage', 0));?>" alt="<?php echo $this->escape($post->getImageTitle());?>" />
				<meta itemprop="width" content="<?php echo $post->getCoverDimension($this->config->get('cover_size', 'large'))->width; ?>">
				<meta itemprop="height" content="<?php echo $post->getCoverDimension($this->config->get('cover_size', 'large'))->height; ?>">
			</a>
		<?php } ?>

		<?php if ($this->config->get('cover_crop', false)) { ?>
			<a href="<?php echo $post->getPermalink();?>" class="eb-post-image-cover"
				style="
					background-image: url('<?php echo $post->getImage($this->config->get('cover_size', 'large'), true, true, $this->config->get('cover_firstimage', 0));?>');
					<?php if ($this->config->get('cover_width_full')) { ?>
					width: 100%;
					<?php } else { ?>
					width: <?php echo $this->config->get('cover_width') ? $this->config->get('cover_width') : '260';?>px;
					<?php } ?>
					height: <?php echo $this->config->get('cover_height') ? $this->config->get('cover_height') : '200';?>px;"
			></a>
			<img itemprop="image" class="hide" src="<?php echo $post->getImage($this->config->get('cover_size', 'large'), true, false, $this->config->get('cover_firstimage', 0));?>" alt="<?php echo $this->escape($post->getImageTitle());?>" />
			<meta itemprop="width" content="<?php echo $post->getCoverDimension($this->config->get('cover_size', 'large'))->width; ?>">
			<meta itemprop="height" content="<?php echo $post->getCoverDimension($this->config->get('cover_size', 'large'))->height; ?>">
		<?php } ?>
	</div>
<?php } ?>
