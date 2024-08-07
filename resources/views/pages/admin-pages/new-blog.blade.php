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
</style>

@endsection

@section('content')


<div class="content">

<div class="toast" style="position: fixed; top: 5px; right: 5px;" data-delay="2000">
    <div class="toast-header bg-success text-light">
      <strong class="mr-auto">Success</strong>
      <button type="button" class="ml-2 mb-1 close text-light" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body bg-success text-light">
    </div>
  </div>

    <div class="d-flex">
        <div class="mr-3">
            <h2>{{$blog->title}}</h2>
        </div>
        <div class="ml-auto">
            <a href="{{route('blogs')}}" class="btn btn-dark mt-1">
                All Blogs
            </a>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-body">
            <form action="" id="newBlogForm">
                @csrf
                <input type="hidden" name="id" value="0">
                <input type="hidden" name="blog_id" value="{{$blog['id']}}">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter Title">
                </div>

                <div class="form-group">
                
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                    <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <div id="editor"></div>
                </div>

                <button type="submit" class="btn btn-dark">Save</button>
            </form>
        </div>
    </div>
</div>

@endsection


@section('script')
<script>
    let editor;
    jQuery(document).ready(function(){
        getMetaData();
        let data;
        ClassicEditor.create( document.querySelector( '#editor' ),{
            ckfinder : {
                uploadUrl : "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
            }
        } ).then(newEditor => {
            editor = newEditor;
        // editor.setData( '<p>Some text.</p>' );
        
        })
        .catch( error => {
        } );


        jQuery(document).on("submit","#newBlogForm",function(e){
            e.preventDefault();
            let formData = new FormData(this);
            const content = editor.getData();
            formData.append("content",content);
            jQuery.ajax({
                url: "{{route('saveMetaData')}}",
                method:"POST",
                data:formData,
                contentType:false,
                processData:false,
                dataType:"JSON",
                success:function(resp){
                    if(resp.success){
                        jQuery('.toast-body').html(resp.message);
                        jQuery(".toast").toast('show');
                    }
                },
                error:function(err){

                }
            })
        })
    })

    function getMetaData(){
        const id = jQuery("input[name='blog_id']").val();
        console.log("ID >>>>",id);
        jQuery.ajax({
            url: "{{route('getMetaData')}}",
            method:"GET",
            data:{
                id:id
            },
            dataType:"JSON",
            success:function(resp){
                if(resp.success){
                    const data = resp.data;
                    console.log(data);
                    if(data.meta){
                        jQuery("input[name='id']").val(data.meta.id);
                        jQuery("select[name='status']").val(data.meta.status);
                        jQuery("input[name='title']").val(data.meta.title);
                        editor.setData(data.meta.description);
                    }
                }
            }
        })
    }

</script>

@endsection