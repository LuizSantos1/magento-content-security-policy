<?php

class Inviqa_ContentSecurityPolicy_Block_Adminhtml_Status extends Mage_Adminhtml_Block_System_Config_Form_Field
{


    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        $message = '';
        $helper = Mage::helper('contentsecuritypolicy');
        $hasCSP = false;

        if ($helper->hasPermanentCSP()) {
            $message .= $this->getPermanentCSPMessage();
            $hasCSP = true;
        } else if ($helper->hasDBDefinedCSP()) {
            $message .= $this->getDBCspMessage();
            $hasCSP = true;
        } else {
            $message .= $this->getNoCSPMessage();
        }
        if ($hasCSP && !$helper->hasReportUriDefined()) {
            $message .= $this->getNoReportUriMessage();
        }
        return $message;
    }

    private function getPermanentCSPMessage()
    {
        return "<p>Permanent Content Security Policy is in place and being enforced. </p>".
            "<p>Any policy set below will be ignored.</p>";
    }

    private function getNoReportUriMessage()
    {
        return "<p>No Report-uri parameter defined. It is recomended to include a url for reports of policy violations to be sent to see ".
            "<a href='https://report-uri.com'>Report-uri.com</a></p>";
    }

    private function getDBCspMessage()
    {
        return "<p>Temporary Content Security Policy is in place. </p>".
            "<p>This a report only CSP and is intended only for debugging a policy before it is enforced. </p>".
            "<p>To enforce this policy place the text shown in a file located in this module at etc/csp.txt</p>";
    }

    private function getNoCSPMessage()
    {
        return  "<p>No CSP In Place.</p>
            <p> The best way to create one is to use the wizard at <a href='https://report-uri.com/account/wizard/csp/'>Report-uri.com</a> to generate a temporary CSP and paste it below. This will report any violations before you upload a permenant CSP as a file.</p>
            <p>Suggested basic config:<pre>default-src 'none'; form-action 'none'; frame-ancestors 'none'; report-uri https://{subdomain}.report-uri.com/r/d/csp/wizard</pre></p>";
    }

}