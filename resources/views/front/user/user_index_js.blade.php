<script>
    // Add event listener to the button
    document.getElementById('backButton').addEventListener('click', function() {
        // Redirect back
        window.history.back();
    });
</script>
<script type="text/javascript"> 
 $(document).ready(function() { 
     $.ajaxSetup({ 
         headers: { 

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 

         } 
     }); 
     $(".bt-logout").click( function() { 
         $.ajax({ 
             url: "{{route('logout')}}", 
             type: "POST", 
             success: function(response) {
                    window.location.href = '/';
                }
         }); 

     });
    })
</script>