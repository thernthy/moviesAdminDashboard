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
        action="{{ crudbooster::mainpath('edit-save/'.$row->id) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="panel-body">
            {{ form_input(cbLang('title'), "title", "text", 10,  "","required value='$row->title'") }}
            
            {{ form_start_combobox(cbLang('select_cateogry'), "movie_category_id", 10, "", "required", "select2") }}
                @foreach($category as $item)
                    <option value="{!! $item->id !!}" @if($row->movie_category_id == $item->id) {{ "selected='selected'" }} @endif>{!! $item->val !!}</option>
                @endforeach
            {{ form_end_combobox() }}
            
            @if($row->movei_cover_path!=null)
                <div class="form-group header-group-0" id="form-group-file" style="">
                    <label class="col-sm-2 control-label">{{ cbLang('cover_photo') }}</label>
                    <div class="col-sm-10">
                        @php
                            $movieCoverPath = $row->movei_cover_path;
                            $isUploaded = str_starts_with($movieCoverPath, 'uploads/');
                            $imageUrl = $isUploaded ? URL::to('/').'/'.$movieCoverPath : $movieCoverPath;
                        @endphp
                        {{-- Debugging statements --}}
                        {{-- Is uploaded: {{ $isUploaded ? 'Yes' : 'No' }} --}}
                        {{-- Image URL: {{ $imageUrl }} --}}
                        <p><a data-lightbox="roadtrip" href="{{ $imageUrl }}">
                            <img style="max-width:160px" title="Image" src="{{ $imageUrl }}">
                        </a></p>

                        <input type="hidden" name="_photo_cover" value="{{ $row->movei_cover_path }}">
                        <p><a class="btn btn-danger btn-delete btn-sm" onclick="if(!confirm('Are you sure ?')) return false" href="{{ CRUDBooster::mainpath('delete-image?image='.$row->movei_cover_path.'&id='.$row->id.'&column=photo_cover') }}"><i class="fa fa-ban"></i> Delete </a></p>
                        <p class="text-muted"><em>{{ cbLang('delet_img_rule') }}</em></p>

                        <div class="text-danger"></div>
                    </div>
                </div>
            @else
                {{ form_mediapicker(cbLang('cover_photo'), "movei_cover_path", 10, "", '') }}
            @endif
            
            @php
                $actionnya = unserialize($row->keyword_id); 
            @endphp
            {{ form_start_combobox(cbLang('keyword.keywords'), "keyword_id[]", 10, "", "required multiple='multiple'", "select2", false) }}
                @if(!empty($actionnya))
                    @foreach ($keyword as $key => $item)
                    <option value="{!! $item->id !!}" {{ in_array($item->id, $actionnya) ? 'selected' : '' }}>{!! $item->id !!}  {!! $item->val !!}</option>
                    @endforeach
                @else
                    @foreach ($keyword as $key => $item)
                        <option value="{!! $item->id !!}">{!! $item->id !!} {!! $item->val !!}</option>
                    @endforeach
                @endif
            {{ form_end_combobox() }}
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <div class="callout callout-info">
                        <h4><i class="fa fa-exclamation-circle"></i>{{ cbLang('note') }}</h4>
                        <p>{{ cbLang('note_text') }}</p>
                    </div>
                    <br>
                </div>
            </div>
            
            {{ form_start_combobox(cbLang('director.director'), "actors_id", 10, "", "required", "select2") }}
                @foreach($actors_id as $item)
                    <option value="{!! $item->id !!}" @if($row->actors_id == $item->id) {{ "selected='selected'" }} @endif>{!! $item->val !!}</option>
                @endforeach
            {{ form_end_combobox() }}
            <hr>
            {{ form_textarea(cbLang('dcr'), "description", "textarea", "", "$row->description") }}
            <div class="form-group">
                <label class="col-sm-2 control-label">{{cbLang('status')}}</label>
                <div class="col-sm-10">
                    <label><input type="radio" name="status" value="1" required {{($row->status==1)? 'checked':''}}>{{ cbLang('public') }}</label><br>
                    <label><input type="radio" name="status" value="0" required {{($row->status==0)? 'checked':''}}>{{ cbLang('private') }}</label>
                </div>
            </div>
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