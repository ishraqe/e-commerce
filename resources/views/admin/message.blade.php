@extends('layouts.admin')
@section('style')
    <style>

    </style>
@endsection
@section('content')
   <div class="row">
       <div class="col-md-12">
           <div class="heading">Message</div>
           <div class="message-container">
               <ul class="list-group">
                   <li class="list-group-item">Dapibus ac facilisis in</li>
                   <li class="list-group-item list-group-item-success">Dapibus ac facilisis in</li>
                   <li class="list-group-item list-group-item-info">Cras sit amet nibh libero</li>
               </ul>
           </div>
           <div class="reply-message">
               <label for="reply">Send message</label>
               <textarea name="reply" id="" cols="70" rows="10"></textarea>
               <button>Send</button>
           </div>
       </div>
   </div>


@endsection
