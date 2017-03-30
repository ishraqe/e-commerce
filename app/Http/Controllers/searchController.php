<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;

use Illuminate\Support\Facades\Input;


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

        $resultAll=$search->searchAll($data);

        $end = microtime(true);

        $difference = $end - $started;

        $queryTime = number_format($difference, 10);

        $time= count($resultAll)." in $queryTime seconds.";



//        $page = Input::get('page', 1);
//
//
//        $perPage = 10;
//
//        $offSet = ($page * $perPage) - $perPage;
//
//
//        $itemsForCurrentPage = array_slice($resultAll, $offSet, $perPage, true);
//
//
//       $result=new  LengthAwarePaginator($itemsForCurrentPage, count($resultAll), $perPage, $page);

        $resultData=[
            'time' => $time,
            'result'=>$resultAll
        ];

        return view('pages.searchresult')->with([
            'resultData' => $resultData
        ]);
    }
}
