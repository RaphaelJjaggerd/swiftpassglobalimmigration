<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class UserLocationController extends Controller {
  public function getUserInfo(Request $request) {
    // Get the user's IP address
    $userIp = $request->ip();
    // Make a request to the ipinfo.io API
    $client = new Client();
    $response = $client->get("https://ipinfo.io/{$userIp}?token=8c1b7efbaf360d");
    // Parse the JSON response
    $data = json_decode($response->getBody());
    // Extract user information
    $country = $data->country;
    // You can return the user information or use it as needed
    return $country;
  }
}
