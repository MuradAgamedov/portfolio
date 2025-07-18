# Front-End Structure Documentation

## Overview
The front-end has been restructured to use organized partials with clear separation of concerns. The structure now includes separate components for head, header, and footer sections.

## File Structure

### Master Layout
- `resources/views/front/layouts/master.blade.php` - Main layout file that includes partials

### Partials
- `resources/views/front/partials/head.blade.php` - Head section with meta tags, title, and CSS files
- `resources/views/front/partials/header.blade.php` - Header navigation and mobile menu
- `resources/views/front/partials/footer.blade.php` - Footer content and JavaScript files

### Pages
- `resources/views/front/home/index.blade.php` - Home page using master layout

### Controller
- `app/Http/Controllers/FrontController.php` - Handles front-end logic and data

## Key Features

### 1. Organized Partials
- **Head Partial**: Contains all meta tags, title, favicon, and CSS files
- **Header Partial**: Contains navigation bar and mobile menu
- **Footer Partial**: Contains footer content, modal, back-to-top button, and JavaScript files
- **Master Layout**: Clean and simple structure using @include directives

### 2. Dynamic Data Integration
- Hero section uses data from `HeroData` and `HeroProfession` models
- Services section dynamically loads from `Service` model
- Portfolio section uses `Portfolio` and `PortfolioCategory` models
- All data is passed through the `FrontController`

### 3. Laravel Asset Handling
- Uses `{{ asset('path/to/file') }}` for all assets
- Proper CSRF protection with `@csrf` directive
- Form validation with `@error` directives
- Old input preservation with `{{ old('field') }}`

### 4. Routes
- `Route::get('/', [FrontController::class, 'index'])->name('home')` - Home page
- `Route::post('/contact', [FrontController::class, 'contact'])->name('contact.send')` - Contact form

## Usage

### Creating New Pages
1. Create a new Blade file in `resources/views/front/`
2. Extend the master layout: `@extends('front.layouts.master')`
3. Define content sections:
   ```blade
   @section('title', 'Page Title')
   @section('content')
       <!-- Your content here -->
   @endsection
   ```

### Adding New Components
1. Create a new partial file in `resources/views/front/partials/`
2. Use `@include('front.partials.filename')` to include it in master layout

### Database Integration
- All dynamic content is loaded through the `FrontController`
- Models are used to fetch data from the database
- Data is passed to views as variables

## Benefits
- **Organized Structure**: Clear separation of head, header, and footer components
- **Maintainable**: Each component has its own file for easy editing
- **Laravel Integration**: Proper use of Blade syntax and Laravel features
- **Dynamic Content**: All content is loaded from the database
- **Security**: CSRF protection and proper form validation
- **Performance**: Efficient asset loading and caching

## Migration from Old Structure
- Head section moved to separate partial with all meta tags and CSS
- Header section includes navigation and mobile menu
- Footer section includes footer content, modal, and JavaScript files
- Master layout simplified to use @include directives
- Static content has been replaced with dynamic database content
- Asset paths updated to use Laravel's `asset()` helper
- Forms updated with proper Laravel validation and CSRF protection

## Current File Structure
```
resources/views/front/
├── layouts/
│   └── master.blade.php (includes partials)
├── partials/
│   ├── head.blade.php (meta tags, CSS)
│   ├── header.blade.php (navigation, mobile menu)
│   └── footer.blade.php (footer, modal, JavaScript)
└── home/
    └── index.blade.php (extends master layout)
``` 