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
                              <h4 class="mb-0">Activity Logs</h4>

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
                                    <!-- <button type="button" id="add_log_button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Grade</button> -->

                                    <!-- <button data-bs-toggle="modal" data-bs-target="#addAuthorModal" type="button" class="btn btn-primary waves-effect waves-light mb-3"><i class="mdi mdi-plus mr-1"></i> Add Grade</button>   -->
                                    </div>
      
             
                                    <div class="table-responsive mb-4 mt-2">
                                       <span id="message_operation"></span>
                                       <table id="log_table" class="table table-centered datatable dt-responsive nowrap table-card-list table-sm" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                          <thead>
                                             <tr class="bg-transparent">                                             
                                             <th class="text-center">#</th>
                                             <th>Action</th>
                                             <th>Message</th>
                                             <th>Username</th>
                                             <th>Logged At</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                          </tbody>    
                                       </table>
                                    </div>

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
                url: "<?= base_url('log/getautoid') ?>",
                method: "post",
                dataType: "json",
                success: function(res) {
                $('#log_id').val(res.success)
                $('#log_auto_id').val(res.success)
                }
            })
        }

      


        $(document).ready(function () {
            var dataTable = $('#log_table').DataTable({
                "aoColumnDefs": [{
                "bSortable": false,
                }],
                "order": [],
                "serverSide": true,
                "ajax": {
                url: "<?= base_url('log/fetch_all') ?>",
                type: 'POST'
                }
            });
        });

    </script>
    
 
    
</html>
