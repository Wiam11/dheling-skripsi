<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Address;

class MyAddressController extends Controller
{
    public function index()
    {

        $provinsi = $this->get_provinsi();
       // dd($provinsi);


        return view('pages.admin.my-address.index',[

            'provinsi' => $provinsi
        ]);
    }

    public function store(Request $request)
    {
        $data = new Address;
        $data->provinces_id = $request->provinces_id;
        $data->cities_id = $request->cities_id;
        $data->save();

        return redirect()->back();
    }

    public function get_provinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 36760764b182091f00c4bac18b8058c4"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
      //  echo $response;
        }

        return json_decode($response);
    }

}
