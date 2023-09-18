@extends('layouts.admin.app', [
    'title' => 'Add Company Info',
    'buttons' => [['name' => 'View List', 'link' => route('admin.company_settings.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('admin.company_settings.update', $company_setting->id) }}" method="post" class="custom-reload-form">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h5 class="card-header">@lang('Update Company Info')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" name="name" value="{{ $company_setting->name }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="address_1" class="form-label">Address_1</label>
                            <input type="text" id="address_1" class="form-control" name="address_1" value="{{ $company_setting->address_1 }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="address_2" class="form-label">Address_2</label>
                            <input type="text" id="address_2" class="form-control" name="address_2" value="{{ $company_setting->address_2 }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email"  value="{{ $company_setting->email }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" id="phone" class="form-control" name="phone"  value="{{ $company_setting->phone }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option @selected($company_setting->status == '1') value="1">@lang('Active')</option>
                                <option @selected($company_setting->status == '0') value="0">@lang('Deactive')</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control">$company_setting->message</textarea>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary"><i class=' menu-icon tf-icons bx bx-save' ></i>Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
