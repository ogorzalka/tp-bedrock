<div class="latest-posts">
  {!! $slot !!}
  @while($posts->have_posts()) @php($posts->the_post())
    <div class="post">
      {!! the_post_thumbnail() !!}
      <h1>{{ the_title() }}</h1>
      <p>{{ the_excerpt() }}</p>
    </div>
  @endwhile
</div>
