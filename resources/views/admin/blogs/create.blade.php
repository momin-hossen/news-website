@extends('layouts.admin.app', [
    'title' => 'Add new blog',
    'buttons' => [['name' => 'View List', 'link' => route('admin.blogs.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
<form action="{{ route('admin.blogs.store') }}" method="post" class="custom-reload-form">
    @csrf

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">@lang('Create new blog')</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <label for="title" class="form-label">Title name</label>
                            <input type="text" id="title" class="form-control" name="title" placeholder="Enter blog title" required>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="lang" class="form-label">Select Language</label>
                            <select name="lang" id="lang" class="form-control" required>
                                <option value="en">English</option>
                                <option value="io">Medge Keith</option>
                                <option value="ss">Branden Simpson</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">@lang('Active')</option>
                                <option value="0">@lang('Deactive')</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="comment_status" class="form-label">Comment Status</label>
                            <select name="comment_status" id="comment_status" class="form-control">
                                <option value="1">@lang('Active')</option>
                                <option value="0">@lang('Deactive')</option>
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="categories" class="form-label">Select Categories</label>
                            <select name="categories[]" id="categories" class="form-control select-2" multiple="multiple">
                                @foreach ($categories as $key => $category)
                                    <option value="{{ $key }}"> {{ __($category) }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label for="tags" class="form-label">Select Tags</label>
                            <select name="tags[]" id="tags" class="form-control select-2" multiple="multiple">
                                @foreach ($tags as $key => $tag)
                                    <option value="{{ $key }}"> {{ __($tag) }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" placeholder="Enter blog title" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <div class="preview-image">{{-- preview-input_name && Don't add any class without this. --}}
                                <label for="image" class="form-label text-start d-block">@lang('Image')</label>
                                <label for="image" class="image-preview">
                                    <img width="60px" height="60px" class="mt-3" src="{{ asset('assets/img/icons/no-image.png') }}" alt="">
                                    <p>Please select an image.</p>
                                </label>
                                <input class="form-control d-none image-input" type="file" id="image" name="image" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <div class="accordion" id="accordionExample">
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button type="button" class="accordion-button collapsed d-block text-center"
                                            data-bs-toggle="collapse" data-bs-target="#accordionOne"
                                            aria-expanded="false" aria-controls="accordionOne">
                                            Seo Settings (Optional) <i class='bx bxs-chevrons-down'></i>
                                        </button>
                                    </h2>

                                    <div id="accordionOne" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <div class="col-12 text-center mb-3">
                                                <div class="preview-seo_image">{{-- preview-input_name && Don't add any class without this. --}}
                                                    <label for="seo_image" class="form-label text-start d-block">@lang('Image')</label>
                                                    <label for="seo_image" class="image-preview">
                                                        <img width="60px" height="60px" class="mt-3" src="{{ asset('assets/img/icons/no-image.png') }}" alt="">
                                                        <p>Please select an image.</p>
                                                    </label>
                                                    <input class="form-control d-none image-input" type="file" id="seo_image" name="seo_image">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="keywords" class="form-label">Meta Keywords</label>
                                                <textarea name="keywords" id="keywords" placeholder="Enter Meta Keywords" class="form-control"></textarea>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="meta_description" class="form-label">Meta
                                                    Description</label>
                                                <textarea name="meta_description" id="meta_description" placeholder="Enter Meta Keywords" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

@push('css')
<link href="{{ asset('assets/plugins/select-2/select2.min.css') }}" rel="stylesheet" />
@endpush

@push('js')
<script src="{{ asset('assets/plugins/select-2/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select-2').select2({
            placeholder: 'Select an option'
        });
    });
</script>
@endpush
