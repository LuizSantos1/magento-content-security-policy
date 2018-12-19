<?php

class Inviqa_ContentSecurityPolicy_Model_Observer
{
    public function setCSPHeader()
    {
        $helper = Mage::helper('contentsecuritypolicy');
        if ($helper->hasPermanentCSP()) {
            $policy = $helper->getPermanentCSP();
            $headerName = 'Content-Security-Policy';
        } else {
            $policy = Mage::getStoreConfig("contentsecuritypolicy/csp/temp_csp");
            $headerName = 'Content-Security-Policy-Report-Only';
        }
        if (!empty($policy)) {
            $response = Mage::app()->getResponse();
            $response->setHeader($headerName, $policy);
        }
    }
}