<div class="pt-5">
    <div class="row logo">
      <p>PIM</p>
  </div>
  <div class="bg-black">
    <div class="row form mw-100">
      <form class="w-50 text-right" id="editInfo" enctype="multipart/form-data">
        @csrf 
          <div class="form-group">
            <label for="exampleInputEmail1">إسم المستخدم</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ $user->name }}" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">كلمة السر</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
          </div>
         
          <button type="submit" class="btn btn-primary w-100 mt-3 mb-3">تحديث البيانات</button>
        </form>

  </div>
  </div>
  </div>