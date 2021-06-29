@extends('layouts/admin-owner/ao-app')

@section('title')
    LTB-Tourism Home Page
@endsection

@section('header-nav')
    <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
        <h1 class="text-light"><a href="index.html"><span>LTTIMS(LOGO)</span></a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
        {{-- <ul>
            <li class="active"><a href="{{route('ao.home')}}">Home</a></li>
            <li><a href="{{route('ao.login')}}">Login</a></li>
            <li><a href="{{route('ao.register')}}">Register</a></li>
        </ul> --}}
        </nav><!-- .nav-menu -->
    </div>
@endsection

@section('content')
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">La Trinidad Tourism</h1>
            <h2 data-aos="fade-up" data-aos-delay="400">La Trinidad Tourism Slogan</h2>
            <div data-aos="fade-up" data-aos-delay="800">
                <a href="" class="btn-get-started scrollto">Visitor Registration</a>
            </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
            <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">
    <!-- ======= Evants Section ======= -->
    <section id="nerby" class="nearby" style="background-color:#ffffff">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Events</h2>
        </div>
      </div>
    </section><!-- End Event Section -->

    <!-- ======= More Event Section ======= -->
    <section id="more-services" class="more-services" style="background-color:#ffffff">
      <div class="container">

        <div class="row">
          <div class="col-md-6 d-flex align-items-stretch">
            <div class="card" style='background-image: url("assets/img/more-services-1.jpg");' data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <h5 class="card-title"><a href="">Benguet Day</a></h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor ut labore et dolore magna aliqua.</p>
                <div class="read-more"><a href="events-calender.html"><i class="icofont-arrow-right"></i> Read More</a></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="card" style='background-image: url("assets/img/more-services-2.jpg");' data-aos="fade-up" data-aos-delay="200">
              <div class="card-body">
                <h5 class="card-title"><a href="">Cordillera Day</a></h5>
                <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem.</p>
                <div class="read-more"><a href="events-calender.html"><i class="icofont-arrow-right"></i> Read More</a></div>
              </div>
            </div>

          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4">
            <div class="card" style='background-image: url("assets/img/more-services-3.jpg");' data-aos="fade-up" data-aos-delay="100">
              <div class="card-body">
                <h5 class="card-title"><a href="">Strawberry Festival 2020</a></h5>
                <p class="card-text">Nemo enim ipsam voluptatem quia voluptas sit aut odit aut fugit, sed quia magni dolores.</p>
                <div class="read-more"><a href="events-calender.html"><i class="icofont-arrow-right"></i> Read More</a></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4">
            <div class="card" style='background-image: url("assets/img/more-services-4.jpg");' data-aos="fade-up" data-aos-delay="200">
              <div class="card-body">
                <h5 class="card-title"><a href="">Organic Market Expo</a></h5>
                <p class="card-text">Nostrum eum sed et autem dolorum perspiciatis. Magni porro quisquam laudantium voluptatem.</p>
                <div class="read-more"><a href="events-calender.html"><i class="icofont-arrow-right"></i> Read More</a></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End More Event Section -->

   <!-- ======= Destination and Establishments ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Where to go!</h2>
          <p>Find tourist distanations and establishments you prefer!</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-dist">Destination</li>
              <li data-filter=".filter-est">Establishments</li>
            </ul>
            <!-- Search form -->
            <form class="form-inline">
              <i class="fas fa-search" aria-hidden="true"></i>
              <input class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search"
                aria-label="Search">
            </form>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">

          <div class="col-lg-4 col-md-6 portfolio-item filter-dist">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/strawberry.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Strawberry Farm</h4>
                <p>Pick what you want, fresh from the soil.</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/strawberry.jpg" data-gall="portfolioGallery" class="venobox" title="dist 1"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details">More Details<i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-est">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>jfskljdflks 3</h4>
                <p>sdfsgs</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-2.jpg" data-gall="portfolioGallery" class="venobox" title="sdfgsfds 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details">More Details<i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-dist">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>dist 2</h4>
                <p>dist</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-3.jpg" data-gall="portfolioGallery" class="venobox" title="dist 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-est">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>est 2</h4>
                <p>est</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-4.jpg" data-gall="portfolioGallery" class="venobox" title="est 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details">More Details<i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-est">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>est 4</h4>
                <p>est</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-5.jpg" data-gall="portfolioGallery" class="venobox" title="est 4"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details">More Details<i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-dist">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>dist 3</h4>
                <p>dist</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-6.jpg" data-gall="portfolioGallery" class="venobox" title="dist 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details">More Details<i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-est">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/gladiola inn.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Galdiola In</h4>
                <p>A place for the dark night!</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/gladiola inn.jpg" data-gall="portfolioGallery" class="venobox" title="Gladiola inn"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details">More Details<i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-est">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>est 3</h4>
                <p>est</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-8.jpg" data-gall="portfolioGallery" class="venobox" title="est 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details">More Details<i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-dist">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>dist 4</h4>
                <p>dist</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-9.jpg" data-gall="portfolioGallery" class="venobox" title="dist 4"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details">More Details<i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->



    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
              <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->
</main>


@endsection