@extends('backend.master')
@section('content')

    @section('site-title')
        Admin | Add News
    @endsection
    @section('page-main-title')
        Add News
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <form action="{{ route('addNews-Submit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                @if(isset($news))
                                    <input type="hidden" name="id" value="{{ $news->id }}">
                                    <input type="hidden" name="old_image" value="{{ $news->thumbnail }}">
                                @endif

                                <!-- Thumbnail Upload -->
                                <div class="mb-3 col-12">
                                    <label for="thumbnail" class="form-label">Image</label>
                                    <input class="form-control" type="file" name="thumbnail" />

                                    @if ($errors->first('thumbnail'))
                                        <span class="text-danger">{{ $errors->first('thumbnail') }}</span>
                                    @endif

                                    @if(isset($news) && $news->thumbnail)
                                        <div class="mt-2">
                                            <img src="{{ $news->thumbnail }}" alt="Current Image" width="100" class="rounded">
                                        </div>
                                    @endif
                                </div>

                                <!-- Title -->
                                <div class="mb-3 col-12">
                                    <label class="form-label">Title</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title', $news->title ?? '') }}">
                                    @if ($errors->first('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                                <!-- Description -->
                                <div class="mb-3 col-12">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" cols="30" rows="5" class="form-control">{{ old('description', $news->description ?? '') }}</textarea>
                                    @if ($errors->first('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="mb-3">
                                <a href="{{ route('listNews') }}" class="btn btn-danger">Cancel</a>

                                @if(isset($news))
                                    <input type="submit" class="btn btn-success" value="Update News" name="btn">
                                @else
                                    <input type="submit" class="btn btn-primary" value="Add News" name="btn">
                                @endif
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


{{-- @extends('backend.master')
@section('content')

    @section('site-title')
        Admin | Add News
    @endsection
    @section('page-main-title')
        Add News
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('addNews-Submit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                @if ($news ?? '')
                                    <input type="hidden" name="id" value="{{ $news->id }}">
                                @endif
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label">Image</label>
                                    <input class="form-control" type="file" name="thumbnail" />
                                    @if ($errors->first('thumbnail'))
                                        <span class="text-danger"  >{{($errors->first('thumbnail'))}}</span>
                                    @endif
                                    @if ($logo ?? '')
                                   <input type="" id="old_image" name="old_image" value="{{ $news->thumbnail }}">
                                   @endif
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label">Title</label>
                                    <input type="text" name="title" id="" class="form-control">
                                    @if ($errors->first('title'))
                                        <span class="text-danger"  >{{($errors->first('title'))}}</span>
                                    @endif
                                </div>
                                <div class="mb-3 col-12">
                                    <label for="formFile" class="form-label">Description</label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                                    @if ($errors->first('description'))
                                        <span class="text-danger"  >{{($errors->first('description'))}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <a href="#" class="btn btn-danger" >Cancel</a>
                                <input type="submit" class="btn btn-primary btnAdd" value="Add News" id="btnAdd" name="btn">
                                <input type="submit" class="btn btn-success btnEdit" id="btnEdit" value="Edit News" name="btn">

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
        const url = window.location.href;
        if(url!='http://127.0.0.1:8000/admin/add-news'){
           $('#title').html('Edit Logo');
            $('#btnAdd').hide();
            $('#btnEdit').show();
        }else{
            $('#title').html('Add Logo');
            $('#btnAdd').show();
            $('#btnEdit').hide();
        }
    });
    </script>

@endsection --}}
