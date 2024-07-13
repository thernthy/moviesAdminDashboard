@extends('crudbooster::admin_template')
@section('content')
    <div id='wrapper'>
        <div id='crud'>
            <div id='crud-panel'>
                <div class='panel panel-default'>
                    <div class='panel-heading'>
                        <strong>{{ cbLang('crawl_board') }}</strong>
                    <div class='panel-body'>
                        <div class="container">
                            <form action="" id = "saveForm" >
                                @csrf
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary" id ="saveBtn">Save</button>
                                </div>
                                <div class="text-center">
                                <img style ="position: absolute;" src="https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif" class = "img-fluid" alt="loading" id = "loadingIndicator1">
                                </div>
                                  <table class ="table mt-5" id="objPermissionTableContent">
                                    <thead>
                                      <tr>
                                        <th><input type="checkbox" name="check" id="" class="form-check-input"></th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Episode</th>
                                      </tr>
                                      <!-- <img src="" alt="" w> -->
                                    </thead>
                                    
                                    <tbody id="objPermissionTable">
                                      
                                      @for ($i = 0;  $i < count($arrMovie); $i++)
                                      <tr>
                                        <td id="{{$i + 1}}"><input type="checkbox" name="checkbox[]" value="{{ $i }}" class="form-check-input"></td>
                                        <td style="width:200px">{{ $arrMovie[$i][0] }} <input type="text" name="<?php echo 'title'.$i; ?>" value="{{ $arrMovie[$i][0] }}" hidden> </td>
                                        <td><img src="{{ $arrMovie[$i][1] }}" width="130"><input type="text" name="<?php echo 'img'.$i; ?>" value="{{ $arrMovie[$i][1] }}" hidden></td>
                                        <td style="width:700px">{{ $arrMovie[$i][2] }} <input type="text" name="<?php echo 'des'.$i; ?>" value="{{ $arrMovie[$i][2] }}" hidden></td>
                                        <td>{{ $arrMovie[$i][3] }}  <input type="text" name="<?php echo 'ep'.$i; ?>" value="{{ $arrMovie[$i][3] }}" hidden></td>
                                        <input type="text" name="<?php echo 'url'.$i; ?>" value="{{ $arrMovie[$i][4] }}" hidden>
                                        <input type="text" name="<?php echo 'genre'.$i; ?>" value="{{ $arrMovie[$i][5] }}" hidden>
                                      </tr>
                                      @endfor
                                    </tbody>
                                  </table>
                                  </form>
                                  
                                  </div>
                                 
                                  <script>
                                    $("#objPermissionTableContent th input[type='checkbox']").on("change", function() {
                                  var cb = $(this),
                                    th = cb.closest('th'),
                                    col = th.index() + 1;
                                  $("#objPermissionTable td:nth-child(" + col + ") input").prop("checked", this.checked);
                                });
                                
                                $(".form-check-input").on("change", function (e) {
                                  var pos = $(this).parent().parent().index();
                                  var isTrue = true;
                                  $("tr").find('td:eq('+pos+')').each(function(){
                                    if(!$(this).find('.form-check-input').prop('checked'))
                                      isTrue = false;
                                  });
                                  if(isTrue)
                                    $('tr th:eq('+pos+')').find('.form-check-input').prop('checked', true);
                                  else
                                    $('tr th:eq('+pos+')').find('.form-check-input').prop('checked', false);
                                });
                                $("tr>td .form-check-input").trigger('change');
                                
                                  </script>
                                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                <script>;
                                $(document).ready(function() {
                                  $('#loadingIndicator1').hide();
                                  $('#saveForm').on('submit', function(event) {
                                    $('#loadingIndicator1').show();
                                    event.preventDefault(); // Prevent default form submission
                                    
                                    // Array to store the checked checkbox values
                                    var checkedData = [];
                                
                                    // Iterate through each checkbox with name "checkbox[]"
                                    $('input[name="checkbox[]"]:checked').each(function() {
                                      var index = $(this).val();
                                      var title = $('input[name="title' + index + '"]').val();
                                      var img = $('input[name="img' + index + '"]').val();
                                      var des = $('input[name="des' + index + '"]').val();
                                      var ep = $('input[name="ep' + index + '"]').val();
                                      var url = $('input[name="url' + index + '"]').val();
                                      var genre = $('input[name="genre' + index + '"]').val();
                                      console.log(genre);
                                      // Push data into checkedData array
                                      checkedData.push({
                                        title: title,
                                        img: img,
                                        des: des,
                                        ep: ep,
                                        url: url,
                                        genre: genre
                                      });
                                    });
                                    
                                    if (checkedData.length === 0) { // Check if checkedData is empty
                                      $('#loadingIndicator1').hide();
                                      Swal.fire({
                                        text: "Please check first!",
                                        icon: "info"
                                      });
                                    } else {
                                      console.log(checkedData);
                                      // Send data to the server via AJAX
                                      $.ajax({
                                        url: '{{ route('dosave')}}', // Replace with your server-side script URL
                                        method: 'POST',
                                        data: {checkedData: checkedData, _token: '{{ csrf_token() }}' }, // Data to be sent to the server
                                        success: function(response) {
                                          $('#loadingIndicator1').hide();
                                          console.log(response);
                                          Swal.fire({
                                            text: response,
                                            icon: "info"
                                          });
                                        },
                                        error: function(xhr, status, error) {
                                          // Handle errors if any
                                          console.error(xhr.responseText);
                                        }
                                      });
                                    } 
                                  });
                                });
                                </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection
