@extends('layouts.admin.app', [
    'title' => 'Add new page',
    'buttons' => [['name' => 'View List', 'link' => route('admin.pages.index'), 'icon' => 'bx bx-list-ul']],
])

@section('contents')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.pages.store') }}" method="post" class="custom-reload-form">
                        @csrf

                        <div class="row">
                            <h5>{{ __('Add new page') }}</h5>
                            <div class="col-sm-6 mb-3">
                                <label for="title" class="form-label">Title name</label>
                                <input type="text" id="title" class="form-control" name="title" placeholder="Enter page title" required>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="1">@lang('Active')</option>
                                    <option value="0">@lang('Deactive')</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="page_excerpt" class="form-label">Page Excerpt</label>
                                <textarea name="page_excerpt" id="page_excerpt" placeholder="Enter page excerpt" class="form-control" required></textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="page_content" class="form-label">Page Content</label>
                                <textarea name="page_content" id="page_content" placeholder="Enter page content" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="col-12 mb-1 mt-3Page Excerpt">
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
                                                <div class="row">
                                                    <div class="col-sm-6 mb-3">
                                                        <label for="keywords" class="form-label">Meta Keywords</label>
                                                        <textarea name="keywords" id="keywords" placeholder="Enter Meta Keywords" class="form-control"></textarea>
                                                    </div>
                                                    <div class="col-sm-6 mb-3">
                                                        <label for="meta_description" class="form-label">Meta Description</label>
                                                        <textarea name="meta_description" id="meta_description" placeholder="Enter Meta Keywords" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="reset" class="btn btn-sm btn-outline-danger mx-1"><i class='bx bx-reset'></i>
                                    Reset
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary ajax-btn mx-1"><i class='bx bx-save'></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
