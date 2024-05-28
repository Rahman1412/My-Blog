@extends('app')


@section('style')

<style>
    .modal.fade .modal-dialog {
  transform: translateY(-50px);
  transition: transform 0.3s ease-out, opacity 0.3s ease-out;
  opacity: 0;
}

.modal.show .modal-dialog {
  transform: translateY(0);
  opacity: 1;
}

span img{
  width:22px;
  height:22px;
}

    </style>

@endsection

@section('content')


<div class="content p-3">
    <div class="d-flex">
        <div class="mr-3">
            <h2>Category</h2>
        </div>
        <div class="ml-auto">
        <button type="button" class="btn btn-dark mt-1" data-toggle="modal" data-target="#myModal">
            New Category
        </button>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <ul class="list-group">
            </ul>
        </div>
    </div>
    

    
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Category</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="alert-message mb-1 mt-1">

        </div>
        <form method="post" action="{{route('add_category')}}" id="category_form">
          @csrf
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Enter Category Name" name="category">
                <label class="text-danger category_error"></label>
            </div>
            <button class="btn btn-dark submit_btn" type="submit">Submit</button>
        </form>
      </div>

    </div>
  </div>
</div>

@endsection


@section('script')

<script>
  jQuery(document).ready(function(){
    getCategory();
    $(document).on("submit","#category_form",function(e){
      jQuery('.category_error').html("");

      handleSubmitBtn(false)

      e.preventDefault();
      let formData = new FormData(this);

      jQuery.ajax({
        url: "{{route('add_category')}}",
        method:"POST",
        data:formData,
        contentType:false,
        processData:false,
        dataType:"JSON",
        success:function(resp){
          $("#category_form")[0].reset();
          handleSubmitBtn(true)
          getCategory();
        },
        error:function(err){
          handleSubmitBtn(true)
          try{
            let error = err.responseJSON?.errors;
            if(typeof error == 'string'){
              jQuery('.alert-message').html("<div class='alert alert-danger alert-dismissible'>\
                <button type='button' class='close' data-dismiss='alert'>&times;</button>\
                "+error+"\
              </div>");
              return;
            }
            jQuery('.category_error').html(error['category'][0]);
          }catch{
            jQuery('.alert-message').html("<div class='alert alert-danger alert-dismissible'>\
                <button type='button' class='close' data-dismiss='alert'>&times;</button>\
                Something went wrong, Please try after sometimes\
              </div>");
          }
        }
      })
    })
  })

  
  function getCategory(){
    jQuery('.list-group').html("<div class='text-center'><div class='spinner-border spinner-border-sm'></div> Please Wait...</div>");
    jQuery.ajax({
        url: "{{route('get_category')}}",
        method:"GET",
        dataType:"JSON",
        success:function(resp){
          if(resp?.success && resp.data.length > 0){
            let data = resp.data;
            let html = "";
            jQuery.each(data,function(key,value){
              // <img src='{{asset('assets/icons/eye.png')}}' alt=''> |
              html += "<li class='list-group-item d-flex justify-content-between align-items-center'>"+value['category']+"<span><strong><img src='{{asset('assets/icons/editing.png')}}' alt=''> | <img src='{{asset('assets/icons/delete.png')}}' alt=''></strong></span></li>";
            })
            jQuery('.list-group').html(html);
          }else{
            jQuery('.list-group').html("<div class='text-danger text-center'>No Category Found</div>");
          }
        },
        error:function(err){
          jQuery('.list-group').html("<div class='text-danger text-center'>No Category Found</div>");
        }
      })
  }


  function handleSubmitBtn(isTrue = false){
    if(isTrue){
      jQuery('.submit_btn').attr('type','submit');
      jQuery('.submit_btn').html("Submit");
    }else{
      jQuery('.submit_btn').attr('type','button');
      jQuery('.submit_btn').html("<div class='spinner-border spinner-border-sm'></div>");
    }
  }
</script>

@endsection