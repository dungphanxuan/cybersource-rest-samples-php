<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../Resources/ExternalConfiguration.php';

function ElectronicCheckDebitsWithLegacyToken()
{
    $clientReferenceInformationArr = [
        "code" => "TC50171_3"
    ];
    $clientReferenceInformation = new CyberSource\Model\Ptsv2paymentsClientReferenceInformation($clientReferenceInformationArr);

    $paymentInformationLegacyTokenArr = [
        "id" => "AB7C01E66529EA42E05341588E0A22AD"
    ];
    $paymentInformationLegacyToken = new CyberSource\Model\Ptsv2paymentsPaymentInformationLegacyToken($paymentInformationLegacyTokenArr);

    $paymentInformationPaymentTypeArr = [
        "name" => "CHECK"
    ];
    $paymentInformationPaymentType = new CyberSource\Model\Ptsv2paymentsPaymentInformationPaymentType($paymentInformationPaymentTypeArr);

    $paymentInformationArr = [
        "legacyToken" => $paymentInformationLegacyToken,
        "paymentType" => $paymentInformationPaymentType
    ];
    $paymentInformation = new CyberSource\Model\Ptsv2paymentsPaymentInformation($paymentInformationArr);

    $orderInformationAmountDetailsArr = [
        "totalAmount" => "100",
        "currency" => "USD"
    ];
    $orderInformationAmountDetails = new CyberSource\Model\Ptsv2paymentsOrderInformationAmountDetails($orderInformationAmountDetailsArr);

    $orderInformationBillToArr = [
        "firstName" => "John",
        "lastName" => "Doe",
        "address1" => "1 Market St",
        "locality" => "san francisco",
        "administrativeArea" => "CA",
        "postalCode" => "94105",
        "country" => "US",
        "email" => "test@cybs.com"
    ];
    $orderInformationBillTo = new CyberSource\Model\Ptsv2paymentsOrderInformationBillTo($orderInformationBillToArr);

    $orderInformationArr = [
        "amountDetails" => $orderInformationAmountDetails,
        "billTo" => $orderInformationBillTo
    ];
    $orderInformation = new CyberSource\Model\Ptsv2paymentsOrderInformation($orderInformationArr);

    $requestObjArr = [
        "clientReferenceInformation" => $clientReferenceInformation,
        "paymentInformation" => $paymentInformation,
        "orderInformation" => $orderInformation
    ];
    $requestObj = new CyberSource\Model\CreatePaymentRequest($requestObjArr);


    $commonElement = new CyberSource\ExternalConfiguration();
    $config = $commonElement->ConnectionHost();
    $merchantConfig = $commonElement->merchantConfigObject();

    $api_client = new CyberSource\ApiClient($config, $merchantConfig);
    $api_instance = new CyberSource\Api\PaymentsApi($api_client);

    try {
        $apiResponse = $api_instance->createPayment($requestObj);
        print_r(PHP_EOL);
        print_r($apiResponse);

        return $apiResponse;
    } catch (Cybersource\ApiException $e) {
        print_r($e->getResponseBody());
        print_r($e->getMessage());
    }
}

if (!defined('DO_NOT_RUN_SAMPLES')) {
    echo "\nElectronicCheckDebitsWithLegacyToken Sample Code is Running..." . PHP_EOL;
    ElectronicCheckDebitsWithLegacyToken();
}
?>
