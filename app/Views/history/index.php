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
                              <h4 class="mb-0">History</h4>

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
                                    <button type="button" id="add_history_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add History</button>

                                    <!-- <button data-bs-toggle="modal" data-bs-target="#addAuthorModal" type="button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add History</button>   -->
                                    </div>
      
             
                                    <div class="table-responsive mb-4">
                                       <span id="message_operation"></span>
                                       <table id="history_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                          <thead>
                                             <tr class="bg-transparent" style="width: 100%;">                                             
                                                <th class="text-center">#</th>
                                                <th>Status</th>
                                                <th>Due Date</th>
                                                <th>Full Name</th>
                                                <th>Book Title</th>
                                                <th>Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>    
                                       </table>
                                    </div>

                                    <!-- History Add Modal -->
                                    <div class="modal fade" id="addHistoryModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="add_history_form">
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
                                                            <label class="form-label">Issue #</label>
                                                            <input type="text" id="history_id" class="form-control" readonly>
                                                            <input type="hidden" class="form-control" name="history_uid" id="history_auto_id">
                                                         <span id="error_history_auto_id" class="text-danger"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="mb-3">
                                                            <label class="form-label">Index</label>
                                                            <input type="number" id="history_index" name="history_index" class="form-control">  
                                                            <span id="error_history_index" class="text-danger"></span>
                                                         </div>
                                                      </div>
                                                   </div>

                                                   <div class="form-group mt-1">
                                                      <div class="form-group">
                                                         <label class="form-label">Full Name</label>
                                                         <input type="text" class="form-control" name="history_full_name" id="history_full_name" readonly>
                                                         <span id='error_history_full_name' class = 'text-danger'></span>
                                                      </div>
                                                   </div>

                                                   <div class="form-group mt-2">
                                                      <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                               <label class="form-label">Student #</label>
                                                               <input type="text" id="history_student_uid" name="history_student_uid" class="form-control" readonly>
                                                               <span id="error_history_student_id" class="text-danger"></span>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                               <label class="form-label">Grade</label>
                                                               <input type="text" id="history_grade" name="history_grade" class="form-control" readonly>
                                                               <span id="error_history_grade" class="text-danger"></span>
                                                            </div>
                                                         </div>
                                                      </div>  
                                                   </div>
      

                                                   <div class="form-group mt-1">
                                                      <div class="form-group">
                                                         <label class="form-label">Book Search</label>
                                                         <input type="text" class="form-control" name="history_book_search" id="history_book_search" placeholder="Search Book" autocomplete="off">
                                                         <span id='error_history_book_search' class = 'text-danger'></span>
                                                      </div>
                                                   </div>

                                                   <div class="form-group mt-1">
                                                      <div class="form-group">
                                                         <label class="form-label">Book Title</label>
                                                         <input type="text" class="form-control" name="history_book_title" id="history_book_title" readonly> 
                                                         <span id='error_history_book_title' class = 'text-danger'></span>
                                                      </div>
                                                   </div>

                                                   <div class="form-group mt-2">
                                                      <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                               <label class="form-label">Book #</label>
                                                               <input type="text" id="history_book_uid" name="history_book_uid" class="form-control" readonly>
                                                               <span id="error_history_book_id" class="text-danger"></span>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                               <label class="form-label">ISBN</label>
                                                               <input type="text" id="history_book_isbn" name="history_book_isbn" class="form-control" readonly>
                                                               <span id="error_history_isbn" class="text-danger"></span>
                                                            </div>
                                                         </div>
                                                      </div>  
                                                   </div> 


                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="form-label">Due Date</label>
                                                         <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>"  id="history_due_date" name="history_due_date">
                                                         <span id='error_history_due_date' class = 'text-danger'></span>
                                                      </div>
                                                   </div>

                                                   
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                   <input type="text" name="history_book_id" id="history_book_id">
                                                   <input type="submit" name="button_action" id="button_action" class="btn btn-primary float-end" value="Add" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End History Add Modal -->

                                    <!-- History Edit Modal -->
                                    <div class="modal fade" id="editHistoryModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="edit_history_form">
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
                                                         <label class="form-label">History #</label>
                                                         <input type="text" id="history_uid_edit" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="history_uid" id="history_uid_edit_hidden">
                                                         <span id="error_history_auto_id" class="text-danger"></span>
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

                                                    <div class="table-responsive">
                                                      <span id="message_operation"></span>
                                                      <table id="history_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                                         <thead>
                                                            <tr class="bg-transparent" style="width: 100%;">                                             
                                                               <th class="text-center">#</th>
                                                               <th>Status</th>
                                                               <th>Due Date</th>
                                                               <th>Full Name</th>
                                                               <th>Book Title</th>
                                                               <th>Action</th>
                                                            </tr>
                                                         </thead>
                                                         <tbody>

                                                         </tbody>    
                                                      </table>
                                                   </div>
                                                 
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">                                                
                                                   <input type="hidden" name="history_id" id="history_id_edit" value="">
                                                   <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End History Edit Modal -->

                                    <!-- History Delete Modal -->
                                    <div class="modal fade" id="deleteHistoryModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
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
                                    <!-- End History Delete Modal -->


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
            url: "<?= base_url('history/getautoid') ?>",
            method: "post",
            dataType: "json",
            success: function(res) {
               $('#history_id').val(res.success)
               $('#history_auto_id').val(res.success)
            }
         })
      }


      function clearField() {
        $('#history_name').val('')
      }

      // Auto complete student with student index
		$('#history_index').keyup(function() {
			const history_index = $('#history_index').val()
			$.ajax({
				url: "<?= base_url('student/fetch_student_index') ?>",
				type: "post",
				data: {
					history_index: history_index
				},
				dataType: "json",
				success: function(res) {
					if (res) {
						$('#history_full_name').val(res.full_name)
						$('#history_student_uid').val(res.student_uid)
						$('#history_grade').val(res.grade)
					} else {
						$('#history_full_name').val('')
						$('#history_student_uid').val('')
						$('#history_grade').val('')
					}
				}
			})
		})

      	// Search suggest with typeahead.js
		$('#history_book_search').typeahead({
			source: function(query, result) {
				$.ajax({
					url: "<?= base_url('book/fetch_book_suggest') ?>",
					method: "post",
					data: {
						query: query
					},
					dataType: "json",
					success: function(res) {
						console.log(res)
						result($.map(res, function(item) {
							return item
						}))

                 
					}
				})
			}
		});

      // Autocomplete Book search by Book Title
		$('#history_book_search').change(function() {
			const bookTitle = $('#history_book_search').val()
			$.ajax({
				url: "<?= base_url('book/fetch_book_title_single') ?>",
				type: "post",
				data: {
					history_book_search: bookTitle
				},
				dataType: "json",
				success: function(res) {
					console.log(res)
					if (res) {
						$('#history_book_id').val(res.book_id)
						$('#history_book_uid').val(res.book_uid)
						$('#history_book_title').val(res.title)
						$('#history_book_isbn').val(res.isbn)
					} else {
						$('#history_book_title').val('Book Not Found')
						$('#history_book_uid').val('')
						$('#history_book_id').val('')
						$('#history_book_isbn').val('')
					}
				}
			})
		})


      $(document).ready(function () {
         var dataTable = $('#history_table').DataTable({
            "aoColumnDefs": [{
               "bSortable": false,
               "aTargets": [5]
            }],
            "order": [],
            "serverSide": true,
            "ajax": {
               url: "<?= base_url('history/fetch_all') ?>",
               type: 'POST'
            }
         });



         $('#add_history_button').click(function() {
            $('#addHistoryModal').modal('show')
            $('#modal_title').text('Add History')
            $('#button_action').val('Save')
            $('#action').val('Save')
            clearField()
            autoCustomerId()
         })

         $('#add_history_form').on('submit', function(event) {
            event.preventDefault()
            $.ajax({
               url: "<?= base_url('history/add_history') ?>",
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
                     if (res.error.error_history_index) {
                           $('#error_history_index').text(res.error.error_history_index)
                           $('#history_index').addClass('is-invalid')
                     } else {
                           $('#error_history_index').res('')
                           $('#history_index').removeClass('is-invalid');
                     }
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-success">${res.success}</div>`)
                     $('#addHistoryModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         $('#edit_history_form').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
               url: "<?= base_url('history/update_history') ?>",
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
                     if (res.error.error_history_name_edit) {
                           $('#error_history_name_edit').text(res.error.error_history_name_edit)
                           $('#history_name_edit').addClass('is-invalid')
                     } else {
                           $('#error_history_name_edit').res('')
                           $('#history_name_edit').removeClass('is-invalid');
                     }
                  }
                     
                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-warning">${res.success}</div>`)
                     $('#editHistoryModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     clearField()
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         
         $(document).on('click', '.edit_history', function() {
            var history_id = $(this).attr('id')
            $.ajax({
               url: "<?= base_url('history/fetch_edit') ?>",
               type: "POST",
               data: {
                  history_id: history_id
               },
               dataType: "json",
               success: function(res) {
                  $('#editHistoryModal').modal('show')
                  $('#history_id_edit').val(res.history_id)
                  $('#history_uid_edit').val(res.history_uid)
                  $('#history_uid_edit_hidden').val(res.history_uid)
                  $('#status_edit').val(res.status)
                  $('#history_name_edit').val(res.history)
               }
            })
         });

         $(document).on('click', '.delete_history', function() {
            var history_id = $(this).attr('id');
            $('#deleteHistoryModal').modal('show');
            $('#ok_button').click(function() {
                  $.ajax({
                     url: "<?= base_url('history/delete_history') ?>",
                     type: "post",
                     data: {
                        history_id: history_id
                     },
                     dataType: "json",
                     success: function(res) {
                        $('#deleteHistoryModal').modal('hide')
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
