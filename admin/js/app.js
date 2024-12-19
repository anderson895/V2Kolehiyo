$(document).ready(function () {

   
  
    
   
  
    
    $('#adduserButton').click(function (e) { 
      e.preventDefault();
      $('#addUserModal').fadeIn();
    });  
  
  
    $('.addUserModalClose').click(function (e) { 
      e.preventDefault();
      $('#addUserModal').fadeOut();
    });  
  
  
  
  
  
    $("#adduserForm").submit(function (e) {
        e.preventDefault();
      
        var formData = new FormData(this); // Use FormData to handle file uploads


        $('.spinner').show();
        $('#btnAddUser').prop('disabled', true);


        formData.append('requestType', 'Adduser'); // Append additional form data
      
        $.ajax({
          type: "POST",
          url: "controller.php",
          data: formData,
          contentType: false,  // Let the browser set the content type for FormData
          processData: false,  // Do not process the data, send as FormData
          success: function (response) {
            if (response == "200") {
              alertify.success('Added Successful');
              $('#addUserModal').fadeOut();
              setTimeout(function () {
                location.reload(); // Reload page after success
              }, 1000);
            } else {
                $('.spinner').hide();
                $('#btnAddUser').prop('disabled', false);
              alertify.error(response);
            }
          },
          error: function (xhr, status, error) {
            console.error("Error: " + error);
            alertify.error('An error occurred. Please try again later.');
          }
        });
      });
      

  
      

      $('.togglerUpdateUser').click(function (e) { 
       
        var users_id =$(this).data('users_id');
        var user_name =$(this).data('user_name');
        var home_sec =$(this).data('home_sec');
        var about_me =$(this).data('about_me');
        var about_me_p =$(this).data('about_me_p');
        var about_me_img =$(this).data('about_me_img');

        var proj_img1_p =$(this).data('proj_img1_p');
        var proj_img1 =$(this).data('proj_img1');

        var proj_img2_p =$(this).data('proj_img2_p');
        var proj_img2 =$(this).data('proj_img2');

        var proj_img3_p =$(this).data('proj_img3_p');
        var proj_img3 =$(this).data('proj_img3');


        var profile_picture =$(this).data('profile_picture');
       
    
        $('#users_id').val(users_id)
        $('#user_name').val(user_name)
        $('#home_sec').val(home_sec)
        $('#about_me').val(about_me)
        $('#about_me_p').val(about_me_p)
        $('#proj_img1_p').val(proj_img1_p)
        $('#proj_img2_p').val(proj_img2_p)
        $('#proj_img3_p').val(proj_img3_p)
        
        e.preventDefault();
        $('#updateUserModal').fadeIn();
      });  
    
      $('.togglerUpdateUserClose').click(function (e) { 
        e.preventDefault();
        $('#updateUserModal').fadeOut();
      });  
  
  
  
      $("#updateuserForm").submit(function (e) {
        e.preventDefault();
      
        var formData = new FormData(this); // Use FormData to handle file uploads
      
        formData.append('requestType', 'Updateuser'); // Append additional form data
      

        $('.spinner').show();
        $('#btnUpdateUser').prop('disabled', true);

        $.ajax({
          type: "POST",
          url: "controller.php",
          data: formData,
          contentType: false,  // Let the browser set the content type for FormData
          processData: false,  // Do not process the data, send as FormData
          success: function (response) {
            if (response == "200") {
              alertify.success('Update Successful');
              $('#addUserModal').fadeOut();
              setTimeout(function () {
                location.reload(); // Reload page after success
              }, 1000);
            } else {

                $('.spinner').hide();
                $('#btnUpdateUser').prop('disabled', false);
              console.log(response);
              alertify.error('Added Failed. Please check the details.');
            }
          },
          error: function (xhr, status, error) {
            console.error("Error: " + error);
            alertify.error('An error occurred. Please try again later.');
          }
        });
      });
      









      $('.togglerDeleteUser').click(function (e) { 
        var users_id =$(this).data('users_id');
        console.log(users_id);
        
        $('#remove_users_id').val(users_id);
        e.preventDefault();
        $('#deleteUserModal').fadeIn();
      }); 

      $('.togglerremoveUserClose').click(function (e) { 
        e.preventDefault();
        $('#deleteUserModal').fadeOut();
      });  



      $("#deleteuserForm").submit(function (e) {
        e.preventDefault();
        
        var formData = $(this).serializeArray();
        formData.push({ name: 'requestType', value: 'DeleteUser' });
        var serializedData = $.param(formData);
      
        $.ajax({
          type: "POST",
          url: "controller.php",
          data: serializedData,
          success: function (response) {
            if (response == "200") {
              alertify.success('Delete Account Successful');
              $('#deleteUserModal').fadeOut();
              setTimeout(function () {
                location.reload(); 
              }, 1000); 
            } else {
              console.log(response);
              alertify.error('Delete Failed. Please check the details.');
            }
          },
        });
    });
  
});