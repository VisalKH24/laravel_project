@extends('backend.master')
@section('content')
    <div class="content-wrapper">
    @section('site-title')
        Admin | List Post
    @endsection
    @section('page-main-title')
        List Logo
    @endsection

    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-fixed ">
                    <thead>
                        <tr>
                            <th>Users</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($logo as $item)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $item['id'] }}</strong></td>

                                <td>

                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <img src="{{ $item->logo }}" alt="Avatar"
                                            style="width: 80px; height: 80px; border-radius: 50px">
                                    </ul>

                                </td>
                                <td><span class="badge bg-label-primary me-1">Active</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('editLogo', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> Edit</a>
                                            <a class="dropdown-item remove-post-key" data-value="{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-target="#basicModal"
                                                href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="mt-3 d-flex justify-content-end">
            {{ $item->links() }}
        </div> --}}

        <div class="mt-3">
            <form action="{{ route('deleteLogo') }}" method="post">
                @csrf
                <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Are you sure to remove this post?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="remove-val" name="remove_id" class="remove_id">
                                <button type="submit" class="btn btn-danger">Confirm</button>
                                <a href="{{ route('listLogo') }}" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Cancel</a>
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
