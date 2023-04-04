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
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideEvent()">
                 <!-- <i class="fas fa-chart-line me-2"> </i>-->
                       Event</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideAnawim()">
                 <!-- <i class="fas fa-chart-line me-2"> </i>-->
                       Feast Mercy Ministries</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideHolyweek()">
                 <!-- <i class="fas fa-chart-line me-2"> </i>-->
                       Holy Week Retreat</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastph()">
                 <!-- <i class="fas fa-chart-line me-2"> </i>-->
                       Feast PH</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastmedia()">
                 <!-- <i class="fas fa-chart-line me-2"> </i>-->
                       Feast Media</button>
                <button class="list-group-item list-group-item-action bg-transparent second-text fw-bold" onclick="openSideFeastapp()">
                 <!-- <i class="fas fa-chart-line me-2"> </i>-->
                       Feast App</button>
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
                include 'events_table/events_index.php';
                // include 'anawim_table/anawim_index.php';
                // include 'feastph_table/feastph_index.php';
                // include 'holyweek_table/holyweek_index.php';
                // include 'feastmedia_table/feastmedia_index.php';
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
                            <form action="" method="post" id="new-author-frm" name="new-author-frm" enctype="multipart/form-data">
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
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-author-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Add Modal Single Record-->
    <div class="modal fade" id="add_modal_single" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" id="new-author-single-frm">
                                <input type="hidden" name="userID">
                                <!-- email -->
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" required>
                                </div>
                                <!-- lastname -->
                                <div class="form-group">
                                    <label for="last_name" class="control-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" required>
                                </div>
                                <!-- firstname -->
                                <div class="form-group">
                                    <label for="first_name" class="control-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" required>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-author-single-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Modal Single Record -->
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
                        <form action="" id="edit-author-frm">
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
                    <button type="submit" class="btn btn-primary" form="edit-author-frm">Save</button>
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
                        <form action="" id="delete-author-frm">
                            <input type="hidden" name="userID">
                            <p>Are you sure to delete <b><span id="name"></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-author-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->

    <!-- EVENTS MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_events" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Event Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-events-frm" name="new-event-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-events" id="file-events" class="form-control" required>
                                </div>
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-events-frm">Import</button>
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
                            <!-- country -->
                            <!-- <div class="form-group">
                                <label class="control-label">Country</label>
                                <input type="text" class="form-control rounded-0" id="country" name="country" required>
                            </div> -->
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
    <!--  -->
    <!--  -->
    <!-- ANAWIM MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_anawim" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Anawim Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-anawim-frm" name="new-anawim-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-anawim" id="file-anawim" class="form-control" required>
                                </div>
                                <!-- <div class="form-group" style="margin-top: 1rem;">
                                    <button button type="submit" name="Import" id="submit" class="btn btn-success" value="upload" data-loading-text="Loading...">Upload</button>
                                </div> -->
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-anawim-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!-- Edit Modal -->
    <div class="modal fade" id="edit_modal_anawim" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Anawim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="edit-anawim-frm">
                            <input type="hidden" name="anawimID">
                            <input name="userID" disabled>
                            <!-- monthy donation -->
                            <div class="form-group">
                                <label class="control-label">Monthly Donation</label>
                                <input type="text" class="form-control rounded-0" id="monthlyDonation" name="monthlyDonation" required>
                            </div>
                            <!-- category -->
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <input type="text" class="form-control rounded-0" id="category" name="category" required>
                            </div>
                            <!-- email -->
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control rounded-0" id="email" name="email" required>
                            </div>
                            <!-- last name -->
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control rounded-0" id="lastname" name="lastname" required>
                            </div>
                            <!-- first name -->
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control rounded-0" id="firstname" name="firstname" required>
                            </div>
                            <!-- mobile number -->
                            <div class="form-group">
                                <label class="control-label">Mobile Number</label>
                                <input type="text" class="form-control rounded-0" id="mobile" name="mobile" required>
                            </div>
                            <!-- main email (deliverable) -->
                            <div class="form-group">
                                <label class="control-label">Deliverable</label>
                                <!-- <input type="text" class="form-control rounded-0" id="isMain" name="isMain" required> -->
                                <br>
                                <select name="isMain" id="isMain">
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
                    <button type="submit" class="btn btn-primary" form="edit-anawim-frm">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Edit Modal -->
    <!-- Delete Modal -->
    <div class="modal fade" id="delete_modal_anawim" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" id="delete-anawim-frm">
                            <input type="hidden" name="anawimID">
                            <p>Are you sure to delete <b><span ></span></b> from the list?</p>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" form="delete-anawim-frm">Yes</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete Modal -->
    <!--  -->
    <!--  -->
    <!-- HOLYWEEK RETREAT MODALS -->
    <!-- Upload/Import Modal -->
    <div class="modal fade" id="add_modal_holyweek" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Import Holy Week Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                            <form action="" method="post" id="new-holyweek-frm" name="new-holyweek-frm" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file" class="control-label">Upload Excel File</label>
                                    <input type="file" name="file-holyweek" id="file-holyweek" class="form-control" required>
                                </div>
                                <!-- <div class="form-group" style="margin-top: 1rem;">
                                    <button button type="submit" name="Import" id="submit" class="btn btn-success" value="upload" data-loading-text="Loading...">Upload</button>
                                </div> -->
                            </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary text-light" form="new-holyweek-frm">Import</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /Upload/Import Modal -->
    <!--  -->
    <!--  -->
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
    <!--  -->
    <!--  -->
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
    <!--  -->
    <!--  -->
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
    <!--  -->
    <!--  -->
<?php
include 'footer.php';
?>