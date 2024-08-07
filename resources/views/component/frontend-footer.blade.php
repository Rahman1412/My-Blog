<footer>


<div class="row justify-content-center copyright">
   <p>&#169; 2024 - {{date('Y')}} Copyright - Manak Academy</p>
</div>


</footer>

<script>

function toggltMenu(){
   if(jQuery(".navbar-collapse").hasClass("show")){
      jQuery(".navbar-collapse").removeClass("show");
   }else{
      jQuery(".navbar-collapse").addClass("show");
   }
}

</script>