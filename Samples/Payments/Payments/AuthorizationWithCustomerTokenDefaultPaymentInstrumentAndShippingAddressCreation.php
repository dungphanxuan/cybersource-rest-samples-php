<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../vendor/autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../Resources/ExternalConfiguration.php';

function AuthorizationWithCustomerTokenDefaultPaymentInstrumentAndShippingAddressCreation()
{
	$clientReferenceInformationArr = [
			"code" => "TC50171_3"
	];
	$clientReferenceInformation = new CyberSource\Model\Ptsv2paymentsClientReferenceInformation($clientReferenceInformationArr);

	$processingInformationActionList = array();
	$processingInformationActionList[0] = "TOKEN_CREATE";
	$processingInformationActionTokenTypes = array();
	$processingInformationActionTokenTypes[0] = "paymentInstrument";
	$processingInformationActionTokenTypes[1] = "shippingAddress";
	$processingInformationArr = [
			"actionList" => $processingInformationActionList,
			"actionTokenTypes" => $processingInformationActionTokenTypes,
			"capture" => false
	];
	$processingInformation = new CyberSource\Model\Ptsv2paymentsProcessingInformation($processingInformationArr);

	$paymentInformationCardArr = [
			"number" => "4111111111111111",
			"expirationMonth" => "12",
			"expirationYear" => "2031",
			"securityCode" => "123"
	];
	$paymentInformationCard = new CyberSource\Model\Ptsv2paymentsPaymentInformationCard($paymentInformationCardArr);

	$paymentInformationCustomerArr = [
			"id" => "AB695DA801DD1BB6E05341588E0A3BDC"
	];
	$paymentInformationCustomer = new CyberSource\Model\Ptsv2paymentsPaymentInformationCustomer($paymentInformationCustomerArr);

	$paymentInformationArr = [
			"card" => $paymentInformationCard,
			"customer" => $paymentInformationCustomer
	];
	$paymentInformation = new CyberSource\Model\Ptsv2paymentsPaymentInformation($paymentInformationArr);

	$orderInformationAmountDetailsArr = [
			"totalAmount" => "102.21",
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
			"email" => "test@cybs.com",
			"phoneNumber" => "4158880000"
	];
	$orderInformationBillTo = new CyberSource\Model\Ptsv2paymentsOrderInformationBillTo($orderInformationBillToArr);

	$orderInformationShipToArr = [
			"firstName" => "John",
			"lastName" => "Doe",
			"address1" => "1 Market St",
			"locality" => "san francisco",
			"administrativeArea" => "CA",
			"postalCode" => "94105",
			"country" => "US"
	];
	$orderInformationShipTo = new CyberSource\Model\Ptsv2paymentsOrderInformationShipTo($orderInformationShipToArr);

	$orderInformationArr = [
			"amountDetails" => $orderInformationAmountDetails,
			"billTo" => $orderInformationBillTo,
			"shipTo" => $orderInformationShipTo
	];
	$orderInformation = new CyberSource\Model\Ptsv2paymentsOrderInformation($orderInformationArr);

	$tokenInformationPaymentInstrumentArr = [
			"_default" => true
	];
	$tokenInformationPaymentInstrument = new CyberSource\Model\Ptsv2paymentsTokenInformationPaymentInstrument($tokenInformationPaymentInstrumentArr);

	$tokenInformationShippingAddressArr = [
			"_default" => true
	];
	$tokenInformationShippingAddress = new CyberSource\Model\Ptsv2paymentsTokenInformationShippingAddress($tokenInformationShippingAddressArr);

	$tokenInformationArr = [
			"paymentInstrument" => $tokenInformationPaymentInstrument,
			"shippingAddress" => $tokenInformationShippingAddress
	];
	$tokenInformation = new CyberSource\Model\Ptsv2paymentsTokenInformation($tokenInformationArr);

	$requestObjArr = [
			"clientReferenceInformation" => $clientReferenceInformation,
			"processingInformation" => $processingInformation,
			"paymentInformation" => $paymentInformation,
			"orderInformation" => $orderInformation,
			"tokenInformation" => $tokenInformation
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

if(!defined('DO_NOT_RUN_SAMPLES')){
	echo "\nAuthorizationWithCustomerTokenDefaultPaymentInstrumentAndShippingAddressCreation Sample Code is Running..." . PHP_EOL;
	AuthorizationWithCustomerTokenDefaultPaymentInstrumentAndShippingAddressCreation();
}
?>
