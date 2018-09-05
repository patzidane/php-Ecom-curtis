</div><br><br>


<div class="col-md-12 text-center" >&copy; Copyright 2018-2019 Shaunta's Boutique</div>

<script>
jQuery(window).scroll(function(){
  var vscroll = jQuery(this).scrollTop();
  jQuery('#logotext').css({
    "transform" : "translate(0px, "+vscroll/2+"px)"
  });


  jQuery('#back-flower').css({
    "transform" : "translate("+vscroll/5+"px, -"+vscroll/12+"px)"
  });


  jQuery('#fore-flower').css({
    "transform" : "translate(0px, -"+vscroll/2+"px)"
  });
});

function detailsmodel(id){
  var data = {"id":id};
  jQuery.ajax({
    url:'/tutorial/includes/detailsmodel.php',
    method: "post",
    data: data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#details-modal').modal('toggle');
    },
    error: function(){
      alert("Something went wrong!");
    }
  });
}
</script>
</body>
</html>
