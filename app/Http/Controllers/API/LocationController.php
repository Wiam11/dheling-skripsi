<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Province;
use App\City;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Http\Request;

class LocationController extends Controller
{

    public function provinces(Request $request)
    {
        return Province::all();
    }

     public function City($province_id)
    {
        return City::where('province_id', $province_id)->get();
    }

    public function City_ID($city_id)
    {
        return City::find($city_id);
    }

    public function checkOngkir(Request $request)
    {
        $cost =  RajaOngkir::ongkosKirim([
            'origin' => 243, //ID kota / Kabupaten asal/ 113 adalah kode kota Bekasi
            'destination' => $request->city_destination, //Id Kota //kabupaten tujuan
            'weight' => $request->weight, // berat barang dalam gram sample 100
            'courier' => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cost All Courir: ' . $request->courier,
            'data'    => $cost
        ]);
    }

}
