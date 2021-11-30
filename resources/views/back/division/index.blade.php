@extends('layouts.main', ['web' => $web])
@section('title', 'Division')
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

  .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    border-color: #f4f4f4 #f4f4f4 #fff !important;
  }
  .nav-tabs {
    border-bottom: 1px solid #f4f4f4;
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
    <h1>Division</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
      <div class="breadcrumb-item">Division</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <nav>
              <div class="nav nav-tabs" id="myTab" role="tablist">
                <a class="nav-item nav-link active" id="nav-division-tab" data-toggle="tab" href="#nav-division"
                  role="tab" aria-controls="nav-division" aria-selected="false">Division</a>
                <a class="nav-item nav-link" id="nav-sub-division-tab" data-toggle="tab" href="#nav-sub-division"
                  role="tab" aria-controls="nav-sub-division" aria-selected="false">Sub Division</a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-division" role="tabpanel"
                aria-labelledby="nav-division-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between w-100">
                      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahDivision"><i
                          class="fas fa-plus-circle"></i></button>
                      @if (count($division))
                      <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-danger" id="deleteAllButton" data-toggle="modal"
                          data-target="#deleteAllConfirm" style="margin-right: 20px;"><i
                            class="fas fa-trash"></i></button>
                      </div>
                      @else
                      <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-danger" id="deleteAllEmpty" style="margin-right: 20px;"
                          disabled><i class="fas fa-trash"></i></button>
                      </div>
                      @endif
                    </div>
                    <br>
                    <table id="divisionTable" class="table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $increment = 1;
                        @endphp
                        @foreach ($division as $divisions)
                        <tr>
                          <td>{{ $increment++ }}</td>
                          <td>{{ $divisions->name }}</td>
                          <td>{{ $divisions->description }}</td>
                          <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                              data-target="#editDivision{{ $divisions->id }}"
                              onclick="editDivisionValidation({{ $divisions }})"><i class="far fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                              data-target="#deleteConfirm" onclick="deleteThisDivision({{$divisions}})"><i
                                class="far fa-trash-alt"></i></button>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane fade" id="nav-sub-division" role="tabpanel" aria-labelledby="nav-sub-division-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between w-100">
                      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahSubDivision"><i
                          class="fas fa-plus-circle"></i></button>
                      @if (count($sub_division))
                      <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-danger" id="deleteAllSubDivisionButton" data-toggle="modal"
                          data-target="#deleteAllSubDivisionConfirm" style="margin-right: 20px;"><i
                            class="fas fa-trash"></i></button>
                      </div>
                      @else
                      <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-danger" id="deleteAllEmpty" style="margin-right: 20px;"
                          disabled><i class="fas fa-trash"></i></button>
                      </div>
                      @endif
                    </div>
                    <br>
                    <table id="subDivisionTable" class="table table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama</th>
                          <th>Deskripsi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                        $increment = 1;
                        @endphp
                        @foreach ($sub_division as $sub_divisions)
                        <tr>
                          <td>{{ $increment++ }}</td>
                          <td>{{ $sub_divisions->name }}</td>
                          <td>{{ $sub_divisions->description }}</td>
                          <td>
                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                              data-target="#editSubDivision{{ $sub_divisions->id }}"
                              onclick="editSubDivisionValidation({{ $sub_divisions }})"><i class="far fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                              data-target="#deleteSubDivisionConfirm" onclick="deleteThisSubDivision({{$sub_divisions}})"><i
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
    </div>
</section>
@endsection

@section('modal')
{{-- DIVISION --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambahDivision">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('divisions.store') }}" method="post" id="tambahDivisionForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="division_name">Nama</label>
            <input type="text" class="form-control" name="division_name" placeholder="Nama Divisi">
          </div>
          <div class="form-group">
            <label for="division_description">Deskripsi</label>
            <input type="text" class="form-control" name="division_description" placeholder="Deskripsi">
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

@foreach ($division as $divisions)
<div class="modal fade" tabindex="-1" role="dialog" id="editDivision{{$divisions->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('divisions.update', $divisions->id) }}" method="post"
        id="editDivisionForm{{$divisions->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="checkDivisionName{{ $divisions->id }}" value="{{ $divisions->name }}">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_division_name">Nama</label>
            <input type="text" class="form-control" name="edit_division_name" id="edit_division_name"
              placeholder="Nama Divisi" value="{{ $divisions->name }}">
          </div>
          <div class="form-group">
            <label for="edit_division_description">Deskripsi</label>
            <input type="text" class="form-control" name="edit_division_description" id="edit_division_description"
              placeholder="Deskripsi" value="{{ $divisions->description }}">
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
      <form action="{{ route('divisions.destroy', '') }}" method="post" id="deleteDivisionForm">
        @csrf
        @method('delete')
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus</b> divisi ini ?
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
      <form action="{{ route('divisions.destroyAll') }}" method="post" id="destroyAllForm">
        @csrf
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus semua</b> divisi ?
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary" id="deleteAllModalButton">Ya, Hapus Semua</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- SUB DIVISION --}}
<div class="modal fade" tabindex="-1" role="dialog" id="tambahSubDivision">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Sub Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('sub-divisions.store') }}" method="post" id="tambahSubDivisionForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="sub_division_name">Nama</label>
            <input type="text" class="form-control" name="sub_division_name" placeholder="Nama Sub Divisi">
          </div>
          <div class="form-group">
            <label for="sub_division_description">Deskripsi</label>
            <input type="text" class="form-control" name="sub_division_description" placeholder="Deskripsi">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="tambahSubDivisionButton">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

@foreach ($sub_division as $sub_divisions)
<div class="modal fade" tabindex="-1" role="dialog" id="editSubDivision{{$sub_divisions->id}}">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Sub Divisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('sub-divisions.update', $sub_divisions->id) }}" method="post"
        id="editSubDivisionForm{{$sub_divisions->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" id="checkSubDivisionName{{ $sub_divisions->id }}" value="{{ $sub_divisions->name }}">
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_sub_division_name">Nama</label>
            <input type="text" class="form-control" name="edit_sub_division_name" id="edit_sub_division_name"
              placeholder="Nama Sub Divisi" value="{{ $sub_divisions->name }}">
          </div>
          <div class="form-group">
            <label for="edit_sub_division_description">Deskripsi</label>
            <input type="text" class="form-control" name="edit_sub_division_description" id="edit_sub_division_description"
              placeholder="Deskripsi" value="{{ $sub_divisions->description }}">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="editSubDivisionButton">Ubah</button>
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
      <form action="{{ route('sub-divisions.destroy', '') }}" method="post" id="deleteSubDivisionForm">
        @csrf
        @method('delete')
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus</b> sub divisi ini ?
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary" id="deleteSubDivisionModalButton">Ya, Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteAllSubDivisionConfirm">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Semua</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('sub-divisions.destroyAll') }}" method="post" id="destroyAllSubDivisionForm">
        @csrf
        <div class="modal-body">
          Apakah anda yakin untuk <b>menghapus semua</b> sub divisi ?
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="button" class="btn btn-primary" id="deleteAllSubDivisionModalButton">Ya, Hapus Semua</button>
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

// Datatable
$(document).ready(function() {
  $('#divisionTable').DataTable( {
        responsive: true,
        "searching": false
  });

  $('#subDivisionTable').DataTable( {
        responsive: true,
        "searching": false
  });

  // Keep Tab Open On Refresh
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
      localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
      $('#myTab a[href="' + activeTab + '"]').tab('show');
  }
  $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
  $($.fn.dataTable.tables(true)).DataTable()
    .columns.adjust()
    .responsive.recalc();
  }); 

});
</script>
{{-- DIVISION --}}
<script>
  $(document).ready(function() {

  $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
  $("#tambahDivisionForm").validate({
      rules: {
          division_name:{
              required: true,
              remote: {
                        url: "{{ route('checkDivisionName') }}",
                        type: "post",
              }
          },
          division_description:{
              required: true,
          },
      },
      messages: {
          division_name: {
                required: "Nama Divisi harus di isi",
                remote: "Nama Divisi sudah tersedia"
          },
          division_description: {
                required: "Deskripsi harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#tambahButton").prop('disabled', true);
            form.submit();
      }
  });
});

function editDivisionValidation(data)
{
  $("#editDivisionForm" + data.id).validate({
      rules: {
        edit_division_name:{
              required: true,
              remote: {
                        param: {
                              url: "{{ route('checkDivisionName') }}",
                              type: "post",
                        },
                        depends: function(element) {
                          // compare name in form to hidden field
                          return ($(element).val() !== $('#checkDivisionName' + data.id).val());
                        },
                      }
          },
          edit_division_description:{
              required: true,
          },
      },
      messages: {
          edit_division_name: {
                required: "Nama Divisi harus di isi",
                remote: "Nama Divisi sudah tersedia"
          },
          edit_division_description: {
                  required: "Deskripsi harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#editButton").prop('disabled', true);
            form.submit();
      }
  });
}



$("#deleteModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#deleteDivisionForm").submit();
});

$("#deleteAllModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#destroyAllForm").submit();
});

const deleteDivision = $("#deleteDivisionForm").attr('action');

  function deleteThisDivision(data) {
    $("#deleteDivisionForm").attr('action', `${deleteDivision}/${data.id}`);
  }
</script>

{{-- DIVISION --}}
<script>
$(document).ready(function() {

  $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
  $("#tambahSubDivisionForm").validate({
      rules: {
          sub_division_name:{
              required: true,
              remote: {
                        url: "{{ route('checkSubDivisionName') }}",
                        type: "post",
              }
          },
          sub_division_description:{
              required: true,
          },
      },
      messages: {
          sub_division_name: {
                required: "Nama Sub Divisi harus di isi",
                remote: "Nama Sub Divisi sudah tersedia"
          },
          sub_division_description: {
                required: "Deskripsi harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#tambahSubDivisionButton").prop('disabled', true);
            form.submit();
      }
  });
});

function editSubDivisionValidation(data)
{
  $("#editSubDivisionForm" + data.id).validate({
      rules: {
        edit_sub_division_name:{
              required: true,
              remote: {
                        param: {
                              url: "{{ route('checkSubDivisionName') }}",
                              type: "post",
                        },
                        depends: function(element) {
                          // compare name in form to hidden field
                          return ($(element).val() !== $('#checkSubDivisionName' + data.id).val());
                        },
                      }
          },
          edit_sub_division_description:{
              required: true,
          },
      },
      messages: {
        edit_sub_division_name: {
                required: "Nama Sub Divisi harus di isi",
                remote: "Nama Sub Divisi sudah tersedia"
          },
          edit_sub_division_description: {
                  required: "Deskripsi harus di isi",
          },
      },
      submitHandler: function(form) {
        $("#editSubDivisionButton").prop('disabled', true);
            form.submit();
      }
  });
}



$("#deleteSubDivisionModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#deleteSubDivisionForm").submit();
});

$("#deleteAllSubDivisionModalButton").click(function() {
    $(this).attr('disabled', true); 
    $("#destroyAllSubDivisionForm").submit();
});

const deleteSubDivision = $("#deleteSubDivisionForm").attr('action');

  function deleteThisSubDivision(data) {
    $("#deleteSubDivisionForm").attr('action', `${deleteSubDivision}/${data.id}`);
  }
</script>
<script>
  // $("#setting").click(function() {
  //     $("#checkAllEmpty").toggle();  
  //     $("#deleteAllEmpty").toggle();
  // });

  // function setting() {
  //   if($('.buttonGroup').css('display') == 'block') {
  //       $(".buttonGroup").css('display', 'none');
  //       $("input:checkbox").css('display', 'none');  
  //       $("#deleteAllButton").css('display', 'none');  
  //   } else {
  //     $(".buttonGroup").css('display', 'block');
  //     $("input:checkbox").css('display', 'block');  
  //     $("#deleteAllButton").css('display', 'block');  
  //   }
  // }

  </script>
@endsection