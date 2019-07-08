<?php
require_once('convert.php');

$wsdl = "https://ws.prooftag.com/AuthenticityService.asmx?WSDL"; // WSDL retrieve's Web Service's functions

$result = "";
$tagError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tagNumber = $_POST["tagNumber"];
    if (empty($tagNumber)) {
        $tagError = "MUST FILL";
    } else {
        try {
            $client = new SoapClient($wsdl, array('trace' => true)); // Creates new SoapClient w/ ability to DEBUG

            $params = array( // Array to convert
                'requestedData' => [
                    [
                        'dataType' => "TAG_NUMBER",
                        'dataValue' => $tagNumber
                    ],
                    [
                        'dataType' => "APP_ID",
                        'dataValue' => "01XXX01-XX02-4XXX-XX1A-334B0DA4XXXX" // Store into an environment variable for PROD.
                    ],
                    [
                        'dataType' => "CLIENT_IP",
                        'dataValue' => "255.255.255.255" // Store into an environment variable for PROD.
                    ],
                    [
                        'dataType' => "GET_BUBBLE",
                    ]
                ]
            );

            // TODO: Check if conditional info are required

            $data = new SimpleXMLElement('<request/>'); // Create XML element that is encapsulated w/ <request> tag
            $xml = array_to_xml($params, $data); // Converts param. array into XML
            $res = $client->GetSealData(array("XmlIn" => $xml)); // Call GetSealData function w/ XML as param.

            // START DEBUG | TODO: REMOVE BEFORE PROD.
            // echo ("<pre>");
            // echo $xml;
            // echo $client->__getLastRequest();
            // echo $res->GetSealDataResult; // TODO: Parse Web Service response

            // Retrieve XmlOut
            $xml = $res->GetSealDataResult;

            $xmlOut = xml_to_array($xml);
            if ($xmlOut->status == "ERROR") {
                $result = "Error: Server Error";
            } else if ($xmlOut->status == "END") {
                switch ($xmlOut->msg_id) {
                    case 1:
                    case 10:
                    case 11:
                        $tagError = "Error: Server Error";
                }
            }
            // END DEBUG
        } catch (Exception $error) {
            $tagError = "Error: Server Error";
        }
    }
}
