<?php
include "./includes/header.php";
?>
<!--**********************************
   Content body start
   ***********************************-->
<div class="content-body">
   <!-- container starts -->
   <div class="container-fluid">
      <div class="row">
         <!-- Column starts -->
         <div class="col-xl-12">
            <div class="card dz-card" id="accordion-one">
               <div class="card-header flex-wrap">
                  <div>
                     <h4 class="card-title">Tenants / Students</h4>
                  </div>
                  <!-- Large modal -->
                  <button type="button" class="btn btn-primary mb-2 btn-sm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Large modal</button>
               </div>
               <!--tab-content-->
               <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="Preview" role="tabpanel" aria-labelledby="home-tab">
                     <div class="card-body pt-0">
                        <div class="table-responsive">
                           <table id="example" class="display table" style="min-width: 845px">
                              <thead>
                                 <tr>
                                    <th>S/N</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Room Number</th>
                                    <th>Hostel</th>
                                    <th>Next of Kin</th>
                                    <th>Contact Next of Kin</th>
                                    <th>Actions</th>
                                    <th>Created</th>
                                    <th>Created By</th>
                                    <th>Modified</th>
                                    <th>Modified By</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>Garrett Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>
                                       <div class="d-flex">
                                          <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-pencil"></i></a>
                                          <form action="./operations/users.php" method="post" onsubmit="return confirm('Are you sure you want to delete this record? Please not that this action is irreversible!')">
                                             <input type="hidden" name="userid">
                                             <button name="delete" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                          </form>
                                       </div>
                                    </td>
                                    <td>63</td>
                                    <td>2011/07/25</td>
                                    <td>$170,750</td>
                                    <td>$170,750</td>
                                 </tr>
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th>S/N</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Room Number</th>
                                    <th>Hostel</th>
                                    <th>Next of Kin</th>
                                    <th>Contact Next of Kin</th>
                                    <th>Actions</th>
                                    <th>Created</th>
                                    <th>Created By</th>
                                    <th>Modified</th>
                                    <th>Modified By</th>
                                 </tr>
                              </tfoot>
                           </table>
                        </div>
                     </div>
                     <!-- /Default accordion -->
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal">
                  </button>
               </div>
               <div class="modal-body">
                  <div class="basic-form">
                     <form>

                        <div class="row">
                           <div class="mb-3 col-md-6">
                              <label class="form-label">First Name</label>
                              <input type="text" class="form-control" placeholder="1234 Main St">
                           </div>
                           <div class="mb-3 col-md-6">
                              <label class="form-label">Email</label>
                              <input type="email" class="form-control" placeholder="Email">
                           </div>
                           <div class="mb-3 col-md-6">
                              <label class="form-label">Password</label>
                              <input type="password" class="form-control" placeholder="Password">
                           </div>
                           <div class="mb-3 col-md-6">
                              <label>City</label>
                              <input type="text" class="form-control">
                           </div>
                        </div>
                        <div class="row">
                           <div class="mb-3 col-md-4">
                              <label class="form-label">State</label>
                              <select id="inputState" class="default-select form-control wide">
                                 <option selected>Choose...</option>
                                 <option>Option 1</option>
                                 <option>Option 2</option>
                                 <option>Option 3</option>
                              </select>
                           </div>
                           <div class="mb-3 col-md-2">
                              <label class="form-label">Zip</label>
                              <input type="text" class="form-control">
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox">
                              <label class="form-check-label">
                                 Check me out
                              </label>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                           <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--**********************************
   Content body end
   ***********************************-->
<?php
include "./includes/footer.php";
?>