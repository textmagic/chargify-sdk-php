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

class Product extends AbstractEntity
{
    /**
     * Boolean, default false. If true is passed, retrieved all products.
     *
     * @param bool $includeArchived
     *
     * @return Product
     */
    public function setIncludeArchived($includeArchived = false)
    {
        $this->setParam('include_archived', $includeArchived ? 'true' : 'false');

        return $this;
    }

    /**
     * List all products for your site
     *
     * @return Product
     */
    public function listProducts()
    {
        $service = $this->getService();

        $response      = $service->request('products', 'GET');
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $this->_normalizeResponseArray($responseArray);
        } else {
            $this->_data = array();
        }

        return $this;
    }

    /**
     * List all products for your site by product family
     *
     * @return Product
     */
    public function listProductsFamily($productFamilyId)
    {
        $service = $this->getService();

        $response      = $service->request('product_families/' . $productFamilyId . '/products', 'GET', NULL, $this->getParams());
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $this->_normalizeResponseArray($responseArray);
        } else {
            $this->_data = array();
        }

        return $this;
    }

    /**
     * Get product details by Chargify ID
     *
     * @param int $id
     *
     * @return Product
     */
    public function readByChargifyId($id)
    {
        $service = $this->getService();

        $response      = $service->request('products/' . $id, 'GET');
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $responseArray['product'];
        } else {
            $this->_data = array();
        }

        return $this;
    }

    /**
     * Get product details by API handle
     *
     * @param string $handle
     *
     * @return Product
     */
    public function readByHandle($handle)
    {
        $service = $this->getService();

        $response      = $service->request('products/handle/' . $handle, 'GET');
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $responseArray['product'];
        } else {
            $this->_data = array();
        }

        return $this;
    }

    /**
     * This normalizes the array for us so we can rely on a consistent structure.
     *
     * @param array $responseArray
     *
     * @return array
     */
    protected function _normalizeResponseArray($responseArray)
    {
        $return = array();
        foreach ($responseArray as $prod) {
            $return[] = $prod['product'];
        }

        return $return;
    }
}