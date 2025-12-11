@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Reference List</h1>
    <p class="text-gray-600 mb-4">Browse all references below.</p>
    {{-- You can include your reference table or list here --}}
    @include('admin.references.index')
</div>
@endsection
