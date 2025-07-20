@extends('front.layouts.master')

@section('title', __('About Me'))

@section('content')
<!-- Start About Area -->
<div class="rn-about-area rn-section-gap section-separator" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true" class="section-title">
                    <div class="title-column">
                        <span class="subtitle">{{__("About Me")}}</span>
                        <h2 class="title">{{__("About Me")}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Content -->
        <div class="row mt--30">
            <div class="col-lg-12">
                <div class="about-content" data-aos="fade-up" data-aos-duration="500" data-aos-delay="200" data-aos-once="true">
                    @if($about->getDescription())
                        <div class="about-description">
                            {!! $about->getDescription() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Education Section -->
        @if($education->count() > 0)
        <div class="row mt--50">
            <div class="col-lg-12">
                <div class="section-title" data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-once="true">
                    <h3 class="title">{{__("Education")}}</h3>
                </div>
            </div>
        </div>
        
        <div class="row mt--30">
            @foreach($education as $index => $edu)
            <div class="col-lg-6 col-md-6 col-12 mt--30" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 400 + ($index * 100) }}" data-aos-once="true">
                <div class="education-card">
                    <div class="inner">
                        <div class="content">
                            <h4 class="title">{{ $edu->getTitle() }}</h4>
                            <p class="university">{{ $edu->university_name }}</p>
                            <p class="period">{{ $edu->start_date }} - {{ $edu->end_date ?? __('Present') }}</p>
                            <p class="description">{{ $edu->getDescription() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Experience Section -->
        @if($experiences->count() > 0)
        <div class="row mt--50">
            <div class="col-lg-12">
                <div class="section-title" data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-once="true">
                    <h3 class="title">{{__("Experience")}}</h3>
                </div>
            </div>
        </div>
        
        <div class="row mt--30">
            @foreach($experiences as $index => $exp)
            <div class="col-lg-6 col-md-6 col-12 mt--30" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 400 + ($index * 100) }}" data-aos-once="true">
                <div class="experience-card">
                    <div class="inner">
                        <div class="content">
                            <h4 class="title">{{ $exp->getTitle() }}</h4>
                            <p class="company">{{ $exp->company_name }}</p>
                            <p class="period">{{ $exp->start_date }} - {{ $exp->end_date ?? __('Present') }}</p>
                            <p class="description">{{ $exp->getDescription() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Skills Section -->
        @if($skills->count() > 0)
        <div class="row mt--50">
            <div class="col-lg-12">
                <div class="section-title" data-aos="fade-up" data-aos-duration="500" data-aos-delay="300" data-aos-once="true">
                    <h3 class="title">{{__("Skills")}}</h3>
                </div>
            </div>
        </div>
        
        <div class="row mt--30">
            @foreach($skills as $index => $skill)
            <div class="col-lg-4 col-md-6 col-12 mt--30" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 400 + ($index * 100) }}" data-aos-once="true">
                <div class="skill-card">
                    <div class="inner">
                        <div class="content">
                            <h4 class="title">{{ $skill->getTitle() }}</h4>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: {{ $skill->percentage }}%"></div>
                            </div>
                            <p class="percentage">{{ $skill->percentage }}%</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
<!-- End About Area -->
@endsection

@section('styles')
<style>
/* Section Title Styles */
.section-title .title-column {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 15px;
    text-align: left;
}

.section-title .subtitle {
    font-size: 16px;
    color: var(--color-body);
    font-weight: 400;
    margin: 0;
}

.section-title .title {
    font-size: 48px;
    font-weight: 700;
    color: var(--color-heading);
    margin: 0;
}

/* About Content Styles */
.about-content {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 20px;
    padding: 40px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.about-description {
    color: var(--color-body);
    font-size: 16px;
    line-height: 1.8;
}

.about-description p {
    margin-bottom: 20px;
}

.about-description p:last-child {
    margin-bottom: 0;
}

/* Education Card Styles */
.education-card {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 15px;
    padding: 25px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.education-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.education-card .title {
    font-size: 18px;
    font-weight: 600;
    color: var(--color-heading);
    margin-bottom: 8px;
}

.education-card .university {
    font-size: 14px;
    color: var(--color-primary);
    font-weight: 500;
    margin-bottom: 5px;
}

.education-card .period {
    font-size: 13px;
    color: var(--color-body);
    margin-bottom: 15px;
}

.education-card .description {
    font-size: 14px;
    color: var(--color-body);
    line-height: 1.6;
    margin: 0;
}

/* Experience Card Styles */
.experience-card {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 15px;
    padding: 25px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.experience-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.experience-card .title {
    font-size: 18px;
    font-weight: 600;
    color: var(--color-heading);
    margin-bottom: 8px;
}

.experience-card .company {
    font-size: 14px;
    color: var(--color-primary);
    font-weight: 500;
    margin-bottom: 5px;
}

.experience-card .period {
    font-size: 13px;
    color: var(--color-body);
    margin-bottom: 15px;
}

.experience-card .description {
    font-size: 14px;
    color: var(--color-body);
    line-height: 1.6;
    margin: 0;
}

/* Skill Card Styles */
.skill-card {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 15px;
    padding: 25px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    height: 100%;
}

.skill-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.skill-card .title {
    font-size: 16px;
    font-weight: 600;
    color: var(--color-heading);
    margin-bottom: 15px;
}

.skill-bar {
    width: 100%;
    height: 8px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 10px;
}

.skill-progress {
    height: 100%;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    border-radius: 4px;
    transition: width 1s ease;
}

.skill-card .percentage {
    font-size: 14px;
    color: var(--color-body);
    margin: 0;
    text-align: right;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .section-title .title {
        font-size: 36px;
    }
    
    .about-content {
        padding: 30px;
    }
    
    .education-card,
    .experience-card,
    .skill-card {
        padding: 20px;
    }
}

@media only screen and (max-width: 575px) {
    .section-title .title {
        font-size: 28px;
    }
    
    .about-content {
        padding: 20px;
    }
    
    .education-card,
    .experience-card,
    .skill-card {
        padding: 15px;
    }
}
</style>
@endsection 