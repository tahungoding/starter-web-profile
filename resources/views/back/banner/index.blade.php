@extends('layouts.main', ['web' => $web])
@section('title', 'Banner')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
  integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
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

  table.dataTable.no-footer {
    border-bottom: 1px solid #f4f4f4 !important;
  }

  .table:not(.table-sm) thead th {
    background-color: rgba(0, 0, 0, 0.75) !important;
    color: #fff !important;
  }
</style>
@endsection
@section('container')
<section class="section">
  <div class="section-header">
    <h1>Banner</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Banner</div>
    </div>
  </div>

  <div class="section-body">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between w-100">
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahBanner"><i
                  class="fas fa-plus-circle"></i></button>
              @if (count($banner))
              <div class="d-flex justify-content-between">
                <button class="btn btn-sm btn-danger" id="deleteAllButton" data-toggle="modal"
                  data-target="#deleteAllConfirm" style="margin-right: 20px;"><i class="fas fa-trash"></i></button>
              </div>
              @else
              <div class="d-flex justify-content-between">
                <button class="btn btn-sm btn-danger" id="deleteAllEmpty" style="margin-right: 20px;" disabled><i
                    class="fas fa-trash"></i></button>
              </div>
              @endif
            </div>
            <br>
            <div class="card">
              <div class="card-body">
                <table id="bannerTable" class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Gambar</th>
                      <th>Url</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $increment = 1;
                    @endphp
                    @foreach ($banner as $banners)
                    <tr>
                      <td>{{ $increment++ }}</td>
                      <td>
                        @if(!empty($banners->image) && Storage::exists($banners->image))
                        <img src="{{ Storage::url($banners->image) }}" alt="Photo" width="100" height="80"
                          style="object-fit: cover" class="rounded">
                        @endif
                      </td>
                      <td>{{ $banners->url }}</td>
                      <td>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                          data-target="#editBanner{{$banners->id}}" onclick="validateEditBanner({{$banners}})"><i
                            class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                          data-target="#deleteConfirm" onclick="deleteThisBanner({{$banners}})"><i
                            class="far fa-trash-alt"></i></button>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="tambahBanner">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('banners.store') }}" method="post" id="tambahBannerForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" class="form-control dropify" name="banner_image"
              data-allowed-file-extensions="png jpg jpeg" data-show-remove="false">
            <div id="errorImage">
            </div>
          </div>
          <div class="form-group">
            <label for="url">Url</label>
            <input type="text" class="form-control" name="banner_url" placeholder="Url">
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

@foreach ($banner as $banners)
<div class="modal fade" tabindex="-1" role="dialog" id="editBanner{{$banners->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Banner</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('banners.update', $banners->id) }}" method="post" id="editBannerForm{{$banners->id}}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_banner_image">Gambar</label>
            <input type="file" class="form-control dropify" name="edit_banner_image"
              data-allowed-file-extensions="png jpg jpeg" data-default-file="@if(!empty($banners->image) &&
                            Storage::exists($banners->image)){{ Storage::url($banners->image) }}@endif"
              data-show-remove="false">
          </div>
          <div class="form-group">
            <label for="edit_banner_url">Nama Lengkap</label>
            <input type="text" class="form-control" name="edit_banner_url" id="edit_banner_url" placeholder="Nama"
              value="{{ $banners->url }}">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="editButton">Ubah</button>
        </div>
      </form>
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
      <form action="{{ route('banners.destroy', '') }}" method="post" id="deleteBannerForm">
        @csrf
        @method('delete')
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus</b> banner ini ?
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary" id="deleteModalButton">Ya, Hapus</button>
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
      <form action="{{ route('banners.destroyAll') }}" method="post" id="destroyAllForm">
        @csrf
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus semua</b> banner ?
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary" id="deleteAllModalButton">Ya, Hapus Semua</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
  integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $('.dropify').dropify();

$(document).ready(function() {
  $('#bannerTable').DataTable( {
        responsive: true,
        "searching": false
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
  
  $("#tambahBannerForm").validate({
      rules: {
          banner_image:{
              required: true,
          },
          banner_url:{
              required: true,
          },
      },
      messages: {
          banner_image:{
                required: "Gambar harus di isi",
          },
          banner_url: {
                  required: "Url harus di isi",
          },
      },
      errorPlacement: function(error, element) {
        if(element.attr("name") == "banner_image") {
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
function validateEditBanner(data) {
  $("#editBannerForm" + data.id).validate({
      rules: {
          edit_banner_url:{
              required: true,
          },
      },
      messages: {
          edit_banner_url: {
                  required: "Gambar harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#editButton").prop('disabled', true);
            form.submit();
      }
  });
}

const deleteBanner = $("#deleteBannerForm").attr('action');

function deleteThisBanner(data) {
  $("#deleteBannerForm").attr('action', `${deleteBanner}/${data.id}`);
}

$("#deleteModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#deleteBannerForm").submit();
});

$("#deleteAllModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#destroyAllForm").submit();
});


</script>
@endsection