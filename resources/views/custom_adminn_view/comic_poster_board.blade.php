@extends('crudbooster::admin_template')
@section('content')
   <style>
       .input-group.siteNamelist > ul {
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }
        .input-group.siteNamelist ul >li {
            padding: 10px;
            list-style: none;
            font-size: 1.4rem;
        }
        .input-group.siteNamelist ul li > label{
            font-size: 1.4rem;
        }
        .input-group.siteNamelist ul li label > input{
            
        }
        form.crawer-wrapper{
            display: flex;
            flex-direction:column;
            align-items: flex-start;
            justify-content: space-between;
        }
        form > .shearchWraper{
            display: flex;
            width: 100%;
            align-items: flex-start;
            justify-content: space-between;
        }
        #table_dashboard.table-bordered, #table_dashboard.table-bordered thead tr th, #table_dashboard.table-bordered tbody tr td   {
            border:0;
        }
        #table_dashboard.table-bordered, #table_dashboard.table-bordered thead tr th, #table_dashboard.table-bordered tbody tr td{
            border:0;
        }
        #loading-component{
            background: #ffffff00;
            width: 100%;
            z-index: 1000;
            position: fixed;
            bottom: 50%;
            left: 0;
            transform: translate(50%, -50%);
        }
        .loader {
          width: 48px;
          height: 48px;
          border: 3px solid #FFF;
          border-radius: 50%;
          display: inline-block;
          position: relative;
          box-sizing: border-box;
          animation: rotation 1s linear infinite;
        }
        .loader::after {
          content: '';  
          box-sizing: border-box;
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%);
          width: 56px;
          height: 56px;
          border-radius: 50%;
          border: 3px solid;
          border-color: #548dbc #f6c45d;
        }
        
        @keyframes rotation {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        } 
   </style>
    <div id='wrapper'>
        <div id='crud'>
            <div id='crud-panel'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <strong>{{ cbLang('crawl_board') }}</strong>
                    <div class='panel-body'>
                        <div id="loading-component" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="loader"></span>
                            </div>
                        </div>
                       <div class="box">
                        <div class="box-header">
                            <form id="crawlerBoard" action="{{ route('dosearch')}}" method="post" class="crawer-wrapper">
                                @csrf
                                <div class="shearchWraper">
                                    <div class="input-group col-12" style="width:100%;">
                                            <div class="input-group">
                                                <span class="input-group-addon open-datetimepicker"><a><i class='fa fa-calendar'></i></a></span>
                                                <input type="text" name="url"class='form-control notfocus input_date' >
                                            </div>
                                            <div class="input-group-btn">
                                              <button type="submit" class="btn btn-sm btn-default btn-success"><i class="fa-solid fa-gears"></i>{{ cbLang('running') }}</button>
                                            </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table id="table_dashboard" class="table table-hover">
                                <thead style="background: #548dbc; padding:10px 0;">
                                    <tr>
                                        <th>{{cbLang('site_name')}}</th>
                                        <th>{{ cbLang('collection') }} {{ cbLang('url') }}</th>
                                        <th>{{ cbLang('post') }} {{ cbLang('title') }}</th>
                                        <th>{{ cbLang('creation_date') }}</th>
                                        <th>{{cbLang('registration')}} {{ cbLang('status') }}</th>
                                        <th>{{cbLang('text_delete')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="content-wrapper">
                                </tbody>
                            </table>
                            {{--{!! $data['crawl_boards']->render() !!}--}}
                        </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection
