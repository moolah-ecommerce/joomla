<?php

/**
 * @package     Moolah Component
 * @subpackage  Administrator Panel
 *
 * @copyright   Copyright (C) 2012-2013 Moolah E-Commerce, Inc. All rights reserved.
 * @license     GNU General Public License version 2
 */

defined('_JEXEC') or die;

require_once(JPATH_ROOT.'/components/com_moolah/helper/moolahhelper.php');

JToolbarHelper::title(JText::_('COM_MOOLAH_ECOMMERCE_STORE'), 'moolah.png');
JToolbarHelper::preferences('com_moolah');

$params = JComponentHelper::getParams('com_moolah');

$storeId    = $params->get('STORE_ID');
$openMethod = $params->get('OPEN_METHOD');

if ( $storeId ) {
    $home = MoolahHelper::getHome();
    $openUrl = "http://$home/$storeId/manage";

    if ( $openMethod == 'iframe') {
        JHtml::_('behavior.keepalive');
        $iframeArgs = 'style="overflow:hidden;height:700px;width:100%;border:none;" height="700px" width="100%"';
        $openHtml = sprintf('<iframe src="%s" %s></iframe>',$openUrl,$iframeArgs);
    } else {
        $openJs = "window.open('$openUrl','new_window'); return false";
        $openClass = 'btn';
        $openStyle = 'display:block;text-align:center;height:30px;width:240px;margin-left:100px;padding-top:10px;font-size:20px;';
        $openText = JText::_('Open Management Panel');
        $openHtml = sprintf('<p><a href="#" onclick="%s" class="%s" style="%s">%s</a></p>',$openJs,$openClass,$openStyle,$openText);
    }

    echo $openHtml;

} else {
    echo "<br/>";
}

$site   = 'http://moolah-ecommerce.com/sign-up';
if ( ! $storeId ) {
    //$store = 2642953450;
    $anchor = '<a href="%s" title="Moolah E-Commerce" target="_blank">%s</a>';
    $link   = sprintf($anchor,$site,$site);
    $msg    = JText::_('Click Options to enter your Store ID. If you do not have one, you can register for a free account at %s.');

    echo '<p>'.sprintf($msg,$link).'</p>';
} else {
    //echo JText::_('In your Joomla Article, insert the code <strong>{moolah}</strong> into the text to load your store. Alternatively, create a link directly to the Moolah Store.');
}
