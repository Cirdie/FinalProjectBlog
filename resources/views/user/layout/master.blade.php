<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{asset('user/bootstrap/css/bootstrap.mins.css')}}">
    <link rel="stylesheet" href="{{asset(path: 'user/css/user.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,900&display=swap"
        rel="stylesheet">

        <!-- Add SweetAlert CDN -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.js"></script>

     <!-- Add SweetAlert styles -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.6/dist/sweetalert2.min.css">

     {{-- bootstrap icon --}}
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    {{-- for dark mode switch  --}}
    <link rel="stylesheet" href="{{asset('user/css/darkmode-switch.css')}}">
    {{-- see more  --}}
    <link rel="stylesheet" href="{{asset('user/css/seemore.css')}}">
    {{-- search  --}}
    <link rel="stylesheet" href="{{asset('user/css/search.css')}}">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        .shadow_2 {
            box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
        }
    </style>
</head>

<body class="body pt-5">

    @include('user.layout.navbar')

    <!-- Navbar End -->

    <!-- content container -->
    @yield('content')


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

        @yield('scriptSource')

        <script>
            var currentUrl = window.location.href;

            $('.nav-link').each(function() {
                var linkUrl = $(this).attr('href');

                if(currentUrl.indexOf(linkUrl) != -1) {
                    $(this).addClass('text-primary');
                }
            })


            $(document).ready(function() {
                if(localStorage.getItem('dark-mode') === 'true') {
                    $('.form-check-input').prop('checked', true);
                    enableDarkMode();
                }


                $('#flexSwitchCheckDefault').on('change', function() {
                    if($(this).prop('checked')) {
                        enableDarkMode();
                        localStorage.setItem('dark-mode', true);
                    } else {
                        disableDarkMode();
                        localStorage.setItem('dark-mode', false);
                    }
                });
            });

            function enableDarkMode() {
    $('body').addClass('dark-mode');
    $('.card, .bg-card').addClass('bg-dark text-light border-secondary').removeClass('bg-white text-dark');
    $('.form-control').addClass('bg-dark text-light border-secondary').removeClass('bg-light text-dark');

    // ✅ Dark mode for sidebar and topics list
    $('.sidebar').addClass('bg-dark text-light').removeClass('bg-white text-dark');
    $('.topics-container').addClass('bg-dark text-light');
    $('.topic-item').addClass('bg-dark text-light border-secondary');

    // ✅ Dark mode background
    $('body').css('background-color', '#121212');
    $('.bg-card').css('background-color', '#1c1c1c');

    // ✅ Smooth transition effect
    $('.sidebar, .topics-container, .bg-card, .card, body').css(
        'transition', 'background-color 0.3s ease-in-out, color 0.3s ease-in-out'
    );

    $('#toggleDarkMode').html('<i class="bi bi-sun"></i> Light Mode');
}

function disableDarkMode() {
    $('body').removeClass('dark-mode');
    $('.card, .bg-card').removeClass('bg-dark text-light border-secondary').addClass('bg-white text-dark');
    $('.form-control').removeClass('bg-dark text-light border-secondary').addClass('bg-light text-dark');

    // ✅ Revert sidebar and topics list to light mode
    $('.sidebar').removeClass('bg-dark text-light').addClass('bg-white text-dark');
    $('.topics-container').removeClass('bg-dark text-light');
    $('.topic-item').removeClass('bg-dark text-light border-secondary');

    // ✅ Restore light background
    $('body').css('background-color', '#f8f9fa');
    $('.bg-card').css('background-color', '#ffffff');

    $('#toggleDarkMode').html('<i class="bi bi-moon"></i> Dark Mode');
}



        </script>


        <script>
            $(document).ready(function(){
                $image = null;
                $('.card-box').each(function(){
                    $viewButton = $(this).find('.btn-view');
                    $image_container = $(this).find('.img-container');
                        if ($image_container.height() > 250) {
                            $viewButton.show();
                        } else {
                            $viewButton.hide();
                        }
                })

                $old_id = null;
                $('.image').click(function(){
                    $parentNode = $(this).parents('.card-box');
                    $viewButton = $parentNode.find('.btn-view');
                    $image_container = $parentNode.find('.img-container');
                    $image = $parentNode.find('.image');
                    $buttons = $parentNode.find('.buttons');
                    $image.css('filter', 'blur(2px)');
                    $buttons.css('opacity', '1');
                    $buttons.css('visibility', 'visible');
                })


                $('.btn-view').on('click', function() {
                        if ($(this).text() === 'Back') {
                            $(this).html('<i class="fa-solid fa-mountain-sun me-2"></i>View');
                        } else {
                            $(this).html('<i class="fa-solid fa-arrow-left me-2"></i>Back');
                        }
                        $parentNode = $(this).parents('.card-box');
                        $image_container = $parentNode.find('.img-container');
                        $image = $parentNode.find('.image');
                        $image_container.toggleClass('full-width');
                        $image.toggleClass('filter-none');
                });


                function removeFilterAndHideButtons() {
                    $image.css('filter', 'none');
                    $buttons.css('opacity', '0');
                    $buttons.css('visibility', 'hidden');
                }

                $(document).on('click', function(event) {
                    if($image!=null) {
                        if (!$(event.target).closest($image).length) {
                            removeFilterAndHideButtons();
                        }
                    }
                });




            })
        </script>
        <script src="{{asset('user/js/main.js')}}"></script>
</body>

</html>
