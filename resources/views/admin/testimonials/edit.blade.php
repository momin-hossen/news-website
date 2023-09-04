@extends('layouts.admin.app', [
    'title' => 'Add new testimonial',
    'buttons' => [['name' => 'View List', 'link' => route('admin.testimonials.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="post" class="custom-reload-form">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">@lang('Create new testimonial')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control name" name="name" value="{{ $testimonial->name }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="designation" class="form-label">Designation</label>
                            <input type="text" id="designation" class="form-control" name="designation" value="{{ $testimonial->designation }}" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option @selected($testimonial->status == '1') value="1">@lang('Active')</option>
                                <option @selected($testimonial->status == '0') value="0">@lang('Deactive')</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea name="review" id="review" placeholder="Enter Review" class="form-control">{{ $testimonial->review }}</textarea>
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
                                    <img width="60px" height="60px" class="mt-3" src="{{ asset($testimonial->image ?? 'assets/img/icons/no-image.png') }}" alt="">
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
