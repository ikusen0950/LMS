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
                              <h4 class="mb-0">User Management</h4>

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
                                    <button type="button" id="add_user_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add User</button>

                                    <!-- <button data-bs-toggle="modal" data-bs-target="#addAuthorModal" type="button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Status</button>   -->
                                    </div>
      
             
                                    <div class="table-responsive mb-4">
                                       <span id="message_operation"></span>
                                       <table id="user_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                          <thead>
                                             <tr class="bg-transparent">                                             
                                             <th style="width: 100px;" class="text-center">#</th>
                                             <th>Status</th>
                                             <th>Image</th>
                                             <th>First Name</th>
                                             <th>Last Name</th>
                                             <th>Role</th>
                                             <th>Created By</th>
                                             <th>Updated By</th>
                                             <th style="width: 120px;" class="text-center">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>    
                                       </table>
                                    </div>

                                    <!-- Status Add Modal -->
                                    <div class="modal fade" id="addStatusModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="add_user_form">
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
                                                         <label class="form-label">User #</label>
                                                         <input type="text" id="user_id" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="user_uid" id="user_auto_id">
                                                         <span id="error_user_auto_id" class="text-danger"></span>
                                                      </div> 
                                                   </div>
                                                   <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">First Name</label>
                                                                <input type="text" id="student_id" class="form-control">
                                                                <span id="error_student_auto_id" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Last Name</label>
                                                                <input type="text" id="student_index" name="index" class="form-control">
                                                                <span id="error_student_index" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="form-label">Status</label>
                                                         <input type="text" class="form-control" name="user_name" id="user_name">
                                                         <span id='error_user_name' class = 'text-danger'></span>
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
                                    <!-- End Status Add Modal -->

                                    <!-- Status Edit Modal -->
                                    <div class="modal fade" id="editStatusModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="edit_user_form">
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
                                                         <label class="form-label">Status #</label>
                                                         <input type="text" id="user_uid_edit" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="user_uid" id="user_uid_edit_hidden">
                                                         <span id="error_user_auto_id" class="text-danger"></span>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="form-label">Status</label>
                                                         <input type="text" class="form-control" name="user_name" id="user_name_edit">
                                                         <span id='error_user_name_edit' class = 'text-danger'></span>
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
                                                   <input type="hidden" name="user_id" id="user_id_edit" value="">
                                                   <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Status Edit Modal -->

                                    <!-- Status Delete Modal -->
                                    <div class="modal fade" id="deleteStatusModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
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
                                    <!-- End Status Delete Modal -->


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
            url: "<?= base_url('user/getautoid') ?>",
            method: "post",
            dataType: "json",
            success: function(res) {
               $('#user_id').val(res.success)
               $('#user_auto_id').val(res.success)
            }
         })
      }

      function clearField() {
        $('#user_name').val('')
        $('#description').val('')
        
      }


      $(document).ready(function () {
         var dataTable = $('#user_table').DataTable({
            "aoColumnDefs": [{
               "bSortable": false,
               "aTargets": [8]
            }],
            "order": [],
            "serverSide": true,
            "ajax": {
               url: "<?= base_url('user/fetch_all') ?>",
               type: 'POST'
            }
         });


         $('#add_user_button').click(function() {
            $('#addStatusModal').modal('show')
            $('#modal_title').text('Add Status')
            $('#button_action').val('Save')
            $('#action').val('Save')
            clearField()
            autoCustomerId()
         })

         $('#add_user_form').on('submit', function(event) {
            event.preventDefault()
            $.ajax({
               url: "<?= base_url('user/add_user') ?>",
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
                     if (res.error.error_user_name) {
                           $('#error_user_name').text(res.error.error_user_name)
                           $('#user_name_add').addClass('is-invalid')
                     } else {
                           $('#error_user_name').res('')
                           $('#user_name_add').removeClass('is-invalid');
                     }
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-success">${res.success}</div>`)
                     $('#addStatusModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         $('#edit_user_form').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
               url: "<?= base_url('user/update_user') ?>",
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
                     $('#editStatusModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     clearField()
                     dataTable.ajax.reload()
                  }

                  if (res.error) {
                        if (res.error.error_user_name_edit) {
                            $('#error_user_name_edit').text(res.error.error_user_name_edit)
                            $('#user_name_edit').addClass('is-invalid')
                        } else {
                            $('#error_user_name_edit').html('')
                            $('#user_name_edit').removeClass('is-invalid')
                        }
                    }
               }
            })
         });

         
         $(document).on('click', '.edit_user', function() {
            var user_id = $(this).attr('id')
            $.ajax({
               url: "<?= base_url('user/fetch_edit') ?>",
               type: "POST",
               data: {
                  user_id: user_id
               },
               dataType: "json",
               success: function(res) {
                  $('#editStatusModal').modal('show')
                  $('#user_id_edit').val(res.user_id)
                  $('#user_uid_edit').val(res.user_uid)
                  $('#user_uid_edit_hidden').val(res.user_uid)
                  $('#user_name_edit').val(res.user)
                  $('#description_edit').val(res.description)
               }
            })
         });

         $(document).on('click', '.delete_user', function() {
            var user_id = $(this).attr('id');
            $('#deleteStatusModal').modal('show');
            $('#ok_button').click(function() {
                  $.ajax({
                     url: "<?= base_url('user/delete_user') ?>",
                     type: "post",
                     data: {
                        user_id: user_id
                     },
                     dataType: "json",
                     success: function(res) {
                        $('#deleteStatusModal').modal('hide')
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
