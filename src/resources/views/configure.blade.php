@extends('web::layouts.grids.12')

@section('title', trans('text::text.configure'))
@section('page_header', trans('text::text.configure'))

@push('head')
<link rel = "stylesheet"
   type = "text/css"
   href = "https://snoopy.crypta.tech/snoopy/seat-text-configure.css" />
@endpush

@section('full')

@if($pages->isEmpty())

<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title">{{ trans('text::text.no_texts') }}</h3>
    </div>
    <div class="card-body">
        <p>You dont appear to have any pages configured. Perhaps you should check out the instructions page!</p>
        <a type="button" href="{{ route('text.instructions') }}" class="btn btn-warning">{{ trans('text::text.instructions') }}</a>
    </div>
</div>

@endif

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">{{ trans('text::text.existing_text') }}</h3>
        <div class="card-tools float-right">
            <button type="button" class="btn btn-xs btn-tool" id="addText" data-toggle="tooltip" data-placement="top"
                title="Add a new text">
                <span class="fa fa-plus-square"></span>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table id="pages" class="table table table-bordered table-striped">
            <thead>
                <tr>
                <!-- TODO LOCALISE THIS -->
                    <th>Name</th>
                    <th>URL</th>
                    <th>Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pages as $page)
                <tr id="pageid" data-id="{{ $page['id'] }}">
                    <td>{{ $page->name }}</td>
                    <td>{{ $page->url }}</td>
                    <td>{{ substr(preg_replace( "/\r|\n/", "", $page->text), 0, 60) }}</td>
                    <td class="no-hover pull-right" style="min-width: 80px;">
                        <a type="button" id="viewtext" class="btn btn-xs btn-success" data-id="{{ $page['id'] }}" data-toggle="tooltip" data-placement="top" title="View Fitting" href="{{ $page->link }}">
                            <span class="fa fa-eye text-white"></span>
                        </a>
                        <button type="button" id="edittext" class="btn btn-xs btn-warning" data-id="{{ $page['id'] }}" data-toggle="tooltip" data-placement="top" title="Edit Text">
                            <span class="fas fa-edit text-white"></span>
                        </button>
                        <button type="button" id="deletetext" class="btn btn-xs btn-danger" data-id="{{ $page['id'] }}" data-toggle="tooltip" data-placement="top" title="Delete Text">
                            <span class="fa fa-trash text-white"></span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted">
        Plugin maintained by <a href="{{ route('text.about') }}"> {!! img('characters', 'portrait', 96057938, 64, ['class' => 'img-circle eve-icon small-icon']) !!} Crypta Electrica</a>. <span class="float-right snoopy" style="color: #fa3333;"><i class="fas fa-signal"></i></span>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="pageConfirmModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title">Are you sure?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this text?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="deleteConfirm" data-dismiss="modal">Delete Text</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="textEditModal">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">{{ trans('text::text.new') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fa fa-times"></span></button>
            </div>
            <form role="form" action="{{ route('text.createText') }}" method="post" class="needs-validation"
                novalidate>
                <input type="hidden" id="id" name="id" value="0">
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row">
                            <div class="form-group col">
                                <label for="name">{{ trans('text::text.name') }}</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Name"
                                    required>
                                <div class="valid-feedback">Looks Good!</div>
                                <div class="invalid-feedback">You need to specify a name</div>
                            </div>

                            <div class="form-group col">
                                <label for="url">URL Stub</label>
                                <input type="text" name="url" class="form-control" id="url" placeholder="url"
                                    required>
                                <div class="valid-feedback">Looks Good!</div>
                                <div class="invalid-feedback">You need to specify a url stub</div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="text">Text</label>
                            <textarea name="text" class="form-control" id="text" placeholder="FILL ME UP, BUTTERCUP!" rows="15"
                                required></textarea>
                            <div class="valid-feedback">Looks Good!</div>
                            <div class="invalid-feedback">The whole point is to have some data here!</div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="btn-group float-right" role="group">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <input type="submit" class="btn btn-primary" id="savetext" value="Create Text" />
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop

@push('javascript')
@include('web::includes.javascript.id-to-name')
<script type="application/javascript">
    $(function () {
        $('#pages').DataTable();

        $('#addText').on('click', function () {
            $('#textEditModal').modal('show');
            $('#id').val('0');
            $('#name').val('');
            $('#url').val('');
            $('#text').val('');
        });

        $('#textEditModal').on('shown.bs.modal', function () {
            $('#textEditModal').trigger('focus')
        });

        $('#pages').on('click', '#deletetext', function () {
        $('#pageConfirmModal').modal('show');
        $('#id').val($(this).data('id'));
    }).on('click', '#edittext', function () {
        id = $(this).data('id');
        $('#textEditModal').modal('show');
        $('#id').val(id);

        $.ajax({
            headers: function () {
            },
            url: "/text/gettextbyid/" + id,
            type: "GET",
            datatype: 'json',
            timeout: 10000
        }).done( function (result) {
            $('textarea#text').val(result.text);
            $('#url').val(result.url);
            $('#name').val(result.name);
        }).fail( function(xmlHttpRequest, textStatus, errorThrown) {
        });
    });


    $('#deleteConfirm').on('click', function () {
       id = $('#id').val();
        $('#pages #fitid[data-id="'+id+'"]').remove();

        $.ajax({
            headers: function () {
            },
            url: "/text/deltextbyid/" + id,
            type: "GET",
                datatype: 'json',
            timeout: 10000
        }).done( function (result) {
            $('#pages #pageid[data-id="'+id+'"]').remove();
        }).fail( function(xmlHttpRequest, textStatus, errorThrown) {
        });
    });

    });
</script>


@endpush