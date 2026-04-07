 @extends('frontend.layouts.app')

 @section('contents')
     @include('frontend.home.sections.hero-section')
     <!--End hero slider-->

     @include('frontend.home.sections.category-section')
     <!--End category slider-->

     @include('frontend.home.sections.banner-section')
     <!--End banners-->

     @include('frontend.home.sections.products-tab-section')
     <!--Products Tabs-->

     @include('frontend.home.sections.banner-section-two')
     <!--End 4 banners-->

     @include('frontend.home.sections.best-sales-section')
     <!--End Best Sales-->

     @include('frontend.home.sections.new-arrival-section')
     <!-- new arrival end -->

     @include('frontend.home.sections.cta-section')
     <!--CTA section end-->

     @include('frontend.home.sections.special-products-section')
     <!-- special products end -->

     @include('frontend.home.sections.four-cols-product-section')
     <!--End 4 columns-->
 @endsection
