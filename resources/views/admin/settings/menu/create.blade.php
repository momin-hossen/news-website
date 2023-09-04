@extends('layouts.admin.app', [
    'title' => __('Add new menu')
])

@section('contents')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-action-filter">
                            <form class="ajaxform_instant_reload" method="post" action="{{ route('admin.settings.menus.destroy') }}">
                                @csrf

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Postion') }}</th>
                                            <th>{{ __('Language') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Customize') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                        <tr>
                                            <td>{{ $menu->name }} </td>
                                            <td>{{ $menu->position }}</td>
                                            <td>{{ $menu->lang }}</td>
                                            <td>
                                                @if ($menu->status == 1)
                                                    <p class="badge bg-success">{{ __('Active Menu') }}</p>
                                                @else
                                                    <p class="badge bg-danger">{{ __('Draft Menu') }}</p>
                                                @endif
                                            </td>

                                            <td>
                                                <a class="text-primary" href="{{ route('admin.settings.menu.show', $menu->id) }}">
                                                    <i class="fas fa-arrows-alt"></i>
                                                    {{ __('Customize') }}
                                                </a>
                                            </td>
                                            <td>
                                                <a class="text-success" href="{{ route('admin.settings.menu.edit', $menu->id) }}">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <form class="custom-reload-form" method="post" action="{{ route('admin.settings.menu.store') }}">
                        @csrf
                        <div class="custom-form">
                            <div class="mb-2">
                                <label for="name">{{ __('Menu Name') }}</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Menu Name">
                            </div>
                            <div class="mb-2">
                                <label for="position">{{ __('Menu Position') }}</label>
                                <select class="form-control" id="position" name="position">
                                    <option value="header">{{ __('Header') }}</option>
                                    <option value="footer">{{ __('Footer') }}</option>
                                    <option value="footer_left_menu">{{ __('Footer left Menu') }}</option>
                                    <option value="footer_right_menu">{{ __('Footer Right Menu') }}</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="lang">{{ __('Select Language') }}</label>
                                <select class="custom-select mr-sm-2 form-control" id="lang" name="lang">
                                    @foreach ($langs as $lang)
                                        <option value="{{ $lang->code }}">{{ $lang->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="position">{{ __('Menu Status') }}</label>
                                <select class="custom-select mr-sm-2 form-control" id="status" name="status">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0" selected="">{{ __('Draft') }}</option>
                                </select>
                            </div>
                            <div class="mb-2 mt-20">
                                <button class="btn btn-primary col-12 ajax-btn" type="submit"><i class="bx bx-plus-circle"></i> {{ __('Add New Menu') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
