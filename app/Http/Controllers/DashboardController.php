<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function stocks(Request $request)
    {
        $index = $request->index ?? 1;

        if (!$request->page) {
            $page = 1;
        } elseif ((int)$request->page > 16) {
            $page = 1;
        } else {
            $page = (int)$request->page;
        }

        $numElements = config('app.elements_per_page');
        $start = (225 * ($index - 1)) + ($numElements * ($page - 1));

        $fileName = 'data/stocks.json';
        $fileHandler = fopen($fileName, 'r') or die($fileName . ' could not be opened');
        $string = fread($fileHandler, fileSize($fileName));
        fclose($fileHandler);

        $stocks = json_decode($string)->stocks;
        $stocks = array_slice($stocks, $start, $numElements);

        return view('stocks')
        ->with('title', 'Stocks')
        ->with('stocks', $stocks)
        ->with('index', $index)
        ->with('paginate_start', ((($index  - 1) * $numElements) + 1))
        ->with('paginate_current', (($index - 1) * $numElements) + $page);
    }

    public function crypto(Request $request)
    {
        $index = $request->index ?? 1;

        if (!$request->page) {
            $page = 1;
        } elseif ((int)$request->page > 16) {
            $page = 1;
        } else {
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
