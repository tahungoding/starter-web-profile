<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('logo/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('logo/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('logo/site.webmanifest')}}">

    <title>JOKIIN AJA</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .nav-link:hover{
            color: #a2dc4d !important;
        }

        .img-tim{
            border-radius: 10px;
            width: 200px;
        }

        .brand {
            font-size: 24px;
            font-weight: 700;
        }

      .upper {
          background-color: #232525;
      }
  
      .active {
          color: #a2dc4d !important;
      }
  
      .small {
        font-weight: 100;
        color: gray !important;
      }

      footer {
        background-color: #232525 !important;
      }    
   
      .fixed-top {
          top: -40px;
          transform: translateY(40px);
          transition: transform .3s;
      }

    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark" id="navbar_top" style="background-color: #232525;">
      <div class="container">
          <a class="navbar-brand" href="{{ route('beranda.index') }}" style="color: #a2dc4d;"><img src="{{ asset('logo.png') }}" style="width: 70px;"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              </ul>
              <div class="navbar-nav mb-2 mb-lg-0">
                  <li class="nav-item">
                      <a class="nav-link nav-button active" aria-current="page"
                          href="{{ route('beranda.index') }}">Beranda</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link nav-button nav_1-jasa" href="#1-jasa">Jasa</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link nav-button nav_2-kontak" href="#2-kontak">Kontak</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link nav-button nav_3-tim" href="#3-tim">Tim</a>
                  </li>
              </div>
          </div>
      </div>
  </nav>
    <!-- Optional JavaScript; choose one of the two! -->
    @yield('container')
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white">
      <!-- Section: Social media -->
      <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
          <!-- Left -->
          <div class="me-5 d-none d-lg-block">
              <span>Terhubung dengan kami di jejaring sosial :</span>
          </div>
          <!-- Left -->

          <!-- Right -->
          <div>
              <a href="" class="me-4 text-reset">
                  <i class="fab fa-facebook-f"></i>
              </a>
              <a href="" class="me-4 text-reset">
                  <i class="fab fa-twitter"></i>
              </a>
              <a href="" class="me-4 text-reset">
                  <i class="fab fa-instagram"></i>
              </a>
          </div>
          <!-- Right -->
      </section>
      <!-- Section: Social media -->

      <!-- Section: Links  -->
      <section class="">
          <div class="container text-center text-md-start mt-5">
              <!-- Grid row -->
              <div class="row mt-3">
                  <!-- Grid column -->
                  <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                      <!-- Content -->
                      <img src="{{ asset('logo.png') }}" style="width: 100px;">
                      <h6 class="text-uppercase fw-bold mb-4" style="color: #a2dc4d; margin-top: 30px;">
                          <i class="fas fa-gem me-3"></i>JOKIIN AJA
                      </h6>
                      <p>
                          Melayani Pengerjaan Tugas, Skripsi, Jurnal, Makalah dan lain lain. Dengan dikerjakan oleh Tim Kami yang sudah bersetifikasi Profesional.
                      </p>
                  </div>
                  <!-- Grid column -->

                  <!-- Grid column -->
                  <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                      <!-- Links -->
                      <h6 class="text-uppercase fw-bold mb-4" style="color: #a2dc4d;">
                          Jasa
                      </h6>
                      <p>
                          <a href="#!" class="text-reset">Jurnal Skripsi</a>
                      </p>
                      <p>
                          <a href="#!" class="text-reset">Matematika</a>
                      </p>
                      <p>
                          <a href="#!" class="text-reset">Makalah</a>
                      </p>
                  </div>
                  <!-- Grid column -->

                  <!-- Grid column -->

                  <!-- Grid column -->

                  <!-- Grid column -->
                  <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                      <!-- Links -->
                      <h6 class="text-uppercase fw-bold mb-4" style="color: #a2dc4d;">
                          Kontak
                      </h6>
                      <p><i class="fas fa-home me-3" style="color: #a2dc4d;"></i> Jl. Pangeran Santri No. 42 - Sumedang - Jawa Barat</p>
                      <p>
                          <i class="fas fa-envelope me-3" style="color: #a2dc4d;"></i>
                          jokiinaja@gmail.com
                      </p>
                      <p><i class="fas fa-phone me-3" style="color: #a2dc4d;"></i>0813-5609-8889</p>
                      <p><i class="fas fa-print me-3" style="color: #a2dc4d;"></i>0813-5609-8889</p>
                  </div>
                  <!-- Grid column -->
              </div>
              <!-- Grid row -->
          </div>
      </section>
      <!-- Section: Links  -->

      <!-- Copyright -->
      <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
          © 2021 Hak Cipta
          <a class="text-reset fw-bold" href="index.html">JOKIIN AJA</a>
      </div>
      <!-- Copyright -->
  </footer>
<!-- Footer -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="{{ asset('slick/slick.js')}}" type="text/javascript" charset="utf-8"></script>
    <script>
      
$('.regular').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
});
	
    </script>
    <script type="text/javascript">
      document.addEventListener("DOMContentLoaded", function(){
        
        window.addEventListener('scroll', function() {
             
          if (window.scrollY > 200) {
            document.getElementById('navbar_top').classList.add('fixed-top');
            // add padding top to show content behind navbar
            navbar_height = document.querySelector('.navbar').offsetHeight;
            document.body.style.paddingTop = navbar_height + 'px';
          } else {
             document.getElementById('navbar_top').classList.remove('fixed-top');
             // remove padding top from body
            document.body.style.paddingTop = '0';
          } 
        });
      }); 
      // DOMContentLoaded  end
    </script>

    <script>
      // $(function(){
      //   var sections = {},
      //   _height  = $(window).height(),
      //   i        = 0;
    
      //   //// Grab positions of our sections
      //   $('.section').each(function(){
      //       sections[this.id] = $(this).offset().top;
      //   });

      //   $(document).scroll(function(){
      //       var $this = $(this),
      //           pos   = $this.scrollTop();
                
      //       for(i in sections){
      //           if(sections[i] > pos && sections[i] < pos + _height){
      //             console.log(i);
      //               $('a').removeClass('active');
      //               $('.nav_' + i).addClass('active');
      //           }  
      //       }
      //   });
    
        $('.nav-button').click(function(){
            $('a').removeClass('active');
            $('.nav_' + $(this).attr('href').replace('#', '')).addClass('active');
        });
    // });
    </script>
  </body>
</html>