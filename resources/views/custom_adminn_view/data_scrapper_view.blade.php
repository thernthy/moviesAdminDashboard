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
                                <div class="shearchWraper">
                                    <div class='form-group srapper_form {{$header_group_class}} {{ ($errors->first($name))?"has-error":"" }}' id='form-group-{{$name}}' style="{{@$form['style']}} width:100%;">
                                        <div class="input-group" style="width:80%;">
                                            <input type='text' class='form-control notfocus input_date' name="url" id="InputUrl" style="width:100%;" />
                                        </div>
                                        <div class="input-group">
                                          <button type="submit" class="btn btn-sm btn-default btn-success"><i class="fa-solid fa-gears"></i>Running</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <form id="scrapperdataform">
                                @csrf
                                <table id="table_dashboard" class="table table-hover">
                                    <thead style="background: #548dbc; padding:10px 0;">
                                        <tr>
                                            <th><label><input type="checkbox" id="checkAll">All</label></th>
                                            <th>Select Cateogry</th>
                                            <th>Title</th>
                                            <th>Derc</th>
                                            <th>Image Url</th>
                                            <th>Url</th>
                                        </tr>
                                    </thead>
                                    <tbody id="content-wrapper">
                                    </tbody>
                                </table>
                                <button type="button" id="submitBtn" class="btn btn-success">Save</button>
                                <button type="button" onclick="testing()" class="btn btn-success">Testing</button>
                            </form>
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
            var url = '{{url('/scrapping')}}';
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
        if (data.element) {
            var dataElement = data.element;
            const category_option = data.category;
            dataRow = dataElement.map((item, index) => {
                return `
                    <tr>
                        <td><input type="checkbox" name="checkbox_name[]" class="checkElement"></td>
                        <td>
                            <select class="form-select">
                               ${category_option.map(option => `<option value="${option.id}">${option.name}</option>`).join('')}
                            </select>
                        </td>
                        ${item.map(dataElement => generateTableRow(dataElement, index)).join('')}
                    </tr>`;
            }).reverse().join('');
            $('#content-wrapper').html(dataRow);
        } else {
            displayNotFound();
        }
    }
    function generateTableRow(dataElement) {
        let tableCell = '';
        if (typeof dataElement === 'string') {
            try {
                let objectData = JSON.parse(dataElement);
                let buttons = '';
                for (const [key, value] of Object.entries(objectData)) {
                    buttons += `<a href="${value}" target="_blank" class="btn btn-success">${key}</a>`;
                }
                tableCell = `<td>${buttons}</td>`;
            } catch (error) {
                if (dataElement.includes("data/file/movie/mg_")) {
                    tableCell = `<td><img src="${dataElement}" class="rounded mx-auto" /></td>`;
                } else {
                    tableCell = `<td>${dataElement}</td>`;
                }
            }
        } else {
            tableCell = `<td><input type="text" /></td>`;
        }
        return tableCell;
    }
    
    $(document).ready(function() {
            $('#checkAll').click(function() {
                $('.checkElement').prop('checked', this.checked);
            });
            $('.checkElement').click(function() {
                $('#checkAll').prop('checked', $('.checkElement:checked').length === $('.checkElement').length);
            });
    });

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
    
   function testing() {
            var selectedData = [];
            $('table tr').each(function() {
            if ($(this).find('.checkElement').prop('checked')) {
                var rowData = {
                    'imgSrc': '',
                    'text': $(this).find('td:nth-child(3)').text(),
                    'decr': $(this).find('td:nth-child(5)').text(), 
                    'selectedOption': '',
                    'links': []
                };
                if(rowData.text == ''){
                   $(this).find('td:nth-child(3)').each(function() {
                        var inputValue = $(this).find('input').val();
                        rowData.text = inputValue;
                    });
                }
                var imgElement = $(this).find('img');
                if (imgElement.length > 0 && imgElement.attr('src')) {
                    rowData.imgSrc = imgElement.attr('src');
                } else {
                    rowData.imgSrc = $(this).find('td:nth-child(4)').text();
                }
                
                var selectedValue = $(this).find('.form-select').val();
                // Update selectedOption if a value is selected
                if (selectedValue !== null) {
                    rowData.selectedOption = selectedValue;
                }
                var links = $(this).find('a');
                if (links.length > 0) {
                    // Iterate over each <a> element and push its text and href into rowData.links
                    links.each(function() {
                        var linkObj = {};
                        linkObj[$(this).text()] = $(this).attr('href');
                        rowData.links.push(linkObj);
                    });
                } else {
                   rowData.links = $(this).find('td:nth-child(6)').text()
                }
                selectedData.push(rowData);
            }
        });
        console.log(selectedData)
   }
    
$(document).ready(function() {
    $('#submitBtn').click(function() {
         $('#loading-component').show();
        var selectedData = [];
        $('table tr').each(function() {
            if ($(this).find('.checkElement').prop('checked')) {
                var rowData = {
                    'imgSrc': '',
                    'text': $(this).find('td:nth-child(3)').text(),
                    'decr': $(this).find('td:nth-child(5)').text(), 
                    'selectedOption': '',
                    'links': []
                };
                if(rowData.text == ''){
                   $(this).find('td:nth-child(3)').each(function() {
                        var inputValue = $(this).find('input').val();
                        rowData.text = inputValue;
                    });
                }
                var imgElement = $(this).find('img');
                if (imgElement.length > 0 && imgElement.attr('src')) {
                    rowData.imgSrc = imgElement.attr('src');
                } else {
                    rowData.imgSrc = $(this).find('td:nth-child(4)').text();
                }
                
                var selectedValue = $(this).find('.form-select').val();
                // Update selectedOption if a value is selected
                if (selectedValue !== null) {
                    rowData.selectedOption = selectedValue;
                }
                var links = $(this).find('a');
                if (links.length > 0) {
                    // Iterate over each <a> element and push its text and href into rowData.links
                    links.each(function() {
                        var linkObj = {};
                        linkObj[$(this).text()] = $(this).attr('href');
                        rowData.links.push(linkObj);
                    });
                } else {
                   rowData.links = $(this).find('td:nth-child(6)').text()
                }
                selectedData.push(rowData);
            }
        });
        if(selectedData!=''){
            $.ajax({
                url: '{{url('')}}/savedata',
                method: 'POST',
                data: { selectedData: selectedData },
                success: function(response) {
                    console.log(response.datasend)
                    console.log('ok')
                     $('#loading-component').hide();
                    // Handle success response from the server
                },
                error: function(xhr, status, error) {
                    // Handle error response from the server
                }
            });
        }
    });
});

</script>
    <!--<script>
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
    </script>-->
@endsection