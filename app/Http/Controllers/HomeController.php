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
    public function kharid(Request $request)
    {
        $data = $request->all();
        $partner =  Partner::create([
            "firstname" => $data['firstname'],
            "lastname" => $data['lastname'],
            "email" => $data['email'],
            "password" => $data['password'],
            "phone" => $data['phone'],
        ]);

        $user_lands_ids = explode(',',$data['user_buyed_lands']);
        foreach ($user_lands_ids as $land_id) {
            Land::create([
                'flag' => $land_id,
                'partner_id'=>$partner->id,
                'status'=>1,
            ]);
        }
        return ('done');
    }
}



