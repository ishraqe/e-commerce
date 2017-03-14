<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Product;
use Session;
use App\Http\Requests;

class ReviewController extends Controller
{
    public function storeReview(Request $request ,$id)
    {  	
    	$this->validate($request, [
            'reviewer_name' => 'required|string',
            'reviewer_email' => 'required|email',
            'reviewer_description' => 'required|max:300|string',
            'reviewer_rating' => 'required|int'
        ]);

       $product=Product::find($id);
       
       if ($product->id<0) {
        	return redirect()->back()->with('notFound_confirmation','The review can not be added');
        }else{
        	$review=new Review();
        	$review->reviewer_name = $request->reviewer_name;
            $review->reviewer_email = $request->reviewer_email;
            $review->reviewer_description = $request->reviewer_description;
            $review->reviewer_rating = $request->reviewer_rating;
            $review->product_id = $product->id;
           	
	        $saveData= $review->save();
	        return redirect()->back()->with('added_confirmation','Your review has been added');
        } 


    }

}
