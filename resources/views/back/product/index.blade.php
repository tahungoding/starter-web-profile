@extends('layouts.main')
@section('title', 'Product')
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
    <h1>Product</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
      <div class="breadcrumb-item">Product</div>
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
              <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahProduk"><i
                  class="fas fa-plus-circle"></i></button>
              <button class="btn btn-sm btn-secondary"><i class="fas fa-cog"></i></button>
            </div>
          </div>
          <div class="card-body">
            <table id="productTable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Deskripsi</th>
                  <th>Youtube</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php
                    $increment = 1;
                @endphp
                @foreach ($product as $products)
                <tr>
                  <td>{{ $increment++ }}</td>
                  <td>{{ $products->name }}</td>
                  <td>{{ $products->description }}</td>
                  <td>{{ $products->youtube }}</td>
                  <td>{{ $products->youtube }}</td>
                  <td>
                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editProduk" onclick="editProduct({{$products}})"><i
                        class="far fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
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
</section>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="tambahProduk">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('products.store') }}" method="post" id="tambahProdukForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Nama">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="description" placeholder="Deskripsi">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="youtube" placeholder="Link Youtube">
          </div>
          <div class="form-group">
            <input type="file" class="form-control" name="image">
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

<div class="modal fade" tabindex="-1" role="dialog" id="editProduk">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('products.update', '') }}" method="post" id="editProdukForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <input type="text" class="form-control" name="edit_name" id="editName" placeholder="Nama">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="edit_description" id="editDescription" placeholder="Deskripsi">
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
  
  $("#tambahProdukForm").validate({
      rules: {
          name:{
              required: true,
              remote: {
                        url: "",
                        type: "post",
                      }
          },
          description:{
              required: true,
          },
          youtube:{
              required: true,
          },
      },
      messages: {
          name: {
                required: "Nama harus di isi",
                remote: "Nama sudah tersedi"
          },
          description: {
                  required: "Deskripsi harus di isi",
          },
          youtube: {
                  required: "Youtube harus di isi",
          }
      },
      submitHandler: function(form) {
        $("#tambahButton").prop('disabled', true);
            form.submit();
      }
  });

  $("#editProdukForm").validate({
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
  
  $('#productTable').DataTable({
      responsive: true
  });
});


const updateProduct = $("#editProdukForm").attr('action');

  function editProduct(data) {
    $("#editProdukForm").attr('action', `${updateProduct}/${data.id}`);
    $("#editName").val(data.name);
    $("#editDescription").val(data.description);
    $("#editYoutube").val(data.youtube);
    $("#editImage").val(data.youtube);
  } 
</script>
@endsection