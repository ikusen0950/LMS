<!doctype html>
<html lang="en">

  

   <body>
      
      <!-- Begin page -->
      <div id="layout-wrapper">

          

         <!-- ============================================================== -->
         <!-- Start right Content here -->
         <!-- ============================================================== -->
         <div class="main-content">

               <div class="page-content">
                  <div class="container-fluid">
                       <!-- start page title -->
                     <div class="row">
                        <div class="col-12">
                           <div class="page-title-box d-flex align-items-center justify-content-between">
                              <h4 class="mb-0">Books</h4>

                              <div class="page-title-right">
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">LMS</a></li>
                                    <li class="breadcrumb-item active">Inventory</li>
                                 </ol>
                               </div>
                           </div>

                        </div>
                     </div>

                     
                     
                     <div class="row">
                           <div class="col-lg-12">
                              <div>
                                 <div >

                                    <div>
                                             <button type="button" id="add_book_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Book</button>
                                    </div>
      
             
                                    <div class="table-responsive mb-4">
                                       <span id="message_operation"></span>
                                       <table id="book_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                          <thead>
                                             <tr class="bg-transparent">                                             
                                             <th style="width: 100px;" class="text-center">#</th>                                             
                                             <th>Status</th>                                             
                                             <th style="width: 200px;">Title</th>
                                             <th style="width: 200px;">Author</th>
                                             <th>Created By</th>
                                             <th>Updated By</th>
                                             <th style="width: 120px;">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>    
                                       </table>
                                    </div>

                                    <!-- Book Add Modal -->
                                    <div class="modal fade" id="addBookModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="add_book_form">
                                          <?= csrf_field() ?>
                                             <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                   <h4 class="modal-title" id="modal_title"></h4>
                                                   <button type="button" class="btn btn-close waves-effect waves-light" data-bs-dismiss="modal" aria-label="Close">
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Book #</label>
                                                                <input type="text" id="book_id" name="book_id" class="form-control" readonly>
                                                                <input type="hidden" class="form-control" name="book_uid" id="book_auto_id">
                                                                <span id="error_book_id" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">ISBN</label>
                                                                <input type="number" id="book_isbn" name="book_isbn" class="form-control">
                                                                <span id="error_book_isbn" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select select2-search-disable" id="book_status" name="book_status" >
                                                                <?php
                                                                foreach ($book_status as $row) {
                                                                    echo '<option value="'.$row["status"].'">' .$row["status"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='erro_book_status' class = 'text-danger'></span>                                
                                                        </div> 
                                                    </div> 

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="form-label">Title</label>
                                                         <input type="text" id="book_title" name="book_title" class="form-control" >
                                                         <span id="error_book_title" class="text-danger"></span>
                                                      </div>
                                                    </div>   

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="col-md-3 text-right">Description</span></label>
                                                         <textarea class="form-control" name="book_description" id="book_description" rows="3"></textarea>
                                                         <span id="error_book_description" class="text-danger"></span>
                                                      </div>
                                                    </div>                                                


                                                    <div class="form-group">
                                                        <div class="form-group">                                                                               
                                                            <label class="form-label">Genre</label>
                                                            <select class="form-select select2-search" name="book_genre" id="book_genre">
                                                                <?php
                                                                foreach ($genres as $row) {
                                                                    echo '<option value="'.$row["genre"].'">' .$row["genre"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='error_book_genre' class = 'text-danger'></span>                                                                 
                                                        </div> 
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="mb-0">                                                                                  
                                                            <label class="form-label">Author</label>
                                                            <select class="form-select select2-search-disable" name="book_author" id="book_author" >
                                                                <?php
                                                                foreach ($authors as $row) {
                                                                    echo '<option value="'.$row["full_name"].'">' .$row["full_name"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            
                                                            <span id='error_book_author' class = 'text-danger'></span>                                                                 
                                                        </div> 
                                                    </div> 

                                                    

                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Publisher</label>
                                                            <select class="form-select select2-search-disable" name="book_publisher" id="book_publisher">
                                                                <?php
                                                                foreach ($publishers as $row) {
                                                                    echo '<option value="'.$row["publisher"].'">' .$row["publisher"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='error_book_publisher' class = 'text-danger'></span>                          
                                                        </div>
                                                        <div class="col-md-6 position-relative" id="datepicker5">
                                                            <label class="form-label">Published Year</label>
                                                            <input type="text" id="book_publisher_date" name="book_publisher_date" class="form-control" >                                                            
                                                            <!-- <input type="text" class="form-control" data-provide="datepicker" data-date-container='#datepicker5' data-date-format="dd M,yyyy" data-date-min-view-mode="2"> -->
                                                            <span id='error_book_publisher_date' class = 'text-danger'></span>                       
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="form-label">Source</label>
                                                         <input type="text" id="book_source" name="book_source" class="form-control" value="Donated">
                                                         <span id="error_book_source" class="text-danger"></span>
                                                      </div>
                                                    </div>                                                     

                                                    
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                   <input type="submit" name="button_action" id="button_action" class="btn btn-primary float-end" value="Add" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Book Add Modal -->

                                    <!-- Book Edit Modal -->
                                    <div class="modal fade" id="editBookModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="edit_book_form">
                                          <?= csrf_field() ?>
                                             <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                   <h4 class="modal-title" id="modal_title_edit"></h4>
                                                   <button type="button" class="btn btn-close waves-effect waves-light" data-bs-dismiss="modal" aria-label="Close">
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Book #</label>
                                                                <input type="text" id="book_uid_edit" class="form-control" readonly>
                                                                <input type="hidden" class="form-control" name="book_uid_edit" id="book_auto_id_edit">
                                                                <span id="error_book_id_edit" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">ISBN</label>
                                                                <input type="number" id="book_isbn_edit" name="book_isbn_edit" class="form-control">
                                                                <span id="error_book_isbn_edit" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select select2-search-disable" id="book_status_edit" name="book_status_edit" >
                                                                <?php
                                                                foreach ($book_status as $row) {
                                                                    echo '<option value="'.$row["status"].'">' .$row["status"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='erro_book_status_edit' class = 'text-danger'></span>                                
                                                        </div> 
                                                    </div> 

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="form-label">Title</label>
                                                         <input type="text" id="book_title_edit" name="book_title_edit" class="form-control" >
                                                         <span id="error_book_title_edit" class="text-danger"></span>
                                                      </div>
                                                    </div>   

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="col-md-3 text-right">Description</span></label>
                                                         <textarea class="form-control" name="book_description_edit" id="book_description_edit" rows="3"></textarea>
                                                         <span id="error_book_description_edit" class="text-danger"></span>
                                                      </div>
                                                    </div>                                                


                                                    <div class="form-group">
                                                        <div class="form-group">                                                                               
                                                            <label class="form-label">Genre</label>
                                                            <select class="form-select select2-search" name="book_genre_edit" id="book_genre_edit">
                                                                <?php
                                                                foreach ($genres as $row) {
                                                                    echo '<option value="'.$row["genre"].'">' .$row["genre"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='error_book_genre_edit' class = 'text-danger'></span>                                                                 
                                                        </div> 
                                                    </div> 

                                                    <div class="form-group">
                                                        <div class="mb-0">                                                                                  
                                                            <label class="form-label">Author</label>
                                                            <select class="form-select select2-search-disable" name="book_author_edit" id="book_author_edit" >
                                                                <?php
                                                                foreach ($authors as $row) {
                                                                    echo '<option value="'.$row["full_name"].'">' .$row["full_name"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            
                                                            <span id='error_book_author_edit' class = 'text-danger'></span>                                                                 
                                                        </div> 
                                                    </div> 

                                                    

                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Publisher</label>
                                                            <select class="form-select select2-search-disable" name="book_publisher_edit" id="book_publisher_edit">
                                                                <?php
                                                                foreach ($publishers as $row) {
                                                                    echo '<option value="'.$row["publisher"].'">' .$row["publisher"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='error_book_publisher_edit' class = 'text-danger'></span>                          
                                                        </div>
                                                        <div class="col-md-6 position-relative" id="datepicker5">
                                                            <label class="form-label">Published Year</label>
                                                            <input type="text" id="book_publisher_date_edit" name="book_publisher_date_edit" class="form-control" >                                                            
                                                            <!-- <input type="text" class="form-control" data-provide="datepicker" data-date-container='#datepicker5' data-date-format="dd M,yyyy" data-date-min-view-mode="2"> -->
                                                            <span id='error_book_publisher_date_edit' class = 'text-danger'></span>                       
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="form-label">Source</label>
                                                         <input type="text" id="book_source_edit" name="book_source_edit" class="form-control">
                                                         <span id="error_book_source_edit" class="text-danger"></span>
                                                      </div>
                                                    </div>                                                    
                                                    
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">                                                
                                                   <input type="hidden" name="book_id" id="book_id_edit" value="">
                                                   <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Book Edit Modal -->

                                    <!-- Book Delete Modal -->
                                    <div class="modal fade" id="deleteBookModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <form>
                                             <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                   <h4 class="modal-title">Delete Confirmation</h4>
                                                   <button type="button" class="btn btn-close waves-effect waves-light" data-bs-dismiss="modal" aria-label="Close">
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                   <div class="form-group">
                                                      <div class="form-group">
                                                         <h4 align="center">Are you sure, you want to delete this record?</h4>
                                                      </div> 
                                                   </div>                                                  
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">                             
                                                   <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">Yes</button>
                                                   <!-- <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" /> -->
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Book Delete Modal -->


                                 </div>
                              </div>
                           </div> <!-- end col -->
                     </div> <!-- end row -->
                  </div> <!-- container-fluid -->
               </div>
               <!-- End Page-content -->

               
         </div>
         <!-- end main content-->

      </div>
      <!-- END layout-wrapper -->    
    
   </body>
   
   <script>

      function autoCustomerId() {
         $.ajax({
            url: "<?= base_url('book/getautoid') ?>",
            method: "post",
            dataType: "json",
            success: function(res) {
               $('#book_id').val(res.success)
               $('#book_auto_id').val(res.success)
            }
         })
      }

      function clearField() {
        $('#book_isbn').val('')
        $('#book_title').val('')
        $('#book_description').val('')
        $('#book_publisher_date').val('')
        $('#book_source').val('')
      }


      $(document).ready(function () {
         var dataTable = $('#book_table').DataTable({
            "aoColumnDefs": [{
               "bSortable": false,
               "aTargets": [6]
            }],
            "order": [],
            "serverSide": true,
            "ajax": {
               url: "<?= base_url('book/fetch_all') ?>",
               type: 'POST'
            }
         });


         $('#add_book_button').click(function() {
            $('#addBookModal').modal('show')
            $('#modal_title').text('Add Book')
            $('#button_action').val('Save')
            $('#action').val('Save')
            clearField()
            autoCustomerId()
         })

         $('#add_book_form').on('submit', function(event) {
            event.preventDefault()
            $.ajax({
               url: "<?= base_url('book/add_book') ?>",
               type: "post",
               data: $(this).serialize(),
               dataType: "json",
               beforeSend: function() {
                  $('#button_action').val('Validate...');
                  $('#button_action').attr('disabled', 'disabled');
               },
               success: function(res) {
                  $('#button_action').attr('disabled', false);
                  $('#button_action').val('Save');

                  if (res.error) {
                     if (res.error.error_book_isbn) {
                           $('#error_book_isbn').text(res.error.error_book_isbn)
                           $('#book_isbn').addClass('is-invalid')
                     } else {
                           $('#error_book_isbn').res('')
                           $('#book_isbn').removeClass('is-invalid');
                     }
                     if (res.error.error_book_title) {
                           $('#error_book_title').text(res.error.error_book_title)
                           $('#book_title').addClass('is-invalid')
                     } else {
                           $('#error_book_title').res('')
                           $('#book_title').removeClass('is-invalid');
                     }
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-success">${res.success}</div>`)
                     $('#addBookModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         $('#edit_book_form').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
               url: "<?= base_url('book/update_book') ?>",
               method: "POST",
               data: new FormData(this),
               dataType: "json",
               contentType: false,
               processData: false,
               beforeSend: function() {
                  $('#button_action').val('Validate...');
                  $('#button_action').attr('disabled', 'disabled');
               },
               success: function(res) {
                  if (res.error) {
                     if (res.error.error_book_isbn_edit) {
                           $('#error_book_isbn_edit').text(res.error.error_book_isbn_edit)
                           $('#book_isbn_edit').addClass('is-invalid')
                     } else {
                           $('#error_book_isbn_edit').res('')
                           $('#book_isbn_edit').removeClass('is-invalid');
                     }
                     if (res.error.error_book_title_edit) {
                           $('#error_book_title_edit').text(res.error.error_book_title_edit)
                           $('#book_title_edit').addClass('is-invalid')
                     } else {
                           $('#error_book_title_edit').res('')
                           $('#book_title_edit').removeClass('is-invalid');
                     }
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-warning">${res.success}</div>`)
                     $('#editBookModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     clearField()
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         
         $(document).on('click', '.edit_book', function() {
            var book_id = $(this).attr('id')
            $.ajax({
               url: "<?= base_url('book/fetch_edit') ?>",
               type: "POST",
               data: {
                  book_id: book_id
               },
               dataType: "json",
               success: function(res) {
                  $('#editBookModal').modal('show')
                  $('#book_id_edit').val(res.book_id)
                  $('#book_uid_edit').val(res.book_uid)
                  $('#book_uid_edit_hidden').val(res.book_uid)
                  $('#book_isbn_edit').val(res.isbn)
                  $('#book_status_edit').val(res.status)
                  $('#book_title_edit').val(res.title)
                  $('#book_description_edit').val(res.description)
                  $('#book_genre_edit').val(res.genre)
                  $('#book_author_edit').val(res.author)
                  $('#book_publisher_edit').val(res.publisher)                  
                  $('#book_publisher_date_edit').val(res.published_date)                  
                  $('#book_source_edit').val(res.source)                  
               }
            })
         });

         $(document).on('click', '.delete_book', function() {
            var book_id = $(this).attr('id');
            $('#deleteBookModal').modal('show');
            $('#ok_button').click(function() {
                  $.ajax({
                     url: "<?= base_url('book/delete_book') ?>",
                     type: "post",
                     data: {
                        book_id: book_id
                     },
                     dataType: "json",
                     success: function(res) {
                        $('#deleteBookModal').modal('hide')
                        $('#message_operation').html(`<div class="alert alert-danger">${res.success}</div>`)
                        setTimeout(() => {
                              $('#message_operation').html('')
                        }, 5000)
                        dataTable.ajax.reload()
                     }
                  })
            })
         });
      });


     


   </script>
    
 
    
</html>
