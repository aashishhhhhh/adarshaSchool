@include('frontend.layout.header')
    <!-- Navigation -->
   @include('frontend.layout.navigation')
    <main class="container">
      <div class="main-body">
        <!-- Home section start -->
        <section id="home">
          <div class="container">
            <div class="row">
              <div class="col-md-8">
                <div class="left-box">
                  <!-- slider  -->
                  <div id="banner">
                    <div class="owl-carousel banner owl-theme">
                      <div
                        class="item"
                        style="
                          background-image: linear-gradient(
                              to right,
                              rgb(23 61 98 /0%),
                              rgb(23 61 98 / 0%)
                            ),
                            url('assets/images/banner001.jpg');
                        "
                      ></div>
                      <div
                        class="item"
                        style="
                          background-image: linear-gradient(
                              to right,
                              rgb(23 61 98 /0%),
                              rgb(23 61 98 / 0%)
                            ),
                            url('assets/images/banner002.jpg');
                        "
                      ></div>
                    </div>
                  </div>
                </div>
              </div>

              @foreach ($pages as $item)
              @foreach ($item->pages as $item)
              @if ($item->page_type_id==1)
              @php
                    $content = json_decode($item->content,true);
              @endphp
              <div class="col-md-4">
                <div class="right-box">
                  <div class="message_from">
                    <h1>Mesage from Principal</h1>
                    <div class="message_body">
                      <div class="image-outer">
                        <div class="image">
                         
                         @foreach ($item->pictures as $value)
                          <img src="{{ asset('storage/upload/' .$value->url)}}" alt=""
                           class="px-1" width="100">
                        @endforeach
                        </div>
                      </div>
                      <p class="limit-200">
                        {{isset($content['name']) ? $content['name'] : ''}}
                      </p>
                      @php
                      @endphp
                      <a href="">Read More..</a>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              @endforeach
              @endforeach

            </div>
          </div>
        </section>
        <!-- end home section -->
        <!-- section two -->
        <section id="section1">
          <div class="container">
            <div class="row">
              <!-- left box -->
              <div class="col-md-8">
                <div class="left-box">
                  <!-- <div class="exam-content">
                    <div class="exam__title">
                      <h3>सूचना :-</h3>
                    </div>
                    <div class="exam__description example1">
                      <ul>
                        <li>
                          <a href="#"
                            >Lorem ipsum, dolor sit amet consectetur adipisicing
                            elit. Totam, fugiat.</a
                          >
                        </li>
                        <li>
                          <a href="#"
                            >Lorem ipsum, dolor sit amet consectetur adipisicing
                            elit. Totam, fugiat.</a
                          >
                        </li>
                      </ul>
                    </div>
                  </div> -->
                  <div class="notice">
                    <h1>Notice Board</h1>
                    <!-- .itme -->
                    @foreach ($pages as $item)
                    @foreach ($item->pages as $item)
                    @if ($item->page_type_id==5)
                    @if ($item->Parents!=null)
                        
                    @foreach ($item->Parents as $item)
                    @php
                        $content = json_decode($item->content,true);
                    @endphp
                    <div class="notice_item">
                      <div class="info">
                        <h4>
                          <a href="{{route('general.notice',$item->slug)}}">
                        {{isset($item->title) ? $item->title : ''}}
                           </a
                          >
                        </h4>
                        <p>
                          <i class="fa-solid fa-clock"></i>
                        {{isset($content['date']) ? $content['date'] : ''}}
                        <span>  </span>
                        </p>
                      </div>
                      <div class="img_box">
                        <span> <i class="fa-solid fa-angle-right"></i> </span>
                      </div>
                    </div>
                    @endforeach
                    @endif
                    @endif
                    @endforeach
                    @endforeach
                    <!-- .itme -->
                    <div class="notice_item">
                      <div class="info">
                        <h4>
                          <a href="general.html">
                            लुम्बिनी प्रदेश: वैकल्पिक उम्मेदवारलाई आवेदनको लागि
                            सूचना - २०७८/१२/१०</a
                          >
                        </h4>
                        <p>
                          <i class="fa-solid fa-clock"></i>
                          <span> Dec 15, 2022 </span>
                        </p>
                      </div>
                      <div class="img_box">
                        <span> <i class="fa-solid fa-angle-right"></i> </span>
                      </div>
                    </div>
                    <!-- .itme -->
                    <div class="notice_item">
                      <div class="info">
                        <h4>
                          <a href="general.html">
                            लुम्बिनी प्रदेश: वैकल्पिक उम्मेदवारलाई आवेदनको लागि
                            सूचना - २०७८/१२/१०</a
                          >
                        </h4>
                        <p>
                          <i class="fa-solid fa-clock"></i>
                          <span> Dec 15, 2022 </span>
                        </p>
                      </div>
                      <div class="img_box">
                        <span> <i class="fa-solid fa-angle-right"></i> </span>
                      </div>
                    </div>
                    <!-- .itme -->
                    <div class="notice_item">
                      <div class="info">
                        <h4>
                          <a href="general.html">
                            लुम्बिनी प्रदेश: वैकल्पिक उम्मेदवारलाई आवेदनको लागि
                            सूचना - २०७८/१२/१०</a
                          >
                        </h4>
                        <p>
                          <i class="fa-solid fa-clock"></i>
                          <span> Dec 15, 2022 </span>
                        </p>
                      </div>
                      <div class="img_box">
                        <span> <i class="fa-solid fa-angle-right"></i> </span>
                      </div>
                    </div>
                    <!-- .itme -->
                    <div class="notice_item">
                      <div class="info">
                        <h4>
                          <a href="general.html">
                            लुम्बिनी प्रदेश: वैकल्पिक उम्मेदवारलाई आवेदनको लागि
                            सूचना - २०७८/१२/१०</a
                          >
                        </h4>
                        <p>
                          <i class="fa-solid fa-clock"></i>
                          <span> Dec 15, 2022 </span>
                        </p>
                      </div>
                      <div class="img_box">
                        <span> <i class="fa-solid fa-angle-right"></i> </span>
                      </div>
                    </div>
                    <!-- .itme -->
                    <div class="notice_item">
                      <div class="info">
                        <h4>
                          <a href="general.html">
                            लुम्बिनी प्रदेश: वैकल्पिक उम्मेदवारलाई आवेदनको लागि
                            सूचना - २०७८/१२/१०</a
                          >
                        </h4>
                        <p>
                          <i class="fa-solid fa-clock"></i>
                          <span> Dec 15, 2022 </span>
                        </p>
                      </div>
                      <div class="img_box">
                        <span> <i class="fa-solid fa-angle-right"></i> </span>
                      </div>
                    </div>
                    <!-- .itme -->
                    <div class="notice_item">
                      <div class="info">
                        <h4>
                          <a href="#">
                            लुम्बिनी प्रदेश: वैकल्पिक उम्मेदवारलाई आवेदनको लागि
                            सूचना - २०७८/१२/१०</a
                          >
                        </h4>
                        <p>
                          <i class="fa-solid fa-clock"></i>
                          <span> Dec 15, 2022 </span>
                        </p>
                      </div>
                      <div class="img_box">
                        <span> <i class="fa-solid fa-angle-right"></i> </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="right-box">
                  <div class="facebook-page">
                    <!-- <h4> Facebook Page</h4> -->
                    <div
                      class="fb-page"
                      data-href="https://www.facebook.com/Adarsha-Secondary-School-Biratnagar-7-Admin-104689884201666/"
                      data-tabs=""
                      data-width=""
                      data-height="200"
                      data-small-header="false"
                      data-adapt-container-width="true"
                      data-hide-cover="false"
                      data-show-facepile="false"
                    >
                      <blockquote
                        cite="https://www.facebook.com/Adarsha-Secondary-School-Biratnagar-7-Admin-104689884201666/"
                        class="fb-xfbml-parse-ignore"
                      >
                        <a
                          href="https://www.facebook.com/Adarsha-Secondary-School-Biratnagar-7-Admin-104689884201666/"
                          >Adarsha Secondary School Biratnagar-7 Admin</a
                        >
                      </blockquote>
                    </div>
                  </div>
                  <div class="photo-gallery">
                    <h4>Photo Gallery</h4>
                    <!-- <div class="gallery"> -->
                    <div class="owl-carousel gallery owl-theme">
                      <div class="item">

                        <a class="gimg" href="{{ asset('assets/images/banner001.jpg') }}"
                          ><img
                            src="assets/images/banner001.jpg"
                            alt="Gallery Image"
                        /></a>
                      </div>

                      <div class="item">
                        <a class="gimg" href="{{ asset('assets/images/banner002.jpg') }}"
                          ><img
                            src="assets/images/banner002.jpg"
                            alt="Gallery Image"
                        /></a>
                      </div>
                    </div>
                    <!-- </div> -->
                  </div>
                  <div class="video-gallery">
                    <h4>Video Gallery</h4>
                    <iframe
                      width="100%"
                      height="200"
                      src="https://www.youtube.com/embed/lZ3p8qYvZws"
                    >
                    </iframe>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
    <!-- Footer Section  -->
    @include('frontend.layout.footer')
   
