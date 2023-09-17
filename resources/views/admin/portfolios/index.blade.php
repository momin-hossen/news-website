@extends('layouts.admin.app', [
    'title' => 'Portfolio List',
    'buttons' => [['name' => 'Add new', 'modal' => 'create-term-modal', 'icon' => 'bx bx-plus-circle']],
])

@section('contents')
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Total Portfolios</span>
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
                            <span>Active Portfolios</span>
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
                            <span>Deactive Portfolios</span>
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
                            <h5>Portfolio List</h5>
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
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($portfolios as $portfolio)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img width="35" height="35" class="rounded-circle" src="{{ asset($portfolio->image ?? '') }}">
                                    </td>
                                    <td>{{ $portfolio->title }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-label-{{ $portfolio->status ? 'primary':'danger' }}">{{ $portfolio->status ? 'Active':'Deactive' }}</span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item portfolio-modal" data-id="{{ $portfolio->id }}"
                                                    data-url="{{ route('admin.portfolios.update', $portfolio->id) }}"
                                                    data-title="{{ $portfolio->title }}" data-status="{{ $portfolio->status }}" href="javascript:void(0);">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                    Edit
                                                </a>
                                                <a class="dropdown-item delete-confirm" data-method="DELETE"
                                                    href="{{ route('admin.portfolios.destroy', $portfolio->id) }}">
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
                        {{ $portfolios->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    <div class="modal fade" id="create-term-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.portfolios.index') }}" method="post" class="custom-reload-form"  enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Create new portfolio</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center mb-3">
                                <div class="preview-seo_image">
                                    <label for="image" class="form-label text-start d-block">@lang('Image')</label>
                                    <label for="image" class="image-preview">
                                        <img width="60px" height="60px" class="mt-3" src="{{ asset('assets/img/icons/no-image.png') }}" alt="">
                                        <p>Please select an image.</p>
                                    </label>
                                    <input class="form-control d-none image-input" type="file" id="image" name="image">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" class="form-control" name="title" placeholder="Enter portfolio title" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">@lang('Active')</option>
                                    <option value="0">@lang('Deactive')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary ajax-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="portfolio-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post" class="custom-reload-form portfolio-edit-form">
                    @csrf
                    @method('put')

                    <div class="modal-header">
                        <h5 class="modal-title">Portfolio update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 text-center mb-3">
                                <div class="preview-seo_image">
                                    <label for="image" class="form-label text-start d-block">@lang('Image')</label>
                                    <label for="image" class="image-preview">
                                        <img width="60px" height="60px" class="mt-3" src="{{ asset($portfolio->image ?? 'assets/img/icons/no-image.png') }}" alt="">
                                        <p>Please select an image.</p>
                                    </label>
                                    <input class="form-control d-none image-input" type="file" id="image" name="image">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" id="title" class="form-control title" name="title"
                                    placeholder="Enter portfolio title" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control status">
                                    <option value="1">@lang('Active')</option>
                                    <option value="0">@lang('Deactive')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary ajax-btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush
