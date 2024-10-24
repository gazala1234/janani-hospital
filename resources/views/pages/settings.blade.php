@extends('navbar')




@section('maincontent')
<div class="container">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" role="tab" aria-controls="personal" aria-selected="true">
                Personal Information
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" role="tab" aria-controls="security" aria-selected="false">
                Security
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Personal Information Tab -->
        <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
            <form action="" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" required>
                        </div>
                    </div>
                </div>
        
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Enter Country" required>
                        </div>
                    </div>
                </div>
        
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="text" class="form-control" id="datepicker" name="dob" placeholder="Select your date of birth" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="mobile">Mobile No</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile No" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="blood_group">Blood Group</label>
                            <select class="form-control" id="blood_group" name="blood_group" required>
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                    </div>
                </div>
        
                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Current Address" required></textarea>
                </div>
        
                <button type="submit" class="btn btn-primary">Update Personal Information</button>
            </form>
        </div>
        
        

        <!-- Security Tab -->
        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter your old password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter your new password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your new password" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Password</button>
            </form>
        </div>
    </div>
</div>

@section('include-js-links')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>   
@endsection

@section('js-script')
<script>
    $( function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd-mm-yy" 
        });
      } );
</script>
@endsection
  

@endsection
