<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Symbol;
use App\Models\Subscription;

class CryptoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $index = $request->index ?? 1;
        
        if(!$request->page) {
            $page = 1;
        }
        else if ((int)$request->page > 16) {
            $page = 1;
        }
        else {
            $page = (int)$request->page;
        }

        $fileName = 'data/crypto.json';
        $fileHandler= fopen($fileName, 'r') or die($fileName . ' cannot be opened');
        $string = fread($fileHandler, filesize($fileName));
        $crypto = json_decode($string, true)['crypto'];
        $total = count($crypto);
        $maxIndex = ceil($total / 225);
        $numElements = config('app.elements_per_page');
        $start = (225 * ($index - 1)) + ($numElements * ($page - 1))  ;
        $crypto = array_slice($crypto, $start, $numElements);
        $crypto = array_map(function($currency) {
            $object = new \stdClass;
            $object->symbol = array_keys($currency)[0];
            $object->company = array_values($currency)[0];
            return $object;
        }, $crypto);

        $cryptoSymbols = Auth::user()->symbols('crypto'); 

        $symbols = array_map(function($crypto) {
            return $crypto['name'];
        }, $cryptoSymbols);

        return view('crypto')
        ->with('title', 'Crypto')
        ->with('crypto', $crypto)
        ->with('numElements', $numElements)
        ->with('index', $index)
        ->with('paginate_start', ((($index  - 1) * $numElements) + 1))
        ->with('paginate_current', (($index - 1) * $numElements) + $page)
        ->with('maxIndex', $maxIndex)
        ->with('paginateStart', ((($index  - 1) * $numElements) + 1))
        ->with('paginateCurrent', (($index - 1) * $numElements) + $page)
        ->with('paginateMax', ceil($total / $numElements))
        ->with('total', $total)
        ->with('subscriptions', $symbols)
        ->with('type', 'crypto');
    }
}
