@extends('app')

@section('style')

<style>
    .form-group label{
        font-weight:bold;
    }
    .btn-dark{
        background:black;
        border-radius:0px;
    }
    .toast{
        z-index:1000;
    }
    .card{
        min-width:100%;
    }
    .icon{
        width:25px;
        height:25px;
        cursor: pointer;
    }
    .text-danger{
        font-weight:bold;
    }
</style>

@endsection

@section('content')

<div class="content p-3">
    <div class="d-flex">
        <div class="mr-3">
            <h2>Page Settings</h2>
        </div>
        <div class="ml-auto">
        <button type="button" class="btn btn-dark mt-1" onclick="openModel(this)">
            New Page Settings
        </button>
        </div>
    </div>

    <div class="row m-2 all-settings">
        
    </div>
    
</div>

<div class="modal fade" id="settingModel">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="alert-message mb-1 mt-1">

        </div>
        <form method="post" action="{{route('add-setting')}}" id="setting-form" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
              <input type="hidden" name="id" value="0">
                <label for="title">Title</label>
                <input type="text" class="form-control" placeholder="Enter Title" name="title" onkeyup="getSlug(this)">
                <span class="text-danger title_error"></span>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" placeholder="Enter Slug" name="slug">
                <span class="text-danger slug_error"></span>
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <div id="editor"></div>
                <span class="text-danger content_error"></span>
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
    let editor;
    jQuery(document).ready(function(){
        getSettings();
        ClassicEditor.create( document.querySelector( '#editor' ),{
            ckfinder : {
                uploadUrl : "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
            }
        } ).then(newEditor => {
            editor = newEditor;
        })
        .catch( error => {
        } );


        jQuery(document).on("submit","#setting-form",function(e){
            btnHandlor(true);
            e.preventDefault();
            let formData = new FormData(this);
            let content = editor.getData();
            formData.append("content",content);
            jQuery.ajax({
                url: "{{route('add-setting')}}",
                method:"POST",
                data:formData,
                contentType:false,
                processData:false,
                dataType:"JSON",
                success:function(resp){
                    jQuery("#setting-form")[0].reset();
                    editor.setData("");
                    jQuery("#settingModel").modal("hide");
                    getSettings();
                    btnHandlor(false);
                },
                error:function(err){
                    let error = err.responseJSON?.errors;
                    btnHandlor(false)
                    if(typeof error == "object"){
                        for(let e in error){
                            jQuery("."+e+"_error").html(error[e][0]);
                        }
                    }
                }
            })
        })
    })

    function getSettings(){
        jQuery(".all-settings").html("<div class='m-auto'>\
            <span class='spinner-border spinner-border-sm'></span> Please Wait...\
        </div>");
        jQuery.ajax({
            url:"{{route('get-setting')}}",
            type:"GET",
            dataType:"JSON",
            success:function(resp){
                let html = "";
                if(resp.success && resp.data.length > 0){
                    jQuery.each(resp.data,function(key,value){
                        html += "<div class='card mb-2'>\
                            <div class='card-body'>\
                                <h3>"+value['title']+"</h3>\
                                <p>"+value['content'].substr(0,300)+"</p>\
                                <img class='icon' src='{{asset('assets/icons/editing.png')}}' alt='Edit' data-id='"+value['id']+"' onclick='editSetting(this)'> | <img class='icon' src='{{asset('assets/icons/delete.png')}}' alt='Delete' data-id='"+value['id']+"' onclick='deleteSetting(this)'>\
                            </div>\
                        </div>";
                    })
                }else{
                    html = "<div class='m-auto text-danger'>No Data Found</div>";
                }
                jQuery(".all-settings").html(html);
            },
            error:function(err){
                jQuery(".all-settings").html("<div class='m-auto text-danger'>No Data Found</div>");
            }
        })
    }

    function openModel(){
        jQuery("#settingModel").modal('show');
        jQuery(".modal-title").html("New Setting");
        jQuery("#setting-form")[0].reset();
        jQuery("input[name='id']").val(0);
        editor.setData("");
    }

    function editSetting(element){
        jQuery("#settingModel").modal('show');
        jQuery(".modal-title").html("Update Setting");
        jQuery.ajax({
            url:"{{route('get-setting')}}",
            type:"GET",
            data:{
                id:jQuery(element).data("id")
            },
            dataType:"JSON",
            success:function(resp){
                if(resp.success){
                    jQuery("input[name='id']").val(resp.data?.id);
                    jQuery("input[name='title']").val(resp.data?.title);
                    jQuery("input[name='slug']").val(resp.data?.slug);
                    editor.setData(resp.data?.content);
                }
            }
        })
    }


    function btnHandlor(istrue = false){
        if(istrue){
            jQuery(".submit_btn").attr("type","button");
            jQuery(".submit_btn").html("<span class='spinner-border spinner-border-sm'></span> Please Wait...");
        }else{
            jQuery(".submit_btn").attr("type","submit");
            jQuery(".submit_btn").html("Submit");
        }
    }

    function deleteSetting(element){
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
                    url:"{{route('delete-setting')}}",
                    type:"GET",
                    data:{
                        id:jQuery(element).data("id")
                    },
                    dataType:"JSON",
                    success:function(resp){
                        if(resp.success){
                            getSettings();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Setting has been deleted.",
                                icon: "success"
                            });
                        }else{
                            Swal.fire({
                                title: "Deleted!",
                                text: "Setting has been deleted.",
                                icon: "success"
                            });
                        }
                    },
                    error:function(err){
                        Swal.fire({
                            title: "Deleted!",
                            text: "Setting has been deleted.",
                            icon: "success"
                        });
                    }
                })


            }
        })
    }
    </script>

@endsection