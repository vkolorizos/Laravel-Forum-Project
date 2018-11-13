@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($threads as $thread)
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="level d-flex align-content-center">
                            <h4 class="d-flex flex-grow-1">
                                <a href="{{$thread->path()}}">
                                    {{$thread->title}}
                                </a>
                            </h4>

                            <a class="text-right" style="flex-basis: 70px;" href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply',$thread->replies_count) }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="body">{{ $thread->body }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
