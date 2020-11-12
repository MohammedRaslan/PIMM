<div class="pt-5">

    <div class="row">
        <div class="col-12">
            <div class="alert alert-info" style="text-align: start;" role="alert">
                <i class="fas fa-user"></i> إجمالي عدد المستخدمين  {{ $userCount }} 
            </div>
        </div>
        
    </div>

    <div class="row first" style="text-align: center;">
        <div class="col-6 col-lg-6 col-md-6 col-sm-12">
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-user"></i>
                <p>{{ $infected }}</p>
                <p>عدد المصابين</p>
            </div>
        </div>
        <div class="col-6 col-lg-6 col-md-6 col-sm-12">
            <div class="alert alert-warning" role="alert">
                <i class="fas fa-user"></i>
                <p>{{ $exposed }}</p>
                <p>عدد المشبتة في اصابتهم</p>
            </div>
        </div>
    </div>

    <div class="row second" style="text-align: center;">
        <div class="col-6 col-lg-6 col-md-6 col-sm-12">
            <div class="alert alert-info" role="alert">
                <i class="fas fa-user"></i>
                <p>{{ $exposed }}</p>
                <p>عدد المخالطين</p>
            </div>
        </div>
        <div class="col-6 col-lg-6 col-md-6 col-sm-12">
            <div class="alert alert-success" role="alert">
                <i class="fas fa-user"></i>
                <p>{{ $fine }}</p>
                <p>غير المصابين</p>
            </div>
        </div>
    </div>
</div>