@extends('user.layout.master')

@section('content')

@include('user.layout.sidebar')

<!-- 📌 Centered Home Posts Section -->
<div class="col-lg-6 offset-lg-4 bg-card pt-4"
style="height: 91vh; overflow-y: scroll; background-color: #f8f9fa; border-radius: 10px; padding: 20px;">

@if (count($posts) != 0)
    @foreach ($posts as $post)
        @if ($post->approved == 1)
            <div class="card-box d-flex justify-content-center mb-4">
                <div class="card shadow rounded border-0" style="width: 35rem">
                    <h5 class="card-title mt-3 fw-bold ms-3">
                        <span class="me-2 text-primary border-start border-4 border-dark ps-1">
                            {{$post->topic_name}}
                        </span>
                    </h5>

                                   <!-- ✅ User Profile Section (Checks if Admin) -->
                <div class="d-flex align-items-center ms-3 mt-1">
                    <div style="width: 55px; height: 55px; overflow: hidden; border-radius: 50%;">
                        @if ($post->profile_image)
                            <img src="{{ asset('storage/'.$post->profile_image) }}"
                                 class="w-100 h-100 rounded-circle card-img-top"
                                 style="object-fit: cover; object-position: center;" alt="" />
                        @else
                            <img class="w-100 h-100 rounded-circle"
                                 style="object-fit: cover; object-position: center;"
                                 src="https://ui-avatars.com/api/?name={{ urlencode($post->admin_name) }}" />
                        @endif
                    </div>
                    <div class="d-flex">
                        <div class="ms-2">
                            <span style="font-size: 18px;" class="fw-semibold">
                                {{$post->admin_name}}
                                @if ($post->role == 'admin')
                                    <i class="bi bi-patch-check-fill text-primary" style="font-size:14px;"></i>
                                @endif
                            </span>
                            <br>
                            <span style="font-size: 12px;">{{$post->created_at->diffForHumans()}}</span>
                        </div>
                    </div>
                </div>

                    <div class="img-container my-3 mx-4 border rounded border-dark border-3">
                        @if ($post->image)
                            <img src="{{asset('storage/'.$post->image)}}" class="image card-img-top" />
                        @else
                            <img src="{{asset('images/alert gif/postimg.jpg')}}" class="card-img-top img-thumbnail" />
                        @endif
                    </div>
                    <div class="card-body">
                        <p class="card-text" style="white-space: pre-wrap">{{Str::words($post->desc,20,"....")}}</p>
                        <hr />
                        <div class="d-flex justify-content-between align-items-center">
                            @if (Auth::check())
                                <div class="btn btn-save" data-post-id="{{$post->id}}">
                                    <i class="fa-regular @if ($saveStatus[$post->id] == true) fa-solid @endif text-primary fa-bookmark fs-3"></i>
                                </div>
                            @endif
                            <a href="{{route('user#view',$post->id)}}" class="btn btn-primary">
                                <i class="fa-solid fa-eye me-2"></i> See More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@else
    <h4 class="text-primary text-center mt-4">No post to show.</h4>
@endif

<div class="mt-2 d-flex justify-content-center">
    {{$posts->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4')}}
</div>
</div>

@endsection


@if (session('feedbackSent'))
    @section('scriptSource')
        <script>
            Swal.fire({
                imageUrl: '{{asset('images/alert gif/happy.gif')}}',
                imageWidth: 300,
                imageHeight: 300,
                imageAlt: 'Custom image',
                title: '{{ session('feedbackSent') }}',
                showConfirmButton: true,
            })
        </script>
    @endsection
@endif

@if (session('info'))
    @section('scriptSource')
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                text: '{{ session('info') }}',
                showConfirmButton: true,
            })
        </script>
    @endsection
@endif

@section('scriptSource')

<script>
   $(document).ready(function() {
    // ✅ Auto-detect links and convert them to clickable URLs
    $(".card-text").each(function() {
        const linkRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
        const modifiedHTML = $(this).html().replace(linkRegex, '<a target="_blank" href="$1">$1</a>');
        $(this).html(modifiedHTML);
    });

    // ✅ Save Post Function
    $('.btn-save').click(function(){
        let $this = $(this);
        let post_id = $this.data('post-id');

        $.ajax({
            type: 'GET',
            url: '/user/home/save',
            data: { post_id: post_id },
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    title: 'Saved!',
                    text: 'This post has been saved!',
                    imageUrl: '{{ asset('images/alert gif/already saved.gif') }}',
                    imageWidth: 300,
                    imageHeight: 300,
                    imageAlt: 'Custom image',
                    confirmButtonText: 'OK'
                }).then(function(){
                    // ✅ Refresh the page after clicking OK
                    location.reload();
                });
            },
            error: function(xhr) {
                console.error('AJAX Error:', xhr.responseText);
                Swal.fire({
                    title: 'Post Already Saved!',
                    text: 'This post has already been saved. If you want to remove it, please go to your Saved Posts.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});


    // ✅ Lazy Load More Posts on Scroll
    var page = 1;
    function loadMorePosts() {
        $.ajax({
            url: '{{ route('user#home') }}' + '?page=' + page + '&searchKey={{ request('searchKey') }}',
            type: 'GET',
            success: function(response) {
                if (response) {
                    $('#posts-placeholder').append(response);
                    page++;
                }
            }
        });
    }
</script>
@endsection
