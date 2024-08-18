@extends('admin.layout.layout')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold" style="color: #fff !important">Welcome {{ Auth::user()->name }}</h3>
              <h6 class="font-weight-normal mb-0" style="color: #fff !important">All systems are running smoothly!</h6>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col grid-margin transparent text-center">
          <div class="row">
            <div class="col mb-4 stretch-card transparent">
              <div class="card card">
                <div class="card-body">
                  <p class=" font-weight-bold mb-4">Total Contact Us Messages</p>
                  <p class=" font-weight-bold fs-30 mb-2">20 </p>
                </div>
              </div>
            </div>
            <div class="col mb-4 stretch-card transparent">
              <div class="card card">
                <div class="card-body">
                  <p class="font-weight-bold mb-4">Total Consultations</p>
                  <p class="font-weight-bold fs-30 mb-2">10</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
              <div class="card card">
                <div class="card-body">
                  <p class="font-weight-bold mb-4">Total Users</p>
                  <p class="font-weight-bold fs-30 mb-2">15</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection