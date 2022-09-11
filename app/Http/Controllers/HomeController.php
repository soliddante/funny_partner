<?php

namespace App\Http\Controllers;

use App\Models\Land;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('start');
    }

    public function page_1()
    {
        return view('page_1');
    }

    public function page_2(Request $request)
    {
        $data = $request->BUYED_LAND_IDIS;
        return view('page_2', compact('data'));
    }

    // nabayad too home bashe vali sari kar darim
    public function kharid_callback(Request $request)
    {
        $etelaatkharid =implode($request->all()); 
        return view('qrcodenahayi', compact('etelaatkharid'));
    }
    public function qrx(Request $request){
        return('Maintnance');
    }
    public function kharid(Request $request)
    {
        $data = $request->all();
        $user_lands_ids = explode(',', $data['user_buyed_lands']);

        $randomString =  substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(20 / strlen($x)))), 1, 20);
        $price = 45000;
        $tedadezaminha = count($user_lands_ids);
        $total = $price * $tedadezaminha;

        $partner =  Partner::create([
            "firstname" => $data['firstname'],
            "lastname" => $data['lastname'],
            "email" => $data['email'],
            "password" => $data['password'],
            "phone" => $data['phone'],
        ]);
        $user_lands_ids = explode(',', $data['user_buyed_lands']);
        foreach ($user_lands_ids as $land_id) {
            Land::create([
                'flag' => $land_id,
                'partner_id' => $partner->id,
                'status' => 1,
            ]);
        }

        $callback_url = route('.kharid_callback');
        $apikey = "44a0e35c-4821-489d-8900-2e159257a44b";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://nextpay.org/nx/gateway/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => "api_key= $apikey&amount=$total&order_id=$randomString&customer_phone=09121004433&custom_json_fields={ 'partner_id':$partner->id , 'tedadezaminha':$tedadezaminha }&callback_uri=$callback_url".'?paramets=partner_id'.$partner->id.',tedadezaminha'.$tedadezaminha.',total'.$total.',randomString'.$randomString,
        ));

        $response = curl_exec($curl);
        $trans_id = json_decode($response)->trans_id;
        curl_close($curl);

        return  redirect()->to("https://nextpay.org/nx/gateway/payment/$trans_id");

       
    }
}
