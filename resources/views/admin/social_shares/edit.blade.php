@extends('layouts.admin.app', [
    'title' => 'Add Social Info',
    'buttons' => [['name' => 'View List', 'link' => route('admin.social_shares.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('admin.social_shares.update', $social_share->id) }}" method="post" class="custom-reload-form">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h5 class="card-header">@lang('Update Social Info')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="url" class="form-label">URl</label>
                            <input type="url" id="name" class="form-control" name="url" value="{{ $social_share->url }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" id="icon" class="form-control" name="icon" value="{{ $social_share->icon }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="follower" class="form-label">Follower</label>
                            <input type="number" id="follower" class="form-control" name="follower" value="{{ $social_share->follower }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option @selected($social_share->status == '1') value="1">@lang('Active')</option>
                                <option @selected($social_share->status == '0') value="0">@lang('Deactive')</option>
                            </select>
                        </div>
                        <div class="col-sm-12 mb-3">
                            <button type="submit" class="btn btn-primary"><i class=' menu-icon tf-icons bx bx-save' ></i>Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
