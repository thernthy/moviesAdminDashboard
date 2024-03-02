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
                        <strong>List of Crawl Boards</strong>
                    <div class='panel-body'>
                        <div id="loading-component" style="display: none;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="loader"></span>
                            </div>
                        </div>
                       <div class="box">
                        <div class="box-header">
                            <form id="crawlerBoard" class="crawer-wrapper">
                                @csrf
                                <div class="input-group siteNamelist">
                                    <ul>
                                        @if(!$data['siteList']->isEmpty())
                                        <li>
                                            <label>
                                                <input type="checkbox" value="YourValueHere" id="checkAll"> Check All
                                            </label>
                                        </li>
                                        @foreach($data['siteList'] as $site)
                                        <li>
                                            <label>
                                                <input type="checkbox" class="siteNameCheckbox" name="siteName[]" value="{{$site->site}}"> 
                                                {{$site->site}}
                                            </label>
                                        </li>
                                        @endforeach
                                        @endif
                                        
                                    </ul>
                                </div>
                                <div class="shearchWraper">
                                    <div class='form-group {{$header_group_class}} {{ ($errors->first($name))?"has-error":"" }}' id='form-group-{{$name}}' style="{{@$form['style']}}">
                                            <div class="input-group">
                                                <span class="input-group-addon open-datetimepicker"><a><i class='fa fa-calendar'></i></a></span>
                                                <input type='text' id="date" title="{{$form['label']}}" readonly {{$required}} {{$readonly}} {!!$placeholder!!} {{$disabled}} class='form-control notfocus input_date' name="dateFile" id="{{$name}}" value='{{$value}}'/>
                                            </div>
                                            <div class="text-danger">{!! $errors->first($name)?"<i class='fa fa-info-circle'></i> ".$errors->first($name):"" !!}</div>
                                            <p class='help-block'>{{ @$form['help'] }}</p>
                                    </div>
                                    <div class="input-group">
                                            <select  name="cateroymovies" style="width: 200px; text-align: center;" class="form-control input-sm">
                                                @foreach($data['categorymovies'] as $item)
                                                <option value="{{$item->id}}">={{$item->name}}=</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-btn">
                                              <button type="submit" class="btn btn-sm btn-default btn-success"><i class="fa-solid fa-gears"></i>Running</button>
                                            </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table id="table_dashboard" class="table table-hover">
                                <thead style="background: #548dbc; padding:10px 0;">
                                    <tr>
                                        <th>Site name</th>
                                        <th>Collection URL</th>
                                        <th>Post title</th>
                                        <th>Creation date</th>
                                        <th>Registration status</th>
                                        <th>delete</th>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('crawlerBoard').addEventListener('submit', function(event) {
            event.preventDefault();
            $('#loading-component').show();
            var formData = new FormData(this);
            var url = '{{url('/admin/crawler')}}';
            fetchData(url, formData);
        });
    });

    function fetchData(url, formData) {
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            $('#loading-component').hide();
            updateContent(data);
        })
        .catch(error => {
            console.error('There was an error!', error);
        });
    }

    function updateContent(data) {
        let dataRow = '';
        if (data.success && data.data[1].length > 0) {
            var data = data.data;
            dataRow = data[0].map(ResuleSite => {
                let site = ResuleSite[0];
                return data[1].map(movie => {
                    return generateTableRow(site, movie);
                }).join('');
            }).join('');
            $('#content-wrapper').html(dataRow);
        } else {
            displayNotFound();
        }
    }

    function generateTableRow(site, movie) {
        return `
            <tr>
                <td>${site.name}</td>
                ${
                    (site.name !== 'kotv-001.com') ?
                    `<td><a href="${site.url}movie/play/${movie.title}/${movie.episode}">${site.url}movie/play/${movie.title}/${movie.episode}</a></td>` :
                    `<td><a href="${site.url}movie/${movie.name}/${movie.episode}/${movie.title}">${site.url}movie/${movie.name}/${movie.episode}/${movie.title}</a></td>`
                }
                <td>${movie.title}</td>
                <td>${movie.created_at}</td>
                <td>${(movie.status==1)? `<span style="color:green;">active</span>`: `<span style="color:red;">inactive</span>`}</td>
                <td><button class="btn btn-danger">Delete</button></td>
            </tr>`;
    }

    function displayNotFound() {
        let notFound = `
            <tr>
                <td colspan="6">
                    <div style="
                        width: fit-content;
                        margin: auto;
                        text-align: center;">
                        <lord-icon src="https://cdn.lordicon.com/rkiwwysn.json"
                            trigger="loop"
                            delay="2000"
                            colors="primary:#e83a30"
                            style="width:50px;height:50px">
                        </lord-icon>
                        <h3 style="
                            font-size: 3rem;
                            color: #548dbc;font-weight: 800;">404 Not Found</h3>
                    </div>
                </td>
            </tr>`;
        $('#content-wrapper').html(notFound);
    }
</script>
    <script>
        $(function() {
                var $datepickerInput = $('#date');
                $datepickerInput.datepicker({
                    dateFormat: 'Y-m-d', 
                    yearRange: '2024:c+10', 
                    onSelect: function(dateText, inst) {
                        $datepickerInput.val(dateText);
                    }
                });
            });
        $(document).ready(function() {
            $('#checkAll').click(function() {
                $('.siteNameCheckbox').prop('checked', $(this).prop('checked'));
            });
            $('.siteNameCheckbox').click(function() {
                if (!$(this).prop('checked')) {
                    $('#checkAll').prop('checked', false);
                }
            });
        });
    </script>
@endsection
