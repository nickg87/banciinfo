<?php
	/*
	 * example2.php
	 * 
	 * This file is provided as an example for the included Live Update class.
	 *
	 */

 
	 

	$myKey 			= "#|p*?a~U2T9Q[6[Se7e^";							//set the secret key
	$myLiveUpdate 	= new LiveUpdate($myKey);					//instantiate the class
 
	$myId			= "MCRSYST";
	$myLiveUpdate->setMerchant($myId);

	$myOrderRef	= "TEST-1";
	$myLiveUpdate->setOrderRef($myOrderRef);

	$myOrderDate = "2005-09-10 10:30:30";
	$myLiveUpdate->setOrderDate($myOrderDate);

	$PName		= array();										//products name array
	
	foreach($_SESSION[cart] as $k => $v) {
	$PName[]	= $v[produs];							 
   } 
    							 
	$myLiveUpdate->setOrderPName($PName);

	$PCode		= array();										//products code array
	 
	foreach($_SESSION[cart] as $k => $v) {
	$PCode[]	= ' s'.$v[produs_cod];					 
   }
	
	$myLiveUpdate->setOrderPCode($PCode);

	 

	$PPrice		= array();										//products price array
	foreach($_SESSION[cart] as $k => $v) {
	$PPrice[]	= $v[pret];					 
   } 
 
	$myLiveUpdate->setOrderPrice($PPrice);

	$PQTY		= array();										//products qty array
	 foreach($_SESSION[cart] as $k => $v) {
	$PQTY[]		= $v[cant];					 
   } 
	 
	$myLiveUpdate->setOrderQTY($PQTY);

	$PVAT		= array();										//products vat array
	 foreach($_SESSION[cart] as $k => $v) {
	$PVAT[]			= 0;					 
   } 
	 
	$myLiveUpdate->setOrderVAT($PVAT);

	//$PShipping = 0.145;
	//$myLiveUpdate->setOrderShipping($PShipping);
	$PShipping = 0;
	$myLiveUpdate->setOrderShipping($PShipping);

	 
	 $PCurrency = "RON";
	 $myLiveUpdate->setPricesCurrency($PCurrency);

	$PDestinationCity = "Iasi";
	$myLiveUpdate->setDestinationCity($PDestinationCity);

	$PDestinationState = "Iasi";
	$myLiveUpdate->setDestinationState($PDestinationState);

	$PDestinantionCountryCode = 'RO';
	$myLiveUpdate->setDestinationCountry($PDestinantionCountryCode);

	$PPayMethod = 'CCVISAMC';
	$myLiveUpdate->setPayMethod($PPayMethod);

	$billing = array(
		"billFName"				=> 'John',
		"billLName"				=> 'Doe',
		"billCISerial"			=> 'EP',
		"billCINumber"			=> '123456',
		"billCIIssuer"			=> '',
		"billCNP"				=> '',
		"billCompany"			=> '',
		"billFiscalCode" 		=> '',
		"billRegNumber" 		=> '',
		"billBank" 				=> '',
		"billBankAccount" 		=> '',
		"billEmail" 			=> 'john@doe.com',
		"billPhone" 			=> '0243236298',
		"billFax" 				=> '0243236298',
		"billAddress1"			=> 'address 1',
		"billAddress2"			=> 'address 2',
		"billZipCode"			=> '030301',
		"billCity"				=> 'Iasi',
		"billState"				=> 'Iasi',
		"billCountryCode"		=> 'RO'
	);
	$myLiveUpdate->setBilling($billing);

	$delivery = array(
		"deliveryFName"			=> 'John',
		"deliveryLName"			=> 'Doe',
		"deliveryCompany"		=> 'Example. INC',
		"deliveryPhone"			=> '02',
		"deliveryAddress1"		=> 'address 1',
		"deliveryAddress2"		=> 'address 2',
		"deliveryZipCode"		=> '33556',
		"deliveryCity"			=> 'Bucuresti',
		"deliveryState"			=> 'Ilfov',
		"deliveryCountryCode"	=> 'EN'
	);
	$myLiveUpdate->setDelivery($delivery);

	$PLanguage = 'ro';
	$myLiveUpdate->setLanguage($PLanguage);

	$myLiveUpdate->setTestMode(true);

	?><form name="frmForm" action="<?=$myLiveUpdate->liveUpdateURL?>" method="post"><?
	echo $myLiveUpdate->getLiveUpdateHTML();
	?><input type="submit"></form><?
?>