<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) 
  die();

include(GetLangFileName(dirname(__FILE__)."/", "/description.php"));

$psTitle = "AssetPayments";
$psDescription = "<a href=\"https://assetpayments.com\" target=\"_blank\">https://assetpayments.com</a>";

$arPSCorrespondence = array(
    "ASSET_MERCHANT" => array(
        "NAME" => GetMessage("ASSETPAYMENTS_MERCHANT"),
        "DESCR" => GetMessage("ASSETPAYMENTS_MERCHANT_DESC"),
        "VALUE" => "",
        "TYPE" => ""
    ),
    "ASSET_SECRET_KEY" => array(
        "NAME" => GetMessage("ASSETPAYMENTS_SECURE_KEY"),
        "DESCR" => GetMessage("ASSETPAYMENTS_SECURE_KEY"),
        "VALUE" => "",
        "TYPE" => ""
    ),
    "ASSET_TEMPLATE_ID" => array(
        "NAME" => GetMessage("ASSETPAYMENTS_TEMPLATE_ID"),
        "DESCR" => GetMessage("ASSETPAYMENTS_DESC_TEMPLATE_ID"),
        "VALUE" => "19",
        "TYPE" => ""
    ),
);
?>