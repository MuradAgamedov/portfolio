<!-- Start Portfolio Area -->
<div class="rn-portfolio-area rn-section-gap section-separator" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div data-aos="fade-up" data-aos-duration="500" data-aos-delay="100" data-aos-once="true" class="section-title">
                    <div class="title-column">
                        <span class="subtitle">{{__("Portfolio")}}</span>
                        <h2 class="title">{{__("My Latest Work")}}</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Filter -->
        <div class="row">
            <div class="col-lg-12">
                <div class="portfolio-filter text-center mb-5 mt-5">
                    <div class="filter-buttons">
                        <a href="#portfolio" class="filter-btn active" data-filter="all">{{__("All")}}</a>
                        @foreach($portfolioCategories as $category)
                            <a href="#portfolio" class="filter-btn" data-filter="{{ $category->getSlug() }}">{{ $category->getTitle() }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Items -->
        <div class="row">
            @foreach($portfolios as $portfolio)
            <div class="col-lg-4 col-md-6 col-12 mt--30 portfolio-item" data-category="{{ $portfolio->category ? $portfolio->category->getSlug() : '' }}" data-aos="fade-up" data-aos-duration="500" data-aos-delay="{{ 200 + ($loop->index * 100) }}" data-aos-once="true">
                <div class="rn-service">
                    <div class="inner">
                        <div class="">
                            <img src="{{ $portfolio->getImageUrl() ?: 'assets/images/portfolio/portfolio-01.jpg' }}" 
                                 alt="{{ $portfolio->getTitle() }}">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <a href="{{ route('portfolios.index') }}#portfolio-{{ $portfolio->id }}">{{ $portfolio->getTitle() }}</a>
                            </h4>
                            <p class="description">{{ $portfolio->getDescription() }}</p>
                            @if($portfolio->category)
                                <div class="category">
                                    <span class="badge bg-primary">{{ $portfolio->category->getTitle() }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mt--50">
                    <a href="{{ route('portfolios.index') }}" class="rn-btn">
                        <span>{{__("View All Projects")}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Portfolio Area -->

@push('styles')
<style>
/* Portfolio Filter Styles */
.portfolio-filter {
    margin-bottom: 50px;
}

.filter-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
}

.filter-btn {
    padding: 12px 25px;
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 25px;
    color: var(--color-body);
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-btn:hover,
.filter-btn.active {
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

/* Portfolio Item Styles */
.portfolio-item {
    display: block;
}

.portfolio-item.hidden {
    display: none;
}

.rn-service {
    background: linear-gradient(135deg, var(--background-color-1) 0%, var(--background-color-2) 100%);
    border-radius: 15px;
    padding: 25px;
    box-shadow: var(--shadow-1);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
}

.rn-service:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
}

.rn-service img {
    width: 100%;
    height: auto;
    border-radius: 10px;
    margin-bottom: 20px;
    transition: transform 0.3s ease;
}

.rn-service:hover img {
    transform: scale(1.05);
}

.rn-service .content {
    text-align: center;
}

.rn-service .title {
    font-size: 18px;
    font-weight: 600;
    color: var(--color-heading);
    margin-bottom: 10px;
}

.rn-service .title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.3s ease;
}

.rn-service .title a:hover {
    color: var(--color-primary);
}

.rn-service .description {
    font-size: 14px;
    color: var(--color-body);
    line-height: 1.6;
    margin-bottom: 15px;
}

.rn-service .category {
    margin-top: 10px;
}

.rn-service .badge {
    font-size: 12px;
    padding: 5px 12px;
    border-radius: 15px;
}

/* View All Button */
.rn-btn {
    display: inline-block;
    padding: 15px 30px;
    background: linear-gradient(45deg, var(--color-primary), var(--color-secondary));
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.rn-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    color: white;
}

/* Responsive */
@media only screen and (max-width: 767px) {
    .filter-buttons {
        gap: 10px;
    }
    
    .filter-btn {
        padding: 10px 20px;
        font-size: 14px;
    }
    
    .rn-service {
        padding: 20px;
    }
}

@media only screen and (max-width: 575px) {
    .filter-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .filter-btn {
        width: 200px;
    }
    
    .rn-service {
        padding: 15px;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Portfolio filtering
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            portfolioItems.forEach(item => {
                const category = item.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    item.classList.remove('hidden');
                    item.style.display = 'block';
                } else {
                    item.classList.add('hidden');
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush 