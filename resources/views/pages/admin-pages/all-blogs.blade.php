@extends('app')


@section('style')

<link rel="stylesheet" href="{{asset('assets/css/new-blog.css')}}">

@endsection

@section('content')


<div class="content p-3">
    <div class="d-flex">
        <div class="mr-3">
            <h2>New Blog</h2>
        </div>
        <!-- <div class="ml-auto header-advertisement flex-grow-1">
            <img src="" alt="Advertisement">
        </div> -->
    </div>



    <div class="row mt-2">
        <div class="col-12 col-sm-9 col-md-9 mb-2">
            <input type="text" class="form-control" placeholder="Search">
        </div>
        <div class="col-12 col-sm-3 col-md-3">
            <button type="button" class="btn btn-dark mt-1" onclick="resetForm()">
            New Blog
        </button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 blogContainer">
            
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 paginateContent mt-2">
            
        </div>
    </div>
    
</div>


<div class="modal fade" id="myNewBlogForm">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Blog</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="alert-message mb-1 mt-1">

        </div>
        <form method="post" action="{{route('saveBlog')}}" id="newBlogForm" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="0">
            <div class="form-group">
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
                <label for="tags">Tags</label>
                <div>
                <select name="tags[]" multiple="multiple" class="tags_select_box">
                    @foreach($tags as $item)
                    <option value="{{$item->name}}">{{$item->name}}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" name="status">
                    <option value="private">Private</option>
                    <option value="public">Public</option>
                </select>
            </div>

            <div class="form-group">
                <label for="short_desc">Short Description</label>
                <div id="editor"></div>
                <span class="text-danger short_desc_error"></span>
            </div>

            

            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" class="form-control" name="thumbnail" accept="image/*" onchange="previewImage(event)">
                <div class="preview-container">
                    <img id="previewImg" src="">
                </div>
            </div>
            <button class="btn btn-dark submit_btn mt-2" type="submit">Submit</button>
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
        initlialize()
        getAllBlogs();
        let data;
        ClassicEditor.create( document.querySelector( '#editor' ),{
            ckfinder : {
                uploadUrl : "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
            }
        } ).then(newEditor => {
            editor = newEditor;
        })
        .catch( error => {
        } );

        jQuery(document).on("submit","#newBlogForm",function(e){
            e.preventDefault();
            jQuery('.title_error').html("");
            jQuery('.slug_error').html("");
            jQuery('.short_desc_error').html("");
            handleSubmitBtn(false);
            let formData = new FormData(this);
            const content = editor.getData();
            formData.append("short_desc",content);
            jQuery.ajax({
                url: "{{route('saveBlog')}}",
                method:"POST",
                data:formData,
                contentType:false,
                processData:false,
                dataType:"JSON",
                success:function(resp){
                    handleSubmitBtn(true);
                    if(resp.success){
                        jQuery('#newBlogForm')[0].reset();
                        getAllBlogs();
                        const output = document.getElementById('previewImg');
                        output.src = "";
                        jQuery('.preview-container').attr("style","display:none");
                        editor.setData("");
                        jQuery('#myNewBlogForm').modal('hide');
                    }else{
                        jQuery('.alert-message').html("<div class='alert alert-danger alert-dismissible'>\
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>\
                            Something went wrong, Please try after sometimes\
                        </div>");
                    }
                },
                error:function(err){
                    handleSubmitBtn(true);
                    try{
                        const error = err.responseJSON?.errors;
                        for(let item in error){
                            jQuery('.'+item+"_error").html(error[item][0]);
                        }
                    }catch(error){
                        jQuery('.alert-message').html("<div class='alert alert-danger alert-dismissible'>\
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>\
                            Something went wrong, Please try after sometimes\
                        </div>");
                    }
                }
            })
        })



        

    });

    function resetForm(){
        jQuery("#myNewBlogForm").modal("show");
        jQuery('#newBlogForm')[0].reset();
        const output = document.getElementById('previewImg');
        output.src = "";
        jQuery('.preview-container').attr("style","display:none");
        editor.setData("");
        jQuery("select[name='tags[]']").val(null).trigger('change');
    }


    function editBlog(element){
        jQuery('#myNewBlogForm').modal('show');
        const id = jQuery(element).data('id')
        jQuery("input[name='id']").val(id);
        jQuery.ajax({
            url: "{{route('viewBlog')}}?id="+id,
            method:"GET",
            dataType:"JSON",
            success:function(resp){
                if(resp.success){
                    var data = resp.data;
                   
                    jQuery("input[name='title']").val(data.title);
                    jQuery("input[name='slug']").val(data.slug);
                    jQuery("select[name='tags[]']").val(data.tags).trigger('change');
                    jQuery("select[name='status']").val(data.status);
                    editor.setData(data.short_desc)
                    if(data.thumbnail){
                        jQuery('.preview-container').attr("style","display:block");
                        const output = document.getElementById('previewImg');
                        output.src = data.thumbnail;
                    }
                }
            }
        })
    }

    function getAllBlogs(element){
        const page = element ? jQuery(element).data("page") : 1;
        jQuery(".blogContainer").html("<div class='text-center'><div class='spinner-border spinner-border-sm'></div> Loading...</div>");
        jQuery.ajax({
                url: "{{route('getBlogs')}}?page="+page,
                method:"GET",
                dataType:"JSON",
                success:function(resp){
                    let blogHtml = "";
                    let pagination = "";
                    if(resp.success){
                        const links = resp.data['links'];
                        const blogs = resp.data['data'];
                        
                        jQuery.each(links,function(key,value){
                            const url = value['url'];
                            let pageNo = 0;
                            let active = "";
                            if(url){
                                const newUrl = new URL(url);
                                pageNo = newUrl.searchParams.get('page'); 
                                active = value['active'] ? 'active' : '';
                            }else{
                                active = "disabled";
                            }
                            
                            pagination += "<li class='page-item "+active+"' aria-current='page'>\
                                <a data-page='"+pageNo+"' class='page-link' href='javascript:void(0)' onclick='getAllBlogs(this)'>"+value['label']+"</a>\
                            </li>";
                        })
                        if(blogs.length > 0){
                            jQuery.each(blogs,function(key,value){
                                let  id = value['id'];
                                var newBlogUrl = '{{ route("new_blog", ["id" => ":id"]) }}';
                                newBlogUrl = newBlogUrl.replace(':id', id);
                                let tags = ""
                                if(value["tags"]){
                                    tags += " <p class='card-text'>";
                                    jQuery.each(value["tags"],function(key1,value1){
                                        tags += "<span class='badge badge-dark'>"+value1+"</span>";
                                    })
                                    tags += "</p>";
                                }

                                const thumbnail = value['thumbnail'] ? value['thumbnail'] : "https://via.placeholder.com/150";
                                blogHtml += "<div class='card mb-3'>\
                                        <div class='row no-gutters'>\
                                            <div class='col-md-4'>\
                                                <img src='"+thumbnail+"' class='card-img' alt='...'>\
                                            </div>\
                                            <div class='col-md-8'>\
                                                <div class='card-body'>\
                                                    <h5 class='card-title'>"+value['title']+"</h5>\
                                                    <p class='card-text'>"+value['short_desc'].substr(0,300)+"</p>\
                                                    "+tags+"\
                                                    <span><strong><a href='"+newBlogUrl+"' style='text-decoration:none;'><img src='{{asset('assets/icons/eye.png')}}' alt='View' style='width:22px;height:22px;background-color:#ffffff;cursor:pointer;'></a> | <img src='{{asset('assets/icons/editing.png')}}' alt='Edit' style='width:22px;height:22px;background-color:#ffffff;cursor:pointer;' data-id='"+value['id']+"' onclick='editBlog(this)'> | <img data-id='"+value['id']+"' src='{{asset('assets/icons/delete.png')}}' alt='Edit' style='width:22px;height:22px;background-color:#ffffff;cursor:pointer;'onclick='deleteBlog(this)'></strong></span>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>";
                                });
                            jQuery(".paginateContent").html("<nav aria-label='Pagination'>\
                                <ul class='pagination justify-content-center'>"+pagination+"</ul>\
                            </nav>");
                        }else{
                            blogHtml = "<div class='text-center text-danger'>No Blogs Found</div>";
                            jQuery(".paginateContent").html("");
                        }
                        
                        jQuery(".blogContainer").html(blogHtml);
                    }
                },
                error:function(err){
                    
                }
        });
    }


    function deleteBlog(element){
        const id = jQuery(element).data("id");
        jQuery.ajax({
            url: "{{route('deleteBlog')}}?id="+id,
            method:"GET",
            dataType:"JSON",
            success:function(resp){
                getAllBlogs();
            },
            error:function(err){
                console.log(err)
            }
        });
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

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            jQuery('.preview-container').attr("style","display:block");
            const output = document.getElementById('previewImg');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function initlialize(){
        jQuery(".tags_select_box").select2();
    }

</script>

@endsection