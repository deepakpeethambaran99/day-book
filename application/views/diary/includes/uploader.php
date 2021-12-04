<script type="text/javascript">


$(document).ready(function() 
{
    $("#entry-id").attr("hidden",true);
    InlineEditor.create( document.querySelector( '#editor' )).then( editor => {
        console.log( editor );

        $("#delete").hide();

        <?php if($entry){?>
            editor.isReadOnly = true;
            $("#title").attr("disabled",true);
            $("#delete").show();
        <?php } ?>
        $('#edit').click(function(){
            editor.isReadOnly=false;
            $("#title").attr("disabled",false);
            
            $("#editor").focus();
        });
        $('#save').click(function(){

            event.preventDefault();
            var baseurl = "<?php echo base_url();?>"
            var content = $('#editor').html();
            console.log(baseurl);
            //alert("title: "+title);
            $.ajax({
            type:"POST",
            url:baseurl+"entries/journal/save",
            dataType: "TEXT",
            data: {title: $("#title").val(),content: content,rowid:$('#entry-id').val()},
            error: function(error){console.log("error: "+error);},
            success: function(data){
                response = jQuery.parseJSON(data);
                $('#entry-id').val(response.row); 
               $('#saved').text(function(n){return response.repo;});
               $("#delete").show();
               window.history.replaceState(null, null, "?id="+$('#entry-id').val());
            }
           });

            editor.isReadOnly=true;
            $("#title").attr("disabled",true);
        });
    } ).catch( error => {
            console.error( error );
        } ); 
    

     $("#editor").click(function(){
        $("#saved").text(function(n){return " ";});
     });


     $("#yes").click(function(){
        window.location = "<?php echo site_url('delete')?>?d="+$("#entry-id").val();
     });

});
</script>