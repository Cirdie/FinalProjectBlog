@extends('user.layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 pt-4 bg-card pt-lg-5" style="height: 92vh; overflow-y: scroll;">

            <!-- 🔙 Modern Back Button -->
            <div class="d-flex justify-content-start mb-4">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary d-flex align-items-center px-4 py-2 rounded-pill shadow-sm back-btn">
                    <i class="fa-solid fa-arrow-left me-2 transition"></i> Back
                </a>
            </div>

            <div class="card-box d-flex justify-content-center mb-4 mb-lg-5">
                <div class="card shadow rounded border-0" style="width: 40rem">
                    <h5 class="card-title mt-3 fw-bold ms-3">
                        <span class="me-2 text-primary border-start border-4 border-dark ps-1">{{$topic_name}}</span>
                    </h5>

                    <!-- Profile Section -->
                    <div class="d-flex align-items-center ms-3 mt-1">
                        <div style="width: 55px; height: 55px; overflow: hidden; border-radius: 50%;">
                            @if ($post->profile_image)
                                <img src="{{ asset('storage/'.$post->profile_image) }}"
                                     class="w-100 h-100 rounded-circle card-img-top"
                                     style="object-fit: cover; object-position: center;" alt="" />
                            @else
                                <img class="w-100 h-100 rounded-circle"
                                     style="object-fit: cover; object-position: center;"
                                     src="https://ui-avatars.com/api/?name={{$post->admin_name}}"/>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="ms-2">
                                <span style="font-size: 18px;" class="fw-semibold">{{$post->admin_name}}
                                    @if ($post->role == 'admin')
                                        <i class="bi bi-patch-check-fill"
                                           style="color: #1DA1F2; font-size:14px;"></i>
                                    @endif
                                </span>
                                <br>
                                <span style="font-size: 12px;">{{$post->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Clickable Image -->
                    <div class="img-container my-3 mx-4 border rounded border-dark border-3 overflow-hidden">
                        @if ($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}"
                                 class="image card-img-top w-100 cursor-pointer"
                                 id="postImage"
                                 data-bs-toggle="modal"
                                 data-bs-target="#imageModal" />
                        @else
                            <img src="{{ asset('images/alert gif/postimg.jpg') }}"
                                 class="card-img-top img-thumbnail"
                                 alt="" />
                        @endif
                    </div>

                    <!-- Post Description -->
                    <div class="card-body">
                        <p class="card-text mt-3" style="white-space: pre-wrap">{{$post->desc}}</p>
                        <hr />

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fs-5 ms-2" style="cursor: pointer;">
                                <i class="fa-regular fa-bookmark"></i>
                                <span>{{$post->save_count}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">View Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="Full Image">
            </div>
        </div>
    </div>
</div>

@endsection@extends('user.layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 pt-4 bg-card pt-lg-5" style="height: 92vh; overflow-y: scroll;">
            <div class="card-box d-flex justify-content-center mb-4 mb-lg-5">
                <div class="card shadow rounded border-0" style="width: 40rem">
                    <h5 class="card-title mt-3 fw-bold ms-3">
                        <span class="me-2 text-primary border-start border-4 border-dark ps-1">{{$topic_name}}</span>
                    </h5>

                    <!-- Profile Section -->
                    <div class="d-flex align-items-center ms-3 mt-1">
                        <div style="width: 55px; height: 55px; overflow: hidden; border-radius: 50%;">
                            @if ($post->profile_image)
                                <img src="{{ asset('storage/'.$post->profile_image) }}"
                                     class="w-100 h-100 rounded-circle card-img-top"
                                     style="object-fit: cover; object-position: center;" alt="" />
                            @else
                                <img class="w-100 h-100 rounded-circle"
                                     style="object-fit: cover; object-position: center;"
                                     src="https://ui-avatars.com/api/?name={{$post->admin_name}}"/>
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="ms-2">
                                <span style="font-size: 18px;" class="fw-semibold">{{$post->admin_name}}
                                    @if ($post->role == 'admin')
                                        <i class="bi bi-patch-check-fill"
                                           style="color: #1DA1F2; font-size:14px;"></i>
                                    @endif
                                </span>
                                <br>
                                <span style="font-size: 12px;">{{$post->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Clickable Image -->
                    <div class="img-container my-3 mx-4 border rounded border-dark border-3 overflow-hidden">
                        @if ($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}"
                                 class="image card-img-top w-100 cursor-pointer"
                                 id="postImage"
                                 data-bs-toggle="modal"
                                 data-bs-target="#imageModal" />
                        @else
                            <img src="{{ asset('images/alert gif/postimg.jpg') }}"
                                 class="card-img-top img-thumbnail"
                                 alt="" />
                        @endif
                    </div>

                    <!-- Post Description -->
                    <div class="card-body">
                        <p class="card-text mt-3" style="white-space: pre-wrap">{{$post->desc}}</p>
                        <hr />

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="fs-5 ms-2" style="cursor: pointer;">
                                <i class="fa-regular fa-bookmark"></i>
                                <span>{{$post->save_count}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">View Image</h5>
                <div>
                    <a href="{{ asset('storage/'.$post->image) }}" download class="btn btn-outline-secondary btn-sm">
                        <i class="fa-solid fa-download me-1"></i> Download
                    </a>
                    <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="Full Image">
            </div>
        </div>
    </div>
</div>

@endsection

