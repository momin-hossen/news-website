@extends('layouts.admin.app', [
    'title' => 'Blogs List',
    'buttons' => [['name' => 'Add New', 'link' => route('admin.blogs.create'), 'icon' => 'bx bx-plus-circle']],
])

@section('contents')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Total Blogs</span>
                        <div class="d-flex align-items-end mt-2">
                            <h3 class="mb-0 me-2">3</h3>
                        </div>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class="bx bx-user bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Active Blogs</span>
                        <div class="d-flex align-items-end mt-2">
                            <h3 class="mb-0 me-2">0</h3>
                        </div>
                    </div>
                    <span class="badge bg-label-success rounded p-2">
                        <i class="bx bx-user-check bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Deactive Blogs</span>
                        <div class="d-flex align-items-end mt-2">
                            <h3 class="mb-0 me-2">0</h3>
                        </div>
                    </div>
                    <span class="badge bg-label-danger rounded p-2">
                        <i class="bx bx-group bx-sm"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-between">
                    <div class="col-sm-6">
                        <h5>Blogs List</h5>
                    </div>
                    <div class="col-md-4 text-end">
                        <form action="" method="get">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search..." aria-describedby="button-addon2" value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit" id="button-addon2"><i class='bx bx-search-alt-2'></i></button>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Slug') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Comment Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($terms as $term)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img width="35" height="35" class="rounded-circle" src="{{ asset($term->meta['image'] ?? '') }}"></td>
                                <td>{{ $term->title }}</td>
                                <td>{{ $term->slug }}</td>
                                <td><span class="badge rounded-pill bg-label-{{ $term->status ? 'primary':'danger' }}">{{ $term->status ? 'Active':'Deactive' }}</span></td>
                                <td><span class="badge rounded-pill bg-label-{{ $term->comment_status ? 'primary':'danger' }}">{{ $term->comment_status ? 'ON':'OFF' }}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.blogs.edit', $term->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i>
                                                {{ __('Edit') }}
                                            </a>
                                            <a class="dropdown-item delete-confirm" data-method="DELETE" href="{{ route('admin.blogs.destroy', $term->id) }}">
                                                <i class="bx bx-trash me-1"></i>
                                                {{ __('Delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row mx-2 mt-2">
                <div class="col-sm-12">
                    {{ $terms->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
