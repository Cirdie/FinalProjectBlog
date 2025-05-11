<div class="container mt-5">
    <div class="row">
        <!-- 📌 Sidebar Section (Fixed Left, Dark Mode Compatible) -->
        <div class="sidebar col-lg-2 d-none d-lg-block pt-5"
            style="position: fixed; left: 10px; width: 250px; height: 88vh; background-color: white;
                   box-shadow: 2px 0 0px rgba(0, 0, 0, 0.1); padding: 20px;">

            <!-- 📢 Announcements -->
            <div class="mb-4">
                <h6 class="fw-bold text-primary"><i class="bi bi-megaphone-fill me-1"></i> Announcements</h6>
                <marquee direction="up" scrollamount="2" style="height: 60px; font-size: 12px;">
                    <p>📣 New coding workshop this Friday!</p>
                </marquee>
            </div>
            <hr style="border-top: 2px solid #6f42c1; margin-bottom: 20px;">

            @if (!request()->is('user/saved/list'))
            <!-- 📌 Topics List -->
            <div class="mb-4">
                <h6 class="fw-bold text-primary"><i class="bi bi-tags-fill me-1"></i> Topics</h6>
                <ul class="list-group">
                    <li class="list-group-item border-0 {{ empty($topicId) ? 'active bg-primary text-white' : '' }}">
                        <a class="text-decoration-none {{ empty($topicId) ? 'text-white fw-bold' : 'text-dark' }}"
                            href="{{ route('user#home') }}">
                            📌 All Posts
                        </a>
                    </li>
                    @foreach ($topics as $topic)
                        <li class="list-group-item border-0 {{ isset($topicId) && $topicId == $topic->id ? 'active bg-primary text-white' : '' }}">
                            <a class="text-decoration-none {{ isset($topicId) && $topicId == $topic->id ? 'text-white fw-bold' : 'text-dark' }}"
                                href="{{ route('user#topicFilter', $topic->id) }}">
                                📝 {{ $topic->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <hr style="border-top: 2px solid #6f42c1; margin-bottom: 20px;">

        @endif






     <!-- 📂 Quick Links -->
<div class="mb-4">
    <h6 class="fw-bold text-primary"><i class="bi bi-link-45deg me-1"></i> Quick Links</h6>
    <ul class="list-group">
        <li class="list-group-item border-0">
            <a href="https://www.facebook.com/ATCIBSIT/" target="_blank" class="text-decoration-none d-flex align-items-center">
                <i class="bi bi-facebook text-primary me-2 fs-5"></i> Bsit Group Page
            </a>
        </li>
        <li class="list-group-item border-0">
            <a href="https://www.facebook.com/cirde.mosquito/" target="_blank" class="text-decoration-none d-flex align-items-center">
                <i class="bi bi-person-circle text-primary me-2 fs-5"></i> Admin Profile
            </a>
        </li>
        <li class="list-group-item border-0">
            <a href="https://github.com/Cirdie" target="_blank" class="text-decoration-none d-flex align-items-center">
                <i class="bi bi-github me-2 fs-5" style="color: #6f42c1;"></i> GitHub
            </a>
        </li>
    </ul>
</div>
            <hr style="border-top: 2px solid #6f42c1; margin-bottom: 20px;">
        </div>
