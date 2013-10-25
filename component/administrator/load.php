<?php

/**
 * @package     Moolah Component
 * @subpackage  Administrator Panel
 *
 * @copyright   Copyright (C) 2012-2013 Moolah E-Commerce, Inc. All rights reserved.
 * @license     GNU General Public License version 2
 */

defined('_JEXEC') or die;

$home       = MoolahHelper::getServer();
$openMethod = $params->get('OPEN_METHOD');
$storeId    = $params->get('STORE_ID');
$task       = ( $storeId == 1793220937 ) ? 'store' : 'manage';
$openUrl    = "http://$task.$home/$storeId/";

if ( $openMethod == 'iframe') {
    JHtml::_('behavior.keepalive');
    $iframeHeight   = (int) $params->get('IFRAME_HEIGHT',500);
    $iframeArgs     = sprintf('style="height:%spx;width:100%%;border:none;" height="%spx" width="100%%"',$iframeHeight,$iframeHeight);
    $openHtml       = sprintf('<iframe src="%s" %s></iframe>',$openUrl,$iframeArgs);
} else {
    $openJs     = "window.open('$openUrl','new_window'); return false";
    $openClass  = 'btn';
    $openStyle  = 'display:block;text-align:center;height:30px;width:240px;margin-left:100px;padding-top:10px;font-size:20px;';
    $openText   = JText::_('Open Moolah E-Commerce');
    $openHtml   = sprintf('<p><a href="#" onclick="%s" class="%s" style="%s">%s</a></p>',$openJs,$openClass,$openStyle,$openText);
}

echo $openHtml;
