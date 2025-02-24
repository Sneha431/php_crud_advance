 <div class="modal fade" id="usermodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Adding / Updating User</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form id="addform" method="POST" enctype="multipart/form-data">
         <div class="modal-body">
           <div class="form-group">
             <label class="">Name:</label>
             <div class="input-group">
               <div class="input-group-prepend">
                 <span class="input-group-text bg-dark"><i class="fas fa-user-alt text-white"></i></span>
               </div>
               <input type="text" class="form-control" name="username" placeholder="Enter your username"
                 autocomplete="off" required="required" id="username">
             </div>
           </div>
           <div class="form-group">
             <label class="">Email:</label>
             <div class="input-group">
               <div class="input-group-prepend">
                 <span class="input-group-text bg-dark"><i class="fas fa-envelope-open text-white"></i></span>
               </div>
               <input type="text" class="form-control" name="email" placeholder="Enter your email" autocomplete="off"
                 required="required" id="email">
             </div>
           </div>
           <div class="form-group">
             <label class="">Phone:</label>
             <div class="input-group">
               <div class="input-group-prepend">
                 <span class="input-group-text bg-dark"><i class="fas fa-phone text-white"></i></span>
               </div>
               <input type="text" class="form-control" autocomplete="off" placeholder="Enter your phone number"
                 required="required" id="phone" name="phone" minLength="10" maxLength="10">
             </div>
           </div>
           <div class="form-group">
             <label class="">Photo:</label>
             <div class="input-group">
               <div class="input-group-prepend">
                 <span class="input-group-text bg-dark"><i class="fas fa-images text-white"></i></span>
               </div>
               <div class="custom-file">
                 <input type="file" class="custom-file-input" required="required" id="userphoto" name="image"
                   onchange="previewImage(event)">
                 <br><br>


                 <label class="custom-file-label" for="userphoto">Choose file</label>

               </div>
             </div>
             <!-- Preview Image -->

             <div class="imgdiv"> <img id="preview" alt="Image Preview" height="250px" width="250px" /></div>
           </div>
         </div>
         <div class="modal-footer">
           <button type="submit" class="btn btn-dark">Submit</button>
           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
           <input type="hidden" value="adduser" name="action" />
           <input type="hidden" value="" name="userId" id="userId" />
         </div>
       </form>
     </div>
   </div>
 </div>