<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Diana Beth Fitness')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Include any CSS files here -->
</head>
<body>
  <!--? Contact form Start -->
  <section class="contact-form-main">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-7 col-lg-7">
                <div class="form-wrapper">
                    <!--Section Tittle  -->
                    <div class="form-tittle">
                        <div class="row ">
                            <div class="col-lg-11 col-md-10 col-sm-10">
                                <div class="section-tittle">
                                    <span>Contact Form</span>
                                    <h2>Feel Free to contact with us!</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Section Tittle  -->
                    <form id="contact-form" action="#" method="POST">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box user-icon mb-30">
                                    <input type="text" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box email-icon mb-30">
                                    <input type="text" name="email" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <div class="select-itms">
                                    <select name="select" id="select2">
                                        <option value="">Boxing</option>
                                        <option value="">saiful islam</option>
                                        <option value="">Arafath Miya</option>
                                        <option value="">Shakil Miya</option>
                                        <option value="">Tamim Sharker</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-box subject-icon mb-30">
                                    <input type="Email" name="subject" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-box message-icon mb-65">
                                    <textarea name="message" id="message" placeholder="Message"></textarea>
                                </div>
                                <div class="submit-info">
                                    <button class="btn" type="submit">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- contact left Img-->
    <div class="from-left d-none d-lg-block">
        <img src="assets/img/gallery/contact_form.png" alt="">
    </div>
</section>
<!-- Contact form End -->
</body>
</html>
