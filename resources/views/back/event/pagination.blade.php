<form action="{{ route('events.destroyAll') }}" method="post" id="destroyAllForm">
    @csrf
    <div class="row">
        @foreach ($event as $events)
        <div class="col-md-4">
            <div class="card" id="thisIs">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <input type="checkbox" name='id[]' class="checkbox mb-3" value="{{ $events->id }}"
                            autocomplete="off" style="display: none;" disabled>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6>{{ Str::limit($events->name, 30) }}</h6>
                        <h6>{{ $events->date }}</h6>
                    </div>
                    <img src="{{ Storage::url($events->image) }}" alt="" class="img-fluid rounded mt-1"
                        style="width:100%; height:200px; object-fit:cover;">
                    <div class="btn-group text-center buttonGroup mt-3" id="buttonGroup">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                            data-target="#editEvent{{ $events->id }}" onclick="validateEvent({{ $events->id }})"><i
                                class="far fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                            data-target="#deleteConfirm" onclick="deleteThisEvent({{$events}})"><i
                                class="far fa-trash-alt"></i></button>
                        <button type="button" class="btn btn-sm btn-dark" data-toggle="modal"
                            data-target="#more{{ $events->id }}">More</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</form>
<div class="d-flex justify-content-center">
    {{ $event->links('vendor.pagination.custom_pagination') }}
</div>