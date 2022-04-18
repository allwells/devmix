@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-center align-items-start">
        <div class="bg-light rounded py-3 mt-5 w-50 px-3">
            <x-post :post="$post" />
        </div>
    </div>
@endsection
