@extends('layouts.main')
@section('title', 'Project')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
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
</style>
@endsection
@section('container')
<section class="section">
  <div class="section-header">
    <h1>Project</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Project</div>
    </div>
  </div>

  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-12">
        <div class="card">

        </div>
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between w-100">
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahProject"><i
                  class="fas fa-plus-circle"></i></button>
              <button class="btn btn-sm btn-secondary" onclick="setting()"><i class="fas fa-cog"></i></button>
            </div>
          </div>

        </div>

      </div>
    </div>
    <div class="row">
      @foreach ($project as $projects)
      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            @if (empty($projects->date_end))
            <span class="badge badge-primary">Ongoing</span>
            @else
            <span class="badge badge-success">Completed</span>
            @endif
            <br><br>
            <h4>{{ $projects->name }}</h4>
            <img src="{{ Storage::url($projects->image) }}" alt="" class="img-fluid rounded mt-1"
              style="width:200px; height:200px; object-fit:cover;">
            <div class="row">
              <div class="col-md-2">
                <button class="btn btn-sm btn-secondary mt-3" data-toggle="modal" data-target="#readDesription" onclick="readDescription({{$projects}})">Deskripsi</button>
              </div>
              <div class="col-md-10">
                <input type="text" class="form-control mt-3" style="height: 30px;" value="{{ $projects->youtube }}"
                  readonly>
              </div>
            </div>
            <div class="btn-group text-center buttonGroup mt-3" style="display: none">
              <button class="btn btn-sm btn-warning"><i class="far fa-edit"></i></button>
              <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{ $project->links('vendor.pagination.custom_pagination') }}
    </div>
  </div>
</section>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="tambahProject">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('projects.store') }}" method="post" id="tambahProjectForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" name="project_name" placeholder="Nama">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="project_description" placeholder="Deskripsi">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="project_youtube" placeholder="Link Youtube">
          </div>
          <div class="form-group">
            <input type="date" class="form-control" name="project_date_start">
          </div>
          <div class="form-group">
            <input type="file" class="form-control" name="project_image">
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

<div class="modal fade" tabindex="-1" role="dialog" id="editProject">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('projects.update', '') }}" method="post" id="editProjectForm"
        enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" name="edit_name" id="editName" placeholder="Nama">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="edit_description" id="editDescription"
              placeholder="Deskripsi">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="edit_youtube" id="editYoutube" placeholder="Link Youtube">
          </div>
          <div class="form-group">
            <input type="file" class="form-control" name="edit_image" id="edit_image">
          </div>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary" id="editButton">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="readDesription">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Deskripsi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <p id="descriptionText"></p>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        </div>
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
<script>
  $(document).ready(function() {

  $.ajaxSetup({
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  
  $("#tambahProjectForm").validate({
      rules: {
        project_name:{
              required: true,
              remote: {
                        url: "{{ route('checkProjectName') }}",
                        type: "post",
              }
          },
          project_description:{
              required: true,
          },
          project_image:{
              required: true,
          },
          project_date_start:{
              required: true,
          },
      },
      messages: {
          project_name: {
                required: "Nama harus di isi",
                remote: "Nama sudah tersedia"
          },
          project_description: {
                  required: "Deskripsi harus di isi",
          },
          project_image: {
                  required: "Gambar harus di isi",
          },
          project_date_start: {
                  required: "Tanggal Mulai harus di isi",
          }
      },
      submitHandler: function(form) {
        $("#tambahButton").prop('disabled', true);
            form.submit();
      }
  });

  $("#editProjectForm").validate({
      rules: {
          edit_name:{
              required: true,
              remote: {
                        url: "",
                        type: "post",
                      }
          },
          edit_description:{
              required: true,
          },
          edit_youtube:{
              required: true,
          },
      },
      messages: {
        edit_name: {
                required: "Nama harus di isi",
                remote: "Nama sudah tersedi"
          },
          edit_description: {
                  required: "Deskripsi harus di isi",
          },
          edit_youtube: {
                  required: "Youtube harus di isi",
          }
      },
      submitHandler: function(form) {
        $("#editButton").prop('disabled', true);
            form.submit();
      }
  });
  
  $('#projectTable').DataTable({
      responsive: true
  });
});


const updateProject = $("#editProjectForm").attr('action');

  function editProject(data) {
    $("#editProjectForm").attr('action', `${updateProject}/${data.id}`);
    $("#editName").val(data.name);
    $("#editDescription").val(data.description);
    $("#editYoutube").val(data.youtube);
    $("#editImage").val(data.youtube);
  } 

  function readDescription(data) {
    $("#descriptionText").html(data.description);
  }

  function setting() {
    $(".buttonGroup").css('display', 'block');
  }
</script>
@endsection