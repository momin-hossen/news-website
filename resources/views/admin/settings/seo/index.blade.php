@extends('layouts.admin.app', [
    'title' => 'Seo Settings',
])

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body pb-3">
                <div class="row justify-content-between">
                    <div class="col-sm-6">
                        <h5>Seo Settings</h5>
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
                            <th>{{ __('Tag') }}</th>
                            <th>{{ __('Site Name') }}</th>
                            <th>{{ __('Site Title') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($datas as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->value['tag'] ?? '' }}</td>
                                <td>{{ $data->value['site_name'] ?? '' }}</td>
                                <td>{{ $data->value['site_title'] ?? '' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('admin.settings.seo.edit', $data->id) }}">
                                                <i class="bx bx-edit-alt me-1"></i>
                                                {{ __('Edit') }}
                                            </a>
                                            <a class="dropdown-item delete-confirm" data-method="DELETE" href="{{ route('admin.settings.seo.destroy', $data->id) }}">
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
                    {{ $datas->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
