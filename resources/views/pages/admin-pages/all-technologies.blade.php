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

label{
    font-weight:bold;
}

.preview-container{
  margin-left: auto;
  margin-right: auto;
  display:none;
  width:150px;
  height:150px;
  position: relative;
}

.icon{
  width: 20px;
  height: 20px;
  position: absolute;
  top: 10px;
  right: -5px;
}

.action-logo{
  width:24px;
  height:24px;
}
.d-flex{
  font-weight:bold;
}

.logo{
  margin-left:40px;
  width:150px;
  height:150px;
}

.card{
  border-radius:0px;
}
    </style>

@endsection

@section('content')


<div class="content p-3">
    <div class="d-flex">
        <div class="mr-3">
            <h2>Technologies</h2>
        </div>
        <div class="ml-auto">
        <button type="button" class="btn btn-dark mt-1" data-toggle="modal" data-target="#myModal" onclick="openModel(this)">
            New Technologies
        </button>
        </div>
    </div>

    <div class="row m-2 all-technologies">

    </div>
    

    
</div>

<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Technologies</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="alert-message mb-1 mt-1">

        </div>
        <form method="post" action="{{route('add-technologies')}}" id="technology_form" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <input type="hidden" name="id" value="0">
                <label for="name">Name</label>
                <input type="text" class="form-control" placeholder="Enter Name" name="technology" onkeyup="getSlug(this)">
                <span class="text-danger technology_error"></span>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" placeholder="Enter Slug" name="slug">
                <span class="text-danger slug_error"></span>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="0">Private</option>
                    <option value="1">Public</option>
                </select>
            </div>

            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control" onchange="previewImage(event)" name="logo">
                <span class="text-danger logo_error"></span>
            </div>

            <div class="preview-container">
              <img class="icon" src="{{asset('assets/icons/close.png')}}" alt="Close" onclick="removeImage()">
              <img id="previewImg" width="150" height="150">
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
    allTechnologies();
    jQuery(document).on("submit","#technology_form",function(e){
      jQuery(".submit_btn").attr("type","button");
      jQuery(".submit_btn").html("<span class='spinner-border spinner-border-sm'></span> Please Wait...");
      e.preventDefault();
      let formData = new FormData(this);
      jQuery.ajax({
        url: "{{route('add-technologies')}}",
        method:"POST",
        data:formData,
        contentType:false,
        processData:false,
        dataType:"JSON",
        success:function(resp){
          allTechnologies();
          jQuery("#myModal").modal("hide");
          jQuery("#technology_form")[0].reset();
          jQuery(".submit_btn").attr("type","submit");
          jQuery(".submit_btn").html("Submit");
          removeImage();
        },
        error:function(err){
          let error = err.responseJSON?.errors;
          jQuery(".submit_btn").attr("type","submit");
          jQuery(".submit_btn").html("Submit");
          if(error && typeof error == "object"){
            for(let e in error){
              jQuery("."+e+"_error").html(error[e][0]);
            }
          }
        }
      })
    })
  })

  function allTechnologies(){
    jQuery(".all-technologies").html("<div class='col-12 text-center'>\
      <span class='spinner-border spinner-border-sm'></span> Please Wait...\
    </div>")
    jQuery.ajax({
      url: "{{route('get-technologies')}}",
      method:"GET",
      dataType:"JSON",
      success:function(resp){
        let html = "";
        if(resp.data.length > 0){
          jQuery.each(resp.data,function(key,value){
            html += "<div class='col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 p-1'>\
              <div class='card bg-light'>\
                <div class='card-body'>\
                  <img class='logo' src='"+value['logo']+"' alt='Logo'>\
                  <h3>"+value['name']+"</h3>\
                  <div class='d-flex mt-2'>\
                    <img class='action-logo' src='{{asset('assets/icons/editing.png')}}' alt='Edit' data-id='"+value['id']+"' data-name='"+value['name']+"' data-slug='"+value['slug']+"' data-status='"+value['status']+"' data-logo='"+value['logo']+"' onclick='editTechnology(this)'>&nbsp;|&nbsp;\
                    <img  class='action-logo' src='{{asset('assets/icons/delete.png')}}' alt='Delete' data-id='"+value['id']+"' onclick='deleteTechnology(this)'>\
                  </div>\
                </div>\
              </div>\
            </div>";
          })
          jQuery(".all-technologies").html(html);
        }else{
          jQuery(".all-technologies").html("<div class='col-12 text-center text-danger'>\
            No data found\
          </div>")
        }
      },
      error:function(err){
        jQuery(".all-technologies").html("<div class='col-12 text-center text-danger'>\
            No data found\
          </div>")
      }
    })
  }

    function openModel(element){
        jQuery(".modal-title").html("Add Technology");
        removeImage();
        jQuery("#technology_form")[0].reset();
    }

    function editTechnology(element){
      jQuery("#myModal").modal("show");
      jQuery(".modal-title").html("Update Technology");
      jQuery("input[name='technology']").val(jQuery(element).data("name"));
      jQuery("input[name='id']").val(jQuery(element).data("id"));
      jQuery("input[name='slug']").val(jQuery(element).data("slug"));
      jQuery("select[name='status']").val(jQuery(element).data("status"));
      jQuery('.preview-container').attr("style","display:block");
      const output = document.getElementById('previewImg');
      output.src = jQuery(element).data("logo");
    }

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            jQuery('.preview-container').attr("style","display:block");
            const output = document.getElementById('previewImg');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function removeImage(){
      const output = document.getElementById('previewImg');
      output.src = "";
      jQuery('.preview-container').attr("style","display:none");
      jQuery("input[name='logo']").val(null);
    }

    function deleteTechnology(element){
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
                    url: "{{route('delete-technology')}}",
                    method:"GET",
                    data:{
                        id:jQuery(element).data("id")
                    },
                    dataType:"JSON",
                    success:function(resp){
                        allTechnologies();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Technology has been deleted.",
                            icon: "success"
                        });
                    },
                    error:function(err){
                        let error = err.responseJSON?.message;
                        if(error){
                            alert(error);
                        }else{
                            alert("Unable to delete technology, Please try after sometimes");
                        }
                    }
                })
            }
        });
    }


</script>
@endsection