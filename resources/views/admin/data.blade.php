<div class="row pt-5">
    <span class="btn btn-primary pb-2 w-100 ">المحافظات</span>
  </div>
  @foreach ($governs as $govern)
      
   <div class="row pt-3">
    <div class="col p-3 rowdata rounded bg-white">
      <span class="float-right text-primary">{{ $govern->name }}</span>
      <span class="text-primary p-2 rounded report" style="background-color: #DFEBFF"><i class="fas fa-chevron-down"></i> التقرير </span>
    </div>
  <div class="row justify-content-end pt-3 squaredata" style="display: none">

      <div class="row first" style="text-align: center;">
        <div class="col-6 col-lg-6 col-md-6 col-sm-12 data">
            <div class="alert alert-light" role="alert">
              <p class="text-danger">عدد المصابين</p>
                <p class="text-danger">{{ $new->infected('INFECTED',$govern->id) }}</p>
              </div>
        </div>
        <div class="col-6 col-lg-6 col-md-6 col-sm-12 data">
            <div class="alert alert-light" role="alert">
              <p class="text-warning">عدد المشبتة في اصابتهم</p>
                <p class="text-warning">{{ $new->infected('EXPOSED',$govern->id) }}</p>
              </div>
        </div>
    </div>
    
    <div class="row second" style="text-align: center;">
        <div class="col-6 col-lg-6 col-md-6 col-sm-12 data">
            <div class="alert alert-light" role="alert">
              <p class="text-success">عدد المخالطين</p>
                <p class="text-success">{{ $new->infected('EXPOSED',$govern->id) }}</p>
              </div>
        </div>
        <div class="col-6 col-lg-6 col-md-6 col-sm-12 data">
            <div class="alert alert-light" role="alert">
              <p class="text-primary">غير المصابين</p>
                <p class="text-primary">{{ $new->infected('FINE',$govern->id) }}</p>
              </div>
        </div>
    </div>
  </div>
   </div>


   @endforeach
