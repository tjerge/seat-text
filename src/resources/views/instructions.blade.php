@extends('web::layouts.grids.12')

@section('title', trans('text::text.text'))
@section('page_header', trans('text::text.text'))
@section('page_description', trans('text::text.instructions'))

@push('head')
<link rel = "stylesheet"
   type = "text/css"
   href = "https://snoopy.crypta.tech/snoopy/seat-text-instructions.css" />
@endpush

@section('full')

<!-- Instructions -->
<div class="row w-100">
  <div class="col">
    <div class="card-deck">
      <div class="card">
        <div class="card-header" >Step 1</div>
        <div class="card-body">
          <p class="card-text">
            Click on the <span class="fa fa-plus-square"></span> on the top right of the text table in order to create a new text. This will open a modal where you can enter the required data.
          </p>
        </div>
      </div>
      <div class="card">
        <div class="card-header" >Step 2</div>
        <div class="card-body">
          <p class="card-text">
            Next enter the name of the page, (this is cosmetic, and only shown on the configure page). 
            The url is the url slug that the page will be accessible at. ie using a url of `testing` will mean that the text will be publicly available `http(s)://seat.your.domain/public/testing`
            Then the text is the raw ascii that will be served by the browser. This is freeform entry. Note that if you write html here, it will be interpreted as such by the browser.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Notes -->

<div class="row w-100 mt-3">
  <div class="col">
    <div class="card">
      <div class="card-header" >Notes</div>
      <div class="card-body">
        <div class="alert alert-info" role="alert">
          <h6 class="alert-heading">Accessibility</h6>
          <hr>
          I mean if you installed this plugin you know the point, and therefore the risk. All texts are publicly available.
        </div>
        <div class="alert alert-danger" role="alert">
          <h6 class="alert-heading">RISKY</h6>
          <hr>
          <p>There is no sanitisation on anything you place into a text, so long as it is ascii.</p>
          <p>This means you could host anything here, including anything from a custom staic webpage, to phishing sites, to malware. This is your (the installer) responsibility to manage!<p>
        </div>
      </div>
      <div class="card-footer text-muted">
        Plugin maintained by <a href="{{ route('text.about') }}"> {!! img('characters', 'portrait', 96057938, 64, ['class' => 'img-circle eve-icon small-icon']) !!} Crypta Electrica</a>. <span class="float-right snoopy" style="color: #fa3333;"><i class="fas fa-signal"></i></span>
      </div>
    </div>
  </div>
</div>

@stop