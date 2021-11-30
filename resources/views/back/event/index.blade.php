@extends('layouts.main', ['web' => $web])
@section('title', 'Event')
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
    <h1>Event</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Event</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between w-100">
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahEvent"><i
                  class="fas fa-plus-circle"></i></button>
              @if (count($event))
              <div class="d-flex justify-content-between">
                <input type="search" class="form-control desktop-search" id="eventSearch" placeholder="Cari Event..." autocomplete="off" style="margin-right: 20px;">
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
        @if (count($event))
        <div class="card mobile-search-card" style="display: none">
          <div class="card-header">
            <input type="search" class="form-control mobile-search" id="mobileEventSearch" placeholder="Cari Event..." autocomplete="off">
          </div>
        </div>
        @endif
      </div>
    </div>
    <div id="searchResult">

    </div>
    <div id="eventData">
      @include('back.event.pagination')
    </div>
  </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="tambahEvent">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('events.store') }}" method="post" id="tambahEventForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="event_name">Nama</label>
            <input type="text" class="form-control" name="event_name" placeholder="Nama">
          </div>
          <div class="form-group">
            <label for="event_description">Deskripsi</label>
            <textarea name="event_description" id="event_description" class="form-control" placeholder="Deskripsi"
              style="height: 100%;"></textarea>
          </div>
          <div class="form-group">
            <label for="event_youtube">Youtube</label>
            <input type="text" class="form-control" name="event_youtube" placeholder="Link Youtube">
          </div>
          <div class="form-group">
            <label for="event_date">Tanggal</label>
            <input type="date" class="form-control" name="event_date">
          </div>
          <div class="form-group">
            <label for="event_location">Lokasi</label>
            <input type="text" class="form-control" name="event_location">
          </div>
          <div class="form-group">
            <label for="event_image">Gambar</label>
            <input type="file" class="form-control dropify" name="event_image"
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

@foreach ($allEvent as $events)
<div class="modal fade" tabindex="-1" role="dialog" id="editEvent{{$events->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Event</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('events.update', $events->id) }}" method="post" id="editEventForm{{ $events->id }}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="checkEventName{{ $events->id }}" value="{{ $events->name }}">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_event_name">Nama</label>
            <input type="text" class="form-control" name="edit_event_name" id="edit_event_name" placeholder="Nama"
              value="{{ $events->name }}">
          </div>
          <div class="form-group">
            <label for="edit_event_description">Deskripsi</label>
            <textarea name="edit_event_description" id="edit_event_description" class="form-control"
              placeholder="Deskripsi" style="height: 100%;">{{ $events->description }}</textarea>
          </div>
          <div class="form-group">
            <label for="edit_event_youtube">Youtube</label>
            <input type="text" class="form-control" name="edit_event_youtube" id="edit_event_youtube"
              placeholder="Link Youtube" value="{{ $events->youtube }}">
          </div>

          <div class="form-group">
            <label for="edit_event_date">Tanggal</label>
            <input type="date" class="form-control" name="edit_event_date" id="edit_event_date"
              value="{{ $events->date }}">
          </div>

          <div class="form-group">
            <label for="edit_event_location">Lokasi</label>
            <input type="text" class="form-control" name="edit_event_location" id="edit_event_location"
              value="{{ $events->location }}">
          </div>
          <div class="form-group">
            <label for="edit_event_image">Gambar</label>
            <input type="file" class="form-control dropify" name="edit_event_image"
              data-allowed-file-extensions="png jpg jpeg" data-default-file="@if(!empty($events->image) &&
                            Storage::exists($events->image)){{ Storage::url($events->image) }}@endif"
              data-show-remove="false">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="editEventButton">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@foreach ($allEvent as $events)
<div class="modal fade" tabindex="-1" role="dialog" id="more{{$events->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Rincian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p><b>Tanggal</b> : {{ $events->date }}</p>
        <p><b>Lokasi</b> : {{ $events->location }}</p>
        <p>{{ $events->name }}</p>

        @if(!empty($events->image) && Storage::exists($events->image))
        <img src="{{ Storage::url($events->image) }}" alt="" class="img-fluid rounded mt-1"
          style="width:100%; height:200px; object-fit:cover;">
        @endif
        <br><br>
        <p>{{ $events->description }}</p>
        @if(isset($events->youtube))
        <input type="text" class="form-control" value="{{ $events->youtube }}" readonly>
        @endif
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
      <form action="{{ route('events.destroy', '') }}" method="post" id="deleteEventForm">
        @csrf
        @method('delete')
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus</b> event ini ?
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
        Apakah anda yakin untuk <b>menghapus semua</b> event ?
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
        event_pagination(page);
    });
  
    function event_pagination(page)
    {
      var _token = $("input[name=_token]").val();
      $.ajax({
        url: "{{ route('eventPagination') }}",
        method: "POST",
        data: {_token:_token, page:page},
        success: function(data) {
            $("#eventData").html(data);
        }
      });
    }
  
    $("#mobileEventSearch, #eventSearch").keyup(function() {
      var _token = $("input[name=_token]").val();
      var originSearch = $("#eventSearch").val();
      var mobileOriginSearch = $("#mobileEventSearch").val();
      if(originSearch == "") {
        var search = $("#mobileEventSearch").val();
      } else {
        var search = $("#eventSearch").val();
      }
        $.ajax({
            url:"{{ route('eventSearch') }}",
            method:"POST",
            data:{_token:_token, search:search},
            success:function(data) {
                if(search == "") {
                    $('#searchResult').html("");
                    $("#eventData").css('display','block');
                } else {
                    $('#searchResult').html(data);
                    $("#eventData").css('display','none');
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
  
  $("#tambahEventForm").validate({
      rules: {
        event_name:{
              required: true,
              remote: {
                        url: "{{ route('checkEventName') }}",
                        type: "post",
              }
          },
          event_description:{
              required: true,
          },
          event_image:{
              required: true,
          },
          event_date:{
              required: true,
          },
          event_location:{
              required: true,
          },
      },
      messages: {
          event_name: {
                required: "Nama Event harus di isi",
                remote: "Nama Event sudah tersedia"
          },
          event_description: {
                  required: "Deskripsi harus di isi",
          },
          event_image: {
                  required: "Gambar harus di isi",
          },
          event_date: {
                  required: "Tanggal harus di isi",
          },
          event_location: {
                  required: "Lokasi harus di isi",
          }
      },
      errorPlacement: function(error, element) {
        if(element.attr("name") == "event_image") {
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

function validateEvent(data) {
  $("#editEventForm" + data.id).validate({
      rules: {
        edit_event_name:{
              required: true,
              remote: {
                        param: {
                              url: "{{ route('checkEventName') }}",
                              type: "post",
                        },
                        depends: function(element) {
                          // compare name in form to hidden field
                          return ($(element).val() !== $('#checkEventName' + data.id).val());
                        },
                      }
          },
          edit_event_description:{
              required: true,
          },
          edit_event_image:{
              required: true,
          },
          edit_event_date:{
              required: true,
          },
          edit_event_location:{
              required: true,
          },
      },
      messages: {
          edit_event_name: {
                required: "Nama Event harus di isi",
                remote: "Nama Event sudah tersedia"
          },
          edit_event_description: {
                  required: "Deskripsi harus di isi",
          },
          edit_event_image: {
                  required: "Gambar harus di isi",
          },
          edit_event_date: {
                  required: "Tanggal harus di isi",
          },
          edit_event_location: {
                  required: "Lokasi harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#editEventButton").prop('disabled', true);
          form.submit();
      }
  });
}
$("#deleteAllModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#destroyAllForm").submit();
});

const deleteEvent = $("#deleteEventForm").attr('action');

  function deleteThisEvent(data) {
    $("#deleteEventForm").attr('action', `${deleteEvent}/${data.id}`);
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