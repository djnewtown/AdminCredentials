<?php

/**
 * Atwix
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 * @category    Atwix Mod
 * @package     Atwix_AdminCredentials
 *
 * @author      Atwix Core Team
 * @copyright   Copyright (c) 2014 Atwix (http://www.atwix.com)
 *
 * @author      Ingo Fabbri <if@newtown.at>
 * @copyright   Copyright (c) 2016 Newtown-Web OG (http://www.newtown.at)
 *
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Atwix_AdminCredentials_Model_Observer
{
    /**
     * @event controller_action_postdispatch_adminhtml_index_login
     * @param Varien_Event_Observer $observer
     */
    public function enableLoginAutocomplete(Varien_Event_Observer $observer)
    {
        $response = $observer->getControllerAction()->getResponse();
        $body = $response->getBody();
        $script = '
            <script type="text/javascript">
            //<![CDATA[
                document.observe("dom:loaded", function() {
                    $("loginForm").setAttribute("autocomplete", "on");
                    $("loginForm").writeAttribute("action", "' . $this->getUrl('adminhtml') . '");
                    $("dummy").remove();
                });
            //]]>
            </script>';

        $body = str_replace('</body>', $script . '</body>', $body);
        $response->setBody($body);
    }
}
