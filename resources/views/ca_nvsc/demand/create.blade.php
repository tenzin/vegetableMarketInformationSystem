@extends('master')

@section('content')
<div class="container">
        <div class="py-2 text-center">
              <h1>Demand Form </h1>
                  <h5>Ref. No:&nbsp;<b>{{$nextNumber}}</b></h5>
                  <p class="lead">Enter the product that you wish to buy.</p>
              <hr>
        </div>
      <form method="POST" action = "{{route('demand-store')}}">
      <input type="hidden" name="refnumber" id="refnumber" value="{{ $nextNumber}}">
@csrf
<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Demand list</span>
      @isset($counts)
      <span class="badge badge-secondary badge-pill text-warning">{{$counts}}</span>
      @endisset
      
    </h4>
    <ul class="list-group mb-0">
      @isset($demands)
        @foreach($demands as $demand)
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
            <h6 class="my-0 text-primary">
            <a href="{{route('demand-edit',$demand->id)}}">
              <i class="fa fa-edit" aria-hidden="true"> </i> {{$demand->product}}</a>
            </h6>
              <small class="text-muted">{{$demand->type}}</small>
            </div>
            <small class="text-muted">Qty. {{$demand->quantity}} @ Nu. {{$demand->price}}</small>
            <a onclick="return confirm('Are you sure want do delete permanently?')" href="/demand-delete/{{$demand->id}}" class="text-danger">
              <i class="fa fa-trash" aria-hidden="true"> </i> Remove</a>
          </li>
        @endforeach
      @endisset
    </ul>
  </div>

  <div class="col-md-8 order-md-1">
    <h4 class="mb-3">Product details</h4>
    <form class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
          <label for="country">Product Type<font color="red">*</font></label>
          <select class="custom-select d-block w-100" id="producttype" name="producttype" required>
            <option value="">Choose...</option>
            @foreach($product_type as $row)
                <option value="{{$row->id}}">{{$row->type}}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">
            Please select a valid country.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="state">Product<font color="red">*</font></label>
          <select class="custom-select d-block w-100" id="product" name="product" required>
            <option value="">Choose...</option>
          </select>
          <div class="invalid-feedback">
            Please provide a valid state.
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-3 mb-3">
              <label for="qty">Quantity<font color="red">*</font></label>
              <input type="text" class="form-control" name="quantity" id ="quantity" placeholder ="Quantity">
              <div class="invalid-feedback">
                  Please enter Quantity.
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="unit">Unit<font color="red">*</font></label>
              <div class="input-group">
                  <select class="custom-select d-block w-100" id="ut" name="ut" required>
                  <option value="">Choose...</option>
                  @foreach($unit as $data)
                      <option value="{{$data->id}}">{{$data->unit}}</option>
                  @endforeach
                  </select>
                  <div class="invalid-feedback" style="width: 100%;">
                  Unit is required.
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="unit">Price<font color="red">*</font> (tentative)</label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Nu.</span>
                  </div>
                  <input type="text" class="form-control" name="price" id ="price" placeholder ="Price">
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
              </div>
          </div>
          <div class="col-md-3 mb-3">
              <label for="qty">Required Date<font color="red">*</font></label>
              <input type="date" class="form-control" name="date" id ="date" placeholder ="Required Date">
              <div class="invalid-feedback">
                  Please enter date of requirement.
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12 mb-3">
              <label for="unit">Remarks</label>
              <textarea class="form-control" id="remarks" name="remarks" cols="50" rows="2" id="remarks" placeholder="If any ...."></textarea>
                  <div class="invalid-feedback" style="width: 100%;">
                  Price is required.
                  </div>
          </div>
      </div>
      

      <hr class="mb-4">
      <button class="btn btn-primary btn-lg btn-block" type="submit">ADD NEW</button><br>
      <div class="jumbotron py-3" style="background-color: orange">
      <h3>Important!!!</h3>
          <i>Your demand list are saved temporarily. Unless it is submitted, other 
            potential suppliers cannot view it. 
            You must <b>SUBMIT</b> your demand list inorder to viewed by others.</i><br>
          <p><a class="btn btn-success btn-lg text-white py-1" onclick="myFunction()">Submit</a></p>
      </div>
    </form>
  </div>
</div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
          $(window).on('load', function() {
        console.log('All assets are loaded')
    })
    $(document).ready(function () {
        $("#producttype").on('change',function(e){
            console.log(e);
            var id = e.target.value;
            //alert(id);
            $.get('/json-product_type?product_type=' + id, function(data){
                console.log(data);
                $('#product').empty();
                $('#product').append('<option value="">Select Products</option>');
                $.each(data, function(index, ageproductObj){
                    $('#product').append('<option value="'+ ageproductObj.id +'">'+ ageproductObj.product + '</option>');
                })
            });
        });
        $("#quantity").keypress(function (e) {
          if (e.which != 46)
          {
            if(isNaN(document.getElementById("quantity").value))
            {
              alert('Invalid number!!!!');
              document.getElementById("quantity").style.color = "red";
              return false;
            }
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              $("#errmsg").html("Digits Only").show().fadeOut("slow");
                  return false;
            }
          }
          document.getElementById("quantity").style.color = "black";
          
      });
      $("#price").keypress(function (e) {
          if (e.which != 46)
          {
            if(isNaN(document.getElementById("price").value))
            {
              alert('Invalid number!!!!');
              document.getElementById("price").style.color = "red";
              return false;
            }
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
              $("#errmsg").html("Digits Only").show().fadeOut("slow");
                  return false;
            }
          }
          document.getElementById("price").style.color = "black";
      });
      
    });
    // function myFunction() {
    //   if (confirm('Are you sure you want to your demand list?. Once you submit, you cannot add or delete or update.'))  {
    //     var id = document.getElementById("refnumber").value;
    //     $.get('/json-submit-supply?ref_number=' + id, function(data){
    //       window.location = "/national/";
    //     });
    //   }
      
    // }
    function myFunction() {
      var refNo = document.getElementById("refnumber").value;
      $.get('/json-product-exist?refNo=' + refNo, function(data){
        if(data == null || data ==''){
            alert('Unsuccessful: To submit the demand you need at least one or more product!');
        } else {
            //show some type of message to the user
            if (confirm('Are you sure you want to submit your demand list?. Once you submit, you cannot add or delete or update.'))  {
              var id = document.getElementById("refnumber").value;
              $.get('/json-submit-demand?ref_number=' + id, function(data){
                window.location = "/national/";
              });
            }
        }
      });
      }
    function deletFn() {
      if (confirm('Are you sure you want delete permanently?'))  {
        $.ajax({
          type: "POST",
          url: url,
          success: function(result) {
            location.reload();
          }
        });
      }
    }
    
</script>

   
     






@endsection








