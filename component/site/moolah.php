<?php

/**
 * @package     Moolah Component
 * @subpackage  Site Panel
 *
 * @copyright   Copyright (C) 2012-2013 Moolah E-Commerce, Inc. All rights reserved.
 * @license     GNU General Public License version 2
 */

defined('_JEXEC') or die;

require_once(JPATH_ROOT.'/components/com_moolah/helper/moolahhelper.php');

$params = JComponentHelper::getParams('com_moolah');

$storeId    = $params->get('STORE_ID');
if ( $storeId ) {

    // Check if we have a category or product id
    $category   = JRequest::getInt('category');
    $product    = JRequest::getInt('product');

    if ( $category ) $params->set('CATEGORY_ID',$category);
    if ( $product ) $params->set('PRODUCT_ID',$product);

    MoolahHelper::loadStore($params);
} else {
    JFactory::getApplication()->enqueueMessage('No Store ID');
}
