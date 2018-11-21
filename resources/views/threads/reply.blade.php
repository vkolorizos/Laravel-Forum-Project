<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card my-3">
        <div class="card-header">
            <div class="d-flex flex-grow-1 justify-content-between">
                <h5>
                    <a href="{{ route('profile', $reply->owner->name) }}">
                        {{ $reply->owner->name }}
                    </a> said {{ $reply->created_at->diffForHumans() }}...
                </h5>
                <div>
                    <favorite :reply="{{ $reply }}"></favorite>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button class="btn btn-sm btn-primary mr-2" @click="update">Update</button>
                <button class="btn btn-sm btn-link mr-2" @click="editing = false">Cancel</button>
            </div>
            <div v-else v-text="body"></div>
        </div>
        @can('update',$reply)
            <div class="card-footer d-flex">
                <button class="btn btn-primary btn-sm mr-2" @click="editing = true">Edit</button>
                <button class="btn btn-danger btn-sm mr-2" @click="destroy">Delete</button>
            </div>
        @endcan
    </div>
</reply>