<?php

/**
 * @package     Moolah Component
 * @subpackage  Administrator Panel
 *
 * @copyright   Copyright (C) 2012-2013 Moolah E-Commerce, Inc. All rights reserved.
 * @license     GNU General Public License version 2
 */

defined('_JEXEC') or die;

JFactory::getApplication()->enqueueMessage(JText::_('COM_MOOLAH_NOTICE_NO_STORE_ID'));

JToolbarHelper::title(JText::_('COM_MOOLAH_ECOMMERCE_STORE'));
JToolbarHelper::preferences('com_moolah');

$regUrl = 'http://moolah-ecommerce.com/sign-up';
$docUrl = 'http://moolah-ecommerce.com/learn';
$anchor = '<a href="%s" title="Moolah E-Commerce" target="_blank">%s</a>';
$regLink= sprintf($anchor,$regUrl,$regUrl);
$docLink= sprintf($anchor,$docUrl,$docUrl);

?>

<div style="float:right;"><img src="http://moolah-ecommerce.com/images/moolah/moolah128.png" title="Moolah E-Commerce" /></div>

<p>Welcome to Moolah E-Commerce, a service that lets you sell premium products and business services directly from your Joomla website.</p>

<h2>Have a Store ID Already</h2>

<p>Great. Just click on the <em>Options</em> button, enter your Store ID, and save.  You should then be able to directly log into your store's management panel.</p>

<h2>Need a Store ID</h2>

<p>Not a problem.  You can get a free store on the Moolah E-Commerce website at <?php echo $regLink ?>.</p>

<h2>Getting Started</h2>

<p>Have questions about how to get started. Have a look at some of our online documentation at <?php echo $docLink ?>.</p>