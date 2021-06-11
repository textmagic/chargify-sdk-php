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

class PaymentProfile extends AbstractEntity
{
    /**
     * Set customer id
     *
     * @param int $customerId
     *
     * @return PaymentProfile
     */
    public function setCustomerId(int $customerId)
    {
        $this->setParam('customer_id', $customerId);

        return $this;
    }

    /**
     * Set Chargify token retrieved from Chargify.js
     *
     * @param string $chargifyToken
     *
     * @return PaymentProfile
     */
    public function setChargifyToken(string $chargifyToken)
    {
        $this->setParam('chargify_token', $chargifyToken);

        return $this;
    }

    /**
     * The page number and number of results used for pagination. By default
     * results are paginated 20 per page.
     *
     * @param int $page
     * @param int $perPage
     *
     * @return PaymentProfile
     */
    public function setPagination($page, $perPage)
    {
        $this->setParam('page', $page);
        $this->setParam('per_page', $perPage);

        return $this;
    }

    /**
     * Create a new payment profile from Chargify.js token.
     *
     * @return PaymentProfile
     * @see  PaymentProfile::setCustomerId()
     * @see  PaymentProfile::setChargifyToken()
     */
    public function create()
    {
        $service = $this->getService();
        $rawData = $this->getRawData(array('payment_profile' => $this->_params));
        $response = $service->request('payment_profiles', 'POST', $rawData);
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $responseArray['payment_profile'];
        } else {
            $this->_data = array();
        }

        return $this;
    }

    /**
     * Delete payment profile by given id
     *
     * @param int $id
     *
     * @return PaymentProfile
     */
    public function delete($id)
    {
        $service = $this->getService();

        $response = $service->request('payment_profiles/' . (int)$id, 'DELETE', null);
        $this->getResponseArray($response);

        $this->_data = array();

        return $this;
    }

    /**
     * Retrieve transactions for your entire site
     *
     * @return PaymentProfile
     * @see PaymentProfile:setCustomerId()
     * @see PaymentProfile::setPagination()
     */
    public function listPaymentProfiles()
    {
        $service = $this->getService();

        $response = $service->request('payment_profiles', 'GET', NULL, $this->getParams());

        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $this->_normalizeResponseArray($responseArray);
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
        foreach ($responseArray as $prof) {
            $return[] = $prof['payment_profile'];
        }

        return $return;
    }
}