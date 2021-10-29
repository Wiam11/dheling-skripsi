<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function account()
    {
        $user = Auth::user();
        $provinces = Province::pluck('name', 'province_id');

        return view('pages.dashboard-account',[
            'user' => $user,
            'provinces' => $provinces
        ]);
    }

         public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }


    public function update(Request $request, $redirect)
    {
        //dd($request->all());
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $item->avatar = $request->file('avatar')->getClientOriginalName();
            $item->save();
        }

        return redirect()->route($redirect);
    }


}
