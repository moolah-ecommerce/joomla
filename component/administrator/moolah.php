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


$params     = JComponentHelper::getParams('com_moolah');
$storeId    = $params->get('STORE_ID');
$fileToLoad = $storeId ? 'load' : 'prompt';

require_once(__DIR__."/$fileToLoad.php");