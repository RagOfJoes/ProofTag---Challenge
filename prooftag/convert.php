<?php
// Converts assoc. array into XML
function array_to_xml($data, $xml_data)
{
    foreach ($data as $key => $value) { // Iterates through each Key, Value Pair 
        if (is_array($value)) { // If nested then recursively run through array
            $key = is_numeric($key) ? 'requestedDataDetail' : $key; // When duplicate keys exist replace w/ 'requestDateDetail'
            $subnode = $xml_data->addChild("$key"); // Creates new XML tag w/ appropriate key
            array_to_xml($value, $subnode); // Recursive call
        } else {
            $key = $key;
            $xml_data->addChild("$key", "$value");
        }
    }
    return $xml_data->asXML();
}

function xml_to_array($xml)
{
    // Convert XML to String
    $string = simplexml_load_string($xml);

    // Convert to JSON
    $json = json_encode($string);

    // Converts JSON to Associative Array
    return json_decode($json);;
}
