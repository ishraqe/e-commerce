<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;
use App\Http\Requests;

class searchController extends Controller
{
    public function getSearch(Request $request){

        $search=new Search();
        $query = $request->input('query');
        if ($query == null) {
            return redirect()->back();
        }
        $data= '%'.$request->input('query').'%';

        $started = microtime(true);
        $result=$search->searchAll($data);
        $end = microtime(true);

        $difference = $end - $started;

        $queryTime = number_format($difference, 10);

        $time= count($result)." in $queryTime seconds.";

        $resultData=[
            'time' => $time,
            'result'=>$result
        ];
        
        return view('pages.searchresult')->with([
            'resultData' => $resultData
        ]);
    }
}
