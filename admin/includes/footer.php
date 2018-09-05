</div><br><br>
<div class="col-md-12 text-center" >&copy; Copyright 2018-2019 Shaunta's Boutique</div>

<script type="text/javascript">
function updateSizes(){
  var sizeString = '';
  for(var i=1;i<=12;i++){
    if(jQuery('#size'+i).val()!= ''){
      sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
    }
  }
  jQuery('#sizes').val(sizeString);
}

function get_child_options(){
  var parentID = jQuery('#parent').val();
  jQuery.ajax({
    url: '/tutorial/admin/parsers/child_categories.php',
    type: 'POST',
    data: {parentID:parentID},
    success: function(){
      jQuery('#child').html(data);
    },
    error: function(){alert("Something went wrong with the child options.")},
  });
}
  jQuery('select[name="parent"]').change(get_child_options);
</script>
</body>
</html>
