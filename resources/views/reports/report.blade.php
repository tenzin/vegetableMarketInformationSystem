@extends('master')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
          <form class="form-horizontal" method="POST" action = "/reports">
            @csrf
          <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">View Report</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    @if ($errors->any())
                      <div class="col-sm-12">
                          <div class="alert  alert-warning alert-dismissible fade show" role="alert">
                              @foreach ($errors->all() as $error)
                                  <span><p>{{ $error }}</p></span>
                              @endforeach
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                          </div>
                      </div>
                  @endif

                  @if (session('success'))
                      <div class="col-sm-12">
                          <div class="alert  alert-success alert-dismissible fade show" role="alert">
                              {{ session('success') }}
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                          </div>
                      </div>
                  @endif
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="product_type_id">Product Type:<font color="red">*</font></label>
                            <select  name="product_type" id="product_type_id" class="form-control select2bs4">
                                <option value="0">All</option>
                                @foreach($ptypes as $ptype)
                                <option value="{{ $ptype->id }}">{{$ptype->type}}</option>
                                @endforeach
                              </select>
                          </div>                
                        </div>
                        <div class="col-md-6 mb-3">
                    <label for="state">Product<font color="red">*</font></label>
                    <select class="custom-select d-block w-100" id="product" name="product" required>
                      <option value="">All</option>
                    </select>
                    <div class="invalid-feedback">
                      Please provide a valid state.
                    </div>
                  </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  @csrf
                  <div class="card-footer">                   
                    <button type="submit" class="btn btn-primary">Search</button>
                  </div>
          </div>
        </form>
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title"> ....  List</h3>
                </div>
                <div class="card-body">
                      <table id="example3" class="display table table-bordered">
                        <thead>                  
                            <tr>
                                <th>Sl. No.</th>
                                <th>Type</th>
                                <th>Product</th>
                                <th>Quantity(unit)</th>
                                <th>Expected Prize(Nu.)</th>
                                <th>Gewog</th>
                                <th>Dzongkhag</th>
                                <th>Date</th>
                              </tr>
                        </thead>
                        <tbody>
                           @foreach($details as $report)
                            <tr>
                              <td>{{$loop->iteration}}</td>
                              <td>{{$report->productType->type}}</td> 
                              <td>{{$report->product->product}}</td> 
                              <td>{{$report->quantity}} {{$report->unit->unit}}</td> 
                              <td>{{$report->price}}</td> 
                              <td>{{$report->transaction->gewog->gewog}}</td>
                              <td>{{$report->transaction->dzongkhag->dzongkhag}}</td>
                              <td>{{$report->created_at}}</td>                   
                            </tr>
                           @endforeach 
                        </tbody>
                      </table>
                </div>
            </div>
                 
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All data are loaded')
    })
    $(document).ready(function () {
        $("#product_type_id").on('change',function(e){
            console.log(e);
            var id = e.target.value;
            //alert(id);
            $.get('/json-product_type?product_type=' + id, function(data){
                console.log(data);
                $('#product').empty();
                $('#product').append('<option value="0">All</option>');
                $.each(data, function(index, ageproductObj){
                    $('#product').append('<option value="'+ ageproductObj.id +'">'+ ageproductObj.product + '</option>');
                })
            });
        });

    });

</script>
    
@endsection
@section('custom_scripts')
  @include('Layouts.addscripts')
  <script>
  $(document).ready( function () 
  {
    $("#example3").DataTable({
        dom: 'B<"clear">lfrtip',
        //buttons: [ 'copy','print','excel','pdf']
        buttons: [
            {
                  extend: 'copy',
                  title:'Product List',
                  exportOptions: {
                    columns: [0, 1, 2]
                }
            },           
            {
                  extend: 'print',
                  exportOptions: {
                    columns: [0, 1, 2]
                }
              },
            {
                  extend: 'excelHtml5',
                  title: 'Data export',
                  exportOptions: {
                    columns: [0, 1, 2]
                }
              },
              {
                  extend: 'pdfHtml5',
                  title: 'Data export',
                  exportOptions: {
                    columns: [ 0, 1, 2]
                }
              }
          ]
    });

  });

</script>     
@endsection