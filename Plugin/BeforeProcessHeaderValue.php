<?php
/**
 * Copyright © DD. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace DD\GraphqlGetCorrectStore\Plugin;

use Magento\Framework\App\Http\Context as HttpContext;
use Magento\Store\Model\StoreManagerInterface;
use Magento\StoreGraphQl\Controller\HttpHeaderProcessor\StoreProcessor;

class BeforeProcessHeaderValue
{
    private StoreManagerInterface $storeManager;
    private HttpContext $httpContext;

    public function __construct(
        StoreManagerInterface $storeManager,
        HttpContext $httpContext
    ) {
        $this->storeManager = $storeManager;
        $this->httpContext  = $httpContext;
    }

    public function beforeProcessHeaderValue(StoreProcessor $subject, string $headerValue): void
    {
        if (empty($headerValue)) {
            $storeCode = $this->storeManager->getStore()->getCode();
            $this->httpContext->setValue(StoreManagerInterface::CONTEXT_STORE, $storeCode, null);
        }
    }
}
