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
            <!-- <a class="btn btn-dark" href="{{route('new_blog')}}">New Blog</a> -->
            <button type="button" class="btn btn-dark mt-1" data-toggle="modal" data-target="#myNewBlogForm">
            New Blog
        </button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @foreach($blogs as $item)
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <!-- Card Image -->
                        <img src="https://via.placeholder.com/150" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <!-- Card Title -->
                            <h5 class="card-title">{{$item['title']}}</h5>
                            <!-- Card Content -->
                            <p class="card-text">{!! $item['content'] !!}</p>
                            <!-- Optional Button -->
                            <a href="blog.html" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
</div>


<div class="modal fade" id="myNewBlogForm">
  <div class="modal-dialog">
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
        <form method="post" action="{{route('saveBlog')}}" id="newBlogForm">
          @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" placeholder="Enter Title" name="title">
                <label class="text-danger title_error"></label>
            </div>

            <div class="form-group">
                <label for="title">Short Description</label>
                <div id="editor"></div>
                <label class="text-danger description_error"></label>
            </div>

            

            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" class="form-control">
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
            formData.append("short_desc",content);
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

    });

</script>

@endsection