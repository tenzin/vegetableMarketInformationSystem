@extends('master')
@section('content')
{{-- <section class="content">
   <h3 class="text-center mt-1 mb-1 alert aqua">Demand Detail Information</h3>
      
   <div class="card">
      
      <div class="card-body">
         <table id="example1" class="table table-bordered table-striped">
         <div class="form-group row">
             <div class="col-md-4">
                  ProductName:<select class="form-control" name="agency_code" id="agency" >
                           <option disabled>Please select your ProductName</option>
                          </select>
              </div>
              <div class="col-md-4">
                  Date:<select class="form-control" name="date" id="agency" >
                       <option disabled>Please select your Date</option>
                    </select>
              </div>
          </div>
            <thead>
               <tr>
                  <th>Sl. no</th>
                  <th>Product</th>
                  <th>Quantity</th>
                  <th>CostPrice</th>
                  <th>Tentitive Pickup Date</th>
                  <th>Remarks</th>
                  <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
               </tr>
            </thead>
            <tr>
               <td> 1</td>
               <td>Potato</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
            </tr>
            <tr>
               <td> 2</td>
               <td>Potato</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
            </tr>
            <tr>
               <td>3</td>
               <td>Potato</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
            </tr>
         </table>
      </div>
   </div>
</section> --}}
<h3 class="text-center mt-1 mb-1 alert aqua">Surplus Details Information</h3>
      
<section class="content">
   <div class="card">
      
      <div class="card-body">
         <table id="example1" class="table table-bordered table-striped">
         <div class="form-group row">
             <div class="col-md-4">
                  ProductName:<select class="form-control" name="agency_code" id="agency" >
                           <option disabled>Please select your ProductName</option>
                          </select>
              </div>
              <div class="col-md-4">
                  Date:<select class="form-control" name="date" id="agency" >
                       <option disabled>Please select your Date</option>
                    </select>
              </div>
          </div>
            <thead>
               <tr>
                  <th>Sl. no</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Product Type</th>
                  <th>Date</th>
                  <th>Remarks</th>
                  <th>Action &nbsp;<span class="fa fa-cogs"></span></th>
               </tr>
            </thead>
            <tr>
               <td> 1</td>
               <td>Potato</td>
               <td>12</td>
               <td>50</td>
               <td>12/05/2020</td>
               <td>rquiered</td>
            </tr>
         </table>
      </div>
   </div>
</section>
@endsection