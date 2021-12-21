@extends('layouts.main', ['web' => $web])
@section('title', 'Jasa')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
  integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  .dropify-wrapper {
    border: 1px solid #e2e7f1;
    border-radius: .3rem;
    height: 150px;
  }

  .card {
    border-radius: 10px;
  }

  label.error {
    color: #f1556c;
    font-size: 13px;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
    margin-top: 5px;
    padding: 0;
  }

  input.error {
    color: #f1556c;
    border: 1px solid #f1556c;
  }

  #buttonGroup {
    display: block;
  }

  @media screen and (max-width: 455px) {
    .desktop-search {
      display: none;
    }

    .mobile-search-card {
      display: block !important;
    }
  }
</style>
@endsection
@section('container')
<section class="section">
  <div class="section-header">
    <h1>Jasa</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Jasa</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between w-100">
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahJasa"><i
                  class="fas fa-plus-circle"></i></button>
              @if (count($jasa))
              <div class="d-flex justify-content-between">
                <input type="search" class="form-control desktop-search" id="jasaSearch" placeholder="Cari Produk..."
                  autocomplete="off" style="margin-right: 20px;">
                <input type="checkbox" id="checkAll" autocomplete="off" style="margin-right: 20px; display:none;">
                <button class="btn btn-sm btn-danger" id="deleteAllButton" data-toggle="modal"
                  data-target="#deleteAllConfirm" style="margin-right: 20px; display:none;"><i
                    class="fas fa-trash"></i></button>
                <button class="btn btn-sm btn-secondary" onclick="setting()"><i class="fas fa-cog"></i></button>
              </div>
              @else
              <div class="d-flex justify-content-between">
                <input type="checkbox" id="checkAllEmpty" autocomplete="off" style="margin-right: 20px; display:none;"
                  disabled>
                <button class="btn btn-sm btn-danger" id="deleteAllEmpty" style="margin-right: 20px; display:none;"
                  disabled><i class="fas fa-trash"></i></button>
                <button class="btn btn-sm btn-secondary" id="setting"><i class="fas fa-cog"></i></button>
              </div>
              @endif
            </div>
          </div>
        </div>
        @if (count($jasa))
        <div class="card mobile-search-card" style="display: none">
          <div class="card-header">
            <input type="search" class="form-control mobile-search" id="mobileJasaSearch"
              placeholder="Cari Produk..." autocomplete="off">
          </div>
        </div>
        @endif
      </div>
    </div>
    <div id="searchResult">

    </div>
    <div id="jasaData">
      @include('back.jasa.pagination')
    </div>
  </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="tambahJasa">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Jasa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('jasa.store') }}" method="post" id="tambahJasaForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="jasa_name" placeholder="Nama">
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" name="jasa_description" placeholder="Deskripsi"
              style="height: 100%;"></textarea>
          </div>
          <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" class="form-control dropify" name="jasa_image"
              data-allowed-file-extensions="png jpg jpeg" data-show-remove="false">
            <div id="errorImage">
            </div>
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="tambahButton">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

@foreach ($allJasa as $jasa)
<div class="modal fade" tabindex="-1" role="dialog" id="editJasa{{$jasa->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Jasa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('jasa.update', $jasa->id) }}" method="post" id="editJasaForm"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="checkJasaName" value="{{ $jasa->name }}">
        <div class="modal-body">
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" name="edit_jasa_name" id="editName" placeholder="Nama"
              value="{{ $jasa->name }}">
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea class="form-control" name="edit_jasa_description" placeholder="Deskripsi"
              style="height: 100%;">{{ $jasa->description }}</textarea>
          </div>
          <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" class="form-control dropify" name="edit_jasa_image"
              data-allowed-file-extensions="png jpg jpeg" data-default-file="@if(!empty($jasa->image) &&
                            Storage::exists($jasa->image)){{ Storage::url($jasa->image) }}@endif"
              data-show-remove="false">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="editJasaButton">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@foreach ($allJasa as $jasa)
<div class="modal fade" tabindex="-1" role="dialog" id="more{{$jasa->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rincian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ $jasa->name }}</p>
        @if(!empty($jasa->image) && Storage::exists($jasa->image))
        <img src="{{ Storage::url($jasa->image) }}" alt="" class="img-fluid rounded mt-1"
          style="width:100%; height:200px; object-fit:cover;">
        @endif
        <br><br>
        <p>{{ $jasa->description }}</p>
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
      </div>
    </div>
  </div>
</div>
@endforeach

<div class="modal fade" tabindex="-1" role="dialog" id="deleteConfirm">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('jasa.destroy', '') }}" method="post" id="deleteJasaForm">
        @csrf
        @method('delete')
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus</b> jasa ini ?
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="deleteModalButton">Ya, Hapus Semua</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteAllConfirm">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Semua</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin untuk <b>menghapus semua</b> jasa ?
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="button" class="btn btn-primary" id="deleteAllModalButton">Ya, Hapus Semua</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
  integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('.dropify').dropify();
</script>
<script>
  $(document).ready(function() {
  $(document).on('click', '.page-link', function(event) {
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      jasa_pagination(page);
  });

  function jasa_pagination(page)
  {
    var _token = $("input[name=_token]").val();
    $.ajax({
      url: "{{ route('jasaPagination') }}",
      method: "POST",
      data: {_token:_token, page:page},
      success: function(data) {
          $("#jasaData").html(data);
      }
    });
  }

  $("#mobileJasaSearch, #jasaSearch").keyup(function() {
    var _token = $("input[name=_token]").val();
    var originSearch = $("#jasaSearch").val();
    var mobileOriginSearch = $("#mobileJasaSearch").val();
    if(originSearch == "") {
      var search = $("#mobileJasaSearch").val();
    } else {
      var search = $("#jasaSearch").val();
    }
      $.ajax({
          url:"{{ route('jasaSearch') }}",
          method:"POST",
          data:{_token:_token, search:search},
          success:function(data) {
              if(search == "") {
                  $('#searchResult').html("");
                  $("#jasaData").css('display','block');
              } else {
                  $('#searchResult').html(data);
                  $("#jasaData").css('display','none');
              }
          }
      });
   });
});
</script>
<script>
  $(document).ready(function() {

  $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
  $("#tambahJasaForm").validate({
      rules: {
          jasa_name:{
              required: true,
              remote: {
                        url: "{{ route('checkJasaName') }}",
                        type: "post",
              }
          },
          jasa_description:{
              required: true,
          },
          jasa_image:{
              required: true,
          },
      },
      messages: {
          jasa_name: {
                required: "Nama harus di isi",
                remote: "Nama sudah tersedia"
          },
          jasa_description: {
                  required: "Deskripsi harus di isi",
          },
          jasa_image: {
                  required: "Gambar harus di isi",
          },
      },
      errorPlacement: function(error, element) {
        if(element.attr("name") == "jasa_image") {
          error.appendTo("#errorImage");
          // $(".dropify-wrapper").css('border-color', '#f1556c');
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        $("#tambahButton").prop('disabled', true);
            form.submit();
      }
  });
});

  $("#editJasaForm").validate({
      rules: {
        edit_jasa_name:{
              required: true,
              remote: {
                        param: {
                              url: "{{ route('checkJasaName') }}",
                              type: "post",
                        },
                        depends: function(element) {
                          // compare name in form to hidden field
                          return ($(element).val() !== $('#checkJasaName').val());
                        },
                      }
          },
          edit_jasa_description:{
              required: true,
          },
      },
      messages: {
        edit_jasa_name: {
                required: "Nama harus di isi",
                remote: "Nama sudah tersedia"
          },
          edit_jasa_description: {
                  required: "Deskripsi harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#editJasaButton").prop('disabled', true);
            form.submit();
      }
  });

$("#deleteAllModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#destroyAllForm").submit();
});

const deleteJasa = $("#deleteJasaForm").attr('action');

  function deleteThisJasa(data) {
    $("#deleteJasaForm").attr('action', `${deleteJasa}/${data.id}`);
  }

  function readDescription(data) {
    $("#descriptionText").html(data.description);
  }

  $("#setting").click(function() {
      $("#checkAllEmpty").toggle();  
      $("#deleteAllEmpty").toggle();
  });

  function setting() {
    $("input:checkbox").toggle();
    $("#deleteAllButton").toggle(); 
  }


  $("#deleteAllButton").attr('disabled', true); 

  $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
        if($(this).is(":checked")){
            $("#deleteAllButton").attr('disabled', false); 
            $(".checkbox").attr('disabled', false); 
        } else if($(this).is(":not(:checked)")) {
            $("#deleteAllButton").attr('disabled', true); 
            $(".checkbox").attr('disabled', true); 
        }
    });
</script>
@endsection