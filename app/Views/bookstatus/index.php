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
                              <h4 class="mb-0">Book Status</h4>

                              <div class="page-title-right">
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">LMS</a></li>
                                    <li class="breadcrumb-item active">Setting</li>
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
                                    <button type="button" id="add_book_status_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Book Status</button>

                                    <!-- <button data-bs-toggle="modal" data-bs-target="#addAuthorModal" type="button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Book Status</button>   -->
                                    </div>
      
             
                                    <div class="table-responsive mb-4">
                                       <span id="message_operation"></span>
                                       <table id="book_status_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                          <thead>
                                             <tr class="bg-transparent">                                             
                                             <th style="width: 100px;" class="text-center">#</th>
                                             <th>Book Status</th>
                                             <th style="width: 250px;">Description</th>
                                             <th>Created By</th>
                                             <th>Updated By</th>
                                             <th style="width: 120px;">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>    
                                       </table>
                                    </div>

                                    <!-- Book Status Add Modal -->
                                    <div class="modal fade" id="addBookStatusModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="add_book_status_form">
                                          <?= csrf_field() ?>
                                             <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                   <h4 class="modal-title" id="modal_title"></h4>
                                                   <button type="button" class="btn btn-close waves-effect waves-light" data-bs-dismiss="modal" aria-label="Close">
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                   <div class="form-group">
                                                      <div class="form-group">
                                                         <label class="form-label">Book Status #</label>
                                                         <input type="text" id="book_status_id" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="book_status_uid" id="book_status_auto_id">
                                                         <span id="error_book_status_auto_id" class="text-danger"></span>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="form-label">Book Status</label>
                                                         <input type="text" class="form-control" name="book_status_name" id="book_status_name">
                                                         <span id='error_book_status_name' class = 'text-danger'></span>
                                                      </div>
                                                   </div>
                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="col-md-3 text-right">Description</span></label>
                                                         <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                                         <span id="error_description" class="text-danger"></span>
                                                      </div>
                                                   </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                   <input type="submit" name="button_action" id="button_action" class="btn btn-primary float-end" value="Save" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Book Status Add Modal -->

                                    <!-- Book Status Edit Modal -->
                                    <div class="modal fade" id="editBookStatusModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="edit_book_status_form">
                                          <?= csrf_field() ?>
                                             <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                   <h4 class="modal-title" id="modal_title_edit"></h4>
                                                   <button type="button" class="btn btn-close waves-effect waves-light" data-bs-dismiss="modal" aria-label="Close">
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                   <div class="form-group">
                                                      <div class="form-group">
                                                         <label class="form-label">Book Status #</label>
                                                         <input type="text" id="book_status_uid_edit" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="book_status_uid" id="book_status_uid_edit_hidden">
                                                         <span id="error_book_status_auto_id" class="text-danger"></span>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="form-label">Book Status</label>
                                                         <input type="text" class="form-control" name="book_status_name" id="book_status_name_edit">
                                                         <span id='error_book_status_name_edit' class = 'text-danger'></span>
                                                      </div>
                                                   </div>
                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="col-md-3 text-right">Description</span></label>
                                                         <textarea class="form-control" name="description" id="description_edit" rows="3"></textarea>
                                                         <span id="error_description" class="text-danger"></span>
                                                      </div>
                                                   </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">                                                
                                                   <input type="hidden" name="book_status_id" id="book_status_id_edit" value="">
                                                   <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Book Status Edit Modal -->

                                    <!-- Book Status Delete Modal -->
                                    <div class="modal fade" id="deleteBookStatusModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
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
                                    <!-- End Book Status Delete Modal -->


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
            url: "<?= base_url('bookstatus/getautoid') ?>",
            method: "post",
            dataType: "json",
            success: function(res) {
               $('#book_status_id').val(res.success)
               $('#book_status_auto_id').val(res.success)
            }
         })
      }

      function clearField() {
        $('#book_status_name').val('')
        $('#description').val('')
        
      }


      $(document).ready(function () {
         var dataTable = $('#book_status_table').DataTable({
            "aoColumnDefs": [{
               "bSortable": false,
               "aTargets": [5],
               // "max-width": 20xp
               // "max-width": "20px", "targets": 1 
            }],
            "order": [],
            "serverSide": true,
            "ajax": {
               url: "<?= base_url('bookstatus/fetch_all') ?>",
               type: 'POST'
            }
         });


         $('#add_book_status_button').click(function() {
            $('#addBookStatusModal').modal('show')
            $('#modal_title').text('Add Book Status')
            $('#button_action').val('Save')
            $('#action').val('Save')
            clearField()
            autoCustomerId()
         })

         $('#add_book_status_form').on('submit', function(event) {
            event.preventDefault()
            $.ajax({
               url: "<?= base_url('bookstatus/add_book_status') ?>",
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
                     if (res.error.error_book_status_name) {
                           $('#error_book_status_name').text(res.error.error_book_status_name)
                           $('#book_status_name_add').addClass('is-invalid')
                     } else {
                           $('#error_book_status_name').res('')
                           $('#book_status_name_add').removeClass('is-invalid');
                     }
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-success">${res.success}</div>`)
                     $('#addBookStatusModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         $('#edit_book_status_form').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
               url: "<?= base_url('bookstatus/update_book_status') ?>",
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
                 

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-warning">${res.success}</div>`)
                     $('#editBookStatusModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     clearField()
                     dataTable.ajax.reload()
                  }

                  if (res.error) {
                        if (res.error.error_book_status_name_edit) {
                            $('#error_book_status_name_edit').text(res.error.error_book_status_name_edit)
                            $('#book_status_name_edit').addClass('is-invalid')
                        } else {
                            $('#error_book_status_name_edit').html('')
                            $('#book_status_name_edit').removeClass('is-invalid')
                        }
                    }
               }
            })
         });

         
         $(document).on('click', '.edit_book_status', function() {
            var book_status_id = $(this).attr('id')
            $.ajax({
               url: "<?= base_url('bookstatus/fetch_edit') ?>",
               type: "POST",
               data: {
                  book_status_id: book_status_id
               },
               dataType: "json",
               success: function(res) {
                  $('#editBookStatusModal').modal('show')
                  $('#book_status_id_edit').val(res.book_status_id)
                  $('#book_status_uid_edit').val(res.book_status_uid)
                  $('#book_status_uid_edit_hidden').val(res.book_status_uid)
                  $('#book_status_name_edit').val(res.status)
                  $('#description_edit').val(res.description)
               }
            })
         });

         $(document).on('click', '.delete_book_status', function() {
            var book_status_id = $(this).attr('id');
            $('#deleteBookStatusModal').modal('show');
            $('#ok_button').click(function() {
                  $.ajax({
                     url: "<?= base_url('bookstatus/delete_book_status') ?>",
                     type: "post",
                     data: {
                        book_status_id: book_status_id
                     },
                     dataType: "json",
                     success: function(res) {
                        $('#deleteBookStatusModal').modal('hide')
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
