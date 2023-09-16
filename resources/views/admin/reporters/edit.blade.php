@extends('layouts.admin.app', [
    'title' => 'Add News Reporter',
    'buttons' => [['name' => 'View List', 'link' => route('admin.reporters.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('admin.reporters.update', $reporter->id) }}" method="post" class="custom-reload-form">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">@lang('Create new reporter')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ $reporter->name }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" id="phone" class="form-control" name="phone"  value="{{ $reporter->phone }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email"  value="{{ $reporter->email }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="nid_no" class="form-label">NID NO</label>
                            <input type="number" id="nid_no" class="form-control" name="nid_no"  value="{{ $reporter->nid_no }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="father_name" class="form-label">Father Name</label>
                            <input type="text" id="father_name" class="form-control" name="father_name"  value="{{ $reporter->father_name }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="mother_name" class="form-label">Mother Name</label>
                            <input type="text" id="mother_name" class="form-control" name="mother_name"  value="{{ $reporter->mother_name }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="present_address" class="form-label">Present Address</label>
                            <textarea name="present_address" id="present_address" class="form-control">{{ $reporter->present_address }}</textarea>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="permanent_address" class="form-label">Permanent Address</label>
                            <textarea name="permanent_address" id="permanent_address"  class="form-control">{{ $reporter->permanent_address }}</textarea>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="joining_date" class="form-label">Joining Date</label>
                            <input type="date" id="joining_date" class="form-control" name="joining_date" value="{{ $reporter->joining_date }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password" value="{{ $reporter->password }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="role" class="form-label">role</label>
                            <select name="role" id="role" class="form-control">
                                <option @selected($reporter->role == '1') value="1">@lang('Reporter')</option>
                                <option @selected($reporter->role == '0') value="0">@lang('Admin')</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center mb-3">
                            <div class="preview-seo_image">
                                <label for="image" class="form-label text-start d-block">@lang('Image')</label>
                                <label for="image" class="image-preview">
                                    <img width="60px" height="60px" class="mt-3" src="{{ asset($reporter->image ?? 'assets/img/icons/no-image.png') }}" alt="">
                                    <p>Please select an image.</p>
                                </label>
                                <input class="form-control d-none image-input" type="file" id="image" name="image">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="reset" class="btn btn-outline-danger mx-1"><i class='bx bx-reset'></i>
                                Reset
                            </button>
                            <button type="submit" class="btn btn-primary ajax-btn mx-1"><i class='bx bx-save'></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
