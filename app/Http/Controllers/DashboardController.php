<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function stocks(Request $request) {
       $index = $request->index ?? 0;
       $page = $request->page ?? 1;
       $numElements = config('app.elements_per_page');
       $start = ($index * $numElements) + $page;

       $fileHandler = fopen('data/stocks.json', 'r') or die('unable to open stocks.json');
       $string = fread($fileHandler, fileSize('data/stocks.json'));
       fclose($fileHandler);

       $stocks = json_decode($string)->stocks;
       $stocks = array_slice($stocks, $start, $numElements);

       return view('stocks')
       ->with('title', 'Stocks')
       ->with('stocks', $stocks)
       ->with('index', $index)
       ->with('paginate_start', ($index * $numElements))
       ->with('paginate_current', ($page - 1));
   }

   public function crypto() {
       return view('crypto')->with('title', 'Crypto');
   }
}
