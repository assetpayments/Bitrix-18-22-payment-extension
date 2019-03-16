<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

		$order = CSaleOrder::GetByID($_GET['ORDER_ID']);
		$images_array = CFile::GetByID($_GET['ORDER_ID']);
		$images = $images_array->Fetch();
		$delivery = CSaleDelivery::GetByID($order['DELIVERY_ID']);
		$customer = CSaleOrderPropsValue::GetOrderProps($_GET['ORDER_ID']);
		$cart = CSaleBasket::GetList(Array("ID" => "ASC"), Array("ORDER_ID" => $_GET['ORDER_ID']));
		$products = $cart->arResult;
		
		//****URLS***//		
		$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
		$domain = $_SERVER['SERVER_NAME'];
		$url = $protocol .'://'. $domain;
		
		$ip = getenv('HTTP_CLIENT_IP')?:
			  getenv('HTTP_X_FORWARDED_FOR')?:
			  getenv('HTTP_X_FORWARDED')?:
			  getenv('HTTP_FORWARDED_FOR')?:
			  getenv('HTTP_FORWARDED')?:
			  getenv('REMOTE_ADDR');
			  
		//****Request mandatory variables****//	
		$option['TemplateId'] = CSalePaySystemAction::GetParamValue("ASSET_TEMPLATE_ID");
		$option['CustomMerchantInfo'] = 'Bitrix: ' .SM_VERSION;
		$option['MerchantInternalOrderId'] = $_GET['ORDER_ID'];
		$option['StatusURL'] = $url .'/bitrix/tools/assetpayments-callback.php';	
		$option['ReturnURL'] = $url .'/personal/orders/';
		$option['AssetPaymentsKey'] = CSalePaySystemAction::GetParamValue("ASSET_MERCHANT");
		$option['Amount'] = number_format($order['PRICE'], 2, '.', '');  	
		$option['Currency'] = $order['CURRENCY'];
		$option['IpAddress'] = $ip;
		
		//****Customer details and address****//
		$address = iconv('windows-1251', 'UTF-8', $customer->arResult[6]['PROXY_VALUE']);
		$city = iconv('windows-1251', 'UTF-8', $customer->arResult[5]['PROXY_VALUE']);		
		$zip = $customer->arResult[3]['PROXY_VALUE'];
		$country = iconv('windows-1251', 'UTF-8', GetCountryByID($customer->arResult[4]['PROXY_VALUE'], "ru"));
		$name = iconv('windows-1251', 'UTF-8', $customer->arResult[0]['PROXY_VALUE']);
		
		$option['FirstName'] = $name;
        $option['Email'] = $customer->arResult[1]['PROXY_VALUE'];
        $option['Phone'] = $customer->arResult[2]['PROXY_VALUE'];
        $option['Address'] = $address .', '. $city .', '. $zip .', '. $country;
		$option['CountryISO'] = 'RUS';

		//****Add products****//		
		foreach ($products as $product) {			
			$option['Products'][] = array(
				'ProductId' => $product['PRODUCT_ID'],
				'ProductName' => iconv('windows-1251', 'UTF-8', $product['NAME']),
				'ProductPrice' => round($product['PRICE'], 2),
				'ProductItemsNum' => (int)$product['QUANTITY'],
				'ImageUrl' => 'https://assetpayments.com/dist/css/images/product.png',
			);	
		}
		
		//****Add delivery****//		
		$option['Products'][] = array(
			'ProductId' => $order['DELIVERY_ID'],
			'ProductName' => iconv('windows-1251', 'UTF-8', $delivery['NAME']),
			'ProductPrice' => $order['PRICE_DELIVERY'],
			'ProductItemsNum' => 1,
			'ImageUrl' => 'https://assetpayments.com/dist/css/images/delivery.png',
		);
			
		$data = base64_encode( json_encode($option) );
		
		echo sprintf('
			<form method="POST" id="checkout" action="https://assetpayments.us/checkout/pay" accept-charset="utf-8">
				<input type="hidden" name="data" id="data" value='.$data.' /> 
			</form>'
		);
		echo "<script type=\"text/javascript\"> 
               window.onload=function(){
                    document.forms['checkout'].submit();
                }
			</script>";
?>
