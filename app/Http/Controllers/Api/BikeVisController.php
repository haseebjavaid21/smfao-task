<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BikeVisController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getJsonData()
    {
        $bikeJsonData = file_get_contents("../resources/bikedata/bikedata.json");
        $bikeJsonData = json_decode($bikeJsonData, true);
        return $bikeJsonData;
    }

}
