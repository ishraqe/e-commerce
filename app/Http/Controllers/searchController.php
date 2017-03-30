<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Search;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;


class searchController extends Controller
{
    public function getSearch(Request $request){

        $search=new Search();
        $query = $request->input('query');
        if ($query == null) {
            return redirect()->back();
        }
        $page = Input::get('page', 1);
        $paginate = 2;

        $data= '%'.$request->input('query').'%';

        $started = microtime(true);

        $resultAll=$search->searchAll($data);

        $end = microtime(true);

        $difference = $end - $started;

        $queryTime = number_format($difference, 10);

        $time= count($resultAll)." in $queryTime seconds.";


        $slice = array_slice($resultAll, $paginate * ($page - 1), $paginate);
        $result = new Paginator($slice, count($resultAll), $paginate);

        $resultData=[
            'time' => $time,
            'result'=>$result
        ];

        return view('pages.searchresult')->with([
            'resultData' => $resultData
        ]);
    }
}
