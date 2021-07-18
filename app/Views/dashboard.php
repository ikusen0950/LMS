<!doctype html>
<html lang="en">

<body>


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
                            <h4 class="mb-0">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">LMS</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Inventory</h4>
                </div>
                    
                    <div class="col-md-6 col-xl-3">
                    
                        <div class="card bg-soft-success">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="total-revenue-chart"></div>
                                </div>
                                <div>
                                    <h1 class="mb-1 mt-1"><span data-plugin="counterup"><?= $total_available_books ?></span></h1>
                                    <p class="text-muted mt-3 mb-0"><i class="mdi mdi-book-arrow-left me-1"></i>Total <span class="text-success me-1">Available</span> Books</p>

                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-soft-primary">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="orders-chart"> </div>
                                </div>
                                <div>
                                    <h1 class="mb-1 mt-1"><span data-plugin="counterup"><?= $total_in_process_books ?></span></h1>
                                    <p class="text-muted mt-3 mb-0"><i class="mdi mdi-book-arrow-right me-1"></i>Total Books <span class="text-primary me-1">In Process</span></p>

                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-md-6 col-xl-3">
                        <div class="card bg-soft-warning">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="customers-chart"> </div>
                                </div>
                                <div>
                                    <h1 class="mb-1 mt-1"><span data-plugin="counterup"><?= $total_due_books ?></span></h1>
                                    <p class="text-muted mt-3 mb-0"><i class="mdi mdi-book-clock me-1"></i>Total Books On <span class="text-warning me-1">Due</span></p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="col-md-6 col-xl-3">

                        <div class="card bg-soft-info">
                            <div class="card-body">
                                <div class="float-end mt-2">
                                    <div id="growth-chart"></div>
                                </div>
                                <div>
                                    <h1 class="mb-1 mt-1"><span data-plugin="counterup"><?= $total_library_use_only_books ?></span></h1>
                                    <p class="text-muted mt-3 mb-0"><i class="mdi mdi-book-cancel me-1"></i>Total Books In <span class="text-info me-1">Library Use Only</span></p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col-->

                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Test</h4>
                    </div>
                   
                </div> <!-- end row-->

            </div> <!-- container-fluid -->
        </div>
    </div>       
</body>

</html>