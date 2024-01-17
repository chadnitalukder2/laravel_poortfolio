@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title"> Home Slide Page  </h4>
                        
                        <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data">
                         @csrf
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title	"  id="title	" value="{{ $homeslide->title	 }}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="short_title"  id="short_title" value="{{ $homeslide->short_title }}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Video Url</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="video_url"  id=video_url"" value="{{ $homeslide->video_url }}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Home Slide</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="home_slide"  id="image"  >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <div class="col-sm-10">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <img id="showImage" class="rounded avatar-lg " src=" {{ (!empty($homeslide->home_slide))? url('upload/home_slide/'.$homeslide->home_slide):url('upload/no_image.jpg')  }}" alt="Card image cap">
                                </div>
                            </div>
                             <!-- end row -->
                             <input type="submit" class="btn btn-info waves-effect waves-light " value="Update Slide">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

@endsection


