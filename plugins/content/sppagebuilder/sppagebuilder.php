<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2018 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('Restricted access');

$sppb_helper_path = JPATH_ADMINISTRATOR . '/components/com_sppagebuilder/helpers/sppagebuilder.php';
if (!file_exists($sppb_helper_path)) {
	return;
}
if(!class_exists('SppagebuilderHelper')) {
	require_once $sppb_helper_path;
}

class PlgContentSppagebuilder extends JPlugin {
	protected $autoloadLanguage = true;
	protected $sppagebuilder_content = '';
	protected $sppagebuilder_active = 0;
	protected $isSppagebuilderEnabled = 0;
	
	public function __construct( &$subject, $config ) {
		$this->isSppagebuilderEnabled = $this->isSppagebuilderEnabled();
		parent::__construct($subject, $config);
	}

	// Common
	public static function __context() {
		$context = array(
			'option'=>'com_content',
			'view'=>'article',
			'id_alias'=>'id'
		);
		return $context;
	}

	public function onContentAfterSave($context, $article, $isNew) {
		if ( !$this->isSppagebuilderEnabled ) return;
		$input = JFactory::getApplication()->input;
		$option = $input->get('option', '', 'STRING');
		$view = 'article';
		$form = $input->post->get('jform', array(), 'ARRAY');
		$sppagebuilder_active = (isset($form['attribs']['sppagebuilder_active']) && $form['attribs']['sppagebuilder_active']) ? $form['attribs']['sppagebuilder_active'] : 0;
		$sppagebuilder_content = (isset($form['attribs']['sppagebuilder_content']) && $form['attribs']['sppagebuilder_content']) ? $form['attribs']['sppagebuilder_content'] : '[]';
		if(!$sppagebuilder_content) return;
		if($context == 'com_content.article') {
			$article_state = $article->state;
			if(!$sppagebuilder_active) {
				$article_state = 0;
			}
			$values = array(
				'title' => $article->title,
				'text' => $sppagebuilder_content,
				'option' => $option,
				'view' => $view,
				'id' => $article->id,
				'active' => $sppagebuilder_active,
				'published' => $article_state,
				'created_on' => $article->created,
				'created_by' => $article->created_by,
				'modified' => $article->modified,
				'modified_by' => $article->modified_by,
				'language' => '*',
				'action' => 'apply'
			);
			if($article->state == 2){
				$values['published'] = 1;
			}
			SppagebuilderHelper::onAfterIntegrationSave($values);
		}
	}
	
	public function onContentPrepare($context, $article, $params, $page) {
		$input  = JFactory::getApplication()->input;
		$option = $input->get('option', '', 'STRING');
		$view   = $input->get('view', '', 'STRING');
		$task   = $input->get('task', '', 'STRING');
		if (!isset($article->id) || !(int) $article->id) {
			return true;
		}
		if ( $this->isSppagebuilderEnabled ) {
			if(($option == 'com_content') && ($view == 'article')) {
				$article->text = SppagebuilderHelper::onIntegrationPrepareContent($article->text, $option, $view, $article->id);
			}
			if(($option == 'com_j2store') && ($view == 'products') && ($task == 'view') && ($context == 'com_content.article.productlist')) {
				$article->text = SppagebuilderHelper::onIntegrationPrepareContent($article->text, 'com_content', 'article', $article->id);
			}
		}
	}

	public function onContentAfterDelete($context, $data) {
		if ( $this->isSppagebuilderEnabled ) {
			$input  = JFactory::getApplication()->input;
			$option = $input->get('option', '', 'STRING');
			$task 	= $input->get('task', '', 'STRING');
			if( $option == 'com_content' && $context == 'com_content.article') {
				$values = array(
					'option' => $option,
					'view' => 'article',
					'id' => $data->id,
					'action' => 'delete'
				);
				SppagebuilderHelper::onAfterIntegrationSave($values);
			}
		}
	}

	public function onContentChangeState($context, $pks, $value) {
		if ( $this->isSppagebuilderEnabled ) {
			$input  = JFactory::getApplication()->input;
			$option = $input->get('option', '', 'STRING');
			$view   = $input->get('view', '', 'STRING');
			$task   = $input->get('task', '', 'STRING');
			if( $option == 'com_content' && $context == 'com_content.article') {
				$actions = array(0,1,-2);
				if( !in_array( $value, $actions ) ) return;
				foreach( $pks as $id ) {
					$values = array(
						'option' => $option,
						'view' => 'article',
						'id' => $id,
						'published' => $value,
						'action' => 'stateChange'
					);
					SppagebuilderHelper::onAfterIntegrationSave($values);
				}
			}
		}
	}

	private function isSppagebuilderEnabled(){
		$db = JFactory::getDbo();
		$db->setQuery("SELECT enabled FROM #__extensions WHERE element = 'com_sppagebuilder' AND type = 'component'");
		return $is_enabled = $db->loadResult();
	}

}