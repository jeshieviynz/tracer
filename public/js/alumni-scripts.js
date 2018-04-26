
$(function() {


    $(document).on('click',"input[type='radio']",{},function(e){

        if( $(this).val() == "Employed"){


            $(".employed_details").css("visibility","visible");


                if( $("#Job_Information").val() == "Others"){


                    $(".OtherJobInfo").css("display","block");

                    $("#AlumniEmploymentInfoForm").attr('action','/EmploymentInfoSurvey_Step2_Others');

                }else
                {

                     $(".OtherJobInfo").css("display","none");

                      $("#AlumniEmploymentInfoForm").attr('action','/EmploymentInfoSurvey_Step2');
                }



        }else
        {

             $(".employed_details").css("visibility","hidden");

              $("#AlumniEmploymentInfoForm").attr('action','/EmploymentInfoSurvey_Not_Employed');

        }


    });  

    



    $(document).on('change',"#Job_Information",{},function(e){

        if( $(this).val() == "Others"){


            $(".OtherJobInfo").css("display","block");

            $("#AlumniEmploymentInfoForm").attr('action','/EmploymentInfoSurvey_Step2_Others');

        }else
        {

             $(".OtherJobInfo").css("display","none");

              $("#AlumniEmploymentInfoForm").attr('action','/EmploymentInfoSurvey_Step2');
        }


    });  





        $("#AlumniInformation_Steps").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function( event, currentIndex, newIndex ){

            var next = false;

            if( currentIndex == 0 ){

                next = false;

                var formdata = $("form#AlumniPersonalInfoForm").serializeArray();
                 $.ajax({
                    url: "/PersonalInfoSurvey_Step1",
                    type:"GET", 
                    data: formdata,
                    async: false,
                    success: function(data){
            
                        if($.isEmptyObject(data.error)){

                            $(".form-error").html("");
                            $("#PersonalInfoSurvey_Step1 input[name='email']").val( $("form#UserAccountForm input[name='email']").val() );
                            $("#PersonalInfoSurvey_Step1 input[name='password']").val( $("form#UserAccountForm input[name='password']").val() );



                            next = true;
                            return true;

                        }else{

                            $(".form-error").html("");
                            $(".form-error.home-address").html(data.error['Address']);
                            $(".form-error.home-phone").html(data.error['Home_Phone']);
                            $(".form-error.mobile-phone").html(data.error['Mobile_Phone']);
                            

                            next = false;
                            return false;


                        }    
                    }



                });

            }



                if( currentIndex == 1 ){


                     next = false;


                        var formdata = $("form#AlumniEmploymentInfoForm").serializeArray();

                         $.ajax({
                            url: $("#AlumniEmploymentInfoForm").attr('action'),
                            type:"GET", 
                            data: formdata,
                            async: false,
                            success: function(data){


                                if($.isEmptyObject(data.error)){

                                    $(".form-error").html("");

                                    next = true;
                                    return true;

                                }else{

                                    $(".form-error").html("");
                                    $(".form-error.job_title").html(data.error['job_title']);
                                    $(".form-error.Company_connected").html(data.error['Company_connected']);
                                    $(".form-error.company_phone_number").html(data.error['company_phone_number']);
                                    $(".form-error.company_address").html(data.error['company_address']);
                                    $(".form-error.other_Job_Info").html(data.error['other_Job_Info']);

                                    next = false;
                                    return false;

                                }    
                            }



                        });



                  

                }

        

            if( currentIndex == 2 ){

                
                next = true;
                return true;

            }


            return next ;

        

        },
        onFinished: function (event, currentIndex){

            alert("Thank for participating the survey.");

            window.location.replace("/home");


        }



    });





















        $(document).on('submit','form#alumniDetailsform-step1',{},function(e){
            e.preventDefault();

             var formdata = $(this).serializeArray();

             
             $.ajax({
                    url:'/filloutstep1',
                    type:"POST",
                    data:formdata,
                    success: function(data)
                    {    
                        if($.isEmptyObject(data.error)){

                        	if( data.employment == "Employed"){

                             window.location = "/filloutstep3";

                        	}else{

                             window.location = "/filloutstep2";

                        	}


                        }
                        else    
                        {
                        	$("#alumniDetailsform-step1 .form-error").html("");
                            $("#alumniDetailsform-step1 .form-error.home-address").html(data.error['Address']);
                            $("#alumniDetailsform-step1 .form-error.home-phone").html(data.error['Home_Phone']);
                            $("#alumniDetailsform-step1 .form-error.mobile-phone").html(data.error['Mobile_Phone']);
                            $("#alumniDetailsform-step1 .form-error.employment-error").html(data.error['Employment']);

                            
                        }



                        
                    },
                    error: function (data) 
                    {
                       alert(data.status);
                    }
             });



        });



        $(document).on('submit','form#alumniDetailsform-step2',{},function(e){
            e.preventDefault();

             var formdata = $(this).serializeArray();



             $.ajax({
                    url:'/filloutstep2',
                    type:"POST",
                    data:formdata,
                    success: function(data)
                    {    

                    	console.log(data);

                        if($.isEmptyObject(data.error)){

                             window.location = "/filloutstep3";

                        }
                        else    
                        {
                        	$("#alumniDetailsform-step2 .form-error").html("");
                            $("#alumniDetailsform-step2 .form-error.job_place").html(data.error['job_place']);
                            $("#alumniDetailsform-step2 .form-error.job_title").html(data.error['job_title']);
                            $("#alumniDetailsform-step2 .form-error.Company_connected").html(data.error['Company_connected']);
                            $("#alumniDetailsform-step2 .form-error.company_phone_number").html(data.error['company_phone_number']);
                            $("#alumniDetailsform-step2 .form-error.company_address").html(data.error['company_address']);

                        }



                        
                    },
                    error: function (data) 
                    {
                       alert(data.status);
                    }
             });



        });




        $(document).on('click','.actionViewEventDetailsBtn',{},function(e){

            e.preventDefault();

             var eventId = $(this).attr('id');


             $.ajax({
                    url:'/alumni/event',
                    type:"GET",
                    data: { 'id' : eventId },
                    success: function(data)
                    {    

                    	$("#ViewEventDetailsModal .title").html(data.title);
                    	$("#ViewEventDetailsModal .time").html(data.time);
                    	$("#ViewEventDetailsModal .date").html(data.date);
                    	$("#ViewEventDetailsModal .venue").html(data.venue);
                    	$("#ViewEventDetailsModal .description").html(data.description);

              			$("#ViewEventDetailsModal").modal("show");

                    },
                    error: function (data) 
                    {
                       alert(data.status);
                    }
             });



        });



        $(document).on('click','.eventList-item',{},function(e){

            e.preventDefault();

             var eventId = $(this).attr('id');
             $('.eventList-item').removeClass('selected');
             $(this).addClass('selected');

             $.ajax({
                    url:'/alumni/event',
                    type:"GET",
                    data: { 'id' : eventId },
                    success: function(data)
                    {   
                        $(".eventList-con-desc .view-event-desc").html("");
                        $(".eventList-con-desc .view-event-title").html(data.title);
                        $(".eventList-con-desc .view-event-batch").html(data.eventBatch);
                        $(".eventList-con-desc .view-event-date").html(data.date + " " + data.time);
                        $(".eventList-con-desc .view-event-venue").html(data.venue);
                        $(".eventList-con-desc .view-event-desc").html(data.description);


                    },
                    error: function (data) 
                    {
                       alert(data.status);
                    }
             });



        });













 });