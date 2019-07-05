<?php
require_once('./convert.php');

$wsdl = "https://ws.prooftag.com/AuthenticityService.asmx?WSDL"; // WSDL retrieve's Web Service's functions

// TODO: Retieve TAG_NUMBER from <form>
try {
    $client = new SoapClient($wsdl, array('trace' => true)); // Creates new SoapClient w/ ability to DEBUG

    $params = array( // Array to convert
        'requestedData' => [
            [
                'dataType' => "TAG_NUMBER",
                'dataValue' => "0PA00AAAB46602"
            ],
            [
                'dataType' => "APP_ID",
                'dataValue' => "120480"
            ],
            [
                'dataType' => "CLIENT_IP",
                'dataValue' => "255.255.255.255"
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
    echo ("<pre>");
    echo $xml;
    echo $client->__getLastRequest();
    echo $res->GetSealDataResult; // TODO: Parse Web Service response
    // END DEBUG
} catch (Exception $error) {
    echo $error;
}
