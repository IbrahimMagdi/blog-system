{{ view('front.layouts.header', ['title'=>trans('main.home')]) }}
<?php $latest = db_first('news', 'order by id desc'); ?>
<div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
  <div class="col-lg-6 px-0">
    <h1 class="display-4 fst-italic">{{$latest['title']}}</h1>
    <p class="lead my-3">{{$latest['description']}}</p>
    <p class="lead mb-0">
      <a href="{{ url('news?category_id='.$latest['category_id'].'&id='.$latest['id']) }}"
        class="text-body-emphasis fw-bold d-inline-flex align-items-center">
        {{ trans('main.readmore') }}

      </a>
    </p>
  </div>
</div>


<div class="row g-5">
  <div class="col-md-8">

  <?php
  $categories = db_get(
    'categories c',
    'JOIN news n ON n.category_id = c.id 
     GROUP BY c.id 
     ORDER BY c.id DESC 
     LIMIT 5',
    'c.id, c.name'
  );
  ?>

  <?php while ($cat = mysqli_fetch_assoc($categories['query'])): ?>

    <?php
    $news = db_get(
      'news',
      'WHERE category_id=' . $cat['id'] . ' 
       ORDER BY created_at DESC 
       LIMIT 3'
    );

    $first_news = mysqli_fetch_assoc($news['query']);
    if (!$first_news) continue;

    $img = !empty($first_news['image'])
      ? url('storage/' . $first_news['image'])
      : url('assets/images/icon.png');
    ?>

    <div class="mb-5">

      <h3 class="border-bottom pb-2 fw-bold">
        {{ $cat['name'] }}
      </h3>

      <div class="row g-3 mb-3 align-items-center">

        <div class="col-md-4">
          <img src="{{ $img }}"
               class="img-fluid rounded"
               style="height:160px; object-fit:cover;"
               alt="{{ $first_news['title'] }}">
        </div>

        <div class="col-md-8">
          <h5 class="mb-2 fw-semibold">
            <a class="text-decoration-none"
               href="{{ url('news?category_id='.$cat['id'].'&id='.$first_news['id']) }}">
              {{ $first_news['title'] }}
            </a>
          </h5>

          <small class="text-muted">
            {{ time_ago($first_news['created_at']) }}
          </small>
        </div>

      </div>

      <?php while ($n = mysqli_fetch_assoc($news['query'])): ?>
        <div class="ps-3 border-start mb-2">
          <a class="text-decoration-none d-block"
             href="{{ url('news?category_id='.$cat['id'].'&id='.$n['id']) }}">
            • {{ $n['title'] }}
          </a>
        </div>
      <?php endwhile; ?>

      <a href="{{ url('category?category_id='.$cat['id']) }}"
         class="fw-semibold text-primary">
        {{ trans('main.readmore') }} →
      </a>

    </div>

  <?php endwhile; ?>

</div>


  <div class="col-md-4">
    <div class="position-sticky" style="top: 2rem">
      <div class="p-4 mb-3 bg-body-tertiary rounded">
        <h4 class="fst-italic">{{ trans('main.about') }}</h4>
        <p class="mb-0">{{trans('main.about_description')}}</p>
      </div>
      <?php $latest_news = db_get('news', 'ORDER BY created_at DESC LIMIT 10'); ?>
      <div>
        <h4 class="fst-italic">{{ trans('main.latest_news') }}</h4>
        <ul class="list-unstyled">
          <?php while ($news = mysqli_fetch_assoc($latest_news['query'])): ?>
            <li>
              <a
                class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top"
                href="{{ url('news?category_id='.$news['category_id'].'&id='.$news['id']) }}">
                <?php
                if (!empty($news['image'])) {
                  $img = url('storage/' . $news['image']);
                } else {
                  $img = url('assets/images/icon.png');
                }
                ?>
                <div style="width: 100px; height: 96px; flex-shrink: 0;">
                  <img src="{{ $img }}"
                    class="bd-placeholder-img"
                    style="width: 100%; height: 100%; object-fit: cover;"
                    alt="{{ $news['title'] }}">
                </div>
                <div class="col-lg-8">
                  <h6 class="mb-0">{{ $news['title'] }}</h6>
                  <small class="text-body-secondary">{{ date('y-m-d', strtotime($news['created_at'])) }}</small>
                </div>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
      <?php $years = db_get('news', 'GROUP BY YEAR(created_at)'); ?>
      <div class="p-4">
        <h4 class="fst-italic">{{trans('main.archives')}}</h4>
        <ol class="list-unstyled mb-0">
          <?php while ($year = mysqli_fetch_assoc($years['query'])):
            $news_year = date('Y', strtotime($year['created_at']));
          ?>
            <li><a href="{{ url('news/archive?year='.$news_year) }}">{{$news_year}}</a></li>
          <?php endwhile; ?>

        </ol>
      </div>
      <div class="p-4">
        <h4 class="fst-italic">{{ trans('main.elsewhere') }}</h4>
        <ol class="list-unstyled d-flex gap-1">
          <li>
            <a href="https://github.com/IbrahimMagdi" target="_blank" rel="noopener">
              <i class="fa-brands fa-github fa-xl"></i>
            </a>
          </li>
          <li>
            <a href="https://www.linkedin.com/in/ibrahim-magdi/" target="_blank" rel="noopener">
              <i class="fa-brands fa-linkedin fa-xl"></i>
            </a>
          </li>
          <li>
            <a href="https://www.facebook.com/ibrahim.magdy.370177" target="_blank" rel="noopener">
              <i class="fa-brands fa-facebook fa-xl"></i>
            </a>
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
{{ view('front.layouts.footer') }}