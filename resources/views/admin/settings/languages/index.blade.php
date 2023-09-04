@extends('layouts.admin.app', [
    'title' => 'Language Settings',
    'buttons' => [['name' => 'Add New', 'modal' => 'create-lang-modal', 'icon' => 'bx bx-plus-circle']],
])

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body pb-3">
                <h5>Language Settings</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Language Name') }}</th>
                            <th>{{ __('Language Code') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($languages as $language)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $language->name }}</td>
                                <td>{{ $language->code }}</td>
                                <td><span class="badge rounded-pill bg-label-{{ $language->status ? 'primary':'danger' }}">{{ $language->status ? 'Active':'Deactive' }}</span></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.settings.languages.edit', $language->code) }}" title="Translations">
                                            <i class="bx bx-world me-1"></i>
                                        </a>
                                        <a class="btn btn-warning btn-sm lang-edit-modal" data-url="{{ route('admin.settings.languages.update', $language->id) }}" data-name="{{ $language->name }}" data-code="{{ $language->code }}" data-status="{{ $language->status }}" href="javascript:void(0)">
                                            <i class="bx bx-edit-alt me-1"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm delete-confirm" data-method="DELETE" href="{{ route('admin.settings.languages.destroy', $language->id) }}">
                                            <i class="bx bx-trash me-1"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('modal')
    <div class="modal fade" id="create-lang-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.settings.languages.store') }}" method="post" class="custom-reload-form">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Create new language</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Language Name</label>
                                <input type="text" id="name" class="form-control" name="name" placeholder="Enter language name" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="code" class="form-label">Language Code</label>
                                <select name="code" id="code" class="form-control w-100" required>
                                    @foreach($countries as $row)
                                    <option value="{{ $row['code'] }}">{{ $row['name'] }} -- ( {{ $row['code'] }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="title" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control status">
                                    <option value="1">@lang('Active')</option>
                                    <option value="0">@lang('Deactive')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">
                            <i class='bx bx-x'></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary ajax-btn btn-sm"><i class='bx bx-save'></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="lang-edit-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="" method="post" class="custom-reload-form lang-edit-form">
                    @csrf
                    @method('put')

                    <div class="modal-header">
                        <h5 class="modal-title">Category update</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name" class="form-label">Language Name</label>
                                <input type="text" id="name" class="form-control name" name="name"
                                    placeholder="Enter category name" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="code" class="form-label">Language Code</label>
                                <select name="code" id="code" class="form-control code w-100" required>
                                    @foreach($countries as $row)
                                    <option value="{{ $row['code'] }}">{{ $row['name'] }} -- ( {{ $row['code'] }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="title" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control status">
                                    <option value="1">@lang('Active')</option>
                                    <option value="0">@lang('Deactive')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            <i class='bx bx-x'></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary ajax-btn"><i class='bx bx-save'></i> Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush
