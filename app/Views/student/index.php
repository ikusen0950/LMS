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
                              <h4 class="mb-0">Students</h4>

                              <div class="page-title-right">
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">LMS</a></li>
                                    <li class="breadcrumb-item active">Students</li>
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
                                    <button type="button" id="add_student_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Student</button>

                                    <!-- <button data-bs-toggle="modal" data-bs-target="#addStudentModal" type="button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Status</button>   -->
                                    </div>
      
             
                                    <div class="table-responsive mb-4">
                                       <span id="message_operation"></span>
                                       <table id="student_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                          <thead>
                                             <tr class="bg-transparent">                                             
                                             <th style="width: 100px;" class="text-center">#</th>                                             
                                             <th>Index</th>
                                             <th>Status</th>                                             
                                             <th style="width: 200px;">Full Name</th>
                                             <th style="width: 60px;">Grade</th>
                                             <th>Created By</th>
                                             <th>Updated By</th>
                                             <th style="width: 120px;">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>    
                                       </table>
                                    </div>

                                    <!-- Student Add Modal -->
                                    <div class="modal fade" id="addStudentModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="add_student_form">
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
                                                                <label class="form-label">Student #</label>
                                                                <input type="text" id="student_id" class="form-control" readonly>
                                                                <input type="hidden" class="form-control" name="student_uid" id="student_auto_id">
                                                                <span id="error_student_auto_id" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Index</label>
                                                                <input type="number" id="student_index" name="index" class="form-control">
                                                                <span id="error_student_index" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select select2-search-disable status" name="status">
                                                                <?php
                                                                foreach ($status as $row) {
                                                                    echo '<option value="'.$row["status"].'">' .$row["status"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='erro_student_status' class = 'text-danger'></span>                                
                                                        </div> 
                                                    </div> 

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="form-label">Full Name</label>
                                                         <input type="text" id="full_name" name="full_name" class="form-control">
                                                         <span id="error_student_full_name" class="text-danger"></span>
                                                      </div>
                                                   </div>

                                                   <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="form-label">Grade</label>
                                                            <select class="form-select select2-search-disable grade" id="grade" name="grade">
                                                                <?php
                                                                foreach ($grades as $row) {
                                                                    echo '<option value="'.$row["grade"].'">' .$row["grade"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='error_student_grade' class = 'text-danger'></span>                                
                                                        </div> 
                                                    </div> 

                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Gender</label>
                                                            <select class="form-select select2-search-disable gender" id="gender" name="gender">
                                                                <option>Female</option>
                                                                <option>Male</option>
                                                            </select>
                                                            <span id='error_student_gender' class = 'text-danger'></span>    
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                            <label class="form-label">Date of Birth</label>
                                                            <input type="date" id="date_of_birth" name="date_of_birth" class="form-control">
                                                            <span id="error_date_of_birth" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>        

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="col-md-3 text-right">Address</span></label>
                                                         <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                                                         <span id="error_address" class="text-danger"></span>
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
                                    <!-- End Student Add Modal -->

                                    <!-- Student Edit Modal -->
                                    <div class="modal fade" id="editStudentModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="edit_student_form">
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
                                                                <label class="form-label">Student #</label>
                                                                <input type="text" id="student_uid_edit" class="form-control" readonly>
                                                                <input type="hidden" class="form-control" name="student_uid" id="student_uid_edit_hidden">
                                                                <span id="error_student_auto_id" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Index</label>
                                                                <input type="number" id="index_edit" name="index_edit" class="form-control" >
                                                                <span id="error_student_index_edit" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select select2-search-disable status" id="status_edit" name="status" >
                                                                <?php
                                                                foreach ($status as $row) {
                                                                    echo '<option value="'.$row["status"].'">' .$row["status"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='error_student_status' class = 'text-danger'></span>                                
                                                        </div> 
                                                    </div> 

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="form-label">Full Name</label>
                                                         <input type="text" id="full_name_edit" name="full_name_edit" class="form-control" >
                                                         <span id="error_student_full_name_edit" class="text-danger"></span>
                                                      </div>
                                                   </div>

                                                   <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="form-label">Grade</label>
                                                            <select class="form-select select2-search-disable grade" id="grade_edit" name="grade_edit" >
                                                                <?php
                                                                foreach ($grades as $row) {
                                                                    echo '<option value="'.$row["grade"].'">' .$row["grade"].'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                            <span id='error_student_grade_edit' class = 'text-danger'></span>                                
                                                        </div> 
                                                    </div> 

                                                    <div class="row mt-2">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Gender</label>
                                                            <select class="form-select select2-search-disable gender" id="gender_edit" name="gender_edit" >
                                                                <option>Female</option>
                                                                <option>Male</option>
                                                            </select>
                                                            <span id='error_student_gender' class = 'text-danger'></span>    
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                            <label class="form-label">Date of Birth</label>
                                                            <input type="date" id="date_of_birth_edit" name="date_of_birth_edit" class="form-control">
                                                            <span id="error_date_of_birth" class="text-danger"></span>
                                                            </div>
                                                        </div>
                                                    </div>        

                                                    <div class="form-group">
                                                      <div class="form-group mt-2">
                                                         <label class="col-md-3 text-right">Address</span></label>
                                                         <textarea class="form-control" name="address_edit" id="address_edit" rows="3"></textarea>
                                                         <span id="error_address" class="text-danger"></span>
                                                      </div>
                                                   </div>                                                    
                                                    
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">                                                
                                                   <input type="hidden" name="student_id" id="student_id_edit" value="">
                                                   <!-- <input type="hidden" name="log_id" id="log_id_edit" value=""> -->
                                                   <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Student Edit Modal -->

                                    <!-- Student Delete Modal -->
                                    <div class="modal fade" id="deleteStudentModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
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
                                    <!-- End Student Delete Modal -->


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
            url: "<?= base_url('student/getautoid') ?>",
            method: "post",
            dataType: "json",
            success: function(res) {
               $('#student_id').val(res.success)
               $('#student_auto_id').val(res.success)
            }
         })
      }


      function clearField() {
        $('#full_name').val('')
        $('#index').val('')
        $('#address').val('')
      }


      $(document).ready(function () {
         var dataTable = $('#student_table').DataTable({
            "aoColumnDefs": [{
               "bSortable": false,
               "aTargets": [7]
            }],
            "order": [],
            "serverSide": true,
            "ajax": {
               url: "<?= base_url('student/fetch_all') ?>",
               type: 'POST'
            }
         });


         $('#add_student_button').click(function() {
            $('#addStudentModal').modal('show')
            $('#modal_title').text('Add Student')
            $('#button_action').val('Save')
            $('#action').val('Save')
            clearField()
            autoCustomerId()
         })

         $('#add_student_form').on('submit', function(event) {
            event.preventDefault()
            $.ajax({
               url: "<?= base_url('student/add_student') ?>",
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
                     if (res.error.error_student_index) {
                           $('#error_student_index').text(res.error.error_student_index)
                           $('#student_index').addClass('is-invalid')
                     } else {
                           $('#error_student_index').text('')
                           $('#student_index').removeClass('is-invalid');
                     }
                     if (res.error.error_student_full_name) {
                           $('#error_student_full_name').text(res.error.error_student_full_name)
                           $('#full_name').addClass('is-invalid')
                     } else {
                           $('#error_student_full_name').text('')
                           $('#full_name').removeClass('is-invalid');
                     }
                     if (res.error.error_student_grade) {
                           $('#error_student_grade').text(res.error.error_student_grade)
                           $('#grade').addClass('is-invalid')
                     } else {
                           $('#error_student_grade').text('')
                           $('#grade').removeClass('is-invalid');
                     }
                     if (res.error.error_student_gender) {
                           $('#error_student_gender').text(res.error.error_student_gender)
                           $('#gender').addClass('is-invalid')
                     } else {
                           $('#error_student_gender').text('')
                           $('#gender').removeClass('is-invalid');
                     }
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-success">${res.success}</div>`)
                     $('#addStudentModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         $('#edit_student_form').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
               url: "<?= base_url('student/update_student') ?>",
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
                     if (res.error.error_student_index_edit) {
                           $('#error_student_index_edit').text(res.error.error_student_index_edit)
                           $('#index_edit').addClass('is-invalid')
                     } else {
                           $('#error_student_index_edit').html('')
                           $('#index_edit').removeClass('is-invalid');
                     }
                     if (res.error.error_student_full_name_edit) {
                           $('#error_student_full_name_edit').text(res.error.error_student_full_name_edit)
                           $('#full_name_edit').addClass('is-invalid')
                     } else {
                           $('#error_student_full_name_edit').text('')
                           $('#full_name_edit').removeClass('is-invalid');
                     }
                     if (res.error.error_student_grade_edit) {
                           $('#error_student_grade_edit').text(res.error.error_student_grade_edit)
                           $('#grade_edit').addClass('is-invalid')
                     } else {
                           $('#error_student_grade_edit').text('')
                           $('#grade_edit').removeClass('is-invalid');
                     }
                     if (res.error.error_student_gender_edit) {
                           $('#error_student_gender_edit').text(res.error.error_student_gender_edit)
                           $('#gender_edit').addClass('is-invalid')
                     } else {
                           $('#error_student_gender_edit').text('')
                           $('#gender_edit').removeClass('is-invalid');
                     }
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-warning">${res.success}</div>`)
                     $('#editStudentModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     clearField()
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         
         $(document).on('click', '.edit_student', function() {
            var student_id = $(this).attr('id')
            $.ajax({
               url: "<?= base_url('student/fetch_edit') ?>",
               type: "POST",
               data: {
                  student_id: student_id
               },
               dataType: "json",
               success: function(res) {
                  $('#editStudentModal').modal('show')
                  $('#student_id_edit').val(res.student_id)
                  $('#student_uid_edit').val(res.student_uid)
                  $('#student_uid_edit_hidden').val(res.student_uid)                
                  $('#index_edit').val(res.index)
                  $('#status_edit').val(res.status)
                  $('#full_name_edit').val(res.full_name)
                  $('#grade_edit').val(res.grade)
                  $('#gender_edit').val(res.gender)
                  $('#address_edit').val(res.address)
                  $('#date_of_birth_edit').val(res.date_of_birth)  
               }
               
            })
         });

         $(document).on('click', '.delete_student', function() {
            var student_id = $(this).attr('id');
            $('#deleteStudentModal').modal('show') 
            $('#ok_button').click(function() {
                  $.ajax({
                     url: "<?= base_url('student/delete_student') ?>",
                     type: "post",
                     data: {
                        student_id: student_id
                     },
                     dataType: "json",
                     success: function(res) {
                        $('#deleteStudentModal').modal('hide')             
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
