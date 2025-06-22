@extends('backend.master')
@section('content')

    @section('site-title')
        Admin | Edit profile
    @endsection
    @section('page-main-title')
       Edit Profile
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('editProfileSubmit',$user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="mb-3 col-12">
                                        <label for="profile">Profile</label>
                                        <input type="file" name="profile" id="" class="form-control">
                                        <img class="mt-2"  width="80px" src="{{$user->profile}}" alt="">
                                        <input name="old_image" type="hidden" value="{{$user->profile}}">

                                </div>
                            </div>
                            <div class="mb-3">
                                <a href="/admin" class="btn btn-danger" >Cancel</a>
                                <input type="submit" class="btn btn-primary" value="Edit Profile">
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
