<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class RajaOngkirController extends Controller
{
    public function getProvincies()
    {
        $provinces = Province::all();
        return response()->json([
            'success' => true,
            'message' => 'List Data Provincies',
            'data'    => $provinces
        ]);
    }

    public function getCities(Request $request)
    {
        $city = City::where('fk_province_id', $request->province_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'List data Cities By Provinces',
            'data'    => $city
        ]);
    }

    public function checkOngkir(Request $request)
    {
        dd($request->all());
        $cost =  RajaOngkir::ongkosKirim([
            'origin' => 113, //ID kota / Kabupaten asal/ 113 adalah kode kota demak
            'destination' => $request->city_destination, //Id Kota //kabupaten tujuan
            'weight' => $request->weight, // berat barang dalam gram
            'courier' => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cost All Courir: ' . $request->courier,
            'data'    => $cost
        ]);
    }
}
