<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $numElements = config('app.elements_per_page');
        $start = (225 * ($index - 1)) + ($numElements * ($page - 1))  ;

        $fileName = 'data/crypto.json';
        $fileHandler= fopen($fileName, 'r') or die($fileName . ' cannot be opened');
        $string = fread($fileHandler, filesize($fileName));
        $crypto = json_decode($string, true)['crypto'];
        $crypto = array_slice($crypto, $start, $numElements);

        return view('crypto')
        ->with('title', 'Crypto')
        ->with('crypto', $crypto)
        ->with('index', $index)
        ->with('paginate_start', ((($index  - 1) * $numElements) + 1))
        ->with('paginate_current', (($index - 1) * $numElements) + $page);
    }
}
