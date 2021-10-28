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

class Invoice extends AbstractEntity
{
    /**
     * List all products for your site
     *
     * @return Invoice
     */
    public function listInvoices(array $params = [])
    {
        $service = $this->getService();

        $response      = $service->request('invoices', 'GET', null, $params);
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $responseArray['invoices'];
        } else {
            $this->_data = array();
        }

        return $this;
    }

    public function readByChargifyId($id)
    {
        $service = $this->getService();

        $response      = $service->request('invoices/' . $id, 'GET');
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $responseArray;
        } else {
            $this->_data = array();
        }

        return $this;
    }
}