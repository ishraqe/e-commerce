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
       </div>
   </div>

    <div class="row">
        <div class="col-md-12">
            <p>
                This is the most minimal example of Dropzone. The upload in this example
                doesn't work, because there is no actual server to handle the file upload.
            </p>

            <!-- Change /upload-target to your upload address -->
            <div>
                hello
                <div id="myAwesomeDropzone" style="height: 100px; width: 100px; display: inline-block ; background-color: green"></div>
            </div>

        </div>
    </div>


@endsection


@section('script')
    <script>
        $("div#myAwesomeDropzone").dropzone({
            url: "/file/post"
        });
    </script>
@endsection
