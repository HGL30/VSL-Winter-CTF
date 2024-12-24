<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSL Spring CTF 2024</title>
    <link rel="icon" type="image/png" href="{{ asset('Photo/favicon-32x32.png') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <nav>
        <div class="avatar-web">
            <a href="{{ url('/') }}">
                <img src="Photo/avt-web.jpg" alt="">
            </a> 
        </div>
        <div class="join-button">
            <a href="https://vku-security-lab.github.io" target="_blank" class="register-btn">About Us</a>
            <a href="{{ route('home') }}" class="register-btn">Join Now !</a>
        </div>
    </nav>
    <div class="video-container">
        <p>
            Welcome to VSL Spring CTF 2024 <br>
            <span id="countdown"></span> <br>
            <script>
                const targetDate = new Date("2025-02-14T08:00:00").getTime();

                // Cập nhật đồng hồ mỗi giây
                const countdown = setInterval(function() {
                    const now = new Date().getTime();
                    const distance = targetDate - now;

                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("countdown").innerHTML ="Competiton start: " + days + "D " + hours + "H " + minutes + "M " + seconds + "S ";

                    if (distance < 0) {
                        clearInterval(countdown);
                        document.getElementById("countdown").innerHTML = "Competiton has been ended!";
                    }
                }, 1000);
            </script>
            <span>organized by VSL.</span> <br>
            <span>If you are newbie, <a href="storage/fornewbie.pdf" target="_blank" style="color: white;">click here !</a></span>
        </p>
        <video data-v-d9ded2bc="" autoplay="autoplay" playsinline="" muted="muted" loop="loop">
            <source data-v-d9ded2bc="" src="media/video-index.webm" type="video/webm; codecs=vp9">
        </video>
    </div>
</body>
</html>
