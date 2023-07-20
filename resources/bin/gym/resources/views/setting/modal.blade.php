<div class="modal fade text-left" id="large" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="alert alert-danger print-error-msg alert-dismissible" style="display:none">
                <ul>

                </ul>
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Add User</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('add.users.setting') }}" method="post" enctype="multipart/form-data" autocomplete="off" class="form" data-parsley-validate>
                @csrf
              
                <div class="modal-body">
                    <label>Name: </label>
                    <div class="form-group mandatory mt-1">
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <label>Email: </label>
                    <div class="form-group mandatory mt-1">
                        <input type="text" name="email" id="email" class="form-control" required>
                    </div>
                    <label>Phone Number: </label>
                    <div class="form-group mandatory mt-1">
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>

                    <label>Role: </label>
                    <div class="form-group mt-1">
                        <select class="form-select" name="role" id="role" required>
                            <option>Admin</option>
                            <option>Staff</option>

                        </select>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="sumbit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Add User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>