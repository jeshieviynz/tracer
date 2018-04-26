@extends('alumni.alumni-app')

@section('content')



      <div class="box-header with-border home-alumni-bg">
        <h2>Department of Business Administration<br>
        <small class="box-title">This Survey aims to track down the whereabouts of the graduates of College of Business and Management under the Department of Business Administration.</small></h2>
      </div>







        <div class="content">
           
            <div id="AlumniInformation_Steps">


                <h2>Personal information</h2>
                <section>
                   <div class="box-body">

                    <form action="/PersonalInfoSurvey_Step1" method="GET" id="AlumniPersonalInfoForm">
                                
                    {{ csrf_field() }}
                        <div class="container-fluid">
                            
                    <div class="row">
                               @if( !$errors->isEmpty() )
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <ul>
                                        @foreach( $errors->all() as $error )
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif


                                <div class="col-md-12">
                                 
                                      <label>Personal information</label>


                                </div>




                                <div class="col-md-6">

                                  <div class="row">

                                      <div class="col-md-6">


                                      <input id="alumni_id" type="hidden" readonly class="form-control text-center form-alumni_id" name="alumni_id" placeholder="id" value="{{ Auth::user()->alumni_id }}" required>
                                  

                                         <input id="email" type="text" disabled="disabled" class="form-control text-center form-email" name="email" placeholder="First Name" value="{{ Auth::user()->firstname }}" required>

                                      </div>
                                      <div class="col-md-6">
                                          <input id="email" type="text" disabled="disabled" class="form-control text-center form-email" name="email" placeholder="Middle Name" value="{{ Auth::user()->middlename }}" required>
                                      </div>

                                </div>


                                </div>

                                <div class="col-md-6">

                                   <div class="row">


                                      <div class="col-md-6">
                                         <input id="email" type="text" disabled="disabled" class="form-control text-center form-email" name="email" placeholder="Last Name" value="{{ Auth::user()->lastname }}" required>
                                      </div>
                                      <div class="col-md-6">
                                         <input id="email" disabled="disabled" type="text" class="form-control text-center form-email" name="email" placeholder="example@gmail.com" value="{{ Auth::user()->email }}" required>
                                      </div>

                                    </div>
                                  
                                </div>
                        </div>


                    <br/>
                    <br/>


                    <div class="row">

                                <div class="col-md-12">
                                   <div class="col-md-6">


                                        <label>Home address</label>


                                   </div>

                                   <div class="col-md-6">



                                        <label>Contact Details</label>


                                   </div>


                                </div>


                                <div class="col-md-6">

                                  <div class="row">

                                      <div class="col-md-12">

                                        <div class="form-group{{ $errors->has('Address') ? ' has-error' : '' }}">
                                                <input id="Address"  type="text" class="form-control text-center form-Address" name="Address" placeholder=" Address" value="{{ old('Address') }}" required>
                                                <small class="form-text form-error home-address"></small>
                                        </div>


                                      </div>

                                </div>


                                </div>

                                <div class="col-md-6">

                                   <div class="row">


                                      <div class="col-md-6">

                                         <input id="Home_Phone" type="text" class="form-control text-center form-Home_Phone" name="Home_Phone" placeholder="Home Number" value="{{ old('Home_Phone') }}">

                                         <small class="form-text form-error home-phone"></small>


                                      </div>
                                      <div class="col-md-6">
                                         <input id="Mobile_Phone" type="text" class="form-control text-center form-Mobile_Phone" name="Mobile_Phone" placeholder="Mobile phone" value="{{ old('Mobile_Phone') }}">

                                           <small class="form-text form-error mobile-phone"></small>
                                      </div>

                                    </div>
                                  
                                </div>
                                
                            </div>

                   </form>


                  </div>



                </section>





                <h2>Employment Details</h2>
                <section class="Company_Details">

            <div class="box-body">
                    

                    <form action="/EmploymentInfoSurvey_Step2" method="GET" id="AlumniEmploymentInfoForm">
                                
                    {{ csrf_field() }}

                        <div class="container-fluid">
                                <div class="row">
                                  @if( !$errors->isEmpty() )
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <ul>
                                            @foreach( $errors->all() as $error )
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                      <input id="alumni_id" type="hidden" readonly class="form-control text-center form-alumni_id" name="alumni_id" placeholder="id" value="{{ Auth::user()->alumni_id }}" required>



                      <div class="row">

                           <div class="col-md-4">

                              <div class="col-md-12 align-center">
                                  <label>Employment</label>
                              </div>
                              <div class="form-group{{ $errors->has('Employment') ? ' has-error' : '' }}">
                                    <div class="row">
                                        <div class="form-group align-center employment-details">
                                            <div class="col-md-6">
                                                <input id="Employment" type="radio" class="text-center form-Employment" name="Employment" value="Employed" checked="checked">
                                                <label>Employed</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input id="Employment" type="radio" class="text-center form-Employment" name="Employment" value="Unemployed">
                                                <label>Unemployed</label>
                                            </div>
                                        </div>

                                        <small class="form-text form-error employment-error"></small> 
                                    </div>
                                       
                                </div>


                           </div>

                           <div class="col-md-8 employed_details">

                              <div class="row">
                                  <div class="col-md-6">
                                    <label class="text-center">Company Connected</label>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="text-center">Company Number</label>
                                  </div>

                                </div>




                                          

                                <div class="row">
                                       
                                              <div class="col-md-6 align-center">
                                                  <div class="form-group{{ $errors->has('Company_connected') ? ' has-error' : '' }}">
                                                          <input id="Company_connected"  type="text" class="form-control text-center form-Company_connected" name="Company_connected" placeholder="Company Connected" value="{{ old('Company_connected') }}" required>

                                                           <small class="form-text form-error Company_connected"></small>

                                                  </div>
                                              </div>

                                              <div class="col-md-6 align-center">
                                                  <div class="form-group{{ $errors->has('company_phone_number') ? ' has-error' : '' }}">
                                                          <input id="company_phone_number"  type="text" class="form-control text-center form-company_phone_number" name="company_phone_number" placeholder="Company Number" value="{{ old('company_phone_number') }}" required>

                                                           <small class="form-text form-error company_phone_number"></small>

                                                  </div>
                                              </div>
                                 </div>

                                 <br/>



                                  <div class="row">
                                    <div class="col-md-6">
                                      <label class="text-center">Company Address</label>
                                    </div>
                                    <div class="col-md-6">
                                      <label class="text-center">Employment Position</label>
                                    </div>

                                  </div>



                                  <div class="row"> 
                                            
                                            <div class="col-md-6 align-center">
                                                <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                                                        <input id="company_address"  type="text" class="form-control text-center form-company_address" name="company_address" placeholder="Company Address" value="{{ old('company_address') }}" required>

                                                         <small class="form-text form-error company_address"></small>

                                                </div>
                                            </div>

                                            <div class="col-md-6 align-center">
                                              
                                              <div class="form-group">
                                              <select class="form-control" id="Job_Information" name="job_title">
                                                      <option value="Accounting Manager">Accounting Manager</option>
                                                      <option value="Actuary">Actuary</option>
                                                      <option value="Administrative Services">Administrative Services</option>
                                                      <option value="Assistant Vice President">Assistant Vice President</option>
                                                      <option value="Regional Director">Regional Director</option>
                                                      <option value="Automotive Retail Salesperson">Automotive Retail Salesperson</option>
                                                      <option value="Bank Examiner">Bank Examiner</option>
                                                      <option value="Budget Analyst">Budget Analyst</option>
                                                      <option value="Chief Marketing Officer (CMO)">Chief Marketing Officer (CMO)</option>
                                                      <option value="Chief Operating Officers, Non-Profit Organization">Chief Operating Officers, Non-Profit Organization</option>
                                                      <option value="Corporate Sales Manager">Corporate Sales Manager</option>
                                                      <option value="Cost Engineer">Cost Engineer</option>
                                                      <option value="Director of Development, Non-Profit Organization">Director of Development, Non-Profit Organization</option>
                                                      <option value="Financial Adviser">Financial Adviser</option>
                                                      <option value="Financial Analyst">Financial Analyst</option>
                                                      <option value="Financial Planner">Financial Planner</option>
                                                      <option value="General Management Positions">General Management Positions</option>
                                                      <option value="Human Resource Manager">Human Resource Manager</option>
                                                      <option value="Management Analyst">Management Analyst</option>
                                                      <option value="Marketing Manager">Marketing Manager</option>
                                                      <option value="Payroll Director">Payroll Director</option>
                                                      <option value="Real Estate Broker">Real Estate Broker</option>
                                                      <option value="Senior Accountant">Senior Accountant</option>
                                                      <option value="Senior Benefits Analyst">Senior Benefits Analyst</option>
                                                      <option value="Senior System Administrator">Senior System Administrator</option>
                                                      <option value="Tax Compliance Manager">Tax Compliance Manager</option>
                                                      <option value="Tax Consultant">Tax Consultant</option>
                                                      <option value="Others">Others</option>
                                              </select>
                                            </div>

                                            <small class="form-text form-error job_title"></small>


                                            </div>
                                  </div>


                                  
                                <div class="row OtherJobInfo"> 
                                            
                                              <div class="col-md-12 align-center">
                                                  <div class="form-group">
                                                          <input  type="text" class="form-control text-center" name="other_Job_Info" placeholder="Other Job Information">

                                                           <small class="form-text form-error other_Job_Info"></small>

                                                  </div>
                                              </div>
                                  </div>





                           </div>

                      </div>
                  </div>

            </form>


            </div>





                </section>





                <h2>Done</h2>
                <section>
                    <div class="text-center"><h1>Thank You for getting in touch!</h1>
                       <h3> We are thrilled to hear from you.</h3>          
                    </div>
                </section>




            </div>
        </div>

 @endsection