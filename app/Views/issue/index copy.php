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
                              <h4 class="mb-0">Issue Books</h4>

                              <div class="page-title-right">
                                 <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">LMS</a></li>
                                    <li class="breadcrumb-item active">Issue</li>
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
                                    <button type="button" id="add_issue_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Issue</button>

                                    <!-- <button data-bs-toggle="modal" data-bs-target="#addAuthorModal" type="button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Issue</button>   -->
                                    </div>
      
             
                                    <div class="table-responsive">
                                       <span id="message_operation"></span>
                                       <table id="issue_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
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

                                    <!-- Issue Add Modal -->
                                    <div class="modal fade" id="addIssueModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="add_issue_form">
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
                                                            <input type="text" id="issue_uid" class="form-control" readonly>
                                                            <span id="error_issue_id" class="text-danger"></span>
                                                         </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                         <div class="mb-3">
                                                            <label class="form-label">Index</label>
                                                            <input type="number" id="issue_index" name="issue_index" class="form-control">  
                                                            <span id="error_issue_index" class="text-danger"></span>
                                                         </div>
                                                      </div>
                                                   </div>
                                                    
                                                   <div class="form-group mt-1">
                                                      <div class="form-group">
                                                         <label class="form-label">Full Name</label>
                                                         <input type="text" class="form-control" name="issue_full_name" id="issue_full_name" readonly >
                                                         <span id='error_issue_full_name' class = 'text-danger'></span>
                                                      </div>
                                                   </div>

                                                   <div class="form-group mt-2">
                                                      <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                               <label class="form-label">Student #</label>
                                                               <input type="text" id="issue_student_uid" name="issue_student_uid" class="form-control" readonly>
                                                               <span id="error_issue_student_id" class="text-danger"></span>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                               <label class="form-label">Grade</label>
                                                               <input type="text" id="issue_grade" name="issue_grade" class="form-control" readonly>
                                                               <span id="error_issue_grade" class="text-danger"></span>
                                                            </div>
                                                         </div>
                                                      </div>  
                                                   </div>

                                                   <div class="form-group mt-1">
                                                      <div class="form-group">
                                                         <label class="form-label">Book Search</label>
                                                         <input type="text" class="form-control" name="issue_book_search" id="issue_book_search" placeholder="Search Book" autocomplete="off">
                                                         <span id='error_issue_issue_book_search' class = 'text-danger'></span>
                                                      </div>
                                                   </div>

                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="form-label">Book Title</label>
                                                         <input type="text" class="form-control" name="issue_book_title" id="issue_book_title" readonly >
                                                         <span id='error_issue_book_title' class = 'text-danger'></span>
                                                      </div>
                                                   </div>

                                                   <div class="form-group mt-2">
                                                      <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                               <label class="form-label">Book #</label>
                                                               <input type="text" id="issue_book_uid" name="issue_book_uid" class="form-control" readonly>
                                                               <span id="error_issue_book_id" class="text-danger"></span>
                                                            </div>
                                                         </div>
                                                         <div class="col-md-6">
                                                            <div class="mb-3">
                                                               <label class="form-label">ISBN</label>
                                                               <input type="text" id="issue_book_isbn" name="issue_book_isbn" class="form-control" readonly>
                                                               <span id="error_issue_isbn" class="text-danger"></span>
                                                            </div>
                                                         </div>
                                                      </div>  
                                                   </div> 


                                                   <div class="form-group mt-2">
                                                      <div class="form-group">
                                                         <label class="form-label">Due Date</label>
                                                         <input class="form-control" type="date" value="<?php echo date('Y-m-d'); ?>"  id="issue_due_date">
                                                         <span id='error_issue_due_date' class = 'text-danger'></span>
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
                                    <!-- End Issue Add Modal -->

                                    <!-- Issue Edit Modal -->
                                    <div class="modal fade" id="editIssueModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="edit_issue_form">
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
                                                         <label class="form-label">Issue #</label>
                                                         <input type="text" id="issue_uid_edit" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="issue_uid" id="issue_uid_edit_hidden">
                                                         <span id="error_issue_auto_id" class="text-danger"></span>
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
                                                         <label class="form-label">Issue</label>
                                                         <input type="text" class="form-control" name="issue_name" id="issue_name_edit"  >
                                                         <span id='error_issue_name_edit' class = 'text-danger'></span>
                                                      </div>
                                                   </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">                                                
                                                   <input type="hidden" name="issue_id" id="issue_id_edit" value="">
                                                   <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Issue Edit Modal -->

                                    <!-- Issue Delete Modal -->
                                    <div class="modal fade" id="deleteIssueModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
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
                                    <!-- End Issue Delete Modal -->


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
            url: "<?= base_url('issue/getautoid') ?>",
            method: "post",
            dataType: "json",
            success: function(res) {
               $('#issue_uid').val(res.success)
               $('#issue_auto_id').val(res.success)
            }
         })
      }

      function clearField() {
        $('#issue_index').val('')
        $('#issue_full_name').val('')
        $('#issue_student_uid').val('')
        $('#issue_grade').val('')
        $('#issue_book_search').val('')  
        $('#issue_book_title').val('')  
        $('#issue_book_uid').val('')  
        $('#issue_book_isbn').val('')  
      }

     
   
		// Auto complete student with student index
		$('#issue_index').keyup(function() {
			const issue_index = $('#issue_index').val()
			$.ajax({
				url: "<?= base_url('student/fetch_student_index') ?>",
				type: "post",
				data: {
					issue_index: issue_index
				},
				dataType: "json",
				success: function(res) {
					if (res) {
						$('#issue_full_name').val(res.full_name)
						$('#issue_student_uid').val(res.student_uid)
						$('#issue_grade').val(res.grade)
					} else {
						$('#issue_full_name').val('')
						$('#issue_student_uid').val('')
						$('#issue_grade').val('')
					}
				}
			})
		})

      	// Search suggest with typeahead.js
		$('#issue_book_search').typeahead({
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
		$('#issue_book_search').change(function() {
			const bookTitle = $('#issue_book_search').val()
			$.ajax({
				url: "<?= base_url('book/fetch_book_title_single') ?>",
				type: "post",
				data: {
					issue_book_search: bookTitle
				},
				dataType: "json",
				success: function(res) {
					console.log(res)
					if (res) {
						$('#issue_book_uid').val(res.book_uid)
						$('#issue_book_title').val(res.title)
						$('#issue_book_isbn').val(res.isbn)
					} else {
						$('#issue_book_title').val('Book Not Found')
						$('#issue_book_uid').val('')
						$('#issue_book_isbn').val('')
					}
				}
			})
		})


     

      $(document).ready(function () {
         var dataTable = $('#issue_table').DataTable({
            "aoColumnDefs": [{
               "bSortable": false,
               "aTargets": [5]
            }],
            "order": [],
            "serverSide": true,
            "ajax": {
               url: "<?= base_url('issue/fetch_all') ?>",
               type: 'POST'
            }
         });


         $('#add_issue_button').click(function() {
            $('#addIssueModal').modal('show')
            $('#modal_title').text('Issue Book')
            $('#button_action').val('Save')
            $('#action').val('Save')
            clearField()
            autoCustomerId()
         });

         $('#add_issue_form').on('submit', function(event) {
            event.preventDefault()
            $.ajax({
               url: "<?= base_url('issue/add_issue') ?>",
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
                     if (res.error.error_issue_index) {
                           $('#error_issue_index').text(res.error.error_issue_index)
                           $('#issue_index').addClass('is-invalid')
                     } else {
                           $('#error_issue_index').text('')
                           $('#issue_index').removeClass('is-invalid');
                     }
                     if (res.error.error_issue_full_name) {
                           $('#error_issue_full_name').text(res.error.error_issue_full_name)
                           $('#issue_full_name').addClass('is-invalid')
                     } else {
                           $('#error_issue_full_name').text('')
                           $('#issue_full_name').removeClass('is-invalid');
                     }
                     if (res.error.error_issue_student_id) {
                           $('#error_issue_student_id').text(res.error.error_issue_student_id)
                           $('#issue_student_uid').addClass('is-invalid')
                     } else {
                           $('#error_issue_student_id').text('')
                           $('#issue_student_uid').removeClass('is-invalid');
                     }
                     if (res.error.error_issue_grade) {
                           $('#error_issue_grade').text(res.error.error_issue_grade)
                           $('#issue_grade').addClass('is-invalid')
                     } else {
                           $('#error_issue_grade').text('')
                           $('#issue_grade').removeClass('is-invalid');
                     }
                     if (res.error.error_issue_issue_book_search) {
                           $('#error_issue_issue_book_search').text(res.error.error_issue_issue_book_search)
                           $('#issue_book_search').addClass('is-invalid')
                     } else {
                           $('#error_issue_issue_book_search').text('')
                           $('#issue_book_search').removeClass('is-invalid');
                     }
                    
                  }

                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-success">${res.success}</div>`)
                     $('#addIssueModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     dataTable.ajax.reload()
                  }
               }
            })
         });

         $('#edit_issue_form').on('submit', function(e) {
            e.preventDefault()
            $.ajax({
               url: "<?= base_url('issue/update_issue') ?>",
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
                     if (res.error.error_issue_name_edit) {
                           $('#error_issue_name_edit').text(res.error.error_issue_name_edit)
                           $('#issue_name_edit').addClass('is-invalid')
                     } else {
                           $('#error_issue_name_edit').res('')
                           $('#issue_name_edit').removeClass('is-invalid');
                     }
                  }
                     
                  if (res.success) {
                     $('#message_operation').html(`<div class="alert alert-warning">${res.success}</div>`)
                     $('#editIssueModal').modal('hide')
                     setTimeout(() => {
                           $('#message_operation').html('')
                     }, 5000)
                     clearField()
                     dataTable.ajax.reload()
                  }
               }
            })
         });
         
         $(document).on('click', '.search_btn', function() {
            var issue_id = $(this).attr('id')
            $.ajax({
               url: "<?= base_url('issue/fetch_student') ?>",
               type: "POST",
               data: {
                  issue_id: issue_id
               },
               dataType: "json",
               success: function(res) {
                  $('#issue_id_edit').val(res.issue_id)
                  $('#issue_uid_edit').val(res.issue_uid)
                  $('#issue_uid_edit_hidden').val(res.issue_uid)
                  $('#status_edit').val(res.status)
                  $('#issue_name_edit').val(res.issue)
               }
            })
         });
         
         $(document).on('click', '.edit_issue', function() {
            var issue_id = $(this).attr('id')
            $.ajax({
               url: "<?= base_url('issue/fetch_edit') ?>",
               type: "POST",
               data: {
                  issue_id: issue_id
               },
               dataType: "json",
               success: function(res) {
                  $('#editIssueModal').modal('show')
                  $('#issue_id_edit').val(res.issue_id)
                  $('#issue_uid_edit').val(res.issue_uid)
                  $('#issue_uid_edit_hidden').val(res.issue_uid)
                  $('#status_edit').val(res.status)
                  $('#issue_name_edit').val(res.issue)
               }
            })
         });

         $(document).on('click', '.delete_issue', function() {
            var issue_id = $(this).attr('id');
            $('#deleteIssueModal').modal('show');
            $('#ok_button').click(function() {
                  $.ajax({
                     url: "<?= base_url('issue/delete_issue') ?>",
                     type: "post",
                     data: {
                        issue_id: issue_id
                     },
                     dataType: "json",
                     success: function(res) {
                        $('#deleteIssueModal').modal('hide')
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
