@extends('crudbooster::admin_template')
@section('content')
<style>
    .select2-container--default .select2-selection--single {
        border-radius: 0px !important
    }
    .select2-container .select2-selection--single {
        height: 35px
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #3c8dbc !important;
        border-color: #367fa9 !important;
        color: #fff !important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #fff !important;
    }
    .spin {
        display: none;
    }
</style>
<p>
    <a title='Return' href="{{ crudbooster::adminPath('movies') }}"><i class='fa fa-chevron-circle-left '></i>
    &nbsp; {{cbLang('btn_back')}}</a></p>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong><i class="fa fa-tasks"></i>{{cbLang('movie.movies')}}</strong>
    </div>

    <form class="form-horizontal" method="post" id="form" enctype="multipart/form-data"
        action="{{ crudbooster::mainpath('add-save') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="panel-body">
            {{ form_input(cbLang('title'), "title", "text", 10,  "required") }}
            
            {{ form_start_combobox(cbLang('select_cateogry'), "movie_category_id", 10, "", "required", "select2") }}
                @foreach($category as $item)
                    <option value="{!! $item->id !!}">{!! $item->val !!}</option>
                @endforeach
            {{ form_end_combobox() }}
            
            {{ form_mediapicker(cbLang('cover_photo'), "movei_cover_path", 10, "require", '') }}

            {{ form_start_combobox(cbLang('keyword.keywords'), "keyword_id[]", 10, "", "required multiple='multiple'", "select2", false) }}
                    @foreach ($keyword as $key => $item)
                        <option value="{!! $item->id !!}">{!! $item->val !!}</option>
                    @endforeach
            {{ form_end_combobox() }}
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <div class="callout callout-info">
                        <h4><i class="fa fa-exclamation-circle"></i> Note:</h4>
                        <p>You could add more than one keyword.</p>
                    </div>
                    <br>
                </div>
            </div>
            {{ form_start_combobox(cbLang('director.director'), "actors_id", 10, "", "required", "select2") }}
                @foreach($actors_id as $item)
                    <option value="{!! $item->id !!}">{!! $item->val !!}</option>
                @endforeach
            {{ form_end_combobox() }}
            <hr>
            {{ form_textarea(cbLang('dcr'), "description", "textarea", "", "") }}
            {{ form_radio(cbLang('status'), "status") }}

             <!--<div class="form-group">
                <label for="id_keyword" class="col-sm-2 control-label"></label>
                <div class="col-md-10">
                    <ul id="keyword_activities"></ul>
                </div>
            </div> -->

        </div>
        <div class="panel-footer">
            <input type="submit" name="submit" value="{{ cbLang('button_save_more') }}"
                class='btn btn-success'>
            <input type="submit" name="submit" class="btn btn-primary" value="{{ cbLang('button_save') }}">
        </div>
    </form>
</div>
@endsection