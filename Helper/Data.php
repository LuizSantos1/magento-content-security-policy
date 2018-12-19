<?php


class Inviqa_ContentSecurityPolicy_Helper_Data extends Mage_Core_Helper_Abstract
{
    const  permanantCSPLocation = __DIR__.'/../etc/csp.txt';

    public function hasPermanentCSP()
    {
        return file_exists(self::permanantCSPLocation) && is_readable(self::permanantCSPLocation);
    }

    public function hasDBDefinedCSP()
    {
        $policy = Mage::getStoreConfig("contentsecuritypolicy/csp/temp_csp");
        return !empty($policy);
    }

    public function getPermanentCSP()
    {
        return file_get_contents(self::permanantCSPLocation);
    }

    public function hasReportUriDefined()
    {
        $policy = Mage::getStoreConfig("contentsecuritypolicy/csp/temp_csp");
        if ($this->hasPermanentCSP()) {
            $policy = file_get_contents(self::permanantCSPLocation);
        }
        return false !== strpos($policy, 'report-uri');
    }
}