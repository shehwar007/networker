<div class="modal fade text-left w-100" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" data-bs-backdrop="false" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Add Member</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('members.store') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mandatory">
                                <label for="first-name-column" class="form-label">Membership NO:</label>
                                <input type="text" id="first-name-column" class="form-control" placeholder="12324" name="member_no" data-parsley-required="true">
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-3">
                            <div class='form-group'>
                                <div class="avatar avatar-xl">
                                    <img id="img" src="{{ asset('assets/images/faces/1.jpg')}}">
                                </div>
                                <input class="form-control form-control-sm mt-1" type="file" id="formFile" accept="image/*" name="member_image" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])">


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h6 class="text-center">PERSONAL DETAILS</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="last-name-column" class="form-label">Full Name</label>
                                <input type="text" id="last-name-column" class="form-control" placeholder="Shehwar Asif" name="member_name" data-parsley-required="true">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="country-floating" class="form-label">Father/Husband Name</label>
                                <input type="text" class="form-control" name="member_fathername">
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <!-- min="2018-01-01" max="2018-12-31" -->
                            <div class="form-group">
                                <label for="company-column" class="form-label">Date of Birth</label>
                                <input type="date" id="company-column" class="form-control" name="member_dob" placeholder="11/11/2001">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="last-name-column" class="form-label">Gender</label>
                                <select class="form-select" id="basicSelect" name="member_gender">
                                    <option value="">--Select--</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="city-column" class="form-label">Nic</label>
                                <input type="text" id="nic" class="form-control" data-inputmask="'mask': '99999-9999999-9'" maxlength="15" placeholder="37402-1453452-1" name="member_nic">
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="last-name-column" class="form-label">Category</label>
                                <select class="form-select" id="category_member" name="member_category">
                                    <option value="">--Select--</option>
                                    <option>Daily</option>
                                    <option>Monthly</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <h6>Diseases</h6>
                            <div class="form-group">
                                <select class="choices form-select multiple-remove" multiple="multiple" name="member_diseases[]">
                                    @foreach($diseases as $data)
                                    <option>{{$data}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <span>The Gym Managament will not be responsible for any unfotunate incident during or after your workout session.</span>


                        </div>
                        <div class="row">
                            <h6 class="text-center">RESIDENCE DETAILS</h6>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Resident of</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="member_residence"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div class="form-group mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" name="member_address"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="last-name-column" class="form-label">Mobile #</label>
                                    <input type="text" id="last-name-column" class="form-control" maxlength="13" placeholder="03131234567" name="member_mobile" data-parsley-required="true">
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="email-id-column" class="form-label">Emergency Contact #</label>
                                    <input type="text" class="form-control" name="member_emergencyno" placeholder="0XXXXXXXXXX" maxlength="13">
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label for="country-floating" class="form-label">Email </label>
                                    <input type="text" id="country-floating" class="form-control" name="member_email">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Add Member</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="ViewHistory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Member History</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">

                    <div class="card-content pb-4" id="RecentServices">
                        <!-- <div class="recent-message d-flex px-4 py-3">
                            <div class="name ms-4">
                                <h5 class="mb-1">Package Name</h5>

                                <h6 class="text-muted mb-0">Expire Date 01/20/2023</h6>
                            </div>
                            <div style="justify-content: flex-end;margin-left: auto;margin-right: 0;">
                                <h6 class="text-muted mb-0">Price 2500</h6>
                                <h6 class="text-muted mb-0">Date: 01/20/2023</h6>
                                <span class="badge bg-light-danger">Freeze</span>
                          


                            </div>

                        </div> -->
                        
                       



                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>