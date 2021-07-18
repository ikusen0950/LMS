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
                              <h4 class="mb-0">Grades</h4>

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
                                    <button type="button" id="add_grade_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Grade</button>

                                    <!-- <button data-bs-toggle="modal" data-bs-target="#addAuthorModal" type="button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Grade</button>   -->
                                    </div>
      
             
                                    <div class="table-responsive mb-4">
                                       <span id="message_operation"></span>
                                       <table id="grade_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                          <thead>
                                             <tr class="bg-transparent">                                             
                                             <th style="width: 100px;" class="text-center">#</th>
                                             <th>Status</th>
                                             <th style="width: 250px;">Grade</th>
                                             <th>Created By</th>
                                             <th>Updated By</th>
                                             <th style="width: 120px;">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>    
                                       </table>
                                    </div>

                                    <!-- Grade Add Modal -->
                                    <div class="modal fade" id="addGradeModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="add_grade_form">
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
                                                         <label class="form-label">Grade #</label>
                                                         <input type="text" id="grade_id" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="grade_uid" id="grade_auto_id">
                                                         <span id="error_grade_auto_id" class="text-danger"></span>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group mt-2">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select select2-search-disable status" name="status" >
                                                                <?php
                                                                foreach ($status as $row) {
                                                                    echo '<option value="'.$row["status"].'">' .$row["status"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='erro_author_status' class = 'text-danger'></span>                                
                                                        </div> 
                                                    </div> 
                                                    <div class="form-group mt-2">
                                                        <div class="form-group">
                                                            <label class="form-label">Grade</label>
                                                            <input type="text" class="form-control" name="grade_name" id="grade_name"  >
                                                            <span id='error_grade_name' class = 'text-danger'></span>
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
                                    <!-- End Grade Add Modal -->

                                    <!-- Grade Edit Modal -->
                                    <div class="modal fade" id="editGradeModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="edit_grade_form">
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
                                                         <label class="form-label">Grade #</label>
                                                         <input type="text" id="grade_uid_edit" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="grade_uid" id="grade_uid_edit_hidden">
                                                         <span id="error_grade_auto_id" class="text-danger"></span>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group mt-2">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select select2-search-disable status" id="status_edit" name="status" >
                                                                <?php
                                                                foreach ($status as $row) {
                                                                    echo '<option value="'.$row["status"].'">' .$row["status"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='erro_author_status' class = 'text-danger'></span>                                
                                                        </div> 
                                                    </div> 
                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="form-label">Grade</label>
                                                         <input type="text" class="form-control" name="grade_name" id="grade_name_edit"  >
                                                         <span id='error_grade_name_edit' class = 'text-danger'></span>
                                                      </div>
                                                   </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">                                                
                                                   <input type="hidden" name="grade_id" id="grade_id_edit" value="">
                                                   <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Grade Edit Modal -->

                                    <!-- Grade Delete Modal -->
                                    <div class="modal fade" id="deleteGradeModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
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
                                    <!-- End Grade Delete Modal -->


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
            url: "<?= base_url('grade/getautoid') ?>",
            method: "post",
            dataType: "json",
            success: function(res) {
               $('#grade_id').val(res.success)
               $('#grade_auto_id').val(res.success)
            }
         })
      }

      function clearField() {
        $('#grade_name').val('')
      }


      $(document).ready(function () {
         var dataTable = $('#grade_table').DataTable({
            "aoColumnDefs": [{
               "bSortable": false,
               "aTargets": [5]
            }],
            "order": [],
            "serverSide": true,
            "ajax": {
               url: "<?= base_url('grade/fetch_all') ?>",
               type: 'POST'
            }
         });


         $('#add_grade_button').click(function() {
            $('#addGradeModal').modal('show')
            $('#modal_title').text('Add Grade')
            $('#button_action').val('Save')
            $('#action').val('Save')
            clearField()
            autoCustomerId()
         })

         $('#add_grade_form').on('submit', function(event) {
            event.preventDefault()
            $.ajax({
               url: "<?= base_url('grade/add_grade') ?>",
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
                     if (res.error.error_grade_name) {
                           $('#error_grade_name').text(res.error.error_grade_name)
                           $('#grade').addClass('is-invalid')
                     } else {
                           $('#error_grade_name').res('')
                           $('#grade').removeClass('is-invalid');
                     }
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-success">${res.success}</div>`)
                     $('#addGradeModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         $('#edit_grade_form').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
               url: "<?= base_url('grade/update_grade') ?>",
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
                     if (res.error.error_grade_name_edit) {
                           $('#error_grade_name_edit').text(res.error.error_grade_name_edit)
                           $('#grade_name_edit').addClass('is-invalid')
                     } else {
                           $('#error_grade_name_edit').res('')
                           $('#grade_name_edit').removeClass('is-invalid');
                     }
                  }
                     
                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-warning">${res.success}</div>`)
                     $('#editGradeModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     clearField()
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         
         $(document).on('click', '.edit_grade', function() {
            var grade_id = $(this).attr('id')
            $.ajax({
               url: "<?= base_url('grade/fetch_edit') ?>",
               type: "POST",
               data: {
                  grade_id: grade_id
               },
               dataType: "json",
               success: function(res) {
                  $('#editGradeModal').modal('show')
                  $('#grade_id_edit').val(res.grade_id)
                  $('#grade_uid_edit').val(res.grade_uid)
                  $('#grade_uid_edit_hidden').val(res.grade_uid)
                  $('#status_edit').val(res.status)
                  $('#grade_name_edit').val(res.grade)
               }
            })
         });

         $(document).on('click', '.delete_grade', function() {
            var grade_id = $(this).attr('id');
            $('#deleteGradeModal').modal('show');
            $('#ok_button').click(function() {
                  $.ajax({
                     url: "<?= base_url('grade/delete_grade') ?>",
                     type: "post",
                     data: {
                        grade_id: grade_id
                     },
                     dataType: "json",
                     success: function(res) {
                        $('#deleteGradeModal').modal('hide')
                        $('#message_operation').html(`<div class="alert alert-danger">${res.success}</div>`)
                        setTimeout(() => {
                              $('#message_operation').html('')
                        }, 5000)

                        // Swal.fire(
                        //       'Success!',
                        //       `${res.success}`,
                        //       'success'
                        // );

                        // swal({
                        //    title: "Good job!",
                        //    text: "You clicked the button!",
                        //    icon: "success",
                        //    button: "Aww yiss!",
                        // });
                        dataTable.ajax.reload()
                     }
                  })
            })
         });
      });


     


   </script>
    
 
    
</html>
