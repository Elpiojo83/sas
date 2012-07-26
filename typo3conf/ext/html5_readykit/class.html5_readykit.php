<?php

require_once(PATH_tslib.'class.tslib_pibase.php');

class user_html5_readykit extends tslib_pibase {
	
	var $extKey = 'html5_readykit';	// The extension key.

	function main($params, &$obj){

		$this->conf = $GLOBALS['TSFE']->tmpl->setup['plugin.']['html5_readykit.'];
		
		$params['metaCharsetTag'] = $this->conf['metaCharsetTag'] . "\n" . $this->conf['metaCharsetTag.']['insertAfter'];
				
		return $params;
	}

  public function replaceContent(&$params, &$obj) {
    $this->conf = $GLOBALS['TSFE']->tmpl->setup['plugin.']['html5_readykit.']; // get conf

    // remove the type="text/css" for stylesheets
    $search = '/<link(.+?) type=\"text\/css\"(.+?)\/>/';
    $replace = '<link${1}${2}/>';
    $params['pObj']->content = preg_replace($search, $replace, $params['pObj']->content);
    
    // remove media="all" from styles - declare @media in css-files!
    $search = '/<link(.+?) media=\"all\"(.+?)\/>/';
    $replace = '<link${1}${2}/>';
    $params['pObj']->content = preg_replace($search, $replace, $params['pObj']->content);

    // remove every type-attribute for scripts
    $search = '/<script(.+?) type=\"text\/javascript\"(.+?)>/';
    $replace = '<script${1}${2}>';
    $params['pObj']->content = preg_replace($search, $replace, $params['pObj']->content);

    // inline script-tags
    $search = '<script type="text/javascript">';
    $replace = '<script>';
    $params['pObj']->content = str_replace($search, $replace, $params['pObj']->content);
    
    // remove width and height attributes from images
    $search = '/<img(.+?) width=\"(.+?)\"(.+?)height=\"(.+?)\"(.+?)>/';
    $replace = '<img${1}${3}${5}>';
    $params['pObj']->content = preg_replace($search, $replace, $params['pObj']->content);
  }

  public function noCache(&$params, &$obj) {
    if (!$GLOBALS['TSFE']->isINTincScript()) { // If there are no INTincScripts to include
      return; // stop
    } 
    $this->replaceContent($params, $obj); // call main replace function
  }

  public function cache(&$params, &$obj) {
    if ($GLOBALS['TSFE']->isINTincScript()) { // If there are any INTincScripts to include
      return; // stop
    } 
    $this->replaceContent($params, $obj); // call main replace function
  }
}
?>