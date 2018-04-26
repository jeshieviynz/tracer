

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#UserPictureUp').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]);
        }
    }

function reloadDataTable_WithPrint( title_header, count, printed_by ) {

    $("#alumni-table-report").DataTable({
        "scrollY":        "320px",
        "scrollCollapse": true,
        drawCallback: function(settings) {
            var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
            pagination.toggle(this.api().page.info().pages > 1);
          },
        columnDefs: [
             { "width": "5px", "targets": 0 },
              { "width": "200px", "targets": 1 },
              { "width": "200px", "targets": 2 }
        ],
        fixedColumns: true,
        dom: 'Bfrtip',
          buttons: {
            buttons: [{
              extend: 'print',
              text: '<i class="fa fa-print"></i> Print',
              title: " ",
              exportOptions: {
                columns: ':not(.no-print)'
              },
              footer: true,
              header: true,
              autoPrint: true,
              customize: function ( win ) {

                  // Style the body..
                  $( win.document.body ).addClass('asset-print-body');

                  $( win.document.body ).prepend('<div class="header-title">' + title_header + '</div>');
                  $( win.document.body ).prepend("<div class='header-title'><img src='"+ $("#logo").attr('src') +"'></div>"); 
                  $( win.document.body ).append('<div class="footer-left">' +  printed_by+ '</div>');
                  $( win.document.body ).append('<div class="footer-right">' + count + '</div>');
   
                  /* Style for the table */
                  $( win.document.body ).find( 'table' ).addClass( 'asset-print-table' );
             
              }
            } , {

              extend: 'pdf',
              text: '<i class="fa fa-file-pdf-o"></i> PDF',
              title: title_header,
              exportOptions: {
                columns: ':not(.no-print)'
              },
              footer: true,
              header: true,
              filename: function(){
                var d = new Date();
                var n = d.getTime();
                return 'report' + n;
              },
              pageSize: 'LEGAL'

            },{

              extend: 'excel',
              text: '<i class="fa fa-file-excel-o"></i> EXCEL',
              title: title_header,
              exportOptions: {
                columns: ':not(.no-print)'
              },
              footer: true,
              header: true,
              filename: function(){
                var d = new Date();
                var n = d.getTime();
                return 'report' + n;
              },
              pageSize: 'LEGAL'

            }],
            dom: {
              container: {
                className: 'dt-buttons'
              },
              button: {
                className: 'btn btn-default'
              }
            }
          }
    });


    if( $('.dataTables_scrollBody').length > 0) {
        $('.dataTables_scrollBody').slimScroll({
            height: '190px',
            wheelStep: 2,
        });
    }



}


    function fullcalendar(){

      $('#calendar').fullCalendar({
        "scrollY":        "320px",
        "scrollCollapse": true,
        theme: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'

        },

        select: function(start, end, allDay) {
          var check = start.format("YYYY-MM-DD");
          var today = moment().format("YYYY-MM-DD");
          if(check < today)
          {
              $("#errorModal .feedback-message").html( "Cannot add event in past days." );
              $("#errorModal").modal("show");
          }
          else
          {
             $("#createeventModal").modal("show");
          }
        },

        defaultDate: new Date(),
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectHelper: true,

        dayClick: function( date, jsEvent, view ) {

            $(".form-error").html("");
             $("#createeventModal input[name='start']").val( moment( date ).format('MM/DD/YYYY  hh:mm A') );
             $("#createeventModal input[name='end']").val( moment( date ).add(1,'hours').format('MM/DD/YYYY  hh:mm A') );

        },
        eventClick: function( calEvent, JsEvent, view){


            $.ajax({
                url: '/events/getevent',
                type:"GET", 
                data: { "id": calEvent.id },
                success: function(data){    
                    
                    var eventBatch = data.eventBatch.split(',');

                    $("#eventBatch1").val(eventBatch);
                    $("#eventBatch1").multiselect('refresh');
                    $("#eventBatch1").multiselect('select', eventBatch);
                    
        
                    $("#updateEventForm .deleteEvent").attr( 'id', data.id );
                    $("#updateEventForm .resetEvent").attr( 'id', data.id );

                    if( data.status == "cancelled"){

                      $("#updateEventForm .updateEvent").hide();
                      $("#updateEventForm .deleteEvent").hide();
                      $("#updateEventForm .resetEvent").show();
                      

                    }else if( data.status == "upcoming" ){

                      $("#updateEventForm .updateEvent").show();
                      $("#updateEventForm .deleteEvent").show();
                      $("#updateEventForm .resetEvent").hide();
                    }else{
                      
                      $("#updateEventForm .updateEvent").hide();
                      $("#updateEventForm .deleteEvent").hide();
                      $("#updateEventForm .resetEvent").hide();

                    }



                    $("#updateEventForm input[name='id']").val( data.id );
                    $("#updateEventForm input[name='title']").val( data.title );
                    $("#updateEventForm input[name='start']").val( moment( data.start ).format('MM/DD/YYYY hh:mm A') );
                    $("#updateEventForm input[name='end']").val( moment( data.end ).format('MM/DD/YYYY hh:mm A') );
                    $("#updateEventForm input[name='venue']").val( data.venue );
                    $("#updateEventForm select[name='eventBatch']").val( data.eventBatch );

                    $("#updateEventForm .note-editable").html("");
                    $("#updateEventForm .note-editable").html( data.description );
                    $("#updateEventModal").modal("show");


                },
                error: function (data) {
                    alert(data.status);
                }

            });

        
        },

        editable: false,
        eventLimit: true, // allow "more" link when too many events
        eventRender : function( event , element ){

            element.attr('id', event.id);


        }
        
    });

      $.ajax({
        url: '/events/getevents',
        type:"GET", 
        success: function(data){ 

             $('#calendar').fullCalendar( 'addEventSource' , data.events);
        },
        error: function (data) {
            alert(data.status);
            }

            });

  }






$(function() {





$("#eventBatch").multiselect({

  includeSelectAllOption : true,

});

$("#eventBatch1").multiselect({

  includeSelectAllOption : true,

});



$('.eventdatepicker').datetimepicker({
    viewMode: 'months',
    showTodayButton: true,
    sideBySide: true,
    minDate: moment().subtract(0, 'years').startOf('year')
});




if( $('.users-panel').length > 0 ) {
    $('.users-panel').slimScroll({
      height: '466px',
      wheelStep: 2,
    });
  }

    $("#users-table").DataTable();
    $("#alumni-table").DataTable();
    $("#event-table").DataTable();


    $(document).on('click','.delete-user', {} ,function(e){
                                       
            var userid = $(this).attr('id');
            $("#DeleteUserModal #deleteForm").attr('action','/users/' + userid + "/delete");
              $("#DeleteUserModal").modal("show");

    });

     $("#imgUpload").change(function () {
                readURL1(this);
        });
        





      $(document).on('click','.active-user', {} ,function(e){

                var userid = $(this).attr('id');
                $("#activeUserModal #activeForm").attr('action','/users/' + userid + "/toactive");
                  $("#activeUserModal").modal("show");

        });

        $(document).on('click','.edit-user', {} ,function(e){

                var userid = $(this).attr('id');



                 $.ajax({
                url: "/user",
                type:"GET", 
                data: {"id":userid}, 
                success: function(result){

                  $("#UpdateUserAccountModal #UserPictureUp").attr('src',result.avatar);
                    $("#UpdateUserAccountModal input[name='username']").val(result.username);
                    $("#UpdateUserAccountModal input[name='firstname']").val(result.firstname);
                    $("#UpdateUserAccountModal input[name='lastname']").val(result.lastname);
                    $("#UpdateUserAccountModal input[name='middlename']").val(result.middlename);
                    $("#UpdateUserAccountModal input[name='email']").val(result.email);
                    $("#UpdateUserAccountModal input[name='id']").val(result.id);
                    $("#UpdateUserAccountModal select[name='userrole'] option").filter(function(){
                        return($(this).val()==result.role_id);
                    }).prop('selected',true);
                    
                    $("#UpdateUserAccountModal").modal("show");     
                    },
                error: function (data) {
                    alert(data.status);
                    }
                 });

        });


        $(document).on('click','.edit-user-profile', {} ,function(e){

                var userid = $(this).attr('id');



                 $.ajax({
                url: "/user",
                type:"GET", 
                data: {"id":userid}, 
                success: function(result){

                    $("#UpdateUserProfileModal #UserPictureUp").attr('src',result.avatar);
                    $("#UpdateUserProfileModal input[name='username']").val(result.username);
                    $("#UpdateUserProfileModal input[name='firstname']").val(result.firstname);
                    $("#UpdateUserProfileModal input[name='lastname']").val(result.lastname);
                    $("#UpdateUserProfileModal input[name='middlename']").val(result.middlename);
                    $("#UpdateUserProfileModal input[name='email']").val(result.email);
                    $("#UpdateUserProfileModal input[name='id']").val(result.id);
                    
                    $("#UpdateUserProfileModal").modal("show");     
                    },
                error: function (data) {
                    alert(data.status);
                    }
                 });

        });

        $(document).on('click','.view-user', {} ,function(e){

                var userid = $(this).attr('id');


                 $.ajax({
                url: "/user",
                type:"GET", 
                data: {"id":userid}, 
                success: function(result){

                    $("#ViewUserAccountModal input[name='username']").html(result.username);
                     $("#ViewUserAccountModal #UserPictureUp").attr('src',result.avatar);
                    $("#ViewUserAccountModal #firstname").html(result.firstname);
                    $("#ViewUserAccountModal #lastname").html(result.lastname);
                    $("#ViewUserAccountModal #middlename").html(result.middlename);
                    $("#ViewUserAccountModal #email").html(result.email);
                    $("#ViewUserAccountModal #username").html(result.username);
                    if( result.status == 1 ){
                      $("#ViewUserAccountModal #Status").html("Active");
                    }else{
                      $("#ViewUserAccountModal #Status").html("Not Active");
                    }
                    
                    $("#ViewUserAccountModal #lastloggedin").html(result.lastLogged);
                    $("#ViewUserAccountModal").modal("show");     
                    },
                error: function (data) {
                    alert(data.status);
                    }
                 });

        });



        $(document).on('click','.view-activities', {} ,function(e){

                var userid = $(this).attr('id');


                 $.ajax({
                url: "/events/getevent",
                type:"GET", 
                data: {"id":userid}, 
                success: function(result){
                  console.log(result);

                    $("#ViewActivitiesAccountModal #id").html(result.id);
                    $("#ViewActivitiesAccountModal #title").html(result.title);
                    $("#ViewActivitiesAccountModal #venue").html(result.venue);
                    $("#ViewActivitiesAccountModal #date").html(result.date);
                    $("#ViewActivitiesAccountModal #time").html(result.time);
                    $("#ViewActivitiesAccountModal #description").html(result.description);
                    $("#ViewActivitiesAccountModal #status").html(result.status);
                    $("#ViewActivitiesAccountModal #eventBatch").html(result.eventBatch);

                    $("#ViewActivitiesAccountModal").modal("show");  

                    if( $('#description').length > 0) {
                        $('#description').slimScroll({
                            height: '350px',
                            wheelStep: 2,
                        });
                    }



                    },
                error: function (data) {
                    alert(data.status);
                    }
                 });

        });

          
            //Alumni modal

       $(document).on('click','.login-alumni', {} ,function(e){
            $("#loginModal").modal("show");
        });

       $(document).on('click','.active-alumni', {} ,function(e){

                var userid = $(this).attr('id');
                $("#activeAlumniModal #activeForm").attr('action','/alumni/' + userid + "/toactiveAlumni");
                  $("#activeAlumniModal").modal("show");

        });

        $(document).on('click','.delete-alumni', {} ,function(e){

                var userid = $(this).attr('id');
                $("#DeleteAlumniModal #deleteForm").attr('action','/alumni/' + userid + "/deleteAlumni");
                  $("#DeleteAlumniModal").modal("show");

        });


        $(document).on('click','.alumni-user', {} ,function(e){
                
                $("#InputNAmeModal #inputNameForm").attr('action','/alumni/' + userid + "/deleteAlumni");
                  $("#InputNAmeModal").modal("show");

        });


        $(document).on('click','.alumni-record', {} ,function(e){
       
                var userid = $(this).attr('id');
                 $.ajax({
                url: "/alumni",
                type:"GET", 
                data: {"id":userid}, 
                success: function(result){

                    $("#UpdateUserAccountModal input[name='firstname']").val(result.firstname);
                    $("#UpdateUserAccountModal input[name='lastname']").val(result.lastname);
                    $("#UpdateUserAccountModal input[name='middlename']").val(result.middlename);
                    
                    $("#UpdateUserAccountModal").modal("show");     
                    },
                error: function (data) {
                    alert(data.status);
                    }
                 });
        });






    $(document).on('click','#AddEventBtn', {} ,function(e){

      $('.summernote').summernote({
            height: 200,
            disableResizeEditor: true
      });



      $(".form-error").html("");

      $("#createeventModal input[name='start']").val( moment().add(2,'weeks').format('MM/DD/YYYY  hh:mm A') );
      $("#createeventModal input[name='end']").val( moment().add(2,'weeks').add(1,'hours').format('MM/DD/YYYY  hh:mm A') );

      $("#createeventModal").modal("show");


    });







        $(document).on('click','.cancelEventBtn', {} ,function(e){
            e.preventDefault();  

            var title = "CANCEL EVENT";
            var message = "Are you sure you want to cancel this event ?";

            var reloadList = "Event-List";

            $("#EventerrorModal .modal-title").html( title );
            $("#EventerrorModal .modal-message").html( message );

            $("#EventerrorModal .modal-header").removeClass("modal-success");
            $("#EventerrorModal .action-confirm").removeClass("btn-success");
            $("#EventerrorModal .modal-header").addClass("modal-danger");
            $("#EventerrorModal .action-confirm").addClass("btn-danger");
            $("#EventerrorModal .reloadList").val(reloadList);

            $("#EventerrorModal #EventerrorModal").attr("action", "/events");
            $("#EventerrorModal #EventerrorModal").attr("method", "POST");

            $("#EventerrorModal .SelectedId").val( $(this).attr("id") );
            $("#EventerrorModal").modal("show");

    });

        $(document).on('click','.resumeEventBtn', {} ,function(e){

            var title = "RE OPEN EVENT";
            var message = "Are you sure you want to re open this event ?";

            var reloadList = "Event-List";

            $("#UpdateAlumniAccountModal .modal-title").html( title );
            $("#UpdateAlumniAccountModal .modal-message").html( message );

            $("#UpdateAlumniAccountModal .modal-header").removeClass("modal-danger");
            $("#UpdateAlumniAccountModal .action-confirm").removeClass("btn-danger");
            $("#UpdateAlumniAccountModal .modal-header").addClass("modal-success");
            $("#UpdateAlumniAccountModal .action-confirm").addClass("btn-success");
            $("#UpdateAlumniAccountModal .reloadList").val(reloadList);

            $("#UpdateAlumniAccountModal #UpdateAlumniAccountModal").attr("action", "/events");
            $("#UpdateAlumniAccountModal #UpdateAlumniAccountModal").attr("method", "POST");

            $("#EventresetModal .SelectedId").val( $(this).attr("id") );
            $("#EventresetModal").modal("show");
             $("#EventActionModal").modal("hide");

    });

    

    $(document).on('click','.updateEventShowModal', {} ,function(e){



      $('.summernote').summernote({
            height: 200,
            disableResizeEditor: true
      });



      $.ajax({
          url: '/events/getevent',
          type:"GET", 
          data: { "id": $(this).attr("id") },
          success: function(data){    
              
              var eventBatch = data.eventBatch.split(',');

              $("#eventBatch1").val(eventBatch);
              $("#eventBatch1").multiselect('refresh');
              $("#eventBatch1").multiselect('select', eventBatch);
              
  
              $("#updateEventForm .deleteEvent").attr( 'id', data.id );
              $("#updateEventForm .resetEvent").attr( 'id', data.id );

              if( data.status == "cancelled"){

                $("#updateEventForm .updateEvent").hide();
                $("#updateEventForm .deleteEvent").hide();
                $("#updateEventForm .resetEvent").show();
                

              }else if( data.status == "upcoming" ){

                $("#updateEventForm .updateEvent").show();
                $("#updateEventForm .deleteEvent").show();
                $("#updateEventForm .resetEvent").hide();

              }else{
                
                $("#updateEventForm .updateEvent").hide();
                $("#updateEventForm .deleteEvent").hide();
                $("#updateEventForm .resetEvent").hide();

              }


              $("#updateEventForm input[name='id']").val( data.id );
              $("#updateEventForm input[name='title']").val( data.title );
              $("#updateEventForm input[name='start']").val( moment( data.start ).format('MM/DD/YYYY hh:mm A') );
              $("#updateEventForm input[name='end']").val( moment( data.end ).format('MM/DD/YYYY hh:mm A') );
              $("#updateEventForm input[name='venue']").val( data.venue );
              $("#updateEventForm select[name='eventBatch']").val( data.eventBatch );

              $("#updateEventForm .note-editable").html("");
              $("#updateEventForm .note-editable").html( data.description );
              $("#updateEventModal").modal("show");


          },
          error: function (data) {
              alert(data.status);
          }

      });


        

      });



      $(document).on('click','.edit-alumni', {} ,function(e){
                
                var recordid = $(this).attr('id');
                 $.ajax({
                url: "/alumni/get",
                type:"GET", 
                data: {"id":recordid}, 
                success: function(result){
                    
                    $("#UpdateAlumniAccountModal input[name='username']").val(result.Alumni_ID_Number);
                    $("#UpdateAlumniAccountModal input[name='firstname']").val(result.First_Name);
                    $("#UpdateAlumniAccountModal input[name='lastname']").val(result.Last_Name);
                    $("#UpdateAlumniAccountModal input[name='middlename']").val(result.Middle_Name);
                    $("#UpdateAlumniAccountModal input[name='email']").val(result.Email);
                    $("#UpdateAlumniAccountModal input[name='id']").val(result.id);

                    $("#UpdateAlumniAccountModal input[name='Birthday']").val(result.Birthdate);
                    $("#UpdateAlumniAccountModal input[name='year_graduated']").val(result.Year_Graduated);
                    
                    $("#UpdateAlumniAccountModal select[name='course'] option").filter(function(){
                        return ($(this).val()==result.Course);
                    }).prop('selected','selected');

                    $("#UpdateAlumniAccountModal input[name='address']").val(result.Address);
                    $("#UpdateAlumniAccountModal input[name='homephone']").val(result.Home_Phone);
                    $("#UpdateAlumniAccountModal input[name='mobilephone']").val(result.Mobile_Phone);

                    
                    $("#UpdateAlumniAccountModal").modal("show");     
                    },
                    error: function (data) {
                    alert(data.status);
                    }
                 });
        });



      $(document).on('submit','#updateAlumniForm', {} ,function(e){
                
             e.preventDefault()

            var formdata = $(this).serializeArray();

                 $.ajax({
                  url: $(this).attr('action'),
                  type:"POST",
                  data:formdata,
                  success: function(data)
                  {    

                      if($.isEmptyObject(data.error))
                      {   

                        $("#UpdateAlumniAccountModal .form-error").html("");
                        $("body #Alumni-List").html(data.content);
                        $("#alumni-table").DataTable();
                        $("#successModal .feedback-message").html( data.success );
                        $("#successModal").modal("show");
                        $("#UpdateAlumniAccountModal").modal("hide"); 
                      }
                       else
                      {    

                           $("#UpdateAlumniAccountModal .form-error").html("");

                          $("#UpdateAlumniAccountModal .form-error.username").html(data.error['username']);
                          $("#UpdateAlumniAccountModal .form-error.firstname").html(data.error['firstname']);
                          $("#UpdateAlumniAccountModal .form-error.lastname").html(data.error['lastname']);
                          $("#UpdateAlumniAccountModal .form-error.middlename").html(data.error['middlename']);
                          $("#UpdateAlumniAccountModal .form-error.email").html(data.error['email']);

                          $("#UpdateAlumniAccountModal .form-error.Birthday").html(data.error['Birthday']);
                          $("#UpdateAlumniAccountModal .form-error.year_graduated").html(data.error['year_graduated']);
                          

                          $("#UpdateAlumniAccountModal .form-error.address").html(data.error['address']);
                          $("#UpdateAlumniAccountModal .form-error.homephone").html(data.error['homephone']);
                          $("#UpdateAlumniAccountModal .form-error.mobilephone").html(data.error['mobilephone']);
                      }




                      
                  },
                  error: function (data) 
                  {
                     alert(data.status);
                  }
                  });


        });





      $(document).on('submit','#addAlumniForm', {} ,function(e){
                
             e.preventDefault()

            var formdata = $(this).serializeArray();

                 $.ajax({
                  url: $(this).attr('action'),
                  type:"POST",
                  data:formdata,
                  success: function(data)
                  {    

                      if($.isEmptyObject(data.error))
                      {   

                        $(".form-error").html("");
                        $("body #Alumni-List").html(data.content);
                        $("#alumni-table").DataTable();
                        $("#successModal .feedback-message").html( data.success );
                        $("#successModal").modal("show");
                        $("#AddAlumniAccountModal").modal("hide"); 
                      }
                       else
                      {    

                           $(".form-error").html("");

                          $(".form-error.username").html(data.error['username']);
                          $(".form-error.firstname").html(data.error['firstname']);
                          $(".form-error.lastname").html(data.error['lastname']);
                          $(".form-error.middlename").html(data.error['middlename']);
                          $(".form-error.email").html(data.error['email']);

                          $(".form-error.Birthday").html(data.error['Birthday']);
                          $(".form-error.year_graduated").html(data.error['year_graduated']);
                          

                          $(".form-error.address").html(data.error['address']);
                          $(".form-error.homephone").html(data.error['homephone']);
                          $(".form-error.mobilephone").html(data.error['mobilephone']);
                      }




                      
                  },
                  error: function (data) 
                  {
                     alert(data.status);
                  }
                  });


        });





            $(document).on('click','.details-alumni', {} ,function(e){

                var userid = $(this).attr('id');


                 $.ajax({
                url: "/alumni/get",
                type:"GET", 
                data: {"id":userid}, 
                success: function(result){

                    $("#graduateDetailsModal input[name='alumni_id_number']").html(result.alumni_id_number);
                    $("#graduateDetailsModal #First_Name").html(result.First_Name);
                    $("#graduateDetailsModal #Last_Name").html(result.Last_Name);
                    $("#graduateDetailsModal #middle_name").html(result.middle_name);
                    $("#graduateDetailsModal #Email").html(result.Email);
                    $("#graduateDetailsModal #alumni_id_number").html(result.alumni_id_number);
                    if( result.status == 1 ){
                      $("#graduateDetailsModal #Account").html("Traced");
                    }else{
                      $("#graduateDetailsModal #Account").html("Not traced");
                    }
                    
                    $("#graduateDetailsModal #lastloggedin").html(result.lastLogged);
                    $("#graduateDetailsModal").modal("show");     
                    },
                error: function (data) {
                    alert(data.status);
                    }
                 });

        });

      $('#datepicker').datepicker({
          autoclose: true
        });


        $("#full-list").click(function(){
            $("#user-list").addClass("col-md-12");
            $("#user-list").removeClass("col-md-8");
            $("#user-information-con").hide();
            $("#full-list").hide();
        });

        $(document).on('click','#actionDeleteUserBtnShowModal', {} ,function(e){

            var userid = $("#selectedUserId").html();

            $.ajax({
            url: "/user",
            type:"GET", 
            data: {"id":userid}, 
            success: function(result){

                $("#DeleteUserModal .user-picture-container img").attr('src',result[0].url_thumb);
                $("#DeleteUserModal input[name='email']").val(result[0].email);
                $("#DeleteUserModal").modal("show");
                
                },
            error: function (data) {
                alert(data);
                }
             });

        });
            

             
  $("#alumniSearch").on('submit',function(e){
            e.preventDefault();

        var formdata = $("form#alumniSearch").serializeArray();


        $.ajax({
        url: $("form#alumniSearch").attr('action'),
        type: $("form#alumniSearch").attr('method'),
        data: formdata ,
        success: function(data){   
            
           if($.isEmptyObject(data.error))
            {   
                $("#accountAlumniModal input[name='username']").val(data.alumni['Alumni_ID_Number']);
                $("#accountAlumniModal input[name='email']").val("");
                $("#accountAlumniModal input[name='password']").val("");
                $("#accountAlumniModal input[name='password_confirmation']").val("");
                $("#accountAlumniModal").modal("show");
                $("#loginModal").modal("hide");
            }
             else
            {    
                $("#errorModal .feedback-message").html( data.error );
                $("#errorModal").modal("show");
            }

            },
                error: function (data) 
            {
                alert(data.status);
            }

        });

        return false;

    }); 






        $(document).on('click','#createAcount', {} ,function(e){
            e.preventDefault();

        var formdata = $("form#accountUser").serializeArray();
            

        $.ajax({
        url: '/createaccount    ',
        type: 'POST',
        data: formdata ,
        async: true,
        success: function(data){   

           if($.isEmptyObject(data.error))
            {
                 
                $("#successModal").modal("show");
                $("#accountAlumniModal").modal("hide");
            }
             else
            {    
                $("#accountAlumniModal .form-error").html("");
                $("#accountAlumniModal .form-error.username").html(data.error['username']);
                $("#accountAlumniModal .form-error.email").html(data.error['email']);
                $("#accountAlumniModal .form-error.password").html(data.error['password']);
                $("#accountAlumniModal .form-error.password_confirmation").html(data.error['password_confirmation']);
            }
            },
                error: function (data) 
            {
                alert(data.status);
            }

        });

        return false;

    });  






        $("#alumniInfoform").on('submit',function(e){
                    e.preventDefault();

                var formdata = $("form#alumniInfoform").serializeArray();


                $.ajax({
                url: $("form#alumniInfoform").attr('action'),
                type: $("form#alumniInfoform").attr('method'),
                data: formdata ,
                success: function(data){   
                    
                   if($.isEmptyObject(data.error))
                    {   
                        $("#step2Modal input[name='alumni_id']").val(data.alumni['alumni_id']);
                        $("#step2Modal").modal("show");
                        $("#infoModal").modal("hide");
                    }
                     else
                    {    
                        $("#errorModal .feedback-message").html( data.error );
                        $("#errorModal").modal("show");
                    }
                    },
                        error: function (data) 
                    {
                        alert(data.status);
                    }

                });

                return false;

            }); 




if (window.location.pathname == "/dashboard"){
 


       $.ajax({
          url: "/graph",
          type:"GET",
          success: function(data){ 

          var count_traced_p = parseFloat ( ( ( data.traced['y'] / data.graduated['y'] ) * 100 ).toFixed(2) )|| 0 ;
          var count_untraced_p = parseFloat ( ( ( data.untraced['y'] / data.graduated['y'] ) * 100 ).toFixed(2) ) || 0;
          var count_employed_p =  parseFloat ( ( ( data.employed['y'] / data.traced['y'] ) * 100 ).toFixed(2) ) || 0;
          var count_unemployed_p =  parseFloat ( ( ( data.unemployed['y'] / data.traced['y'] ) * 100 ).toFixed(2) ) || 0;
          var count_related_p =  parseFloat ( ( ( data.related['y'] / data.employed['y'] ) * 100 ).toFixed(2) ) || 0;
          var count_unrelated_p =  parseFloat ( ( ( data.unrelated['y'] / data.employed['y'] ) * 100 ).toFixed(2) ) || 0;

          $("body #tracer_percentage_table .count_graduates").html(data.graduated['y']);
          $("body #tracer_percentage_table .count_traced_p").html(data.traced['y'] + " ( " + count_traced_p  + "% )" );
          $("body #tracer_percentage_table .count_untraced_p").html(data.untraced['y'] + " ( " + count_untraced_p  + "% )" );
          $("body #tracer_percentage_table .count_employed_p").html(data.employed['y'] + " ( " + count_employed_p  + "% )" );
          $("body #tracer_percentage_table .count_unemployed_p").html(data.unemployed['y'] + " ( " + count_unemployed_p  + "% )" );
          $("body #tracer_percentage_table .count_related_p").html(data.related['y'] + " ( " + count_related_p  + "% )" );
          $("body #tracer_percentage_table .count_unrelated_p").html(data.unrelated['y'] + " ( " + count_unrelated_p  + "% )" );



          var chart = new CanvasJS.Chart("grap-container", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
              text: $("#GraphYear").val() + " BSBA GRADUATES GRAPH"
            },
            axisY: {
              title: "Total Graduates",
              interval: 1
            },
            data: [{        
              type: "column",
              dataPoints: [      
                data.graduated,
                data.traced,
                data.untraced,
                data.employed,
                data.unemployed,
                data.related,
                data.unrelated
              ]
            }]
          });

          chart.render();


    }

    });



  }


if (window.location.pathname == "/print/graph"){
 


       $.ajax({
          url: "/graph",
          type:"GET",
          success: function(data){ 

          var count_traced_p = parseFloat ( ( ( data.traced['y'] / data.graduated['y'] ) * 100 ).toFixed(2) )|| 0 ;
          var count_untraced_p = parseFloat ( ( ( data.untraced['y'] / data.graduated['y'] ) * 100 ).toFixed(2) ) || 0;
          var count_employed_p =  parseFloat ( ( ( data.employed['y'] / data.traced['y'] ) * 100 ).toFixed(2) ) || 0;
          var count_unemployed_p =  parseFloat ( ( ( data.unemployed['y'] / data.traced['y'] ) * 100 ).toFixed(2) ) || 0;
          var count_related_p =  parseFloat ( ( ( data.related['y'] / data.employed['y'] ) * 100 ).toFixed(2) ) || 0;
          var count_unrelated_p =  parseFloat ( ( ( data.unrelated['y'] / data.employed['y'] ) * 100 ).toFixed(2) ) || 0;

          $("body #tracer_percentage_table .count_graduates").html(data.graduated['y']);
          $("body #tracer_percentage_table .count_traced_p").html(data.traced['y'] + " ( " + count_traced_p  + "% )" );
          $("body #tracer_percentage_table .count_untraced_p").html(data.untraced['y'] + " ( " + count_untraced_p  + "% )" );
          $("body #tracer_percentage_table .count_employed_p").html(data.employed['y'] + " ( " + count_employed_p  + "% )" );
          $("body #tracer_percentage_table .count_unemployed_p").html(data.unemployed['y'] + " ( " + count_unemployed_p  + "% )" );
          $("body #tracer_percentage_table .count_related_p").html(data.related['y'] + " ( " + count_related_p  + "% )" );
          $("body #tracer_percentage_table .count_unrelated_p").html(data.unrelated['y'] + " ( " + count_unrelated_p  + "% )" );



          var chart = new CanvasJS.Chart("grap-container", {
            animationEnabled: true,
            exportEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
              text: $("#GraphYear").val() + " BSBA GRADUATES GRAPH"
            },
            axisY: {
              title: "Total Graduates",
              interval: 1
            },
            data: [{        
              type: "column",
              dataPoints: [      
                data.graduated,
                data.traced,
                data.untraced,
                data.employed,
                data.unemployed,
                data.related,
                data.unrelated
              ]
            }]
          });

          chart.render();



    }

    });



  }






if (window.location.pathname == "/events"){

    


        fullcalendar();

        

      $('.summernote').summernote({
            height: 200,
            disableResizeEditor: true
      });


    }






    $(document).on('submit','form#createEventForm',{},function(e){
        e.preventDefault();


        var data = new FormData(this);


             $.ajax({
                url:'/events/create',
                type:"POST",
                data:data, 
                async:false,
                success: function(data)
                {    
                    if($.isEmptyObject(data.error)){

                        $("#successModal .feedback-message").html( data.success );
                        $("#successModal").modal("show");
                        $("#createeventModal").modal("hide");
                        $("body #wrap").html(data.content);
                        $("body #event-list .panel-body").html(data.EventList);
                        $("#event-table").DataTable();
                        fullcalendar();
                    }
                    else    
                    {
                        $(".form-error").html("");
                        $("#createEventForm .form-error.start").html(data.error['start']);
                        $("#createEventForm .form-error.end").html(data.error['end']);
                        $("#createEventForm .form-error.title").html(data.error['title']);
                        $("#createEventForm .form-error.venue").html(data.error['venue']);
                        $("#createEventForm .form-error.eventBatch").html(data.error['eventBatch']);

                    }
                
                },
                error: function (data) 
                {
                   alert(data.status);
                },
                cache: false,
                contentType: false,
                processData: false
                });
        });



  $(document).on('submit','form#updateEventForm',{},function(e){
        e.preventDefault()
        var formdata = $(this).serializeArray();

             $.ajax({
                    url:'/events/updateevent',
                    type:"POST",
                    data:formdata, 
                    async:false,
                    success: function(data)
                    {    
                      if($.isEmptyObject(data.error)){

                        $("#successModal .feedback-message").html( data.success );
                        $("#successModal").modal("show");
                        $("#updateEventModal").modal("hide");
                        $("body #wrap").html(data.content);
                        $("body #event-list .panel-body").html(data.EventList);
                        $("#event-table").DataTable();
                        fullcalendar();
                    }
                    else    
                    {
                        $(".form-error").html("");
                        $("#updateEventModal .form-error.start").html(data.error['start']);
                        $("#updateEventModal .form-error.end").html(data.error['end']);
                        $("#updateEventModal .form-error.title").html(data.error['title']);
                        $("#updateEventModal .form-error.venue").html(data.error['venue']);
                        $("#createEventForm .form-error.eventBatch").html(data.error['eventBatch']);

                    }
                        
                    },
                    error: function (data) 
                    {
                       alert(data.status);
                    }
                });
        });




    $(document).on('click','.deleteEvent',{},function(e) {

        $("#yesOrNoModal form#yesOrNoForm").attr('method','POST');
        $("#yesOrNoModal form#yesOrNoForm").attr('action','/events/deleteevent');
        $("#yesOrNoModal .title").html("DELETE");
        $("#yesOrNoModal .message").html("Are you sure you want to delete this event ?");
        $("#yesOrNoModal input[name='id']").val($(this).attr('id'));
        $("#yesOrNoModal").modal("show");
        $("#updateEventModal").modal("hide");

    });


    $(document).on('click','.resetEvent',{},function(e) {

        $("#yesOrNoModal form#yesOrNoForm").attr('method','POST');
        $("#yesOrNoModal form#yesOrNoForm").attr('action','/events/resetevent');
        $("#yesOrNoModal .title").html("RESET");
        $("#yesOrNoModal .message").html("Are you sure you want to reset this event ?");
        $("#yesOrNoModal input[name='id']").val($(this).attr('id'));
        $("#yesOrNoModal").modal("show");
        $("#updateEventModal").modal("hide");

    });




        $(document).on('submit','form#yesOrNoForm',{},function(e){
            e.preventDefault()
            var formdata = $(this).serializeArray();
                 $.ajax({
                  url: $(this).attr('action'),
                  type:"POST",
                  data:formdata,
                  success: function(data)
                  {    
                      $("body #event-list .panel-body").html(data.EventList);
                      $("#event-table").DataTable();
                      $("body #wrap").html(data.content);
                      $("#successModal .feedback-message").html( data.success );
                      $("#successModal").modal("show");
                      $("#yesOrNoModal").modal("hide");

                      fullcalendar();
                      
                  },
                  error: function (data) 
                  {
                     alert(data.status);
                  }
                  });
        });




     $("#changepassword_container").attr("checked","false");

    $(document).on('change','#changepassword_checkbox',{},function(e) {

       if( this.checked ){
             $("#changepassword_container,.changepassword_container").show();
       }else{
             $("#changepassword_container,.changepassword_container").hide();
       }
       
       

    });







    $(document).on('change','#Batch',{},function(e) {
          e.preventDefault()

          var formdata = $("#FilterAlumniByYearForm").serializeArray();

           $.ajax({
            url: "/alumni/filter_by_year",
            type:"GET",
            data: formdata,
            success: function(data)
            {    
               
                 $("body #user-list .panel-body").html(data.content);
                 $("#alumni-table").DataTable();

            },
            error: function (data) 
            {
               alert(data.status);
            }
            });
       
       

    });



    $(document).on('change','#GraphYear',{},function(e) {
          e.preventDefault()


          if( $(this).val() == "ALL"){


             $.ajax({
              url: "/graph",
              type:"GET",
              data: formdata,
              success: function(data)
              {    

                    var count_traced_p = parseFloat ( ( ( data.traced['y'] / data.graduated['y'] ) * 100 ).toFixed(2) )|| 0 ;
                    var count_untraced_p = parseFloat ( ( ( data.untraced['y'] / data.graduated['y'] ) * 100 ).toFixed(2) ) || 0;
                    var count_employed_p =  parseFloat ( ( ( data.employed['y'] / data.traced['y'] ) * 100 ).toFixed(2) ) || 0;
                    var count_unemployed_p =  parseFloat ( ( ( data.unemployed['y'] / data.traced['y'] ) * 100 ).toFixed(2) ) || 0;
                    var count_related_p =  parseFloat ( ( ( data.related['y'] / data.employed['y'] ) * 100 ).toFixed(2) ) || 0;
                    var count_unrelated_p =  parseFloat ( ( ( data.unrelated['y'] / data.employed['y'] ) * 100 ).toFixed(2) ) || 0;

                    $("body #tracer_percentage_table .count_graduates").html(data.graduated['y']);
                    $("body #tracer_percentage_table .count_traced_p").html(data.traced['y'] + " ( " + count_traced_p  + "% )" );
                    $("body #tracer_percentage_table .count_untraced_p").html(data.untraced['y'] + " ( " + count_untraced_p  + "% )" );
                    $("body #tracer_percentage_table .count_employed_p").html(data.employed['y'] + " ( " + count_employed_p  + "% )" );
                    $("body #tracer_percentage_table .count_unemployed_p").html(data.unemployed['y'] + " ( " + count_unemployed_p  + "% )" );
                    $("body #tracer_percentage_table .count_related_p").html(data.related['y'] + " ( " + count_related_p  + "% )" );
                    $("body #tracer_percentage_table .count_unrelated_p").html(data.unrelated['y'] + " ( " + count_unrelated_p  + "% )" );

                    var chart = new CanvasJS.Chart("grap-container", {
                      animationEnabled: true,
                       exportEnabled: true,
                      theme: "light2", // "light1", "light2", "dark1", "dark2"
                      title:{
                        text: $("#GraphYear").val() + " BSBA GRADUATES GRAPH"
                      },
                      axisY: {
                        title: "Total Graduates",
                        interval: 1
                      },
                      data: [{        
                        type: "column",
                        dataPoints: [      
                          data.graduated,
                          data.traced,
                          data.untraced,
                          data.employed,
                          data.unemployed,
                          data.related,
                          data.unrelated
                        ]
                      }]
                    });

                    chart.render();

              },
              error: function (data) 
              {
                 alert(data.status);
              }
              });



          }else {


                  var formdata = $("#FilterAlumniGraphByYearForm").serializeArray();

                   $.ajax({
                    url: "/dashboard/graph/filter",
                    type:"GET",
                    data: formdata,
                    success: function(data)
                    {    

                          var count_traced_p = parseFloat ( ( ( data.traced['y'] / data.graduated['y'] ) * 100 ).toFixed(2) )|| 0 ;
                          var count_untraced_p = parseFloat ( ( ( data.untraced['y'] / data.graduated['y'] ) * 100 ).toFixed(2) ) || 0;
                          var count_employed_p =  parseFloat ( ( ( data.employed['y'] / data.traced['y'] ) * 100 ).toFixed(2) ) || 0;
                          var count_unemployed_p =  parseFloat ( ( ( data.unemployed['y'] / data.traced['y'] ) * 100 ).toFixed(2) ) || 0;
                          var count_related_p =  parseFloat ( ( ( data.related['y'] / data.employed['y'] ) * 100 ).toFixed(2) ) || 0;
                          var count_unrelated_p =  parseFloat ( ( ( data.unrelated['y'] / data.employed['y'] ) * 100 ).toFixed(2) ) || 0;

                          $("body #tracer_percentage_table .count_graduates").html(data.graduated['y']);
                          $("body #tracer_percentage_table .count_traced_p").html(data.traced['y'] + " ( " + count_traced_p  + "% )" );
                          $("body #tracer_percentage_table .count_untraced_p").html(data.untraced['y'] + " ( " + count_untraced_p  + "% )" );
                          $("body #tracer_percentage_table .count_employed_p").html(data.employed['y'] + " ( " + count_employed_p  + "% )" );
                          $("body #tracer_percentage_table .count_unemployed_p").html(data.unemployed['y'] + " ( " + count_unemployed_p  + "% )" );
                          $("body #tracer_percentage_table .count_related_p").html(data.related['y'] + " ( " + count_related_p  + "% )" );
                          $("body #tracer_percentage_table .count_unrelated_p").html(data.unrelated['y'] + " ( " + count_unrelated_p  + "% )" );

                          var chart = new CanvasJS.Chart("grap-container", {
                            animationEnabled: true,
                            exportEnabled: true,
                            theme: "light2", // "light1", "light2", "dark1", "dark2"
                            title:{
                              text: $("#GraphYear").val() + " BSBA GRADUATES GRAPH"
                            },
                            axisY: {
                              title: "Total Graduates",
                              interval: 1
                            },
                            data: [{        
                              type: "column",
                              dataPoints: [      
                                data.graduated,
                                data.traced,
                                data.untraced,
                                data.employed,
                                data.unemployed,
                                data.related,
                                data.unrelated,
                              ]
                            }]
                          });

                          chart.render();




                    },
                    error: function (data) 
                    {
                       alert(data.status);
                    }
                    });
         }
       
       

    });


        var val = $("#filter_by").val();

        if( val == "ALUMNI"){ 

          $(".filter_by_alumni_con").show();  
          $(".filter_by_userrole_con").hide();
          $(".filter_by_user_status_con").hide();


           if( $("#filter_by_alumni").val() != "NOT TRACED" ){
              $(".filter_by_employment_con").show();
            }else $(".filter_by_employment_con").hide();

            if( $("#filter_by_employment").val() != "NOT EMPLOYED" ){
              $(".filter_by_job_relevance_con").show();
            }else $(".filter_by_job_relevance_con").hide();

        }
        else { 
          $(".filter_by_alumni_con").hide();
          $(".filter_by_alumni_con").hide(); 
          $(".filter_by_employment_con").hide();
          $(".filter_by_job_relevance_con").hide();
          $(".filter_alumni_by_con").hide();

          $(".filter_by_userrole_con").show();
          $(".filter_by_user_status_con").show();

           }




        $(document).on('change','#filter_by', {} ,function(e){

                var val = $(this).val();

                if( val == "ALUMNI"){ 


                  $(".filter_by_alumni_con").show();
                  $(".filter_alumni_by_con").show();

                  $(".filter_by_userrole_con").hide();
                  $(".filter_by_user_status_con").hide();

                  if( $("#filter_by_alumni").val() != "NOT TRACED" ){
                    $(".filter_by_employment_con").show();
                      
                      if( $("#filter_by_employment").val() != "NOT EMPLOYED" ){
                        $(".filter_by_job_relevance_con").show();
                      }

                  }
                } else { 
                  $(".filter_by_alumni_con").hide(); 
                  $(".filter_by_employment_con").hide();
                  $(".filter_by_job_relevance_con").hide();
                  $(".filter_alumni_by_con").hide();

                  $(".filter_by_userrole_con").show();
                  $(".filter_by_user_status_con").show();
                }



        });

        $(document).on('change','#filter_by_alumni', {} ,function(e){

                var val = $(this).val();

                if( val != "NOT TRACED"){ 
                  $(".filter_by_employment_con").show(); 

                      if( $("#filter_by_employment").val() != "NOT EMPLOYED" ){
                        $(".filter_by_job_relevance_con").show();
                      }
                }
                else { $(".filter_by_employment_con").hide(); $(".filter_by_job_relevance_con").hide();}



        });

        $(document).on('change','#filter_by_employment', {} ,function(e){

                var val = $(this).val();

                if( val != "NOT EMPLOYED") $(".filter_by_job_relevance_con").show();
                else { $(".filter_by_job_relevance_con").hide(); }



        });


      $(document).on('submit','#Filter_Reports_Form', {} ,function(e){
         e.preventDefault();

          var formdata = $("#Filter_Reports_Form").serializeArray();

           $.ajax({
            url: "/reports/filters",
            type:"GET",
            data: formdata,
            success: function(data)
            {    
               
                 $("body #QueryResultContainer").html(data.content);
                 reloadDataTable_WithPrint( data.title, data.count, data.printed_by );

            },
            error: function (data) 
            {
               alert(data.status);
            }
            });



        });



      $(document).on('click','.elect-officer-btn', {} ,function(e){

           var title = $(this).html();
           var position_id = $(this).attr('id');

           $.ajax({
            url: "/AllTracedAlumni",
            type:"GET",
            success: function(data)
            {  


              $("#ElectOfficerModal .form-error").html("");
              $("#ElectOfficerModal .Traced_Alumni_con").html(data.content);
              $("#ElectOfficerModal .position_id").val(position_id);
              $('#ElectOfficerModal .modal-title-position').html( title.toUpperCase() );

              $("#TracedAlumniTable").DataTable();

              if( $('.dataTables_scrollBody').length > 0) {
                  $('.dataTables_scrollBody').slimScroll({
                      height: '190px',
                      wheelStep: 2,
                  });
              }

              $('#ElectOfficerModal').modal('show');

            },
            error: function (data) 
            {
               alert(data.status);
            }
            });



        });




  $(document).on('click','table#TracedAlumniTable tr.data', {} ,function(e){

    $(this).find('input:radio').prop('checked', true);

  });



      $(document).on('click','.change-officer-btn', {} ,function(e){

           var title = $(this).html();
           var position_id = $(this).attr('id');

           $.ajax({
            url: "/AllTracedAlumni",
            type:"GET",
            success: function(data)
            {  


              $("#ElectOfficerModal .form-error").html("");
              $("#ElectOfficerModal .Traced_Alumni_con").html(data.content);
              $("#ElectOfficerModal .position_id").val(position_id);
              $('#ElectOfficerModal .modal-title-position').html( title.toUpperCase() );

              $("#TracedAlumniTable").DataTable();

              if( $('.dataTables_scrollBody').length > 0) {
                  $('.dataTables_scrollBody').slimScroll({
                      height: '190px',
                      wheelStep: 2,
                  });
              }

              $('#ElectOfficerModal').modal('show');

            },
            error: function (data) 
            {
               alert(data.status);
            }
            });



        });


        $(document).on('submit','#ElectOfficerForm', {} ,function(e){

         e.preventDefault();

          var formdata = $(this).serializeArray();

           $.ajax({
            url: "/alumni/officer/elect",
            type:"POST",
            data: formdata,
            success: function(data)
            {  

              if($.isEmptyObject(data.error)){

                $('#ElectOfficerModal').modal('hide');

                $(".position-table").html(data.content);
                $("#successModal .feedback-message").html( data.success );
                $("#successModal").modal("show");


              }else{


                $("#ElectOfficerModal .form-error").html("");

                $("#ElectOfficerModal .form-error.position_id").html(data.error['position_id']);
                $("#ElectOfficerModal .form-error.alumni_id").html(data.error['alumni_id']);

              }

            },
            error: function (data) 
            {
               alert(data.status);
            }
            });



        });






});