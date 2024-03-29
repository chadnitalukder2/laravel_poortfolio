@extends('frontend.main_master')
@section('main')
@section('title')
    Service | Website
@endsection
@php
$allMultiImage = App\Models\MultiImage::all();
@endphp

<main>

    <!-- breadcrumb-area -->
    <section class="breadcrumb__wrap">
        <div class="container custom-container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="breadcrumb__wrap__content">
                        <h2 class="title">Services Details</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="breadcrumb__wrap__icon">
            <ul>
                @foreach($allMultiImage as $item)
                <li>
                 <img class="light" src="{{ asset($item->multi_image ) }}" style="width: 80px; height: 80px;" alt="XD"> 
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <!-- breadcrumb-area-end -->

    <!-- services-details-area -->
    <section class="services__details">
        <div class="container">
            <div class="row">
              
                <div class="col-lg-8">
                    @foreach ($service  as $item )

                    <div class="services__details__thumb">
                        <img src="{{   url(  $item->service_image) }}"   alt="">
                    </div>
                    <div class="services__details__content">
                        <h2 class="title">{{ $item->service_title }}</h2>
                        <p>{!! $item->service_description !!}</p><br><br>
                    </div>
                    
                @endforeach
                </div>

                
                <div class="col-lg-4">
                    <aside class="services__sidebar">
                        <div class="widget">
                            <h5 class="title">Get in Touch</h5>
                            <form action="#" class="sidebar__contact">
                                <input type="text" placeholder="Enter name*">
                                <input type="email" placeholder="Enter your mail*">
                                <textarea name="message" id="message" placeholder="Massage*"></textarea>
                                <button type="submit" class="btn">send massage</button>
                            </form>
                        </div>
                        <div class="widget">
                            <h5 class="title">Contact Information</h5>
                            <ul class="sidebar__contact__info">
                                <li><span>Address :</span> 8638 Amarica Stranfod, <br> Mailbon Star</li>
                                <li><span>Mail :</span> yourmail@gmail.com</li>
                                <li><span>Phone :</span> +7464 0187 3535 645</li>
                                <li><span>Fax id :</span> +9 659459 49594</li>
                            </ul>
                            <ul class="sidebar__contact__social">
                                <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fab fa-behance"></i></a></li>
                                <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- services-details-area-end -->


    <!-- contact-area -->
    <section class="homeContact homeContact__style__two">
        <div class="container">
            <div class="homeContact__wrap">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="section__title">
                            <span class="sub-title">07 - Say hello</span>
                            <h2 class="title">Any questions? Feel free <br> to contact</h2>
                        </div>
                        <div class="homeContact__content">
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form</p>
                            <h2 class="mail"><a href="mailto:Info@webmail.com">Info@webmail.com</a></h2>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="homeContact__form">
                            <form method="post" action="{{ route('store.message') }}" class="contact__form">
                                 @csrf
                                <input type="text" name="name" placeholder="Enter name*">
                                <input type="email" name="email" placeholder="Enter mail*">
                                <input type="number" name="phone" placeholder="Enter number*">
                                <textarea  name="message" placeholder="Enter Massage*"></textarea>
                                <button type="submit">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-area-end -->

</main>


@endsection