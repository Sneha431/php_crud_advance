//function for pagination
 function pagination(totalpages,currentpages)
 {
      var pagelist="";
      if(totalpages > 1)
        {
          currentpages=parseInt(currentpages);
          const prevClass= (currentpages === 1)?"disabled":"";
           const nextClass= (currentpages === totalpages)?"disabled":"";
          pagelist+=`<ul class="pagination justify-content-center">`;
          pagelist+=` <li class="page-item ${prevClass}"><a class="page-link" href="#" data-page=${currentpages-1}>Previous</a></li>`;
         for (let index = 1; index <= totalpages; index++) {
           const activeClass= (currentpages === index)?"active":""
            pagelist+=` <li class="page-item ${activeClass}"><a class="page-link" href="#" data-page="${index}">${index}</a></li>`;
          
         }
           pagelist+=`<li class="page-item ${nextClass}"><a class="page-link" href="#" data-page=${currentpages+1}>Next</a></li>`;
            pagelist+=`</ul>`;
      }
      //pagination
$("#pagination").html(pagelist);
 }


 // function to get the users from the database
 function getuserrow(user)
 {
  var userrow="";
  if(user)
  {
    userrow=` <tr>
       <th scope="row">${user.id}</th>
       <td><img src="uploads/${user.photo}" class="userphoto"/></td>
       <td>${user.pname}</td>
       <td>${user.email}</td>
       <td>${user.phone}</td>
       <td>
         <a href="#" class="mr-3 profile" data-target="#userviewmodal" data-toggle="modal" data-id=${user.id} title="View Profile"> <i
             class="fas fa-eye text-success"></i></a>
         <a href="#" class="mr-3 edituser" title="Edit" data-target="#usermodal" data-toggle="modal" data-id=${user.id}><i
             class="fas fa-edit text-info"></i></a>
         <a href="#" class="mr-3 deleteuser" title="Delete"><i class="fas fa-trash-alt text-danger" data-id=${user.id}></i></a>
       </td>
     </tr>`;
  }
return userrow;
 }
 
 
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
      success:function(row){
console.log(row);
      if(row.users)
        {
          var userlist="";
          $.each(row.users,function(index,user){
            userlist+=getuserrow(user);
          })
          $("#usertable tbody").html(userlist);
          let totalusers= Math.ceil(parseInt(row.count)/4);
          const currentpages = $("#currentPage").val();
          pagination(totalusers,currentpages);


        }
      },
      error:function(request,error){
          console.log(arguments);
        console.log("Error :"+ error);
      }
    })

  }
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
          $("#usermodal").modal("hide");
          
          // Reset the form with id 'addform' (clears the form fields)
          // console.log( $("#addform"));//ce.fn.init {0: form#addform, length: 1}

          //  console.log( $("#addform")[0]);// <form id=​"addform" method=​"POST" enctype=​"multipart/​form-data">​…​</form>​
          $("#addform")[0].reset();
          getUsers();
        }
      },

      error: function(request, error) {
        // This function will be executed if there is an error with the AJAX request
        console.log(arguments);  // Logs all the arguments passed to the error callback for debugging purposes
        console.log("Error: " + error);  // Logs the error message
      }
    });
    
  });

$(document).on("click","ul.pagination li a",function(event){
event.preventDefault();
const pagenum = $(this).data("page");
$("#currentPage").val(pagenum);
$(this).parent().siblings().removeClass("active");
$(this).parent().addClass("active");
 getUsers();
})
//onclick event for editing
$(document).on('click','a.edituser',function(){
     $("#exampleModalLabel").text("Updating User");
var uid= $(this).data('id');

        $(".imgdiv").hide();
$("#preview").hide();
 $.ajax({
      url:"/php_crud_advance/CRUD/ajax.php",
      method:"GET",
      dataType:"json",
      data:{id:uid,action:"editusersdata"},
      beforeSend:function(){
        console.log("waiting data is loading");
      },
      success:function(row){
      console.log(row);
      if(row){
          $("#userId").val(row.id)
        $("#username").val(row.pname);
        $("#email").val(row.email);
        $("#phone").val(row.phone);
        $("#userphototext").val(row.photo);
     if(row.photo)
       { $(".imgdiv").show();
$("#preview").show();

  $("#preview").attr("src","uploads/"+row.photo);
  }
  
      }
    
          
        
      },
      error:function(request,error){
          console.log(arguments);
        console.log("Error :"+ error);
      }
    })
})

$(document).on("click", "a.deleteuser", function(e) {
  e.preventDefault();
  
  // Corrected: Using $(this) to get the clicked element's data-id
  var uid = $(this).find('i').data('id');
  // You can remove this line after confirming it's correct

  if (confirm("Are you sure you want to delete?")) {
    $.ajax({
      url: "/php_crud_advance/CRUD/ajax.php",
      method: "POST",  // Change GET to POST for deletion
      dataType: "json",
      data: { id: uid, action: "deleteuserdata" },
      beforeSend: function() {
        console.log("Waiting for data to load...");
      },
      success: function(res) {
        if (res.deleted == 1) 
          {
             
          $(".displaymessage")
            .html("User is deleted successfully.")
            .fadeIn()
            .delay(2500)
            .fadeOut();
          getUsers();  // Assuming this is a function that updates the user list
          console.log("Done");
        }
      },
      error: function(request, error) {
        console.log(arguments);
        console.log("Error: " + error);
      }
    });
  }
});

 getUsers();

$(".imgdiv").hide();
$("#preview").hide();


});
 //add user btn click event

 $(document).on("click","#addnewuser",function(){
   $("#exampleModalLabel").text("Adding User");
   $("#addform")[0].reset();
    $("#userphototext").val("");
     
        $(".imgdiv").hide();
$("#preview").hide();
$("#userId").val();
  
 })

function previewImage(event) {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        // Set the preview image source to the file content
        const preview = document.getElementById('preview');
        preview.src = e.target.result;
        $(".imgdiv").show();
        preview.style.display = 'block'; // Show the preview image
    };

    // Read the file as a data URL
    if (file) {
        reader.readAsDataURL(file);
    }
}