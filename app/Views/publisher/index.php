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
                              <h4 class="mb-0">Publishers</h4>

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
                                    <button type="button" id="add_publisher_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Publisher</button>

                                    <!-- <button data-bs-toggle="modal" data-bs-target="#addAuthorModal" type="button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Publisher</button>   -->
                                    </div>
      
             
                                    <div class="table-responsive mb-4">
                                       <span id="message_operation"></span>
                                       <table id="publisher_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                          <thead>
                                             <tr class="bg-transparent">                                             
                                             <th style="width: 100px;" class="text-center">#</th>
                                             <th>Status</th>
                                             <th style="width: 250px;">Publisher</th>
                                             <th>Created By</th>
                                             <th>Updated By</th>
                                             <th style="width: 120px;">Action</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>    
                                       </table>
                                    </div>

                                    <!-- Publisher Add Modal -->
                                    <div class="modal fade" id="addPublisherModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="add_publisher_form">
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
                                                         <label class="form-label">Publisher #</label>
                                                         <input type="text" id="publisher_id" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="publisher_uid" id="publisher_auto_id">
                                                         <span id="error_publisher_auto_id" class="text-danger"></span>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group mt-2">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select select2-search-disable status" name="status">
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
                                                            <label class="form-label">Publisher</label>
                                                            <input type="text" class="form-control" name="publisher" id="publisher_name">
                                                            <span id='error_publisher_name' class = 'text-danger'></span>
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
                                    <!-- End Publisher Add Modal -->

                                    <!-- Publisher Edit Modal -->
                                    <div class="modal fade" id="editPublisherModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
                                       <div class="modal-dialog modal-sm-1">
                                          <form method="post" id="edit_publisher_form">
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
                                                         <label class="form-label">Publisher #</label>
                                                         <input type="text" id="publisher_uid_edit" class="form-control" readonly>
                                                         <input type="hidden" class="form-control" name="publisher_uid" id="publisher_uid_edit_hidden">
                                                         <span id="error_publisher_auto_id" class="text-danger"></span>
                                                      </div> 
                                                   </div>
                                                   <div class="form-group mt-2">
                                                        <div class="form-group">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select select2-search-disable status" id="status_edit" name="status">
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
                                                         <label class="form-label">Publisher</label>
                                                         <input type="text" class="form-control" name="publisher_name" id="publisher_name_edit" >
                                                         <span id='error_publisher_name_edit' class = 'text-danger'></span>
                                                      </div>
                                                   </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">                                                
                                                   <input type="hidden" name="publisher_id" id="publisher_id_edit" value="">
                                                   <input type="submit" name="button_action" id="button_action_edit" class="btn btn-primary float-end" value="Update" />
                                                </div>

                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- End Publisher Edit Modal -->

                                    <!-- Publisher Delete Modal -->
                                    <div class="modal fade" id="deletePublisherModal" class="modal hide" data-backdrop="static" data-keyboard="false" tabindex="-1000" role="dialog" aria-hidden="true">
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
                                    <!-- End Publisher Delete Modal -->


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
                url: "<?= base_url('publisher/getautoid') ?>",
                method: "post",
                dataType: "json",
                success: function(res) {
                $('#publisher_id').val(res.success)
                $('#publisher_auto_id').val(res.success)
                }
            })
        }

        function clearField() {
            $('#publisher_name').val('')
        }


        $(document).ready(function () {
            var dataTable = $('#publisher_table').DataTable({
                "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [5]
                }],
                "order": [],
                "serverSide": true,
                "ajax": {
                url: "<?= base_url('publisher/fetch_all') ?>",
                type: 'POST'
                }
            });


            $('#add_publisher_button').click(function() {
                $('#addPublisherModal').modal('show')
                $('#modal_title').text('Add Publisher')
                $('#button_action').val('Save')
                $('#action').val('Save')
                clearField()
                autoCustomerId()
            })

            $('#add_publisher_form').on('submit', function(event) {
                event.preventDefault()
                $.ajax({
                url: "<?= base_url('publisher/add_publisher') ?>",
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
                        if (res.error.error_publisher_name) {
                              $('#error_publisher_name').text(res.error.error_publisher_name)
                              $('#publisher').addClass('is-invalid')
                        } else {
                              $('#error_publisher_name').res('')
                              $('#publisher').removeClass('is-invalid');
                        }
                     }

                    if (res.success) {
                        $('#message_operation').html(`<div class="alert alert-success">${res.success}</div>`)
                        $('#addPublisherModal').modal('hide')
                        setTimeout(() => {
                            $('#message_operation').html('')
                        }, 5000)
                        dataTable.ajax.reload()
                    }
                }
                })
            });

            $('#edit_publisher_form').on('submit', function(e) {
                e.preventDefault()
                $.ajax({
                url: "<?= base_url('publisher/update_publisher') ?>",
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
                        if (res.error.error_publisher_name_edit) {
                              $('#error_publisher_name_edit').text(res.error.error_publisher_name_edit)
                              $('#publisher_name_edit').addClass('is-invalid')
                        } else {
                              $('#error_publisher_name_edit').res('')
                              $('#publisher_name_edit').removeClass('is-invalid');
                        }
                     }

                    if (res.success) {
                        $('#message_operation').html(`<div class="alert alert-warning">${res.success}</div>`)
                        $('#editPublisherModal').modal('hide')
                        setTimeout(() => {
                            $('#message_operation').html('')
                        }, 5000)
                        clearField()
                        dataTable.ajax.reload()
                    }
                }
                })
            });

            
            $(document).on('click', '.edit_publisher', function() {
                var publisher_id = $(this).attr('id')
                $.ajax({
                url: "<?= base_url('publisher/fetch_edit') ?>",
                type: "POST",
                data: {
                    publisher_id: publisher_id
                },
                dataType: "json",
                success: function(res) {
                    $('#editPublisherModal').modal('show')
                    $('#publisher_id_edit').val(res.publisher_id)
                    $('#publisher_uid_edit').val(res.publisher_uid)
                    $('#publisher_uid_edit_hidden').val(res.publisher_uid)
                    $('#status_edit').val(res.status)
                    $('#publisher_name_edit').val(res.publisher)
                }
                })
            });

            $(document).on('click', '.delete_publisher', function() {
                var publisher_id = $(this).attr('id');
                $('#deletePublisherModal').modal('show');
                $('#ok_button').click(function() {
                    $.ajax({
                        url: "<?= base_url('publisher/delete_publisher') ?>",
                        type: "post",
                        data: {
                            publisher_id: publisher_id
                        },
                        dataType: "json",
                        success: function(res) {
                            $('#deletePublisherModal').modal('hide')
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
