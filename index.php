<?php
include 'header.php';
?>
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-dark bg-gradient">
  <div class="container">
    <a class="navbar-brand text-light text-shadow" target="_blank">*ALPHA TEST*</a>
  </div>
</nav> -->
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-building me-2"></i>SVRTV</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active">
                 <i class="fas fa-tachometer-alt me-2"></i>
                        Dashboard</a>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideUsers()">
                 <!-- <i class="fas fa-project-diagram me-2"> </i>-->
                       Users</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideEventOrders()">
                 <!-- <i class="fas fa-chart-line me-2"> </i>-->
                       Event Orders</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideEventTickets()">
                       Event Tickets</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFMM()">
                       Feast Mercy Ministries</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideHWR()">
                       Holy Week Retreat</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastph()">
                       Feast PH</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastmedia()">
                       Feast Media</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastapp()">
                       Feast App</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastbookProducts()">
                       Feastbook Products</button>
                <!--<button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideEvents()">
                       Events</button> -->
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-justify primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 primary-text">Feast Database</h2>
                </div>                
            </nav>

            <div class="container py-5">
                <div class="row">
                    <div class="col-md-12" id="msg"></div>
                </div>
                <?php
                include 'users_table/users_index.php';
                include 'events_table/events_orders_index.php';
                include 'events_table/events_ticket_index.php';
                include 'feastmercyministry_table/fmm_index.php';
                include 'holyweek_retreat_table/holyweek_retreat_index.php';
                include 'feastph_table/feastph_index.php';
                include 'feastmedia_table/feastmedia_index.php';
                include 'feastapp_table/feastapp_index.php';
                ?>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-user-frm" name="new-user-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file" id="file" class="form-control" required>
                                </div>
                                <!-- <div class="form-group" style="margin-top: 1rem;">
                                    <button button type="submit" name="Import" id="submit" class="btn btn-success" value="upload" data-loading-text="Loading...">Upload</button>
                                </div> -->
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-user-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-user-frm">
                            <input type="hidden" name="user_id">
                            <!-- email -->
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control rounded-0" id="email" name="email" required>
                            </div>
                            <!-- last name -->
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control rounded-0" id="lastname" name="last_name" required>
                            </div>
                            <!-- first name -->
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control rounded-0" id="firstname" name="first_name" required>
                            </div>
                            <!-- mobile number -->
                            <div class="form-group">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" class="form-control rounded-0" id="mobileno" name="mobile_no">
                            </div>
                            <!-- main email (deliverable) -->
                            <div class="form-group">
                                <label class="control-label">Deliverable</label>
                                <!-- <input type="text" class="form-control rounded-0" id="isMain" name="isMain" required> -->
                                <br>

                                <input type="hidden" name='is_bonafied' id="bonafied">
                                <select name="" class="form-control" onchange="dropDownBonafied(event)">
                                    <option disabled selected hidden>Change..</option>
                                    <option value=0>TRUE</option>
                                    <option value=1>FALSE</option>    
                                </select>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-user-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-user-frm">
                            <input type="hidden" name="userID">
                            <p>Are you sure to delete from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-user-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- EVENTS ORDERS MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_event_order" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Event Order Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-event-order-frm" name="new-event-order-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-event-order" id="file-event-order" class="form-control" required>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-event-order-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal_event_order" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Event Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-event-order-frm">
                            <input name="order_no">
                            <input name="receipt_no">
                            <!-- order status -->
                            <div class="form-group">
                                <label class="control-label">Order Status</label>
                                <input type="text" class="form-control rounded-0" name="order_status" required>
                            </div>
                            <!-- Order Created Date -->
                            <div class="form-group">
                                <label class="control-label">Order Created Date</label>
                                <input type="text" class="form-control rounded-0" name="order_created_date" required>
                            </div>
                            <!-- Order Completed Date -->
                            <div class="form-group">
                                <label class="control-label">Order Completed Date</label>
                                <input type="text" class="form-control rounded-0" name="order_completed_date" required>
                            </div>
                            <!-- Pay Method -->
                            <div class="form-group">
                                <label class="control-label">Pay Method</label>
                                <input type="text" class="form-control rounded-0" name="pay_method" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-event-order-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_event_order" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-event-order-frm">
                            <input name="orderNo">
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-event-order-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- EVENTS TICKETS MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_event_ticket" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Event Ticket Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-event-ticket-frm" name="new-event-ticket-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-events-ticket" id="file-events-ticket" class="form-control" required>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-event-ticket-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal_event_ticket" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Event Ticket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-event-ticket-frm">
                            <input name="ticket_id">
                            <!-- event id -->
                            <div class="form-group">
                                <label class="control-label">Event ID</label>
                                <input type="text" class="form-control rounded-0" name="event_id" required>
                            </div>
                            <!-- ticket type -->
                            <div class="form-group">
                                <label class="control-label">Ticket Type</label>
                                <input type="text" class="form-control rounded-0" name="ticket_type" required>
                            </div>
                            <!-- ticket name -->
                            <div class="form-group">
                                <label class="control-label">Ticket Name</label>
                                <input type="text" class="form-control rounded-0" name="ticket_name" required>
                            </div>
                            <!-- ticket cost -->
                            <div class="form-group">
                                <label class="control-label">Ticket Cost</label>
                                <input type="text" class="form-control rounded-0" name="ticket_cost" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-event-ticket-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_event_ticket" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-event-ticket-frm">
                            <input name="ticketID">
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-event-ticket-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- FMM MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_fmm" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Feast Mercy Ministry Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-fmm-frm" name="new-fmm-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-fmm" id="file-fmm" class="form-control" required>
                                </div>
                                <!-- <div class="form-group" style="margin-top: 1rem;">
                                    <button button type="submit" name="Import" id="submit" class="btn btn-success" value="upload" data-loading-text="Loading...">Upload</button>
                                </div> -->
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-fmm-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal_fmm" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Feast Mercy Ministry</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-fmm-frm">
                            <input name="fmm_id">
                            <input name="user_id">
                            <!-- donor type -->
                            <div class="form-group">
                                <label class="control-label">Donor Type</label>
                                <input type="text" class="form-control rounded-0" name="donor_type" required>
                            </div>
                            <!-- donation start -->
                            <div class="form-group">
                                <label class="control-label">Donation Start Date</label>
                                <input type="text" class="form-control rounded-0" name="donation_start_date" required>
                            </div>
                            <!-- donation end -->
                            <div class="form-group">
                                <label class="control-label">Donation End Date</label>
                                <input type="text" class="form-control rounded-0" name="donation_end_date" required>
                            </div>
                            <!-- amount -->
                            <div class="form-group">
                                <label class="control-label">Amount</label>
                                <input type="text" class="form-control rounded-0" name="amount" required>
                            </div>
                            <!-- pay method -->
                            <div class="form-group">
                                <label class="control-label">Pay Method</label>
                                <input type="text" class="form-control rounded-0" name="pay_method" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-fmm-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_fmm" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-fmm-frm">
                            <input name="fmmID" >
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-fmm-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- HOLYWEEK RETREAT MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_hwr" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Holy Week Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-hwr-frm" name="new-holyweek-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-hwr" id="file-hwr" class="form-control" required>
                                </div>
                                <!-- <div class="form-group" style="margin-top: 1rem;">
                                    <button button type="submit" name="Import" id="submit" class="btn btn-success" value="upload" data-loading-text="Loading...">Upload</button>
                                </div> -->
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-hwr-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal_hwr" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Holy Week Retreat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-hwr-frm">
                            <input name="hwr_id">
                            <input name="user_id">
                            <!-- event date -->
                            <div class="form-group">
                                <label class="control-label">Event Date</label>
                                <input type="text" class="form-control rounded-0" name="event_date" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-hwr-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_hwr" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-hwr-frm">
                            <input name="hwrID" >
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-hwr-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- FEASTPH MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_feastph" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Feast PH Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-feastph-frm" name="new-feastph-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-feastph" id="file-feastph" class="form-control" required>
                                </div>
                                <!-- <div class="form-group" style="margin-top: 1rem;">
                                    <button button type="submit" name="Import" id="submit" class="btn btn-success" value="upload" data-loading-text="Loading...">Upload</button>
                                </div> -->
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-feastph-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal_feastph" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Feast PH</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-feastph-frm">
                            <input name="feastph_id">
                            <input name="user_id">
                            <!-- file name -->
                            <div class="form-group">
                                <label class="control-label">File Name</label>
                                <input type="text" class="form-control rounded-0" name="file_name" required>
                            </div>
                            <!-- download date -->
                            <div class="form-group">
                                <label class="control-label">File Download Date</label>
                                <input type="text" class="form-control rounded-0" name="file_download_date" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-feastph-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_feastph" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-feastph-frm">
                            <input name="feastphID" >
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-feastph-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- FEASTMEDIA MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_feastmedia" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Feast Media Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-feastmedia-frm" name="new-feastmedia-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-feastmedia" id="file-feastmedia" class="form-control" required>
                                </div>
                                <!-- <div class="form-group" style="margin-top: 1rem;">
                                    <button button type="submit" name="Import" id="submit" class="btn btn-success" value="upload" data-loading-text="Loading...">Upload</button>
                                </div> -->
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-feastmedia-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal_feastmedia" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Feast Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-feastmedia-frm">
                            <input name="feast_media_event_id">
                            <input name="user_id">
                            <!-- event name -->
                            <div class="form-group">
                                <label class="control-label">Event Name</label>
                                <input type="text" class="form-control rounded-0" name="event_name" required>
                            </div>
                            <!-- ticket type -->
                            <div class="form-group">
                                <label class="control-label">Ticket Type</label>
                                <input type="text" class="form-control rounded-0" name="ticket_type" required>
                            </div>
                            <!-- event type -->
                            <div class="form-group">
                                <label class="control-label">Event Type</label>
                                <input type="text" class="form-control rounded-0" name="event_type" required>
                            </div>
                            <!-- event date -->
                            <div class="form-group">
                                <label class="control-label">Event Date</label>
                                <input type="text" class="form-control rounded-0" name="event_date" required>
                            </div>
                            <!-- ticket cost -->
                            <div class="form-group">
                                <label class="control-label">Ticket Cost</label>
                                <input type="text" class="form-control rounded-0" name="ticket_cost" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-feastmedia-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_feastmedia" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-feastmedia-frm">
                            <input name="feastmediaID" >
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-feastmedia-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- FEASTAPP MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_feastapp" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Feast App Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-feastapp-frm" name="new-feastapp-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-feastapp" id="file-feastapp" class="form-control" required>
                                </div>
                                <!-- <div class="form-group" style="margin-top: 1rem;">
                                    <button button type="submit" name="Import" id="submit" class="btn btn-success" value="upload" data-loading-text="Loading...">Upload</button>
                                </div> -->
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-feastapp-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal_feastapp" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Feast App</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-feastapp-frm">
                            <input name="feastapp_id">
                            <input name="user_id">
                            <!-- download date -->
                            <div class="form-group">
                                <label class="control-label">Date Downloaded</label>
                                <input type="text" class="form-control rounded-0" name="date_downloaded" required>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-feastapp-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_feastapp" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-feastapp-frm">
                            <input name="feastappID" >
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-feastapp-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->
<?php
include 'footer.php';
?>