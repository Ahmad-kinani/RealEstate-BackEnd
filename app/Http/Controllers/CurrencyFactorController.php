<?php

namespace App\Http\Controllers;

use App\Models\CurrencyFactor;
use Illuminate\Http\Request;

class CurrencyFactorController extends Controller
{
    //
    public function index()
    {
        //
        return CurrencyFactor::all();
    }
}