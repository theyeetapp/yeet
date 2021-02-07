<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public $symbol;

    public function show(Request $request)
    {
        $index = $request->index ?? 1;
        $this->symbol = strtolower($request->symbol);

        if(!$request->page) {
            $page = 1;
        }
        else if((int)$request->page > 16) {
            $page = 1;
        }
        else {
            $page = (int)$request->page;
        }

        $stocks = $this->getStockResults();
        $crypto = $this->getCryptoResults();
        $results = array_merge($stocks, $crypto);
        usort($results, function($first, $second) {
            return strcmp($first->symbol, $second->symbol);
        });
        
        $total = count($results);
        $maxIndex = ceil($total / 225);
        $numElements = config('app.elements_per_page');
        $start = (225 * ($index - 1)) + ($numElements * ($page - 1));
        $results = array_slice($results, $start, $numElements);

        $subscribedSymbols = Auth::user()->symbols();
        $symbols = array_map(function($symbol) {
            return $symbol['name'];
        }, $subscribedSymbols);

        return view('search')
        ->with('title', $request->symbol)
        ->with('type', 'search')
        ->with('results', $results)
        ->with('numElements', $numElements)
        ->with('index', $index)
        ->with('maxIndex', $maxIndex)
        ->with('paginateStart', ((($index  - 1) * $numElements) + 1))
        ->with('paginateCurrent', (($index - 1) * $numElements) + $page)
        ->with('paginateMax', ceil($total / $numElements))
        ->with('subscriptions', $symbols)
        ->with('searchTerm', strtoupper($this->symbol));
    }

    public function getStockResults()
    {
        $fileName = 'data/stocks.json';
        $fileHandler = fopen($fileName, 'r') or die($fileName . ' could not be opened');
        $string = fread($fileHandler, fileSize($fileName));
        fclose($fileHandler);

        $stocks = json_decode($string)->stocks;
        $stocks = array_filter($stocks, function($stock) {
            if(strtolower(substr($stock->symbol, 0, strlen($this->symbol))) === $this->symbol) {
                return $stock;
            }
        });
        return $stocks;
    }

    public function getCryptoResults() 
    {
        $fileName = 'data/crypto.json';
        $fileHandler= fopen($fileName, 'r') or die($fileName . ' cannot be opened');
        $string = fread($fileHandler, filesize($fileName));
        fclose($fileHandler);

        $crypto = json_decode($string, true)['crypto'];
        $crypto = array_filter($crypto, function($currency) {
            if(strtolower(substr(array_keys($currency)[0], 0, strlen($this->symbol))) === $this->symbol) {
                return $currency;
            }
        });
        $crypto = array_map(function($currency) {
            $object = new \stdClass;
            $object->symbol = array_keys($currency)[0];
            $object->company = array_values($currency)[0];
            return $object;
        }, $crypto);
        return $crypto;
    }
}
