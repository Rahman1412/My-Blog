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
    .category_error{
        display:none;
    }
    .form-group label{
        font-weight:bold;
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
            <h2>Menus</h2>
        </div>
        <div class="ml-auto">
        <button type="button" class="btn btn-dark mt-1" data-toggle="modal" data-target="#myModal">
            New Menu
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
        <h4 class="modal-title">Add Menu</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="alert-message mb-1 mt-1">

        </div>
        <form id="menuForm" method="post">
          @csrf
            <div class="form-group">
              <input type="hidden" name="id" value="0">
              <label for="menu">Menu Name</label>
                <input type="text" class="form-control" placeholder="Enter Menu Name" name="menu" onkeyup="getSlug(this)">
                <span class="text-danger menu_error"></span>
            </div>

            <div class="form-group">
            <label for="slug">Slug</label>
                <input type="text" class="form-control" placeholder="Enter Slug" name="slug">
                <span class="text-danger slug_error"></span>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select class="form-control" name="status">
                    <option value="0">Private</option>
                    <option value="1">Public</option>
                </select>
            </div>
            <button class="btn btn-dark mt-2 submit_btn" type="submit" disabled>Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')

<script>
    jQuery(document).ready(function(){
        getMenus();
        jQuery('.submit_btn').prop("disabled",false);
        jQuery(document).on("submit","#menuForm",function(e){
            e.preventDefault();
            jQuery('.submit_btn').prop("disabled",true);
            jQuery('.submit_btn').html("<div class='spinner-border spinner-border-sm'></div> Please wait...");
            jQuery('.menu_error').html("");
            let formData = new FormData(this);
            jQuery.ajax({
                url:"{{route('new-menu')}}",
                method:"POST",
                data:formData,
                contentType:false,
                processData:false,
                dataType:"JSON",
                success:function(resp){
                    jQuery("#menuForm")[0].reset();
                    jQuery('#myModal').modal('hide');
                    jQuery('.submit_btn').prop("disabled",false);
                    jQuery('.submit_btn').html("Submit");
                    getMenus();
                },
                error:function(err){
                    let error = err.responseJSON?.errors;
                    jQuery('.submit_btn').prop("disabled",false);
                    jQuery('.submit_btn').html("Submit");
                    if(typeof error == "string"){
                    jQuery(".alert-message").html("<div class='alert alert-danger alert-dismissible'>\
                        <button type='button' class='close' data-dismiss='alert'>&times;</button>\
                        "+error+"\
                    </div>")
                    }else{
                        jQuery(".menu_error").html(error['menu'][0]);
                        jQuery(".slug_error").html(error['slug'][0]);
                    }
                }
            })
        });
    });

    function getMenus(){
        jQuery('.list-group').html("<div class='text-center'><div class='spinner-border spinner-border-sm'></div> Please wait...</div>");
        jQuery.ajax({
            url:"{{route('get-menu')}}",
            method:"GET",
            dataType:"JSON",
            success:function(resp){
                if(resp?.success && resp.data.length > 0){
                    let data = resp.data;
                    let html = "";
                    jQuery.each(data,function(key,value){
                        let image;
                        if(value['status'] == "0"){
                            image = "{{asset('assets/icons/private.png')}}";
                        }else{
                            image = "{{asset('assets/icons/public.png')}}";
                        }
                        console.log("IMAGE",image);
                        html += "<li class='list-group-item d-flex justify-content-between align-items-center'>"+value['name']+"<span><strong><img src='{{asset('assets/icons/editing.png')}}' alt='Edit' data-id='"+value['id']+"' data-name='"+value['name']+"' data-slug='"+value['slug']+"' data-status='"+value['status']+"' onclick='editMenu(this)'> | <img src='{{asset('assets/icons/delete.png')}}' alt='Delete' data-id='"+value['id']+"' onclick='deleteMenu(this)'> | <img src='"+image+"' alt='Delete'></strong></span></li>";
                    })
                    jQuery('.list-group').html(html);
                }else{
                    jQuery('.list-group').html("<div class='text-danger text-center'>No Menu Found</div>");
                }
            },
            error:function(err){
                jQuery('.list-group').html("<div class='text-danger text-center'>Unable to get menu, Please try after sometimes</div>");
            }
        })
    }

    function editMenu(element){
        jQuery("#myModal").modal("show");
        jQuery("input[name='id']").val(jQuery(element).data("id"));
        jQuery("input[name='menu']").val(jQuery(element).data("name"));
        jQuery("input[name='slug']").val(jQuery(element).data("slug"));
        jQuery("select[name='status']").val(jQuery(element).data("status"));
    }

    function deleteMenu(element){

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            allowOutsideClick: false,
            allowEscapeKey:false
        }).then((result) => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: "", 
                    html: "<div class='spinner-border spinner-border-sm'></div>&nbsp;Please Wait...",  
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey:false
                });

                jQuery.ajax({
                    url: "{{route('delete-menu')}}",
                    method:"GET",
                    data:{
                        id:jQuery(element).data("id")
                    },
                    dataType:"JSON",
                    success:function(resp){
                        getMenus();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Menu has been deleted.",
                            icon: "success"
                        });
                    },
                    error:function(err){
                        let error = err.responseJSON?.message;
                        if(error){
                            alert(error);
                        }else{
                            alert("Unable to delete menu, Please try after sometimes");
                        }
                    }
                })
            }
        });
    }
</script>

@endsection
