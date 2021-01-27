<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Subscription;

class StocksController extends Controller
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
       $start = (225 * ($index - 1)) + ($numElements * ($page - 1));

       $fileName = 'data/stocks.json';
       $fileHandler = fopen($fileName, 'r') or die($fileName . ' could not be opened');
       $string = fread($fileHandler, fileSize($fileName));
       fclose($fileHandler);

       $stocks = json_decode($string)->stocks;
       $stocks = array_slice($stocks, $start, $numElements);
       
       $subscribedStockIds = Subscription::select('market_id')->where('user_id', $request->user()->id)->where('market_type', 'stock')->get();        
       $subscribedStockSymbols = Stock::select('symbol')->whereIn('id', $subscribedStockIds)->get();
       $subscribedStockSymbols = json_decode($subscribedStockSymbols[0], true);
       $subscribedStockSymbols = array_values($subscribedStockSymbols);
       $subscriptionString = '';

       foreach($subscribedStockSymbols as $symbol) {
           $subscriptionString .= $symbol . '|';
       }

       return view('stocks')
       ->with('title', 'Stocks')
       ->with('stocks', $stocks)
       ->with('index', $index)
       ->with('paginate_start', ((($index  - 1) * $numElements) + 1))
       ->with('paginate_current', (($index - 1) * $numElements) + $page)
       ->with('subscriptions', $subscribedStockSymbols)
       ->with('subscriptionString', $subscriptionString);
    }
}
