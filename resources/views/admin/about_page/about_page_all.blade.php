@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title"> About Slide Page  </h4>
                        
                        <form method="POST" action="{{ route('update.AboutSlider') }}" enctype="multipart/form-data">
                         @csrf

                            <input type="hidden" name="id" value="{{ $aboutSlide->id }}"  >

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title"  id="title" value="{{ $aboutSlide->title}}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="short_title"  id="short_title" value="{{ $aboutSlide->short_title }}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" type="text" name="short_description"  >{{ $aboutSlide->short_description }}</textarea>
                                </div>
                            </div>
                             <!-- end row -->

                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Long Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" type="text" name="long_description" >{{ $aboutSlide->long_description }}</textarea> 
                                </div>
                            </div>
                             <!-- end row -->

                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">About Slide</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="about_slide"  id="image"  >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <div class="col-sm-10">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <img id="showImage" class="rounded avatar-lg " src=" {{ (!empty($aboutSlide->about_image))? url('upload/about_slide/'.$homeslide->about_slide):url('upload/no_image.jpg')  }}" alt="Card image cap">
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


