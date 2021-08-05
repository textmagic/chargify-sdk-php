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
     * Set first name
     *
     * @param string $firstName
     *
     * @return PaymentProfile
     */
    public function setFirstName(string $firstName)
    {
        $this->setParam('first_name', $firstName);

        return $this;
    }

    /**
     * Set last name
     *
     * @param string $lastName
     *
     * @return PaymentProfile
     */
    public function setLastName(string $lastName)
    {
        $this->setParam('last_name', $lastName);

        return $this;
    }

    /**
     * Set billing address
     *
     * @param string $billingAddress
     *
     * @return PaymentProfile
     */
    public function setBillingAddress(string $billingAddress)
    {
        $this->setParam('billing_address', $billingAddress);

        return $this;
    }

    /**
     * Set billing address 2
     *
     * @param string $billingAddress2
     *
     * @return PaymentProfile
     */
    public function setBillingAddress2(string $billingAddress2)
    {
        $this->setParam('billing_address_2', $billingAddress2);

        return $this;
    }

    /**
     * Set billing city
     *
     * @param string $billingCity
     *
     * @return PaymentProfile
     */
    public function setBillingCity(string $billingCity)
    {
        $this->setParam('billing_city', $billingCity);

        return $this;
    }

    /**
     * Set billing state
     *
     * @param string $billingState
     *
     * @return PaymentProfile
     */
    public function setBillingState(string $billingState)
    {
        $this->setParam('billing_state', $billingState);

        return $this;
    }

    /**
     * Set billing zip
     *
     * @param string $billingZip
     *
     * @return PaymentProfile
     */
    public function setBillingZip(string $billingZip)
    {
        $this->setParam('billing_zip', $billingZip);

        return $this;
    }

    /**
     * Set billing country
     *
     * @param string $billingCountry
     *
     * @return PaymentProfile
     */
    public function setBillingCountry(string $billingCountry)
    {
        $this->setParam('billing_country', $billingCountry);

        return $this;
    }

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
     * Get payment profile by Chargify ID
     *
     * @param int $id
     *
     * @return PaymentProfile
     */
    public function readByChargifyId($id)
    {
        $service = $this->getService();

        $response      = $service->request('payment_profiles/' . $id, 'GET');
        $responseArray = $this->getResponseArray($response);

        if (!$this->isError()) {
            $this->_data = $responseArray['payment_profile'];
        } else {
            $this->_data = array();
        }

        return $this;
    }

    /**
     * Update the payment profile record in Chargify.
     *
     * @param int $id
     *
     * @return PaymentProfile
     * @see PaymentProfile::setFirstName()
     * @see PaymentProfile::setLastName()
     * @see PaymentProfile::setBillingAddress()
     * @see PaymentProfile::setBillingAddress2()
     * @see PaymentProfile::setBillingCity()
     * @see PaymentProfile::setBillingState()
     * @see PaymentProfile::setBillingZip()
     * @see PaymentProfile::setBillingCountry()
     */
    public function update($id)
    {
        $service = $this->getService();

        $rawData       = $this->getRawData(array('payment_profile' => $this->getParams()));
        $response      = $service->request('payment_profiles/' . (int)$id, 'PUT', $rawData);
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