<!DOCTYPE html>
<html class="no-js" lang="en">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        .contact-form-main {
            padding: 50px 0;
        }

        .form-wrapper {
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
        }

        .section-title span {
            color: #dd1bf7;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .section-title h2 {
            font-size: 2rem;
            margin-top: 10px;
            font-weight: 600;
            color: #333;
        }

        .form-box input, .form-box textarea {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px 15px;
            font-size: 16px;
            transition: all 0.3s;
        }

        .form-box input:focus, .form-box textarea:focus {
            border-color: #dd1bf7;
            outline: none;
            box-shadow: 0 0 5px rgba(247, 99, 27, 0.5);
        }

        .form-box {
            margin-bottom: 20px;
        }

        .submit-info button {
            background: #dd1bf7;
            color: #fff;
            border: none;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .submit-info button:hover {
            background: #d9531e;
        }

        .from-left img {
            position: absolute;
            left: 50px;
            bottom: 0;
            max-width: 300px;
            opacity: 0.8;
        }
    </style>
</head>
<body>
  <!-- Contact Form Start -->
  <section id="contact" class="contact-form-main">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Contact Form -->
            <div class="col-md-8">
                <div class="form-wrapper">
                    <!-- Section Title -->
                    <div class="section-title text-center mb-4">
                        <span>Contact US</span>
                        <h2>We'd Love To Hear From You!</h2>
                    </div>
                    <!-- Form Start -->
                    <form id="contact-form" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-lg-6">
                                <div class="form-box">
                                    <input type="text" name="name" placeholder="Name" required>
                                </div>
                            </div>
                            <!-- Phone Field -->
                            <div class="col-lg-6">
                                <div class="form-box">
                                    <input type="text" name="phone" placeholder="Phone Number" required>
                                </div>
                            </div>
                            <!-- Email Field -->
                            <div class="col-lg-6">
                                <div class="form-box">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                            <!-- Subject Field -->
                            {{-- <div class="col-lg-6">
                                <div class="form-box">
                                    <input type="text" name="subject" placeholder="Subject" required>
                                </div>
                            </div> --}}
                            <!-- Message Field -->
                            <div class="col-lg-12">
                                <div class="form-box">
                                    <textarea name="message" rows="5" placeholder="Write Your Message" required></textarea>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="col-lg-12 text-center">
                                <div class="submit-info">
                                    <button type="submit" class="btn">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Form End -->
                </div>
            </div>
        </div>
    </div>

  </section>
  <!-- Contact Form End -->

  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var workoutLink = document.querySelector('a[href="#workouts"]');
        workoutLink.addEventListener('click', function(event) {
            event.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            window.scrollTo({
                top: target.offsetTop,
                behavior: 'smooth'
            });
        });
    });
</script>

