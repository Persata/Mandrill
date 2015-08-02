<?php

namespace Persata\Mandrill\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    /**
     * XML Store Config Path for API Key
     */
    const XML_PATH_API_KEY = 'persata_mandrill/general/key';

    /**
     * Get API Key for Mandrill
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_API_KEY);
    }
}