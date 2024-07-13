
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script>
        function toggltMenu(){
            if(jQuery(".navbar-collapse").hasClass("show")){
                jQuery(".navbar-collapse").removeClass("show");
            }else{
                jQuery(".navbar-collapse").addClass("show");
            }
        }

        function getSlug(element){
            const title = jQuery(element).val();
            const slug = stringToSlug(title);
            jQuery("input[name='slug']").val(slug);
        }

        function stringToSlug(str) {
            str = str.trim().toLowerCase(); // Convert to lowercase and trim whitespace
            str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, ""); // Remove diacritics
            str = str.replace(/[^a-z0-9 -]/g, '') // Remove invalid characters
                        .replace(/\s+/g, '-') // Replace whitespace with hyphens
                        .replace(/-+/g, '-'); // Collapse multiple hyphens
            return str;
        }
    </script>
    </body>

</html> 