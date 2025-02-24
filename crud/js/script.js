$(document).ready(function() {
  // Wait until the document is fully loaded, then execute the following function
  $(document).on("submit", "#addform", function(e) {
    e.preventDefault(); // Prevent the default form submission action (which would reload the page)

    $.ajax({
      url: "/php_crud_advance/CRUD/ajax.php",  // The URL to which the request will be sent (in this case, it's 'ajax.php' inside the 'CRUD' folder)
      method: "POST",  // HTTP request method. Here we are using POST to send data to the server.
      dataType: "json",  // Expecting a JSON response from the server
      data: new FormData(this),  // The data that will be sent to the server. `FormData(this)` serializes the form as FormData (including files)
      processData: false,  // This prevents jQuery from processing the data into a query string (default behavior when sending data)
      contentType: false,  // This tells jQuery not to set a content type for the request, because FormData sets its own Content-Type header, which is necessary for file uploads

      beforeSend: function() {
        // This function will be executed before the AJAX request is sent
        console.log("Waiting........");  // Logs to the console to show that the request is being processed
      },

      success: function(response) {
        // This function will be executed if the AJAX request is successful and a response is returned
        console.log(response);  // Logs the response returned by the server (usually contains success message or data)

        if(response) {  // Check if the response exists (usually checks if the server indicates success)
          // Hide the modal (assumes you have a modal with id 'usermodel')
          $("#usermodel").modal("hide");
          
          // Reset the form with id 'addform' (clears the form fields)
          // console.log( $("#addform"));//ce.fn.init {0: form#addform, length: 1}

          //  console.log( $("#addform")[0]);// <form id=​"addform" method=​"POST" enctype=​"multipart/​form-data">​…​</form>​
          $("#addform")[0].reset();
        }
      },

      error: function(request, error) {
        // This function will be executed if there is an error with the AJAX request
        console.log(arguments);  // Logs all the arguments passed to the error callback for debugging purposes
        console.log("Error: " + error);  // Logs the error message
      }
    });
  });


  //get user function

  function getUsers()
  {
    var pageno=$("#currentPage").val();
    $.ajax({
      url:"/php_crud_advance/CRUD/ajax.php",
      method:"GET",
      dataType:"json",
      data:{page:pageno,action:"getallusers"},
      beforeSend:function(){
        console.log("waiting data is loading");
      },
      success:function(response){
        console.log(response);
      },
      error:function(request,error){
          console.log(arguments);
        console.log("Error :"+ error);
      }
    })

  }
getUsers();

});
