<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Login Form with Avatar Image</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<style>
    body {
        background: rgb(99, 39, 120)
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 14px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }
    .address{
        margin-top: 54px;
    }
    .address-box{
        margin-top: 15px;
    }
    .profile-box{
        margin-bottom: 1rem!important;
        margin-top: 1rem!important;
    }
</style>
</head>
<body>
<div class="container rounded bg-white  profile-box">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"><?= $user_data->name;?></span><span class="text-black-50"><?= $user_data->email;?></span><span> </span></div>
        </div>
        <div class="col-md-5 ">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Name</label>
                        <input type="text" class="form-control" value="<?php $f_name = $user_data->name; echo strtok($f_name, " ");?>">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Surname</label>
                        <input type="text" class="form-control" value="<?php $l_name = $user_data->name; $parts = explode(' ', $l_name);echo $parts[1];?>" >
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label class="labels">Mobile Number</label>
                        <input type="text" class="form-control" value="<?= $user_data->phone_no;?>">
                    </div>
                    <div class="col-md-12">
                        <label class="labels address-box">Email ID</label>
                        <input type="text" class="form-control" value="<?= $user_data->email;?>">
                    </div>
                    <div class="col-md-12 address-box">
                        <label class="labels">Education</label>
                        <input type="text" class="form-control" placeholder="education" value="">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="labels">Country</label>
                        <input type="text" class="form-control" placeholder="country" value="">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">State/Region</label>
                        <input type="text" class="form-control" value="" placeholder="state">
                    </div>
                </div>
                <div class="mt-5 text-center">
                    <button class="btn btn-primary profile-button" type="button">Save Profile</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5 address">
                <div class="col-md-12">
                    <label class="labels">Address Line 1</label>
                    <input type="text" class="form-control" placeholder="Address line 1" value="">
                </div>
                <div class="col-md-12 address-box">
                    <label class="labels">Address Line 2</label><input type="text" class="form-control" placeholder="Address line 2" value="">
                </div>
                <div class="col-md-12 address-box">
                    <label class="labels">Pin Code</label>
                    <input type="text" class="form-control" placeholder="PIN CODE" value="">
                </div>
                <div class="col-md-12 address-box">
                    <label class="labels">City</label>
                    <input type="text" class="form-control" placeholder="City" value="">
                </div>
                <div class="col-md-12 address-box">
                    <label class="labels">Area</label>
                    <input type="text" class="form-control" placeholder="enter address line 2" value="">
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

</body>
</html>