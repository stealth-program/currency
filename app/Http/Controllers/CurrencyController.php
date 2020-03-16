<?php

namespace App\Http\Controllers;

use App\Currency;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currency = new Currency();

        if ($currency->hasError()) {
            return view('welcome', ['error' => $currency->hasError()]);
        }

        return view('welcome',
            [
                'dollarBefore' => $currency->getDollarBefore(),
                'dollar' => $currency->getDollar(),
                'euroBefore' => $currency->getEuroBefore(),
                'euro' => $currency->getEuro(),
                'dateBefore' => $currency->getDateBefore(),
                'date' => $currency->getDate(),
            ]);
    }
}
