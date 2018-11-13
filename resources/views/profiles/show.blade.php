@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="pb-2 mt-4 mb-2 border-bottom">
                    <h1>
                        {{ $profileUser->name }}
                        <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                    </h1>
                </div>


            @foreach($threads as $thread)
                <div class="card mt-5">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                        <span>
                            <a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted {{ $thread->title }}
                        </span>
                            <span>
                            {{ $thread->created_at->diffForHumans() }}
                        </span>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
            @endforeach

            <div class="mt-5">
                {{ $threads->links() }}
            </div>
            </div>
        </div>
    </div>
@endsection
