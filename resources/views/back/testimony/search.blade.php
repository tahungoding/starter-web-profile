<form action="{{ route('testimony.destroyAll') }}" method="post" id="destroyAllForm">
    @csrf
    <div class="row">
        @foreach ($testimony_result as $testimony)
        <div class="col-md-4">
            <div class="card" id="thisIs">
                <div class="card-body">
                    <input type="checkbox" name='id[]' class="checkbox mb-3" value="{{ $testimony->id }}"
                        autocomplete="off" style="display: none;" disabled>
                    <h6>{{ Str::limit($testimony->name, 30) }}</h6>
                    <img src="{{ Storage::url($testimony->image) }}" class="img-fluid rounded mt-1"
                        style="width:100%; height:200px; object-fit:cover;">
                    <div class="btn-group text-center buttonGroup mt-3" id="buttonGroup">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#editTestimony{{ $testimony->id }}"><i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#deleteConfirm" onclick="deleteThisTestimony({{$testimony}})"><i
                                class="far fa-trash-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-dark" data-toggle="modal"
                            data-target="#more{{ $testimony->id }}">More</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</form>