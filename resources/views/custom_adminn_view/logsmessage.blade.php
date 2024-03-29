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
            background: #00000026;
            width: 100%;
            z-index: 1000;
            height:100vh;
            position: fixed;
            display:flex;
            align-items:center;
            justify-content:center;
            top:0;
            left: 0;
    }
    .loader {
      width: 175px;
      height: 80px;
      display: block;
      margin:auto;
      background-image: radial-gradient(circle 25px at 25px 25px, #FFF 100%, transparent 0), radial-gradient(circle 50px at 50px 50px, #FFF 100%, transparent 0), radial-gradient(circle 25px at 25px 25px, #FFF 100%, transparent 0), linear-gradient(#FFF 50px, transparent 0);
      background-size: 50px 50px, 100px 76px, 50px 50px, 120px 40px;
      background-position: 0px 30px, 37px 0px, 122px 30px, 25px 40px;
      background-repeat: no-repeat;
      position: relative;
      box-sizing: border-box;
    }
    .loader::before {
      content: '';  
      left: 60px;
      bottom: 18px;
      position: absolute;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background-color: #FF3D00;
      background-image: radial-gradient(circle 8px at 18px 18px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 18px 0px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 0px 18px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 36px 18px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 18px 36px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 30px 5px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 30px 5px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 30px 30px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 5px 30px, #FFF 100%, transparent 0), radial-gradient(circle 4px at 5px 5px, #FFF 100%, transparent 0);
      background-repeat: no-repeat;
      box-sizing: border-box;
      animation: rotationBack 3s linear infinite;
    }
    .loader::after {
      content: '';  
      left: 94px;
      bottom: 15px;
      position: absolute;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      background-color: #FF3D00;
      background-image: radial-gradient(circle 5px at 12px 12px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 12px 0px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 0px 12px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 24px 12px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 12px 24px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 20px 3px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 20px 3px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 20px 20px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 3px 20px, #FFF 100%, transparent 0), radial-gradient(circle 2.5px at 3px 3px, #FFF 100%, transparent 0);
      background-repeat: no-repeat;
      box-sizing: border-box;
      animation: rotationBack 4s linear infinite reverse;
    }
    
    @keyframes rotationBack {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(-360deg);
      }
    }  
        div.srapper_form{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .rounded.mx-auto{
            width:200px;
            height:200px;
        }
   </style>
    <div id='wrapper'>
        <div id='crud'>
            <div id='crud-panel'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <strong>{{ cbLang('link_scrapper') }}</strong>
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
                                <div class="shearchWraper">
                                    <div class='form-group srapper_form {{$header_group_class}} {{ ($errors->first($name))?"has-error":"" }}' id='form-group-{{$name}}' style="{{@$form['style']}} width:100%;">
                                        <div class="input-group" style="width:80%;">
                                            <input type='text' class='form-control notfocus input_date' name="url" placeholder="{{cbLang('enter_url')}}" id="InputUrl" style="width:100%;" />
                                        </div>
                                        <div class="input-group">
                                          <button type="submit" class="btn btn-sm btn-default btn-success"><i class="fa-solid fa-gears"></i>{{ cbLang('running') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <div id="log-container"></div>
                        </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script>
        function fetchLogs() {
            fetch('/logms')
                .then(response => response.json())
                .then(logs => {
                    // Update UI with logs
                    const logContainer = document.getElementById('log-container');
                    logContainer.innerHTML = logs.join('<br>');
                })
                .catch(error => console.error('Error fetching logs:', error));
        }
        // Fetch logs every 5 seconds (adjust as needed)
        setInterval(fetchLogs, 5000);
    </script>
@endsection