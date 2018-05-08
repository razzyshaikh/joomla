<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('_JEXEC') or die();

?>
<div class="search">
		<a id="search-button" href="javascript:void(0);" role="button"<i class="fa fa-search" aria-hidden="true"></i></a>
		<div class="drop-down-search" aria-labelledby="header-search-button">
		<form action="<?php echo JRoute::_('index.php'); ?>" method="post">
			<?php
				$input  = '<input name="searchword" id="mod-search-searchword' . $module->id . '" class="form-control" type="search" placeholder="Search...">';
				$output = '';

				if ($button) :
					if ($imagebutton) :
						$btn_output = '<input type="image" alt="' . $button_text . '" class="btn btn-primary" src="' . $img . '" onclick="this.form.searchword.focus();">';
					else :
						$btn_output = '<button class="btn btn-primary" onclick="this.form.searchword.focus();">' . $button_text . '</button>';
					endif;

					$output .= '<div class="input-group">';
					$output .= $input;
					$output .= '<span class="input-group-btn">';
					$output .= $btn_output;
					$output .= '</span>';
					$output .= '</div>';
				else :
					$output .= $input;
				endif;

				echo $output;
			?>
			<input type="hidden" name="task" value="search">
			<input type="hidden" name="option" value="com_search">
			<input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>">
		</form>
		</div>
</div>
<script>
jQuery(document).ready(function($){
	$(document).on('click',function(evt){
		if(evt.target.id == 'mod-search-searchword129'){
			return false;
		}
	 	if(evt.target.id != 'search-button'){
			$(".drop-down-search").removeClass('open_search_box');
		}else{
			$(".drop-down-search").toggleClass('open_search_box');
		}
	})
});
																			  
</script>
 