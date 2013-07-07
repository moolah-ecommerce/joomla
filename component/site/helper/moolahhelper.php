<?php

/**
 * @package     Moolah Component
 * @subpackage  Site Helper
 *
 * @copyright   Copyright (C) 2012-2013 Moolah E-Commerce, Inc. All rights reserved.
 * @license     GNU General Public License version 2
 */

defined('_JEXEC') or die;

class MoolahHelper {

    /**
     * Determine the home server to call
     *
     * @return  string
     * @since   2.1
     * @static
     */
    public static function getHome()
    {
        static $home;

        if (!$home) {

            $params = JComponentHelper::getParams('com_moolah');
            $home   = $params->get('SERVER','store.moolah-ecommerce.com');

        }

        return $home;
    }

    /**
     * Load a Moolah Store into the current page
     *
     * @param   $params JRegistry
     * @since   2.1
     * @static
     */
    public static function loadStore($params)
    {
        self::addHeader($params);

        $divId		= $params->get('DIV_ID','moolah');
        $text       = JText::_('Moolah Store');
        $tmpl		= '<div id="%s">%s</div>';

        printf($tmpl,$divId,$text);
    }

    /**
     * Add a header to the response
     */
    public static function addHeader($params)
    {
        $doc		= JFactory::getDocument();
        $uri        = JUri::getInstance();
        $ssl        = $uri->isSSL();
        $proto      = $ssl ? 'https' : 'http';

        $site       = self::getHome();
        $storeId	= $params->get('STORE_ID');
        $productId	= $params->get('PRODUCT_ID');
        $categoryId	= $params->get('CATEGORY_ID');
        $siteId     = $params->get('SITE_ID');
        $affiliateId= $params->get('AFFILIATE_ID');
        $divId		= $params->get('DIV_ID','moolah');
        $moolah		= $params->get('MOOLAH_JS_LOCATION',"$proto://$site/$storeId/js/");

        $args		= "?target=$divId&store=$storeId&category=$categoryId&product=$productId&system=joomla";

        if ( $siteId )      $args .= "&site=$siteId";
        if ( $affiliateId)  $args .= "&affiliate=$affiliateId";

        $doc->addScript( $moolah . 'load.js' . $args );

    }
}