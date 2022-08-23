<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getCustomer(){
        $token = $this->loginApi()->access_token;
        return $this->getApi($token);
    }

    public function addCustomer(request $request){
        $token = $this->loginApi()->access_token;
        return $this->addApi($request, $token);
    }

    public function loginApi(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://mitramas-test.herokuapp.com/auth/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "email": "akun10@mig.id",
            "password" : "41504C81"
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);
    }

    public function getApi($token){

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://mitramas-test.herokuapp.com/customers',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Authorization: '.$token
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $decode = json_decode($response);
        return json_encode($decode);
    }

    public function addApi(request $request, $token){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://mitramas-test.herokuapp.com/customers',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
            "name": '.$request->input("name").',
            "address" : '.$request->input("address").',
            "country": '.$request->input("country").',
            "phone_number" : '.$request->input("phone_number").',
            "job_title": '.$request->input("job_title").',
            "status": '.$request->input("status").',
        }',
        CURLOPT_HTTPHEADER => array(
            'Authorization: '.$token,
            'Content-Type: application/json'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}
