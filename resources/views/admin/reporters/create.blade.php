@extends('layouts.admin.app', [
    'title' => 'Add News Reporter',
    'buttons' => [['name' => 'View List', 'link' => route('admin.reporters.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('admin.reporters.store') }}" method="post" class="custom-reload-form">
    @csrf

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">@lang('Create News Reporter')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="Enter reporter name" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" id="phone" class="form-control" name="phone" placeholder="Enter reporter phone" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Enter reporter email" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="nid_no" class="form-label">NID NO</label>
                            <input type="number" id="nid_no" class="form-control" name="nid_no" placeholder="Enter reporter nid_no" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="father_name" class="form-label">Father Name</label>
                            <input type="text" id="father_name" class="form-control" name="father_name" placeholder="Enter reporter father name" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="mother_name" class="form-label">Mother Name</label>
                            <input type="text" id="mother_name" class="form-control" name="mother_name" placeholder="Enter reporter mother name" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="present_address" class="form-label">Present Address</label>
                            <textarea name="present_address" id="present_address" placeholder="Enter present address" class="form-control"></textarea>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="permanent_address" class="form-label">Permanent Address</label>
                            <textarea name="permanent_address" id="permanent_address" placeholder="Enter permanent address" class="form-control"></textarea>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="joining_date" class="form-label">Joining Date</label>
                            <input type="date" id="joining_date" class="form-control" name="joining_date" placeholder="Enter reporter joining date" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Enter reporter password" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="role" class="form-label">role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="1">@lang('Reporter')</option>
                                <option value="0">@lang('Admin')</option>
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
                                    <img width="60px" height="60px" class="mt-3" src="{{ asset('assets/img/icons/no-image.png') }}" alt="">
                                    <p>{{ __('Please select an image.') }}</p>
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
