<form action="{{route('admin.editBasicProfile')}}" method="post" enctype="multipart/form-data">
                    @if (!$errors->editBasicError->isEmpty())
                        <div class="form_error_login">
                            <ul>
                                @foreach ($errors->editBasicError->all() as $error)
                                    <li class="alert alert-danger signInError">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="mobile_number">Mobile number</label>
                        <input class="form-control" type="text" name="mobile_number" value="{{Auth::user()->basicInfo->mobile_number}}">
                    </div>

                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea class="form-control" name="about" id="exampleTextarea" rows="3">{{Auth::user()->basicInfo->about}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="website">Website</label>
                        <input class="form-control" type="text" name="website" value="{{Auth::user()->basicInfo->website}}">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputFile">Profile photo</label>
                        <input class="form-control" name="user_image" type='file' id="imgInp" />

                        <img id="blah" name="profile_image"  alt="Preview image" class="img-rounded"  width="304" height="236"  />
                    </div>


    <input type="hidden" name="_token" value="{{csrf_token()}}">




    <button type="submit" class="btn btn-primary">Submit</button>
</form>