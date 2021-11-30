@extends('layouts.main', ['web' => $web])
@section('title', 'Product')
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
    <h1>Team</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Team</div>
    </div>
  </div>

  <div class="section-body">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between w-100">
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahTeam"><i
                  class="fas fa-plus-circle"></i></button>
              @if (count($team))
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
                <table id="teamTable" class="table table-striped" style="width:100%">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Lengkap</th>
                      <th>Photo</th>
                      <th>Jabatan</th>
                      <th>Divisi</th>
                      <th>Sub Divisi</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                    $increment = 1;
                    @endphp
                    @foreach ($team as $teams)
                    <tr>
                      <td>{{ $increment++ }}</td>
                      <td>{{ $teams->fullname }}</td>
                      <td>
                        @if(!empty($teams->photo) && Storage::exists($teams->photo))
                        <img src="{{ Storage::url($teams->photo) }}" alt="Photo" width="100" height="80"
                          style="object-fit: cover" class="rounded">
                        @endif
                      </td>
                      <td>{{ $teams->position }}</td>
                      <td>
                        @if (isset($teams->divisions->name))
                        {{ $teams->divisions->name }}
                        @endif
                      </td>
                      <td>
                        @if (isset($teams->sub_divisions->name))
                        {{ $teams->sub_divisions->name }}
                        @endif
                      </td>
                      <td>
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                          data-target="#editTeam{{$teams->id}}" onclick="validateEditTeam({{$teams}})"><i
                            class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                          data-target="#deleteConfirm" onclick="deleteThisTeam({{$teams}})"><i
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
<div class="modal fade" tabindex="-1" role="dialog" id="tambahTeam">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('teams.store') }}" method="post" id="tambahTeamForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="fullname">Nama Lengkap</label>
            <input type="text" class="form-control" name="team_fullname" placeholder="Nama Lengkap">
          </div>
          <div class="form-group">
            <label for="position">Jabatan</label>
            <input type="text" class="form-control" name="team_position" placeholder="Jabatan">
          </div>
          <div class="form-group">
            <label for="division">Divisi</label>
            <select class="form-control" name="team_division_id">
              @if (count($division))
              <option value="">Pilih Divisi</option>
              @foreach ($division as $divisions)
              <option value="{{ $divisions->id }}">{{ $divisions->name }}</option>
              @endforeach
              @else
              <option value="">Divisi Tidak Tersedia</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="sub_division">Sub Divisi</label>
            <select class="form-control" name="team_sub_division_id">
              @if (count($sub_division))
              <option value="">Pilih Sub Divisi</option>
              @foreach ($sub_division as $sub_divisions)
              <option value="{{ $sub_divisions->id }}">{{ $sub_divisions->name }}</option>
              @endforeach
              @else
              <option value="">Sub Divisi Tidak Tersedia</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="team_photo">Foto</label>
            <input type="file" class="form-control dropify" name="team_photo" data-allowed-file-extensions="png jpg jpeg"
              data-show-remove="false">
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

@foreach ($team as $teams)
<div class="modal fade" tabindex="-1" role="dialog" id="editTeam{{$teams->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Team</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('teams.update', $teams->id) }}" method="post" id="editTeamForm{{$teams->id}}"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_team_fullname">Nama Lengkap</label>
            <input type="text" class="form-control" name="edit_team_fullname" id="edit_team_fullname" placeholder="Nama"
              value="{{ $teams->fullname }}">
          </div>
          <div class="form-group">
            <label for="edit_team_position">Jabatan</label>
            <input type="text" class="form-control" name="edit_team_position" id="edit_team_position"
              placeholder="Deskripsi" value="{{ $teams->position }}">
          </div>
          <div class="form-group">
            <label for="edit_team_division">Divisi</label>
            <select class="form-control" name="edit_team_division_id">
              @if (count($division))
              <option value="">Pilih Divisi</option>
              @foreach ($division as $divisions)
              <option value="{{ $divisions->id }}" {{ $divisions->id == $teams->division_id ? 'selected' : '' }}>{{ $divisions->name }}</option>
              @endforeach
              @else
              <option value="">Divisi Tidak Tersedia</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="edit_team_sub_division">Sub Divisi</label>
            <select class="form-control" name="edit_team_sub_division_id">
              @if (count($sub_division))
              <option value="">Pilih Sub Divisi</option>
              @foreach ($sub_division as $sub_divisions)
              <option value="{{ $sub_divisions->id }}" {{ $sub_divisions->id == $teams->sub_division_id ? 'selected' : '' }}>{{ $sub_divisions->name }}</option>
              @endforeach
              @else
              <option value="">Sub Divisi Tidak Tersedia</option>
              @endif
            </select>
          </div>
          <div class="form-group">
            <label for="edit_photo">Foto</label>
            <input type="file" class="form-control dropify" name="edit_team_photo"
              data-allowed-file-extensions="png jpg jpeg" data-default-file="@if(!empty($teams->photo) &&
                            Storage::exists($teams->photo)){{ Storage::url($teams->photo) }}@endif"
              data-show-remove="false">
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
      <form action="{{ route('teams.destroy', '') }}" method="post" id="deleteTeamForm">
        @csrf
        @method('delete')
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus</b> team ini ?
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
      <form action="{{ route('teams.destroyAll') }}" method="post" id="destroyAllForm">
        @csrf
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus semua</b> team ?
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
  $('#teamTable').DataTable( {
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
  
  $("#tambahTeamForm").validate({
      rules: {
          team_fullname:{
              required: true,
          },
          team_position:{
              required: true,
          },
      },
      messages: {
          team_fullname:{
                required: "Nama Lengkap harus di isi",
          },
          team_position: {
                  required: "Jabatan harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#tambahButton").prop('disabled', true);
            form.submit();
      }
  });
});
function validateEditTeam(data) {
  $("#editTeamForm" + data.id).validate({
      rules: {
          edit_team_fullname:{
              required: true,
          },
          edit_team_position:{
              required: true,
          },
      },
      messages: {
          edit_team_fullname: {
                required: "Nama Lengkap harus di isi",
          },
          edit_team_position: {
                  required: "Jabatan harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#editButton").prop('disabled', true);
            form.submit();
      }
  });
}

const deleteTeam = $("#deleteTeamForm").attr('action');

function deleteThisTeam(data) {
  $("#deleteTeamForm").attr('action', `${deleteTeam}/${data.id}`);
}

$("#deleteModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#deleteTeamForm").submit();
});

$("#deleteAllModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#destroyAllForm").submit();
});


</script>
@endsection