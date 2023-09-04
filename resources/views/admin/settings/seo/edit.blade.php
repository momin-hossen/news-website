@extends('layouts.admin.app', [
    'title' => 'Seo Settings',
])

@section('contents')
<div class="row justify-content-center">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-body pb-3">
                <div class="row justify-content-between">
                    <div class="col">
                        <h5>Seo Settings</h5>
                    </div>
                    <div class="col text-end">
                        <a href="{{ route('admin.settings.seo.index') }}" class="btn btn-primary btn-sm rounded-pill"><i class='bx bx-arrow-back'></i> Back</a>
                    </div>
                </div>
                <form action="{{ route('admin.settings.seo.update', $seo->id) }}" method="post" class="custom-reload-form">
                    @csrf
                    @method('put')
                    
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="site_name" class="form-label">Site Name</label>
                            <input type="text" id="site_name" name="site_name" value="{{ $seo->value['site_name'] ?? '' }}" class="form-control" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="site_title" class="form-label">Twitter Site Title</label>
                            <input type="text" id="site_title" name="site_title" value="{{ $seo->value['site_title'] ?? '' }}" class="form-control">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="tag" class="form-label">Meta Tag</label>
                            <input type="text" name="tag" id="tag" value="{{ $seo->value['tag'] ?? '' }}" class="form-control">
                        </div>
                        <div class="col-12 text-center mb-4">
                            <div class="preview-image">{{-- preview-input_name && Don't add any class without this. --}}
                                <label for="image" class="form-label text-start d-block">@lang('Meta Image')</label>
                                <label for="image" class="image-preview">
                                    <img width="60px" height="60px" class="mt-3" src="{{ asset($seo->value['image'] ?? 'assets/img/icons/no-image.png') }}" alt="">
                                    <p>{{ __('Please select an image.') }}</p>
                                </label>
                                <input class="form-control d-none image-input" type="file" id="image" name="image" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">Meta Description</label>
                            <textarea name="description" id="description" rows="4" class="form-control">{{ $seo->value['description'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="col-12 text-center">
                        <button type="reset" class="btn btn-outline-danger mx-1"><i class='bx bx-reset'></i>
                            {{ __('Reset') }}
                        </button>
                        <button type="submit" class="btn btn-primary ajax-btn mx-1"><i class='bx bx-save'></i>
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
