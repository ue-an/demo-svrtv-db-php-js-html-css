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
                <!--<button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideHWR()">
                       Holy Week Retreat</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastph()">
                       Feast PH</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastmedia()">
                       Feast Media</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastapp()">
                       Feast App</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideEvents()">
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
                // include 'feastph_table/feastph_index.php';
                // include 'holyweek_retreat_table/holyweek_retreat_index.php';
                // include 'feastmedia_table/feastmedia_index.php';
                // include 'feastapp_table/feastapp_index.php';
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
                                <input type="text" class="form-control rounded-0" id="mobileno" name="mobile_no" required>
                            </div>
                            <!-- main email (deliverable) -->
                            <div class="form-group">
                                <label class="control-label">Deliverable</label>
                                <!-- <input type="text" class="form-control rounded-0" id="isMain" name="isMain" required> -->
                                <br>

                                <select name="is_bonafied" id="isBonafied">
                                    <option value="TRUE">TRUE</option>
                                    <option value="FALSE">FALSE</option>    
                                </select>
                                
                            </div>
                            <!-- feast attendee -->
                            <div class="form-group">
                                <label class="control-label">Feast Attendee</label>
                                <!-- <input type="text" class="form-control rounded-0" id="isMain" name="isMain" required> -->
                                <br>
                                <select name="isFeastAttendee" id="isFeastAttendee">
                                    <option value="TRUE">TRUE</option>
                                    <option value="FALSE">FALSE</option>
                                </select>
                            </div>
                            <!-- feast name -->
                            <div class="form-group">
                                <label class="control-label">Feast Name</label>
                                <input type="text" class="form-control rounded-0" id="feastName" name="feastName" required>
                            </div>
                            <!-- district -->
                            <div class="form-group">
                                <label class="control-label">District</label>
                                <input type="text" class="form-control rounded-0" id="district" name="district" required>
                            </div>
                            <!-- address -->
                            <div class="form-group">
                                <label class="control-label">Adress</label>
                                <input type="text" class="form-control rounded-0" id="address" name="address" required>
                            </div>
                            <!-- city -->
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <input type="text" class="form-control rounded-0" id="city" name="city" required>
                            </div>
                            <!-- country -->
                            <div class="form-group">
                                <label class="control-label">Country</label>
                                <input type="text" class="form-control rounded-0" id="country" name="country" required>
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
                            <p>Are you sure to delete <b><span id="name"></span></b> from the list?</p>
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
    <div class="modal fade" id="edit_modal_events" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-events-frm">
                            <input type="hidden" name="orderID">
                            <input type="hidden" name="receiptID">
                            <input name="userID" disabled>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" form="edit-eventsrm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_events" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-event-frm">
                            <input type="hidden" name="orderID">
                            <input type="hidden" name="receiptID">
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-events-frm">Yes</button>
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

    
<?php
include 'footer.php';
?>