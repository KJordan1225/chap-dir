@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Add Member</h2>

    <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
        @include('members._form')
        <div class="mt-3">
            <button class="btn btn-primary">Create</button>
            <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection