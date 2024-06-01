@extends('app')

@section('style')

<style>
    .form-group label{
        font-weight:bold;
    }
</style>

@endsection

@section('content')


<div class="content">
    <div class="d-flex">
        <div class="mr-3">
            <h2>New Blog</h2>
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
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group">
                
                    <label for="category">Category</label>
                    <select class="form-control" name="category">
                        <option value="0">Select Category</option>
                        @foreach($category as $item)
                            <option value="{{$item['id']}}">{{$item['category']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                
                    <label for="status">Status</label>
                    <select class="form-control" name="status">
                        <option value="private">Private</option>
                        <option value="public">Public</option>
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

    jQuery(document).ready(function(){
        let editor;
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
                url: "{{route('saveBlog')}}",
                method:"POST",
                data:formData,
                contentType:false,
                processData:false,
                dataType:"JSON",
                success:function(resp){

                },
                error:function(err){

                }
            })
        })
    })

</script>

@endsection