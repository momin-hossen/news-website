@extends('layouts.admin.app', [
    'title' => 'Language Settings',
    'buttons' => [
        ['name' => 'Back', 'link' => route('admin.settings.languages.index'), 'icon' => 'bx bx-arrow-back'],
        ['name' => 'Add Text', 'modal' => 'create-text-modal', 'icon' => 'bx bx-plus-circle'],
    ],
])

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card">
			<div class="card-header">
				<h4>{{ __('Text Update') }}</h4>
			</div>
			<div class="card-body">
                <form class="ajax-form" action="{{ route('admin.settings.languages.text', $key) }}" method="post">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="phase-key">
                            <thead>
                            <tr>
                                <th width="50%">{{ __('Key') }}</th>
                                <th width="50%">{{ __('Value') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($phrases ?? [] as $keyname => $row)
                                <tr>
                                    <td>
                                        <label for="values-{{ $keyname }}">
                                            {{ $keyname }}
                                        </label>
                                    </td>
                                    <td>
                                        <input type="text" name="values[{{ $keyname }}]" id="values-{{ $keyname }}" class="form-control w-100" value="{{ $row }}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-12 text-end mt-3">
                        <button type="reset" class="btn btn-outline-danger mx-1"><i class='bx bx-reset'></i>
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary ajax-button mx-1"><i class='bx bx-save'></i>
                            Save Changes
                        </button>
                    </div>
				</form>
			</div>
		</div>
    </div>
</div>
@endsection

@push('modal')
    <div class="modal fade" id="create-text-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.settings.languages.add-text', $key) }}" method="post" class="custom-reload-form">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Add new text</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="key" class="form-label">Text (Key)</label>
                                <input type="text" id="key" class="form-control" name="key" placeholder="Enter text key name" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="value" class="form-label">Text (Value)</label>
                                <input type="text" id="value" class="form-control" name="value" placeholder="Enter text value" required>
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
@endpush
