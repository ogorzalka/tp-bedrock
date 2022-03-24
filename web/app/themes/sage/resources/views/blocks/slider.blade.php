@if (count($slides) > 0)
  <!-- Slider main container -->
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      @foreach($slides as $slide)
        <!-- Slides -->
        <div class="swiper-slide">
          {!! $slide->image !!}
          <div class="slide-content">
            <h2>{{ $slide->title }}</h2>
            <p>{!! $slide->description !!}</p>
            <a href="{{ $slide->permalink }}" class="btn btn-primary">Voir plus</a>
          </div>
        </div>
      @endforeach
    </div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
@endif

<style>
  .swiper {
    width: 600px;
  }
</style>
