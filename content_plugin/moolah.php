<?php

/**
 * @Package Plugin Moolah E-Commerce Loader
 * @Author Moolah E-Commerce
 * @Copyright (C) 2012-2013 Moolah E-Commerce
 * @license GNU/GPLv2
 **/

// No direct access.
defined('_JEXEC') or die;

class plgContentMoolah extends JPlugin
{
    protected   $shouldAddheader    = false;

    /**
     * @param $context
     * @param $article
     * @param $params
     * @param int $page
     * @return bool
     */
    public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
    	// simple performance check to determine whether bot should process further
    	if ( strpos( $article->text, 'moolah' ) === false ) {
    		return true;
    	}

        $regex = "#{moolah(.+)?}#s"; //(.*?)
    	
    	// Get plugin info
    	$plugin =& JPluginHelper::getPlugin('content', 'moolah');
    	$pluginParams = new JRegistry( $plugin->params );

    	// check whether plugin has been unpublished
    	if ( !$pluginParams->get( 'enabled', 1 ) ) {
    		$article->text = preg_replace( $regex, '', $article->text );
    		return true;
    	}
    	
    	// find all instances of plugin and put in $matches

    	preg_match_all( $regex, $article->text, $matches );

    	// Number of plugins
     	$count = count( $matches[0] );

     	// plugin only processes if there are any instances of the plugin in the text
     	if ( ! $count ) {
    		$article->text = preg_replace( '#{moolah.*?}#', '<!-- No Moolah Code Detected -->', $article->text );
    		return true;
    	}

        // Load the helper
        require_once(JPATH_ROOT.'/components/com_moolah/helper/moolahhelper.php');

        return $this->plgContentProcessMoolahMatches( $article, $matches, $pluginParams );

	}

    /**
     * Add a header to the response
     */
    public function onBeforeRender()
    {
        if ( $this->shouldAddHeader ) {
            MoolahHelper::addHeader($this->params);
        }
    }

	
	public function plgContentProcessMoolahMatches( &$row, &$matches, $params )
	{
		$parts = preg_split('#\s#', trim($matches[1][0]) );
		foreach ( $parts as $part )
		{
			if ( strpos($part,'='))
			{
				list($k,$v) = explode('=',$part);
				$k = strtoupper(trim($k)).'_ID';
				$v = trim($v);
				$params->set($k,$v);
			}
		}
		
		$divId		= $params->get('DIV_ID','moolah');
		$text		= '<div id="'.$divId.'">Moolah Store</div>';

        $this->shouldAddHeader = true;

		$this->params = $params;
		
		$row->text = str_replace( $matches[0][0], $text, $row->text );
		
        return true;
	}
}
