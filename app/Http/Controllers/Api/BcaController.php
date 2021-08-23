<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BcaController extends Controller
{
  public function getToken()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://devapi.klikbca.com:9443/api/oauth/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic ZTMwNWE3NmEtNzhkMy00ZjkyLWI3MzQtYzIzYWU1OGM5N2Q4OjA0MDMxNzQzLTk2NDUtNGJjNy04NGU1LWM4OTQzNjE4YzJjOA==',
        'grant_type: client_credentials',
        'Content-Type: application/x-www-form-urlencoded',
        'Cookie: cookie-api-gateway=ffffffff091cfc5c45525d5f4f58455e445a4a4229b1'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return response()->json($response);
  }

  public function validationBca($token, $account_name, $account_number, $timestamp)
  {
    $access_token = $token;
    $apiKey = "a16c5bb4-49d1-4a12-9194-db3df367d893";
    $apiSecret = "2ad77de8-7f0e-4379-bce5-71d70529a611";
    $accountName = rawurlencode($account_name);
    $accountNumber = $account_number;
    $httpMethod = "GET";
    $now = microtime(true);
    $timestamp = gmdate('Y-m-d\TH:i:s', $now) . sprintf('.%03dZ', round(($now - floor($now)) * 1000));
    //$timestamp = $timestamp;
    $requestBody = "e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855";
    $baseUrl = "https://devapi.klikbca.com:9443";
    $relativeUrl = "/banking/general/corporates/UATCORP001/accounts/" . $accountNumber . "/validation?Action=validate&By=name&Value=" . $accountName;
    $examineUri = $baseUrl . $relativeUrl;
    $stringToSign =
      $httpMethod .
      ":" .
      $relativeUrl .
      ":" .
      $access_token .
      ":" .
      $requestBody .
      ":" .
      $timestamp;
    $signature = hash_hmac('sha256', $stringToSign, $apiSecret);

    //return response()->json($timestamp);
    //return response()->json($accountName);

    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $examineUri,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json',
        'X-BCA-Key: ' . $apiKey,
        'X-BCA-Timestamp: ' . $timestamp,
        'X-BCA-Signature: ' . $signature,
      ),
    ));

    $response = curl_exec($curl);
    $response = preg_replace("/\r|\n/", "", $response);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);
    //echo $response;

    return $response;
  }
}
