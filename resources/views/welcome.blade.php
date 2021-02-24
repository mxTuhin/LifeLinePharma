@extends('layouts.LandingLayout')
@section('title')
    Life Line Pharma
@endsection

@section('main_section')
    <section class="hero">
        <div class="container">
            <div class="hero-inner">
                <div class="hero-copy">
                    <h1 class="hero-title mt-0">Life Line Pharma</h1>
                    <p class="hero-paragraph">Even if Life Line Pharma Started its journey a bit late but we promise you to give the best service in the area. Thanks for being a support !</p>
                    <div class="hero-cta">

                            <a class="button button-primary" href="{{ route('login') }}">Admin Login</a>
                            <a class="button" href="#">Get in touch</a></div>



                </div>
                <div class="hero-figure anime-element">
                    <img src="ldp/src/images/background.png">

                </div>
            </div>
        </div>
    </section>

    <section class="features section">
        <div class="container">
            <div class="features-inner section-inner has-bottom-divider">
                <div class="features-wrap">
                    <div class="feature text-center is-revealing">
                        <div class="feature-inner">
                            <div class="feature-icon">
                                <img src="ldp/dist/images/feature-icon-01.svg" alt="Feature 01">
                            </div>
                            <h4 class="feature-title mt-24">Availability</h4>
                            <p class="text-sm mb-0">Meow Meow</p>
                        </div>
                    </div>
                    <div class="feature text-center is-revealing">
                        <div class="feature-inner">
                            <div class="feature-icon">
                                <img src="ldp/dist/images/feature-icon-02.svg" alt="Feature 02">
                            </div>
                            <h4 class="feature-title mt-24">Fast</h4>
                            <p class="text-sm mb-0">Meow Meow</p>
                        </div>
                    </div>
                    <div class="feature text-center is-revealing">
                        <div class="feature-inner">
                            <div class="feature-icon">
                                <img src="ldp/dist/images/feature-icon-03.svg" alt="Feature 03">
                            </div>
                            <h4 class="feature-title mt-24">Reliable</h4>
                            <p class="text-sm mb-0">Meow Meow.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


@endsection
