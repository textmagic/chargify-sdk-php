<?php

/**
 * Copyright 2011 Crucial Web Studio, LLC or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * https://raw.githubusercontent.com/chargely/chargify-sdk-php/master/LICENSE.md
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Crucial\Service\Chargify;

class PricePoint extends AbstractEntity
{
    /**
     * Boolean, default false. If true is passed, retrieved prices for all currencies.
     *
     * @param bool $currencyPrices
     *
     * @return PricePoint
     */
    public function setCurrencyPrices($currencyPrices = false)
    {
        $this->setParam('currency_prices', $currencyPrices ? 'true' : 'false');

        return $this;
    }

    /**
     * List all products price points
     *
     * @see  Product::setCurrencyPrices()
     *
     * @return PricePoint
     */
    public function listProductPricePoints($id)
    {
        $service = $this->getService();

        $response      = $service->request('products/' . $id . '/price_points', 'GET', NULL, $this->getParams());
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $responseArray['price_points'];
        } else {
            $this->_data = array();
        }

        return $this;
    }
}