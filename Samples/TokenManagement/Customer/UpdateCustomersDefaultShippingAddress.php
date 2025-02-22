<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../Resources/ExternalConfiguration.php';

function UpdateCustomersDefaultShippingAddress()
{
    $customerTokenId = 'AB695DA801DD1BB6E05341588E0A3BDC';
    $defaultShippingAddressArr = [
        "id" => "AB6A54B97C00FCB6E05341588E0A3935"
    ];
    $defaultShippingAddress = new CyberSource\Model\Tmsv2customersDefaultShippingAddress($defaultShippingAddressArr);

    $requestObjArr = [
        "defaultShippingAddress" => $defaultShippingAddress
    ];
    $requestObj = new CyberSource\Model\PatchCustomerRequest($requestObjArr);


    $commonElement = new CyberSource\ExternalConfiguration();
    $config = $commonElement->ConnectionHost();
    $merchantConfig = $commonElement->merchantConfigObject();

    $api_client = new CyberSource\ApiClient($config, $merchantConfig);
    $api_instance = new CyberSource\Api\CustomerApi($api_client);

    try {
        $apiResponse = $api_instance->patchCustomer($customerTokenId, $requestObj, null, null);
        print_r(PHP_EOL);
        print_r($apiResponse);

        return $apiResponse;
    } catch (Cybersource\ApiException $e) {
        print_r($e->getResponseBody());
        print_r($e->getMessage());
    }
}

if (!defined('DO_NOT_RUN_SAMPLES')) {
    UpdateCustomersDefaultShippingAddress();
}
?>
