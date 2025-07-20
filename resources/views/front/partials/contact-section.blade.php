<!-- Start Contact section -->
<div class="rn-contact-area rn-section-gap section-separator" id="contacts">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <span class="subtitle">{{__("Contact")}}</span>
                    @php
                        $contactTitle = \App\Models\SiteSetting::getByKey('title');
                    @endphp
                    <h2 class="title">{{ $contactTitle ?: __("Contact With Me") }}</h2>
                </div>
            </div>
        </div>

        <div class="row mt--50 mt_md--40 mt_sm--40 mt-contact-sm">
            <div class="col-lg-5">
                <div class="contact-about-area">
                    <div class="thumbnail">
                        @php
                            $contactImage = \App\Models\SiteSetting::getByKey('contact_section_image');
                            $contactImageAlt = \App\Models\SiteSetting::getByKey('contact_section_alt');
                        @endphp
                        @if($contactImage)
                            <img src="{{ asset('storage/' . $contactImage) }}" alt="{{ $contactImageAlt ?: 'contact-img' }}">
                        @else
                        <img src="assets/images/contact/contact1.png" alt="contact-img">
                        @endif
                    </div>
                    <div class="title-area">
                        <h4 class="title">{{$contactTitle}}</h4>
                    </div>
                    <div class="description">
                        @php
                            $contactText = \App\Models\SiteSetting::getByKey('contact_section_text');
                            $phone = \App\Models\SiteSetting::getByKey('phone');
                            $email = \App\Models\SiteSetting::getByKey('email');
                        @endphp
                        <p>{{ $contactText ?: __("I am available for freelance work. Connect with me via and call in to my account.") }}</p>
                        <span class="phone">{{__("Phone")}}: <a href="tel:{{ $phone ?: '01941043264' }}">{{ $phone ?: '+01234567890' }}</a></span>
                        <span class="mail">{{__("Email")}}: <a href="mailto:{{ $email ?: 'admin@example.com' }}">{{ $email ?: 'admin@example.com' }}</a></span>
                    </div>
                    <div class="social-area">
                        <div class="name">{{__("FIND WITH ME")}}</div>
                        <div class="social-icone">
                            <a href="#"><i data-feather="facebook"></i></a>
                            <a href="#"><i data-feather="linkedin"></i></a>
                            <a href="#"><i data-feather="instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div data-aos-delay="600" class="col-lg-7 contact-input">
                <div class="contact-form-wrapper">
                    <div class="introduce">

                        <form class="rnt-contact-form rwt-dynamic-form row" id="contact-form" method="POST">
                            @csrf

                            <div class="col-lg-6">
                                <div class="form-group" style="width: 100%;">
                                    <label for="contact-name">{{__("Your Name")}}</label>
                                    <input class="form-control" name="contact-name" id="contact-name" type="text" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group" style="width: 100%;">
                                    <label for="contact-phone">{{__("Phone Number")}}</label>
                                    <input class="form-control" name="contact-phone" id="contact-phone" type="text" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group" style="width: 100%;">
                                    <label for="contact-email">{{__("Email")}}</label>
                                    <input class="form-control" id="contact-email" name="contact-email" type="email" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group" style="width: 100%;">
                                    <label for="subject">{{__("Subject")}}</label>
                                    <input class="form-control" id="subject" name="subject" type="text" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group" style="width: 100%;">
                                    <label for="contact-message">{{__("Your Message")}}</label>
                                    <textarea class="form-control" name="contact-message" id="contact-message" cols="30" rows="8"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div style="display: flex; flex-direction: row; align-items: center; gap: 20px; justify-content: space-between;">
                                    <div class="g-recaptcha mb-3" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                    <button name="submit" type="submit" id="submit" class="rn-btn">
                                        <span>{{__("SEND MESSAGE")}}</span>
                                        <i data-feather="arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Contact section -->

<style>
/* Neumorphic Contact Form Styles */
.contact-form-wrapper {
    background: #2a2d31;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 
        20px 20px 60px rgba(0, 0, 0, 0.5),
        inset 5px 5px 10px rgba(255, 255, 255, 0.05),
        inset -5px -5px 10px rgba(0, 0, 0, 0.3);
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #c4cfde;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.form-control {
    width: 100%;
    padding: 15px 20px;
    background: #212428;
    border: none;
    border-radius: 15px;
    color: #c4cfde;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 
        inset 5px 5px 10px rgba(0, 0, 0, 0.3),
        inset -5px -5px 10px rgba(255, 255, 255, 0.05);
}

.form-control:focus {
    outline: none;
    box-shadow: 
        inset 8px 8px 15px rgba(0, 0, 0, 0.4),
        inset -8px -8px 15px rgba(255, 255, 255, 0.08),
        0 0 0 2px rgba(255, 1, 79, 0.3);
}

.form-control::placeholder {
    color: rgba(196, 207, 222, 0.4);
}

textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.rn-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    background: #212428;
    color: #ff014f;
    text-decoration: none;
    border-radius: 15px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 
        5px 5px 10px rgba(0, 0, 0, 0.3),
        -5px -5px 10px rgba(255, 255, 255, 0.05);
}

.rn-btn:hover {
    transform: translateY(-2px);
    box-shadow: 
        8px 8px 15px rgba(0, 0, 0, 0.4),
        -8px -8px 15px rgba(255, 255, 255, 0.08);
    color: #ff014f;
}

.rn-btn:active {
    transform: translateY(0);
    box-shadow: 
        inset 5px 5px 10px rgba(0, 0, 0, 0.3),
        inset -5px -5px 10px rgba(255, 255, 255, 0.05);
}

/* reCAPTCHA styling */
.g-recaptcha {
    margin-bottom: 20px;
}

/* Contact info styling */
.contact-about-area {
    background: #2a2d31;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 
        20px 20px 60px rgba(0, 0, 0, 0.5),
        inset 5px 5px 10px rgba(255, 255, 255, 0.05),
        inset -5px -5px 10px rgba(0, 0, 0, 0.3);
}

.contact-about-area .thumbnail img {
    border-radius: 15px;
    box-shadow: 
        10px 10px 20px rgba(0, 0, 0, 0.3),
        -10px -10px 20px rgba(255, 255, 255, 0.05);
}

.contact-about-area .title {
    color: #c4cfde;
    margin: 20px 0;
}

.contact-about-area .description {
    color: #c4cfde;
    line-height: 1.8;
}

.contact-about-area .description span {
    display: block;
    margin-bottom: 10px;
}

.contact-about-area .description a {
    color: #ff014f;
    text-decoration: none;
}

.social-area {
    margin-top: 30px;
}

.social-area .name {
    color: #c4cfde;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 15px;
}

.social-icone a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: #212428;
    border-radius: 10px;
    color: #c4cfde;
    margin-right: 10px;
    transition: all 0.3s ease;
    box-shadow: 
        5px 5px 10px rgba(0, 0, 0, 0.3),
        -5px -5px 10px rgba(255, 255, 255, 0.05);
}

.social-icone a:hover {
    color: #ff014f;
    transform: translateY(-2px);
    box-shadow: 
        8px 8px 15px rgba(0, 0, 0, 0.4),
        -8px -8px 15px rgba(255, 255, 255, 0.08);
}
</style> 