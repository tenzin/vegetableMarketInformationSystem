<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gewog;
use DB;

class MapController extends Controller
{
    public function index(){

        // $mapping = Gewog::pluck();

        $mapping = DB::table('tbl_gewogs')->first();

        // dd($mapping->id);
        return view('index',compact('mapping'));
        // dd('sdjfkh');
    }
}