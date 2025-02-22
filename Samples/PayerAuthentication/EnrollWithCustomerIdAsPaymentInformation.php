<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../vendor/autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../Resources/ExternalConfiguration.php';

function EnrollWithCustomerIdAsPaymentInformation()
{
    $clientReferenceInformationArr = [
        "code" => "UNKNOWN"
    ];
    $clientReferenceInformation = new CyberSource\Model\Riskv1decisionsClientReferenceInformation($clientReferenceInformationArr);

    $orderInformationAmountDetailsArr = [
        "currency" => "USD",
        "totalAmount" => "10.99"
    ];
    $orderInformationAmountDetails = new CyberSource\Model\Riskv1authenticationsOrderInformationAmountDetails($orderInformationAmountDetailsArr);

    $orderInformationBillToArr = [
        "address1" => "1 Market St",
        "address2" => "Address 2",
        "administrativeArea" => "CA",
        "country" => "US",
        "locality" => "san francisco",
        "firstName" => "John",
        "lastName" => "Doe",
        "phoneNumber" => "4158880000",
        "email" => "test@cybs.com",
        "postalCode" => "94105"
    ];
    $orderInformationBillTo = new CyberSource\Model\Riskv1authenticationsOrderInformationBillTo($orderInformationBillToArr);

    $orderInformationArr = [
        "amountDetails" => $orderInformationAmountDetails,
        "billTo" => $orderInformationBillTo
    ];
    $orderInformation = new CyberSource\Model\Riskv1authenticationsOrderInformation($orderInformationArr);

    $paymentInformationCustomerArr = [
        "customerId" => "AB695DA801DD1BB6E05341588E0A3BDC"
    ];
    $paymentInformationCustomer = new CyberSource\Model\Ptsv2paymentsPaymentInformationCustomer($paymentInformationCustomerArr);

    $paymentInformationArr = [
        "customer" => $paymentInformationCustomer
    ];
    $paymentInformation = new CyberSource\Model\Riskv1authenticationsPaymentInformation($paymentInformationArr);

    $requestObjArr = [
        "clientReferenceInformation" => $clientReferenceInformation,
        "orderInformation" => $orderInformation,
        "paymentInformation" => $paymentInformation
    ];
    $requestObj = new CyberSource\Model\CheckPayerAuthEnrollmentRequest($requestObjArr);


    $commonElement = new CyberSource\ExternalConfiguration();
    $config = $commonElement->ConnectionHost();
    $merchantConfig = $commonElement->merchantConfigObject();

    $api_client = new CyberSource\ApiClient($config, $merchantConfig);
    $api_instance = new CyberSource\Api\PayerAuthenticationApi($api_client);

    try {
        $apiResponse = $api_instance->checkPayerAuthEnrollment($requestObj);
        print_r(PHP_EOL);
        print_r($apiResponse);

        return $apiResponse;
    } catch (Cybersource\ApiException $e) {
        print_r($e->getResponseBody());
        print_r($e->getMessage());
    }
}

if (!defined('DO_NOT_RUN_SAMPLES')) {
    echo "\nEnrollWithCustomerIdAsPaymentInformation Sample Code is Running..." . PHP_EOL;
    EnrollWithCustomerIdAsPaymentInformation();
}
?>
