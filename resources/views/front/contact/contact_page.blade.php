@extends('front._layouts._layout')
@section('content')

@include('front.contact.partials.title')

<div class="section">
    <div class="container">
        <div class="row">

            @include('front.contact.partials.contact_information')
            @include('front.contact.partials.contact_form')

        </div>
    </div>
</div> <!-- /.untree_co-section -->
@endsection
