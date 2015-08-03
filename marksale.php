<?php
// no direct access
defined( '_JEXEC' ) or die;

//jimport( 'joomla.plugin.plugin' );
 
class PlgSystemMarksale extends JPlugin
{
	public function __construct(& $subject, $config)
{
	parent::__construct($subject, $config);
}

	function replace_content(){
		
		if( JFactory::getApplication()->isAdmin() )
		{
			return;
		}
		
    
      $ga   = 'var _mstc = {}; '
		.'_mstc.id = '.$this->params->get("marksale_id",0).'; '
		.'_mstc.endpoint = "https://tracking.weiseundstark.de/"; '
		.'</script>'
		.'<script src="https://tracking.weiseundstark.de/tracker.js">';
		if ( version_compare( JVERSION, '3.0', '<' ) == 1) {
			$body =JResponse::getBody();
			$code = "<script type='text/javascript'>".$ga."</script>";
			JResponse::setBody($body.$code);
		}else{
			$body =JFactory::getApplication()->getBody();
			$code = "<script type='text/javascript'>".$ga."</script>";
			JFactory::getApplication()->setBody($body.$code);
	  }
		
		return true;
	}
	public function onAfterRender()
	{
		return $this->replace_content();
	}

}
?>