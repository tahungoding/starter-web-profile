<form action="{{ route('projects.destroyAll') }}" method="post" id="destroyAllForm">
    @csrf
    <div class="row">
        @foreach ($project_result as $project_results)
        <div class="col-md-4">
            <div class="card" id="thisIs">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        @if (empty($project_results->date_end))
                        <span class="badge badge-primary">Ongoing</span>
                        @else
                        <span class="badge badge-success">Completed</span>
                        @endif
                        <input type="checkbox" name='id[]' class="checkbox" value="{{ $project_results->id }}"
                            autocomplete="off" style="display: none;" disabled>
                    </div>
                    <br>
                    <h6>{{ Str::limit($project_results->name, 30) }}</h6>
                    <img src="{{ Storage::url($project_results->image) }}" alt="" class="img-fluid rounded mt-1"
                        style="width:100%; height:200px; object-fit:cover;">
                    <div class="btn-group text-center buttonGroup mt-3" id="buttonGroup">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#editProject{{ $project_results->id }}"><i class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#deleteConfirm" onclick="deleteThisProject({{$project_results}})"><i
                                class="far fa-trash-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-dark" data-toggle="modal"
                            data-target="#more{{ $project_results->id }}">More</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</form>
