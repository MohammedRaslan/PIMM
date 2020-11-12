jQuery(document).ready(function ($){
    function RemoveActiveState(className) {
       $('body').find("."+className).removeClass(className);
}
   function ajaxload(url,fatherdiv,tabactive,id=null,append=null){
       $('.loading').css({"display":"flex"});
       RemoveActiveState(tabactive);
       url = id==null? url: url+"/"+id;
      var jqxhr = $.get(url, function(data) {
         $("."+fatherdiv).fadeOut(3,function(){
             $(this).empty();
             $(this).html(data);
             if(append !== null){
                 $(this).append(append);
             }
             $(this).fadeIn();
         });
       }).done(function() {
       $('.loading').css({'display':'none'});
       return true;
     }).fail(function(data){
       $('.loading').css({'display':'none'})
         alert('Something went wrong!');
         return false;
     });
   }

   $(document).on('click','.dataTab',function(){
    ajaxload('data','fatherDiv','tabActive');
    $(this).addClass('tabActive');
   });

   $(document).on('click','.home',function(){
    ajaxload('counter','fatherDiv','tabActive');
    $(this).addClass('tabActive');
   });

   $(document).on('click','.setting',function(){
    ajaxload('setting','fatherDiv','tabActive');
    $(this).addClass('tabActive');
   });


   $(document).on('click','.report',function(event){
     $this =  $(this);
     $this.children('i').toggleClass('rotated');
     $this.parent().parent().find('.squaredata').slideToggle();
  });
   

  $(document).on('submit','#loginForm',function(event){
    $form =$(this);
    event.preventDefault();
    $.ajax({
      url: '/login',
      method: 'post',
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData:false,
      success: function(response){
        if(response == true){
          window.location.href = 'home';
        }else{
          $x = `<div class="alert alert-danger alert-dismissible fade show"  role="alert">
          Phone Number  or Password is wrong
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>`;
          
          $('.alerts').append($x);
        }

      },
      error: function(response){
        $('.alerts').empty();
       $.each(response['responseJSON']['errors'],function(key,value){

       $x = `<div class="alert alert-danger alert-dismissible fade show"  role="alert">
        `+value+`
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>`;
        
        $('.alerts').append($x);
       })
      }
  });
  });

  $(document).on('submit','#editInfo',function (event) {
    $form =$(this);
    event.preventDefault();
    $.ajax({
      url: '/editInfo',
      method: 'post',
      data: new FormData(this),
      dataType: 'JSON',
      contentType: false,
      cache: false,
      processData:false,
      success: function(response){
        if(response == true){
          Swal.fire(
            'تمت العملية بنجاح!',
            'تم حفظ البيانات!',
            'success'
          )
        }else{
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
          })
        }
      }
      
    });
  })
});