<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../Resources/ExternalConfiguration.php';

function CanadianBillingDetails()
{
    $clientReferenceInformationArr = [
        "code" => "addressEg",
        "comments" => "dav-All fields"
    ];
    $clientReferenceInformation = new CyberSource\Model\Riskv1decisionsClientReferenceInformation($clientReferenceInformationArr);

    $orderInformationBillToArr = [
        "address1" => "1650 Burton Ave",
        "address2" => "",
        "address3" => "",
        "address4" => "",
        "administrativeArea" => "BC",
        "country" => "CA",
        "locality" => "VICTORIA",
        "postalCode" => "V8T 2N6"
    ];
    $orderInformationBillTo = new CyberSource\Model\Riskv1addressverificationsOrderInformationBillTo($orderInformationBillToArr);

    $orderInformationLineItems = array();
    $orderInformationLineItems_0 = [
        "unitPrice" => "120.50",
        "quantity" => 3,
        "productSKU" => "9966223",
        "productName" => "headset",
        "productCode" => "electronic"
    ];
    $orderInformationLineItems[0] = new CyberSource\Model\Riskv1addressverificationsOrderInformationLineItems($orderInformationLineItems_0);

    $orderInformationArr = [
        "billTo" => $orderInformationBillTo,
        "lineItems" => $orderInformationLineItems
    ];
    $orderInformation = new CyberSource\Model\Riskv1addressverificationsOrderInformation($orderInformationArr);

    $buyerInformationArr = [
        "merchantCustomerId" => "ABCD"
    ];
    $buyerInformation = new CyberSource\Model\Riskv1addressverificationsBuyerInformation($buyerInformationArr);

    $requestObjArr = [
        "clientReferenceInformation" => $clientReferenceInformation,
        "orderInformation" => $orderInformation,
        "buyerInformation" => $buyerInformation
    ];
    $requestObj = new CyberSource\Model\VerifyCustomerAddressRequest($requestObjArr);


    $commonElement = new CyberSource\ExternalConfiguration();
    $config = $commonElement->ConnectionHost();
    $merchantConfig = $commonElement->merchantConfigObject();

    $api_client = new CyberSource\ApiClient($config, $merchantConfig);
    $api_instance = new CyberSource\Api\VerificationApi($api_client);

    try {
        $apiResponse = $api_instance->verifyCustomerAddress($requestObj);
        print_r(PHP_EOL);
        print_r($apiResponse);

        return $apiResponse;
    } catch (Cybersource\ApiException $e) {
        print_r($e->getResponseBody());
        print_r($e->getMessage());
    }
}

if (!defined('DO_NOT_RUN_SAMPLES')) {
    echo "\nCanadianBillingDetails Sample Code is Running..." . PHP_EOL;
    CanadianBillingDetails();
}
?>
