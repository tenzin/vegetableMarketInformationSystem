<!-- Content Wrapper. Contains page content -->
@extends('master')
    
@section('content')
{{-- @include('flash-message') --}}
<section class="content">
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Cultivation Information
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Sl. no</th>
            <th>Crop_name</th>
            <th>Acerage</th>
            <th>Sowing_Date</th>
            <th>Estimated Output</th>
            <th>Estimated Output Unit</th>
            <th>Status</th>
            <th>Update</th>
          </tr>
        </thead>
        <tbody>
                    <tr>
                      <td>1</td>
                      <td>Cabbage</td>
                      <td>20 Acres</td>
                      <td>25/06/2020</td>
                      <td>1000kg</td>
                      <td>20 Acres</td>
                      <td>Avaliable</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Chilli</td>
                      <td>20 Acres</td>
                      <td>25/06/2020</td>
                      <td>1000kg</td>
                      <td>20 Acres</td>
                      <td>Avaliable</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Potatoes</td>
                      <td>20 Acres</td>
                      <td>25/06/2020</td>
                      <td>1000kg</td>
                      <td>20 Acres</td>
                      <td>Avaliable</td>
                    </tr>
        </tbody>
          
      </table>
    </div>
</div>  
</section>

</div>
</div>
@endsection
   
     












