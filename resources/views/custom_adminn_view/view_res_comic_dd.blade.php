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
                            <form action="{{ route('dosearch')}}" method="post">
                            @csrf
                              <div class="row mt-5">
                                  <div class="col-md-10">
                                  <input type="text" class="form-control" placeholder="Have a question? Ask Now" name="url" value ="{{ $url }}">
                                  </div>
                                  <div class="col-md-2">
                                  <button type="submit" class="btn btn-primary">Search</button>
                                  </div>
                                </div>
                            </form>
                            <form action="{{ crudbooster::mainpath('add-save') }}" method="Post" >
                            @csrf

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
                                        <td id = "{{$i + 1 }}"><input type="checkbox" name="checkbox[]"  value =" {{ $i }}"  class="form-check-input" ></td>
                                        <td style = "width :200px">{{ $arrMovie[$i][0] }} <input type="text" name="<?php echo 'title'.$i; ?>" value = "{{ $arrMovie[$i][0] }}" hidden> </td>
                                        <td><img src="{{ $arrMovie[$i][1] }}" width="130"><input type="text" name="<?php echo 'img'.$i; ?>" value = "{{ $arrMovie[$i][1] }}" hidden></td>
                                        <td style = "width :700px">{{ $arrMovie[$i][2] }} <input type="text" name="<?php echo 'des'.$i; ?>" value = "{{ $arrMovie[$i][2] }}" hidden></td>
                                        <td>{{ $arrMovie[$i][3] }}  <input type="text" name="<?php echo 'ep'.$i; ?>" value = "{{ $arrMovie[$i][3] }}" hidden></td>
                                        <input type="text" name="<?php echo 'url'.$i; ?>" value = "{{ $arrMovie[$i][4] }}" hidden>
                                      </tr>
                                  @endfor
                                </tbody>
                              </table>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                                </div>
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
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
@endsection
