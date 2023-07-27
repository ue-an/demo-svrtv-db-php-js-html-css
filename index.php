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
                    class="fas fa-building me-2"></i>DEMO</div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active">
                 <i class="fas fa-tachometer-alt me-2"></i>
                        Dashboard</a>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideUsers()">
                       Users</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideEventTickets()">
                       Event Tickets</button>
                <div style="padding-left: 00px; padding-top:20px">
    <!-- 
        used 'pre' tag for easier putting note on ui, however messed up the structure here
        let me do this exception for this part
    -->
    <pre>
    ***Note***
    Confidential files
    were hidden.

    Data inserted are 
    samples only.

    If you want to use
    bulk entry/import 
    excel functionality:
    - Make an excel file. 
    - Copy the structure
    of the table
    corresponding to
    column names.
    <!-- This is a prototype of the
    database I developed for
    SVRTV. The purpose is to
    demonstrate the
    functionality of the
    developed system and to
    showcase the skill while
    protecting their
    information abiding their
    confidentiality.

    Tables are intentionally
    hidden and chosen two
    sample tables and data.

    ***DISCLAIMER***
    Data inserted are not
    legitimate ones nor
    coming from legit sources;
    the following are only 
    mock data.
    Do not use information
    presented here in any 
    means. -->
    </pre>    
    <!-- End of 'pre' tag -->
                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-justify primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0 primary-text">Prototype Database</h2>
                </div>                
            </nav>

            <div class="container py-5">
                <div class="row">
                    <div class="col-md-12" id="msg"></div>
                </div>
                <?php
                include 'users_table/users_index.php';
                include 'events_table/events_ticket_index.php';
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

<?php
include 'footer.php';
?>