<?php
	
	

    $accessToken = 'BAE/tNsRpxyb/W1gf+R9fISBYIbW9CG3t0kWfe882V5CaWpqFn1ElTWkWhHEOo59hddigwwRPRzJ0cZtyXXBpaKjKiqdwQbNrGUMYGu3YgLZkctGd4nqCxYXnAcF/PvEkPZDLYBGw23vKXpGdEyINgdB04t89/1O/w1cDnyilFU=';
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
	
	$all_data = getData();
	$data = array_column($all_data,$message);
	$c = count($data);
	if($c > 0)
	{
		$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
		/*
		$arrayPostData['messages'][$index]['type'] = "text";
		$arrayPostData['messages'][$index]['text'] = 
			"SAP Material         : " . $data[0]["SAP Material"]
			. "\n" . "Description          : " . $data[0]["Description"]
			. "\n" . "Storage Location     : " . $data[0]["Storage Location"]
			. "\n" . "Storage Bin          : " . $data[0]["Storage Bin"]
			. "\n" . "Type                 : " . $data[0]["Type"]
			. "\n" . "Group                : " . $data[0]["Group"]
			. "\n" . "Old Material         : " . $data[0]["Old Material"]
			. "\n" . "Model / Part Number  : " . $data[0]["Model / Part Number"]
			. "\n" . "Contractual Q'ty     : " . $data[0]["Contractual Q'ty"]
			. "\n" . "Supplementary Q'ty   : " . $data[0]["Supplementary Q'ty"]
			. "\n" . "Warranty Q'ty        : " . $data[0]["Warranty Q'ty"]
			. "\n" . "Unrestricted use     : " . $data[0]["Unrestricted use"]
			. "\n" . "Blocked              : " . $data[0]["Blocked"]
			. "\n" . "In Qual. Insp.       : " . $data[0]["In Qual. Insp."];
		*/
		for ($item = 0; $item < $c; $item++) {
			$arrayPostData['messages'][$item]['type'] = "text";
			$arrayPostData['messages'][$item]['text'] = "1";
				/*
			$item == 0 ? "" : "\n"
			. "SAP Material         : " . $data[$item]["SAP Material"]
			. "\n" . "Description          : " . $data[$item]["Description"]
			. "\n" . "Storage Location     : " . $data[$item]["Storage Location"]
			. "\n" . "Storage Bin          : " . $data[$item]["Storage Bin"]
			. "\n" . "Type                 : " . $data[$item]["Type"]
			. "\n" . "Group                : " . $data[$item]["Group"]
			. "\n" . "Old Material         : " . $data[$item]["Old Material"]
			. "\n" . "Model / Part Number  : " . $data[$item]["Model / Part Number"]
			. "\n" . "Contractual Q'ty     : " . $data[$item]["Contractual Q'ty"]
			. "\n" . "Supplementary Q'ty   : " . $data[$item]["Supplementary Q'ty"]
			. "\n" . "Warranty Q'ty        : " . $data[$item]["Warranty Q'ty"]
			. "\n" . "Unrestricted use     : " . $data[$item]["Unrestricted use"]
			. "\n" . "Blocked              : " . $data[$item]["Blocked"]
			. "\n" . "In Qual. Insp.       : " . $data[$item]["In Qual. Insp."];
			*/
		}
		replyMsg($arrayHeader,$arrayPostData);
	}else
	{
		$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "11538";
        $arrayPostData['messages'][0]['stickerId'] = "51626526";
        replyMsg($arrayHeader,$arrayPostData);
	}
	
		
	function replyMsg($arrayHeader,$arrayPostData)
	{
		$strUrl = "https://api.line.me/v2/bot/message/reply";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$strUrl);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
		curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($ch);
		curl_close ($ch);
	}
	
	function getData()
	{
		return array(			
 array("11100000" => array("SAP Material"=> "11100000","Description"=> "Door Closer   Assa Abloy    U8001-6-DA","Storage Location"=> "AIRC","Storage Bin"=> "42_04_02","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP001","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100000" => array("SAP Material"=> "11100000","Description"=> "Door Closer   Assa Abloy    U8001-6-DA","Storage Location"=> "PAST","Storage Bin"=> "","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP001","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100001" => array("SAP Material"=> "11100001","Description"=> "Door Closer  Assa Abloy  U8001-6-DA-SLD","Storage Location"=> "AIRC","Storage Bin"=> "42_05_02","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP002","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "5","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100001" => array("SAP Material"=> "11100001","Description"=> "Door Closer  Assa Abloy  U8001-6-DA-SLD","Storage Location"=> "PAST","Storage Bin"=> "","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP002","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100002" => array("SAP Material"=> "11100002","Description"=> "Door Closer (floor) GEZE","Storage Location"=> "AIRC","Storage Bin"=> "42_04_02","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP003","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "10","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100002" => array("SAP Material"=> "11100002","Description"=> "Door Closer (floor) GEZE","Storage Location"=> "PAST","Storage Bin"=> "","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP003","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100003" => array("SAP Material"=> "11100003","Description"=> "Hinge Support  ( Heavy Duty Hinge )","Storage Location"=> "PAST","Storage Bin"=> "","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP004","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100004" => array("SAP Material"=> "11100004","Description"=> "Lock Set  Heavy Duty Deadlock","Storage Location"=> "PAST","Storage Bin"=> "","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP005","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100005" => array("SAP Material"=> "11100005","Description"=> "Lock Set Multipoint Locking","Storage Location"=> "PAST","Storage Bin"=> "","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP006","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100006" => array("SAP Material"=> "11100006","Description"=> "Lock Set Latch Lever","Storage Location"=> "AIRC","Storage Bin"=> "42_01_02","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP007","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "12","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100006" => array("SAP Material"=> "11100006","Description"=> "Lock Set Latch Lever","Storage Location"=> "PAST","Storage Bin"=> "","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP007","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100007" => array("SAP Material"=> "11100007","Description"=> "Lock Set Heavy Duty Lock","Storage Location"=> "PAST","Storage Bin"=> "","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP008","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "0","Blocked"=> "0","In Qual. Insp."=> "0")),
 array("11100008" => array("SAP Material"=> "11100008","Description"=> "Lock Set Latch Lever M","Storage Location"=> "AIRC","Storage Bin"=> "42_01_02","Type"=> "ZSP1","Group"=> "1111","Old Material"=> "CIVSP009","Model / Part Number"=> "","Contractual Q'ty"=> "","Supplementary Q'ty"=> "","Warranty Q'ty"=> "","Unrestricted use"=> "12","Blocked"=> "0","In Qual. Insp."=> "0"))
		);
	}

	exit;
?>
