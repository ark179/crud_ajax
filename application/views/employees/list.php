<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Product List</title>
        <link rel="stylesheet" type="text/css" media="screen" href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets2/css/bootstrap.css')?>">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets2/css/dataTables.bootstrap4.css')?>">-->
        <!--<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">-->
</head>
<body>
 	<!-- Page Heading -->
        <div class="msg"></div>
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Employee
                    <small>List</small>
                    <div class="float-right"><a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#Modal_Add"><span class="fa fa-plus"></span> Add New</a></div>
                </h1>
            </div>
            
            <table class="table table-striped table-bordered" id="emp_table">
                <thead>
                    <tr>
                        <th>Employee id</th>
                        <th>Employee Name</th>
                        <th>Employee Date of birth</th>
                        <th>Employee Email</th>
                        <th>Employee Mobile</th>
                        <th>Actions</th>
                    </tr>
                </thead>
<tbody id="employees_data">
           <?php
                if (!empty($employees)) {
                    $i = 0;
                    
                    foreach ($employees as $key => $value):
                        $i++;
                        ?>
                       
                        <tr>
                            <!--<td align="center"><input type="checkbox" name="checked_id[]" id="checked_id" class="checkbox" value="<?php echo  $value->emp_id; ?>"></td>-->
                            <td><?php echo $value->emp_id ?></td>
                            <td><?php echo $value->emp_name ?></td>
                            <td><?php echo $value->emp_dob ?></td>
                            <td><?php echo $value->emp_email ?></td>
                            <td><?php echo $value->emp_mobile ?></td>
                            <td>
<!--                                <a href="<?php echo base_url('employees/view/') . $value->emp_id ?>"
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></button>
                                </a>-->
                                <a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-emp_id="<?php echo $value->emp_id ?>" data-emp_name="<?php echo $value->emp_name ?>" data-emp_dob="<?php echo $value->emp_dob ?>" data-emp_email="<?php echo $value->emp_email ?>" data-emp_mobile="<?php echo $value->emp_mobile ?>">Edit</a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-emp_id="<?php echo $value->emp_id ?>">Delete</a>
<!--                                <a href="<?php echo base_url('employees/edit/') . $value->emp_id ?>"
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>
                                </a>
                                <a href="<?php echo base_url('employees/delete/') . $value->emp_id ?>"
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </a>-->
                            </td>
                        </tr>
                        
                    <?php
                    endforeach;
                }
                else {
                    
                }
                    ?>
                </tbody>            
            </table>
        </div>
    </div>
        
		<!-- MODAL ADD -->
            <form>
            <div class="modal fade" id="Modal_Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Employee Name</label>
                            <div class="col-md-9">
                              <input type="text" name="emp_name" id="emp_name" class="form-control" placeholder="Employee Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Employee Date of Birth</label>
                            <div class="col-md-9">
                              <input type="text" name="emp_dob" id="emp_dob" class="form-control datetimepicker" placeholder="Employee Date of Birth">
                              <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Employee email</label>
                            <div class="col-md-9">
                              <input type="text" name="emp_email" id="emp_email" class="form-control" placeholder="Employee Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Employee mobile</label>
                            <div class="col-md-9">
                                <input type="text" name="emp_mobile" id="emp_mobile" class="form-control" placeholder="Employee Mobile">
                            </div>
                        </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" type="submit" id="btn_save" class="btn btn-primary">Save</button>
                  </div>
                </div>
              </div>
            </div>
            </form>
        <!--END MODAL ADD-->

        <!-- MODAL EDIT -->
        <form>
            <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Employees</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Employee Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="emp_name_edit" id="emp_name_edit" class="form-control" placeholder="Employee Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Employee Date of Birth</label>
                                <div class="col-md-9">
                                    <input type="text" name="emp_dob_edit" id="emp_dob_edit" class="form-control datetimepicker" placeholder="Employee Date of Birth"> 
                                    <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Employee email</label>
                                <div class="col-md-9">
                                    <input type="text" name="emp_email_edit" id="emp_email_edit" class="form-control" placeholder="Employee Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Employee mobile</label>
                                <div class="col-md-9">
                                    <input type="text" name="emp_mobile_edit" id="emp_mobile_edit" class="form-control" placeholder="Employee Mobile">
                                </div>
                            </div>
                            <div class="form-group row">
                                <!--<label class="col-md-3 col-form-label">Employee mobile</label>-->
                                <div class="col-md-9">
                                    <input type="hidden" name="emp_id_edit" id="emp_id_edit" class="form-control" >
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--END MODAL EDIT-->

        <!--MODAL DELETE-->
         <form>
            <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <strong>Are you sure to delete this record?</strong>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="employee_code_delete" id="employee_code_delete" class="form-control">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--END MODAL DELETE-->

<script type="text/javascript" src="<?php echo base_url('assets2/js/jquery-3.2.1.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets2/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url('assets2/js/dataTables.bootstrap4.js')?>"></script>-->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
//		show_employees();	//call function to show all employee
		$('.datetimepicker').datepicker();
		$('#emp_table').dataTable();
                
                //function show all product
                function show_employees() {
                    $.ajax({
                        type: 'ajax',
                        url: '<?php echo site_url('employees/emp_list') ?>',
                        async: true,
                        dataType: 'json',
                        success: function (result) {
                            var html = html1 = '';
                            var i;
                            if(result['success']==1)
                            {
                                var data=result['data'];
                                for (i = 0; i < data.length; i++) {
                                    html += '<tr>' +
                                            '<td>' + data[i].emp_id + '</td>' +
                                            '<td>' + data[i].emp_name + '</td>' +
                                            '<td>' + data[i].emp_dob + '</td>' +
                                            '<td>' + data[i].emp_email + '</td>' +
                                            '<td>' + data[i].emp_mobile + '</td>' +
                                            '<td>' +
                                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-emp_id="' + data[i].emp_id + '" data-emp_name="' + data[i].emp_name + '" data-emp_dob="' + data[i].emp_dob + '" data-emp_email="' + data[i].emp_email + '" data-emp_mobile="' + data[i].emp_mobile + '">Edit</a>' + ' ' +
                                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-emp_id="' + data[i].emp_id + '">Delete</a>' +
                                            '</td>' +
                                            '</tr>';
                                }
                                $('#employees_data').html(html);
                            }
                        }
                    });
                }

        //Save employee
            $('#btn_save').on('click', function () {
                var emp_name = $('#emp_name').val();
                var emp_dob = $('#emp_dob').val();
                var emp_email = $('#emp_email').val();
                var emp_mobile = $('#emp_mobile').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('employees/add') ?>",
                    dataType: "JSON",
                    data: {emp_name: emp_name, emp_email: emp_email, emp_dob: emp_dob, emp_mobile: emp_mobile},
                    success: function (result) {
                        if(result["success"]==1) {
                            msg='<div class="alert alert-success alert-dismissible" role="alert"><strong class="success_msg">'+result.message+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
                            $('.msg').html(msg);
                            $('[name="emp_name"]').val("");
                            $('[name="emp_dob"]').val("");
                            $('[name="emp_email"]').val("");
                            $('[name="emp_mobile"]').val("");
                            $('#Modal_Add').modal('hide');
                            show_employees();
                        }
                        else if(result['success']==0)
                        {
                            msg='<div class="alert alert-danger alert-dismissible" role="alert"><strong class="error_msg">'+result.message+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
                            $('.msg').html(msg);
                            $('#Modal_Add').modal('hide');
                        }
                    }
                });
                return false;
            });

        //get data for update record
        $('#employees_data').on('click', '.item_edit', function () {
            var emp_id = $(this).data('emp_id');
            var emp_name = $(this).data('emp_name');
            var emp_dob = $(this).data('emp_dob');
            var emp_email = $(this).data('emp_email');
            var emp_mobile = $(this).data('emp_mobile');
            //$('.datetimepicker').datetimepicker();
            $('#Modal_Edit').modal('show');
            $('[name="emp_id_edit"]').val(emp_id);
            $('[name="emp_name_edit"]').val(emp_name);
            $('[name="emp_dob_edit"]').val(emp_dob);
            $('[name="emp_email_edit"]').val(emp_email);
            $('[name="emp_mobile_edit"]').val(emp_mobile);
        });

        //update record to database
        $('#btn_update').on('click', function () {
            var emp_name_edit = $('#emp_name_edit').val();
            var emp_id_edit = $('#emp_id_edit').val();
            var emp_dob_edit = $('#emp_dob_edit').val();
            var emp_email_edit = $('#emp_email_edit').val();
            var emp_mobile_edit = $('#emp_mobile_edit').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('employees/edit') ?>",
                dataType: "JSON",
                data: {emp_id: emp_id_edit,emp_name: emp_name_edit, emp_dob: emp_dob_edit, emp_email: emp_email_edit, emp_mobile: emp_mobile_edit},
                success: function(result) {
                    if(result["success"] == 1) {
                        msg='<div class="alert alert-success alert-dismissible" role="alert"><strong class="success_msg">'+result.message+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
                        $('.msg').html(msg);
                        $('[name="emp_name_edit"]').val("");
                        $('[name="emp_id_edit"]').val("");
                        $('[name="emp_dob_edit"]').val("");
                        $('[name="emp_email_edit"]').val("");
                        $('[name="emp_mobile_edit"]').val("");
                        $('#Modal_Edit').modal('hide');
                        show_employees();
                    }                       
                    else if(result['success']==0)
                    {
                        msg='<div class="alert alert-danger alert-dismissible" role="alert"><strong class="error_msg">'+result.message+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
                        $('.msg').html(msg);
                        $('#Modal_Edit').modal('hide');
                    }
                }
            });
            return false;
        });

        //get data for delete record
        $('#employees_data').on('click', '.item_delete', function () {
            var employee_id = $(this).data('emp_id');
            $('#Modal_Delete').modal('show');
            $('[name="employee_code_delete"]').val(employee_id);
        });

        //delete record to database
        $('#btn_delete').on('click', function () {
            var employee_code = $('#employee_code_delete').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('employees/delete') ?>",
                dataType: "JSON",
                data: {employee_id: employee_code},
                success: function(result) {
                    if(result['success']==1) {
                        msg='<div class="alert alert-success alert-dismissible" role="alert"><strong class="success_msg">'+result.message+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
                        $('.msg').html(msg);
                        $('[name="employee_code_delete"]').val("");
                        $('#Modal_Delete').modal('hide');
                        show_employees();
                    }                                            
                    else if(result['success']==0)
                    {
                        msg='<div class="alert alert-danger alert-dismissible" role="alert"><strong class="error_msg">'+result.message+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button></div>';
                        $('.msg').html(msg);
                        $('#Modal_Delete').modal('hide');
                    }
                
                }
            });
            return false;
        });

	});

</script>
</body>
</html>