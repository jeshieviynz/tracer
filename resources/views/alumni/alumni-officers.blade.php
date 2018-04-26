@extends('alumni.alumni-app')

@section('content')
	   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Alumni Officers
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="panel-heading">

              <div class="row">
                    <div class="col-md-8">
                              <div class="row">

                                <div class=" col-md-12 text-center">
                                  <img src="{{ asset('img/default.png') }}" id="officerPictureUp" alt="User Picture" onclick="document.getElementById('imgUpload').click();" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                  <input type="file" id="imgUpload" name="avatar" value="{{ Session::get('avatar') }}"  accept="image/*" style="display: none;">
                                  <div class="pull-center info ">
                                    <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                                    <p>PRESIDENT</p>
                                  </div>
                                </div>

                              </div>
                              
                              <div class="row">

                                <div class=" col-md-6 text-center">
                                  <img src="{{ asset('img/default.png') }}" id="officerPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                  <div class="pull-center info ">
                                    <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                                    <p>VICE PRESIDENT</p>
                                  </div>
                                </div>

                                 <div class=" col-md-6 text-center">
                                  <img src="{{ asset('img/default.png') }}" id="officerPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                  <div class="pull-center info ">
                                    <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                                    <p>SECRETARY</p>
                                  </div>
                                </div>

                              </div>

                              <div class="row">

                                <div class=" col-md-4 text-center">
                                  <img src="{{ asset('img/default.png') }}" id="officerPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                  <div class="pull-center info ">
                                    <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                                    <p>TREASURER</p>
                                  </div>
                                </div>

                                <div class="col-md-4 text-center">
                                  
                                </div>

                                <div class="col-md-4 text-center">
                                   <img src="{{ asset('img/default.png') }}" id="officerPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                  <div class="pull-center info ">
                                    <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                                    <p>AUDITOR</p>
                                  </div>
                                </div>

                              </div>

                                <div class="row">
                                  
                                  <div class="col-md-4 text-center">
                                     <img src="{{ asset('img/default.png') }}" id="officerPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                    <div class="pull-center info ">
                                      <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                                      <p>PIO</p>
                                    </div>
                                  </div>

                                  <div class="col-md-4 text-center">
                                     <img src="{{ asset('img/default.png') }}" id="officerPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                    <div class="pull-center info ">
                                      <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                                      <p>PIO</p>
                                    </div>
                                  </div>

                                  <div class="col-md-4 text-center">
                                     <img src="{{ asset('img/default.png') }}" id="officerPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                    <div class="pull-center info ">
                                      <span>{{ Auth::user()->lastname }}, {{ Auth::user()->firstname }}</span>
                                      <p>PIO</p>
                                    </div>
                                  </div>

                                </div>
                            
                            </div>
                      </div>
           </div>

    </section>
    <!-- /.content -->
  </div>

    @include('admin.footer.footer')



@endsection