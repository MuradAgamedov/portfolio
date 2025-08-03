<!-- Start Contact section -->
<div class="rn-contact-area rn-section-gap section-separator" id="contacts">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style="flex-direction: column; align-items: flex-start; " class="section-title text-center">
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
                        <div class="name">{{__("find with me")}}</div>
                        <div class="social-icone">
                            <a href="#"><i data-feather="facebook"></i></a>
                            <a href="#"><i data-feather="linkedin"></i></a>
                            <a href="#"><i data-feather="instagram"></i></a>
                            @php
                                $whatsapp = \App\Models\SiteSetting::getByKey('whatsapp');
                            @endphp
                            @if($whatsapp)
                                <a href="https://wa.me/{{ $whatsapp }}" target="_blank" id="contact-whatsapp-link" name="whatsapp">
                                    <i data-feather="message-circle"></i>
                                </a>
                            @endif
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
                                <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 20px; width: max-content;">
                                    <div class="g-recaptcha mb-3" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                    <button name="submit" type="submit" id="submit" class="rn-btn" style="width: 100%; display: block; text-align: center;">
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