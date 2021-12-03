@extends('layouts.front')
@section('container')
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css')}}">
<style>
@media screen and (max-width: 455px) {
    .intro-image {
      display: none;
  }
    .kontak {
      text-align: center;
    }

    .kontak p {
      font-size: 12px;
      padding-top: 20px;
      padding-bottom: 15px;
    }

    .wave {
      height: 50% !important;
    }

    .slick-slide img {
      width: 50% !important;
      margin: 0 auto;
    }

    .bottom-line{
        width: 70% !important;
    }

    .layanan-h1 {
      width: 50% !important;
    }
    .procedure {
      border-radius: 0 !important;
    }

    #harga-mobile {
      display: block !important;
    }

    .button-mobile {
      display: block !important;
      margin: 0 auto !important;
      background-color: #a2dc4d;
      margin-bottom: 100px !important; 
    }
}

#harga-mobile {
    display: none;
}

.procedure {
  background-color: #232525;
}

.card {
  border: none !important;
}

.kontak {
  background-color: #232525;
}

.procedure-image {
  border-radius: 50%;
}


    .slider {
        width: 70%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 10%;
      margin: 0 auto;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    
    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }

    .title {
    color: #1a1a1a;
    text-align: center;
    margin-bottom: 10px
}

.content {
    position: relative;
    width: 90%;
    max-width: 320px;
    margin: auto;
    overflow: hidden
}

.content .content-overlay {
    background: rgba(0, 0, 0, 0.7);
    position: absolute;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    opacity: 0;
    -webkit-transition: all 0.4s ease-in-out 0s;
    -moz-transition: all 0.4s ease-in-out 0s;
    transition: all 0.4s ease-in-out 0s
   
}

.content:hover .content-overlay {
    opacity: 1
}

.content-image {
    width: 100%
}

img {
    
}

.content-details {
    position: absolute;
    text-align: center;
    padding-left: 2em;
    padding-right: 2em;
    width: 100%;
    top: 50%;
    left: 50%;
    opacity: 0;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    -webkit-transition: all 0.3s ease-in-out 0s;
    -moz-transition: all 0.3s ease-in-out 0s;
    transition: all 0.3s ease-in-out 0s
    
}

.content:hover .content-details {
    top: 50%;
    left: 50%;
    opacity: 1
}

.content-details h4 {
    color: #fff;
    font-weight: 500;
    letter-spacing: 0.15em;
    margin-bottom: 0.5em;
    text-transform: uppercase
}

.content-details p {
    color: #fff;
    font-size: 0.8em
}

.fadeIn-bottom {
    top: 100%
}

.content-img {
  display: flex;
  margin: 0 auto !important;
}
.button-mobile {
  display: none;
}

</style>
  <section class="upper">
    <div class="container">
      <br><br><br><br>
       <div class="row justify-content-between">
         <div class="col-md-6">
              <h3 class="text-white">Layanan Jasa Nugas Profesional</h3>
              <p class="text-muted" >Kami melayani Pengerjaan Tugas, Skripsi, Jurnal, Makalah dan lain lain. Dengan dikerjakan oleh Tim Kami yang sudah bersetifikasi Profesional</p>
              <a href="#1-jasa" class="btn btn-sm" style="background-color: #a2dc4d;">Layanan</a>
          </div>
         <div class="col-md-6">
           <div class="d-flex justify-content-end">
              <img src="{{ asset('image.svg') }}" class="intro-image" style="width:400px;" alt="image-one">
           </div>
          </div>
        </div>     
    </div>
  </section>
  <div style="height: 150px; overflow: hidden;">
    <svg viewBox="0 0 500 150" preserveAspectRatio="none" class="wave" style="height: 70%; width: 100%;">
      <path d="M0.00,92.27 C216.83,192.92 304.30,8.39 500.00,109.03 L500.00,0.00 L0.00,0.00 Z" style="stroke: none;fill: #232525;"></path>
    </svg>
  </div>

  <section>
    
  </section>
  <section class="section" id="1-jasa">
    <br><br><br>

    <div class="container">
      <h2 class="heading bottom-line text-center pt-3" style="border-bottom:3px solid #232525; width: 18%; margin:auto; padding: 10px;">Layanan</h2>
      <div class="container">
        <h6 class="text-center mt-5">Dengan dikerjakan oleh Kami yang sudah bersertifikasi Profesional</h6>
        <h6 class="text-center">tentunya Tugas anda akan segera selesai dengan Cepat dan Tepat.</h6>
        <br><br>
      <div class="row">
          <div class="col-md-4">
            <h5 class="text-center">Skripsi</h5>
              <div class="content" style="margin-top: 40px;"> <a href="https://wa.me/6282120659532?text=hallo%20saya%20ingin%20bertanya%20soal%20jasa%20pembuatan%20skripsi">
                      <div class="content-overlay"></div> <img src="{{ asset('thesis_journal.svg') }}" class="content-img"  width="71%" height="300px">
                      <div class="content-details fadeIn-bottom">
                          <h4 class="content-text">Harga RP 100.000</h4>
                      </div>
                  </a> 
              </div>
              <p class="text-center" id="harga-mobile">Harga Rp. 100.000</p>
              <button class="btn btn-sm button-mobile">Pesan</button>
          </div>
          <div class="col-md-4">
            <h5 class="text-center">Matematika</h5>
            <div class="content" style="margin-top: 40px;"> <a href="https://wa.me/6282120659532?text=hallo%20saya%20ingin%20bertanya%20soal%20jasa%20tugas%20matematika">
                      <div class="content-overlay"></div> <img  src="{{ asset('math.svg') }}" class="content-img"  width="58%" height="300px">
                      <div class="content-details fadeIn-bottom">
                        <h4 class="content-text">Harga RP 200.000</h4>
                      </div>
                  </a> 
                </div>
                <p class="text-center" id="harga-mobile">Harga Rp. 100.000</p>
                <button class="btn btn-sm button-mobile">Pesan</button>
          </div>
          <div class="col-md-4">
            <h5 class="text-center">Makalah</h5>
            <div class="content" style="margin-top: 40px;"> <a href="https://wa.me/6282120659532?text=hallo%20saya%20ingin%20bertanya%20soal%20jasa%20pembuatan%20makalah">
                      <div class="content-overlay"></div> <img  src="{{ asset('makalah.svg') }}" class="content-img" class="ml-5" width="70%" height="300px">
                      <div class="content-details fadeIn-bottom">
                        <h4 class="content-text">Harga RP 300.000</h4>

                      </div>
                  </a> 
                </div>
                <p class="text-center" id="harga-mobile">Harga Rp. 100.000</p>
                <button class="btn btn-sm button-mobile">Pesan</button>
          </div>
      </div>
  </div>
      <br><br><br><br><br><br> 
    </div>
  </section>
  <section>
    <div class="container procedure" style="border-radius: 10px;">
        <h2 class="heading text-center text-white pt-5">begini cara kita membantu Anda.</h2>
        <div class="row text-center p-5">
          <div class="col-sm-3">
            <img src="{{ asset('konsultasi.svg') }}" class="img-fluid py-5 mx-auto" style="width: 50%;" alt="image-one">
            <p class="text-white">Konsultasi</p>
            <span class="text-muted text-left" style="font-size: 12px;">Konsultasi dengan Kami terlebih dahulu mengenai Tugas yang akan dikerjakan. Silahkan Hubungi Kami : <br><i class="fas fa-phone me-3"></i>0813-5609-8889</span>
          </div>
          <div class="col-sm-3">
            <img src="{{ asset('pembayaran.svg') }}" class="img-fluid py-5" style="width: 65%;" alt="image-one">
            <p class="text-white">Pembayaran</p>
            <span class="text-muted text-left" style="font-size: 12px;">Untuk Pembayaran bisa melalui Rekening Bank berikut : <br><i class="bi bi-credit-card-fill me-2"></i>1139-7543-9 (BJB) <br><i class="bi bi-credit-card-fill me-2"></i>3567-8091-11 (BRI) <br>Setelah selesai melakukan Pembayaran, harap kirimkan Bukti Pembayaran kepada Kami </span>
          </div>
          <div class="col-sm-3">
            <img src="{{ asset('pengerjaan.svg') }}" class="img-fluid py-5" style="width: 55%;" alt="image-one">
            <p class="text-white">Pengerjaan</p>
            <span class="text-muted text-left" style="font-size: 12px;">Untuk Pengerjaan akan kami Kerjakan dengan cepat dan tepat. Jadi mohon ditunggu konfirmasi lebih lanjut dari Kami.</span>
          </div>
          <div class="col-sm-3">
            <img src="{{ asset('penyerahan.svg') }}" class="img-fluid py-5" style="width: 50%;" alt="image-one">
            <p class="text-white">Penyerahan</p>
            <span class="text-muted text-left" style="font-size: 12px;">Untuk Penyerahan file yang telah selesai kami kerjakan, akan Kami kirim dalam bentuk file yang Client minta. Dan untuk Penyerahan file tersebut akan Kami kirim melalui E-Mail atau WhatsApp</span>
          </div>
        </div>
    </div>
  </section>

  <br><br>

  <br>
  
  <br>

  <div class="container">
    <h2 class="heading bottom-line text-center pt-3" style="border-bottom:3px solid #232525; width: 20%; margin:auto; padding: 10px;">Testimonial</h2>
  </div>
  
  <section class="regular slider text-center">
    <div>
      <img src="{{ asset('ikbal.jpg') }}"  class="procedure-image">
      <p class="mt-5">"Best. Product. Ever! Thank You!"</p>
      <span class="fw-bold">Ikbal</span>
    </div>
    <div>
      <img src="{{ asset('ridwan.jpg') }}" class="procedure-image">
      <p class="mt-5">"It's exactly what I've been looking for. I am so pleased with this product."
      </p>
      <span class="fw-bold">Ridwan</span>
    </div>
    <div>
      <img src="{{ asset('rizal.jpg') }}" class="procedure-image">
      <p class="mt-5">"It's just amazing. I am completely blown away."
      </p>
      <span class="fw-bold">Rizal</span>
    </div>
    <div>
      <img src="{{ asset('indra.jpg') }}" class="procedure-image">
      <p class="mt-5">""Definitely worth the investment."
      </p>
      <span class="fw-bold">Indra</span>
    </div>
  </section>

  <section class="kontak section" id="2-kontak" style="padding: 50px;">
    <div class="container">
      <h2 class="heading bottom-line kontak-bottom-line text-center pt-3" style="border-bottom:3px solid #fff; width: 20%; margin:auto; padding: 10px; color: #fff;">Kontak</h2>
      <br><br>
       <h3 class="text-white"  style="">Perlu konsultasi masalah Tugas?</h3>
       <p class="text-muted ">Kami menerima konsultasi gratis untuk pelanggan pertama kami, silahkan hubungi kami online 24 Jam!</p>
       <a href="https://wa.me/6282120659532" class="btn btn-sm" style="background-color: #a2dc4d;">Ada yang bisa kami bantu?</a> 
    </div>
  </section>

  <section class="section" id="3-tim">
    <br><br><br><br><br>
    <div class="container text-center">
      <h2 class="heading bottom-line text-center pt-3" style="border-bottom:3px solid #232525; width: 20%; margin:auto; padding: 10px;">Tim Kita</h2>
      <br><br><br>
      <div class="row">
        <div class="col-sm-3">
          <div class="card">
            <div class="card-body">
              <img src="{{ asset('ikbal.jpg') }}" class="img-fluid rounded mb-4" alt="image-one">
              <h2 style="font-size: 18px; ">Ikbal Malik Ramadhan</h2>
              <span style="color: #232525; font-size: 12px;">BACKEND</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <div class="card-body">
              <img src="{{ asset('rizal.jpg') }}" class="img-fluid rounded mb-4" alt="image-one">
              <h2 style="font-size: 18px;">Rizal Jalaludin</h2>
              <span style="color: #232525; font-size: 12px;">FRONTEND</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <div class="card-body">
              <img src="{{ asset('ridwan.jpg') }}" class="img-fluid rounded mb-4" alt="image-one">
              <h2 style="font-size: 18px;">Ridwan Permana</h2>
              <span style="color: #232525; font-size: 12px;">FRONTEND</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card">
            <div class="card-body">
              <img src="{{ asset('indra.jpg') }}" class="img-fluid rounded mb-4" alt="image-one">
              <h2 style="font-size: 18px;">Indra Yuda</h2>
              <span style="color: #232525; font-size: 12px;">UI/UX</span>
            </div>
          </div>
        </div>
      </div>
      <br><br><br><br>
    </div>
  </section>
  
@endsection