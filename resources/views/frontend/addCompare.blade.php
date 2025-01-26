
<div  id="productCompareModal" tabindex="-1" role="dialog" aria-labelledby="productModalCenterTitle"
  aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLongTitle">جستجو</h5>
        <form id="compare-search">
          <input type="text" name="search" id="keyword">
          <!--<select name="brand" id="brand">-->
          <!--  <option value="">تمامی برندها</option>-->
          <!--  <option value="13918">بیم</option>-->
          <!--  <option value="28119">کوخ</option>-->
          <!--  <option value="14515">سنکور</option>-->
          <!--  <option value="21426">اسمگ</option>-->
          <!--  <option value="27559">نینجا</option>-->
          <!--</select>-->
        </form>
        <script>
           //setup before functions
              var typingTimer;                //timer identifier
              var doneTypingInterval = 10;  //time in ms, 5 second for example
              var $input = $('#keyword');
             
              //on keyup, start the countdown
              $input.on('keyup', function () {
                  clearTimeout(typingTimer);
                  typingTimer = setTimeout(doneTyping, doneTypingInterval);
              });
              //on keydown, clear the countdown
              $input.on('keydown', function () {
                  clearTimeout(typingTimer);
              });
          
              //user is "finished typing," do something
              function doneTyping () {
                  phrase = $input.val();
                  var phrase = phrase.replace("ك", "ک");
                  var phrase = phrase.replace("ي", "ی");
                  // category = $category.val();
                  
                  if(phrase.length==0){
                      
                      url = `{{ url('/compare/ajax/search') }}` + '?phrase='+ 'no';
                      $.ajax(url,
                          {
                              success: function (data) {
                                  if(data.length > 0) {
                               
                                      $('#products_compare').html(data);
                                  } else {
                                  }
                              },
                              error: function (jqXhr, textStatus, errorMessage) {
                                  
                                  alert('Error: ' + errorMessage);
                              }
                          });
                  }
            
                  if(phrase.length > 1) {
                      url = `{{ url('/compare/ajax/search') }}` + '?phrase=' + phrase;
                      $.ajax(url,
                          {
                              success: function (data) {
                                  if(data.length > 0) {
                               
                                      $('#products_compare').html(data);
                                  } else {
                                  }
                              },
                              error: function (jqXhr, textStatus, errorMessage) {
                                  
                                  alert('Error: ' + errorMessage);
                              }
                          });
                  } else{
                    
                     
                          
                    //   $('#products_compare').css("display", "none");
                  }
              }
        </script>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
        @if( $product_all && count($product_all)>0)
               <div class="modal-body" id="products_compare">
                  @include('frontend.partials.compare-product',['products'=>$product_all])
                </div>
        @endif
    </div>
  </div>
</div>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $('.addToCompare1').submit(function(e) {
        $('.loader').fadeIn();
        e.preventDefault();
        var form=$(this);
        var data = form.serialize();
        var productId = $(this).find('.productId').val();
        $.ajax({
            type: 'POST',
            url: "/compare/add/" + productId,
            data:{
                data:data
            },

            success: function(message) {
                $('.loader').fadeOut();
                // Set sth
        window.location.reload();
            },
            error: function(e) {
                // Set sth
                swal({
                    text: 'متاسفانه مشکلی در افزودن محصول به بخش مقایسه پیش آمد.',
                    icon: "warning",
                    button: 'متوجه شدم'
                });
            }
        });
    });
</script>
