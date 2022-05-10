<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZipCodeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 郵便番号化から住所を取得
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getZipCode(Request $request)
    {
        // 郵便番号取得API
        $api_url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=' . $request->zipcode;
        // CURL
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $api_url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);     
        $json_response = curl_exec($curl_handle);
        curl_close($curl_handle);
        // データ処理
        $decoded_data = json_decode($json_response , true);
        $address = '';
        if ($decoded_data['status'] === 200) {
            $data = $decoded_data['results'][0];
            $address = $data['address1'] . $data['address2'] . $data['address3'];
        }
        return $address;
    }
}
