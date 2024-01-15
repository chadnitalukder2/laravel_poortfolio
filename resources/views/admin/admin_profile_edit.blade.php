@extends('admin.admin_master')
@section('admin')
 
<div class="page-content">
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title"> Edit Profile Page  </h4>
                        
                        <form>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name"  id="name" value="{{ $editData->name }}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">User Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email"  id="email" value="{{ $editData->email }}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="username"  id="username" value="{{ $editData->username }}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="profile_image"  id="username" value="{{ $editData->username }}" >
                                </div>
                            </div>
                             <!-- end row -->
                             <div class="row mb-3">
                                <div class="col-sm-10">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <img class="rounded avatar-lg " src=" {{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Card image cap">
                                </div>
                            </div>
                             <!-- end row -->
                             <input type="submit" class="btn btn-info waves-effect waves-light " value="Update Profile">
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

    </div>
</div>
    
@endsection