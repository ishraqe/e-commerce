@if(Session::has('update_confirmation'))
   
   <button type="button" class="btn btn-success btn-toastr"  data-context="success" data-message="This is success info" data-position="top-right">{{Session::get('update_confirmation')}}</button>
@elseif(Session::has('delete_confirmation'))
     <button type="button" class="btn btn-success btn-toastr-callback" id="toastr-callback1" data-context="info" data-position="top-right" data-message="onShown and onHidden callback demo">{{Session::get('delete_confirmation')}}
     </button>
@elseif(Session::has('added_confirmation'))
     <div class="alert alert-success flash" id="#flash">{{Session::get('added_confirmation')}}</div>
@endif 