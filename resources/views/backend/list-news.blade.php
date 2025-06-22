@extends('backend.master')
@section('content')
<div class="content-wrapper">
    @section('site-title')
      Admin | List News
    @endsection
    @section('page-main-title')
      List News
    @endsection

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
          <div class="table-responsive text-nowrap">
            <table class="table text-center">
              <thead>
                <tr>
                  <th>TITLE</th>
                  <th>DESCRIPTION</th>
                  <th>IMAGE</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0 ">
                @foreach ($news as $item)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$item->title}}</strong></td>

                    <td>{{$item->description}}</td>
                    <td>
                      <img src="{{ $item->thumbnail }}" alt="Thumbnail" width="80" class="rounded mx-auto d-block">
                    </td> 
                    <td>
                      <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href="{{route('editNews',$item->id)}}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                          <a class="dropdown-item remove-post-key" id="remove-post-key" data-value="{{$item->id}}" data-bs-toggle="modal" data-bs-target="#basicModal" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="mt-3">
          {{ $news->links() }}
        </div>


        <div class="mt-3">
          <form action="{{route('deleteNews')}}" method="post">
            @csrf
          <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel1">Are you sure to remove this post?</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                  <input type="hidden" id="remove-val" name="remove_id" class="remove_id">
                  <button type="submit" class="btn btn-danger">Confirm</button>
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </form>
        </div>

      <hr class="my-5" />
    </div>
    <!-- / Content -->
  </div>
</div>

@endsection
