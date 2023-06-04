<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Symbol;
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
        $index = (int)$index;

        if (!$request->page) {
            $page = 1;
        } elseif ((int)$request->page > 16) {
            return redirect()->route('stocks', ['index' => $index]);
        } else {
            $page = (int)$request->page;
        }

        $fileName = 'data/stocks.json';
        $fileHandler = fopen($fileName, 'r') or die($fileName . ' could not be opened');
        $string = fread($fileHandler, fileSize($fileName));
        fclose($fileHandler);

        $stocks = json_decode($string)->stocks;
        $total = count($stocks);
        $numElements = config('app.elements_per_page');
        $maxIndex = (int)ceil($total / pow($numElements, 2));

        if ($index > $maxIndex) {
            return redirect()->route('stocks');
        }

        if ($index === $maxIndex) {
            $rem = $total - ($index - 1) * pow($numElements, 2);
            $remPages = ceil($rem / $numElements);

            if ($page > $remPages) {
                return redirect()->route('stocks', ['index' => $index]);
            }
        }

        $start = (pow($numElements, 2) * ($index - 1)) + ($numElements * ($page - 1));
        $stocks = array_slice($stocks, $start, $numElements);

        $stockSymbols = Auth::user()->symbols('stock');
        $symbols = [];
        foreach ($stockSymbols as $symbol) {
            $symbols[$symbol['company']] = $symbol['name'];
        }

        return view('stocks')
        ->with('title', 'Stocks')
        ->with('stocks', $stocks)
        ->with('numElements', $numElements)
        ->with('index', $index)
        ->with('maxIndex', $maxIndex)
        ->with('paginateStart', ((($index  - 1) * $numElements) + 1))
        ->with('paginateCurrent', (($index - 1) * $numElements) + $page)
        ->with('paginateMax', ceil($total / $numElements))
        ->with('total', $total)
        ->with('subscriptions', $symbols)
        ->with('type', 'stock');
    }
}
