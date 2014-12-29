<script src="http://code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery.unveil.min.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
    <script>
      $(document).ready(function(){
        $("img.lazy").unveil();
        
             $("#start-intro").click(function(){
                bootstro.start();    
            });

             $.scrollUp({
                  scrollName: 'scrollUp', // Element ID
                  topDistance: '300', // Distance from top before showing element (px)
                  topSpeed: 300, // Speed back to top (ms)
                  animation: 'fade', // Fade, slide, none
                  animationInSpeed: 200, // Animation in speed (ms)
                  animationOutSpeed: 200, // Animation out speed (ms)
                  scrollText: '', // Text for element
                  activeOverlay: false  // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            });
          });
</script>