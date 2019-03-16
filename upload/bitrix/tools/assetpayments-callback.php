<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") die();
if (!require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php")) die('prolog_before.php not found!');

if (CModule::IncludeModule('sale')) {
    $json = json_decode(file_get_contents('php://input'), true);

    //****Get callback variables****//
	$order_id = $json['Order']['OrderId'];
	$transactionId = $json['Payment']['TransactionId'];		
	$amount = $json['Order']['Amount'];
	$currency = $json['Order']['Currency'];
	$status = $json['Payment']['StatusCode'];
	$status_desc = $json['Payment']['Status'];
	
	//****Access to config file****//
	$arOrder = CSaleOrder::GetByID($order_id);
	CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);
	$key = CSalePaySystemAction::GetParamValue("ASSET_MERCHANT");
	$secret = CSalePaySystemAction::GetParamValue("ASSET_SECURE_KEY");
	
	//****Check signature****//
	$signature = $json['Payment']['Signature'];
	$requestSign =$key.':'.$transactionId.':'.strtoupper($secret);
	$sign = hash_hmac('md5',$requestSign,$secret);
	
	if ($status == 1 && $sign == $signature) {
			
		$arFields = array(
			"PS_STATUS" => "Y",
			"PS_STATUS_CODE" => $status,
			"PS_STATUS_DESCRIPTION" => $status_desc,
			"PS_STATUS_MESSAGE" => 'Successful transaction # ' .$transactionId ,
			"PS_SUM" => $amount,
			"PS_CURRENCY" => $currency,
			"PS_RESPONSE_DATE" => Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG))),
			"USER_ID" => $arOrder["USER_ID"]
		);
					
		$arFields["PAYED"] = "Y";
		$arFields["DATE_PAYED"] = Date(CDatabase::DateFormatToPHP(CLang::GetDateFormat("FULL", LANG)));
		$arFields["EMP_PAYED_ID"] = false;

		if (CSaleOrder::Update($arOrder["ID"], $arFields))
		{
			if ($err == '')
			{
				echo 'Ok';
			}
		}else{
			$err = 'Error on update order';
		}			
	} 
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");

?>