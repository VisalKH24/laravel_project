@extends('backend.master')
@section('content')

    @section('site-title')
        Admin | Add Logo
    @endsection
    @section('page-main-title')
        Add Logo
    @endsection

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="col-xl-12">
                <!-- File input -->
                <form action="{{route('addLogoSubmit')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        
                        <div class="card-body">

                            <div class="row">
                                @if ($logo ?? '')
                                    <input type="hidden" name="id" value="{{ $logo->id }}">
                                @endif
                                <div class="mb-3 col-12">
                                    
                                    <label for="formFile" class="form-label">Thumbnail</label>
                                    <input class="form-control" type="file" name="logo" />
                                    @if ($errors->first('logo'))
                                        <span class="text-danger"  >{{($errors->first('logo'))}}</span>
                                    @endif
                                    @if ($logo ?? '')
                                   <input type="" id="old_image" name="old_image" value="{{ $logo->logo }}">
                                   @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <a href="#" class="btn btn-danger" >Cancel</a>
                                <input type="submit" class="btn btn-primary btnAdd" id="btnAdd" value="Add Logo" name="btn">
                                <input type="submit" class="btn btn-primary btnEdit" id="btnEdit" value="Edit Logo" name="btn">

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
        if(url!='http://127.0.0.1:8000/admin/add-logo'){
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

@endsection
