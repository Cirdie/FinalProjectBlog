@extends('user.layout.master')

@section('title', 'Feedback Form')

@section('content')
<div class="container-fluid d-flex align-items-center justify-content-center bg-card" style="min-height: 90vh;">
    <div class="row w-100">
        <div class="col-12 col-lg-8 offset-lg-2 bg-card shadow-lg rounded-4 px-4 px-lg-5 py-5">

            <!-- 📝 Form Title -->
            <div class="text-center mb-4">
                <h3 class="fw-bold text-primary"><i class="fa-solid fa-comment-dots me-2"></i> Feedback Form</h3>
                <p class="text-muted">We value your feedback! Let us know how we can improve.</p>
            </div>

            <div class="row">
                <!-- 📌 Contact Info -->
                <div class="col-lg-4">
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <div class="icon text-primary fs-4"><i class="fa-solid fa-phone"></i></div>
                            <div class="ms-3">
                                <div class="fw-semibold">Phone</div>
                                <div class="text-muted">(084) 216 4241</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <div class="icon text-primary fs-4"><i class="fa-solid fa-envelope"></i></div>
                            <div class="ms-3">
                                <div class="fw-semibold">Email</div>
                                <div class="text-muted">bsit.atci@gmail.com</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex align-items-center">
                            <div class="icon text-primary fs-4"><i class="fa-solid fa-map-location-dot"></i></div>
                            <div class="ms-3">
                                <div class="fw-semibold">Address</div>
                                <div class="text-muted">Aces Tagum College Campus, Pioneer Ave, Tagum, 8100 Davao del Norte</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 📝 Feedback Form -->
                <div class="col-lg-7 offset-lg-1">
                    <form action="{{ route('feedback#send') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <input type="text" name="name" value="{{ Auth::user()->name }}"
                                       class="form-control form-control-lg bg-card border-2 text-dark"
                                       placeholder="Your Name" required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" value="{{ Auth::user()->email }}"
                                       class="form-control form-control-lg bg-card border-2 text-dark"
                                       placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="subject" class="form-control form-control-lg bg-card border-2 text-dark"
                                   placeholder="Subject" required>
                        </div>
                        <div class="mb-3">
                            <textarea name="message" class="form-control form-control-lg bg-card border-2 text-dark"
                                      placeholder="Write your feedback here..." rows="4" required></textarea>
                        </div>

                        <!-- ✅ Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-paper-plane me-2"></i> Send Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
