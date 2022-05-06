<style>
div.card-header {
    font-size: 22px;
}

td#index,
td#type,
td#date,
td#status,
td#manage,
th {
    text-align: center;
    vertical-align: middle;
}

td#dpm,
td#sec {
    text-align: left;
    vertical-align: middle;
}

tr:hover {
    background-color: #f2f2f2;
}
</style>
<script>
function search_data() {
    var type = document.getElementById("type").value;
    var department_id = document.getElementById("department_id").value;
    var create_date = document.getElementById("create_date").value;
    var status_form = document.getElementById("status_form").value;
    var temp = '';

    if (type == "0") {
        type = null;
    }
    if (department_id == "0") {
        department_id = null;
    }
    if (status_form == "0") {
        status_form = null;
    }
    if (create_date == "") {
        create_date = null;
    }
    console.log("type ", type);
    console.log("department_id ", department_id);
    console.log("status_form ", status_form);
    console.log("create_date ", create_date);
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>/Rcs_Admin_Controller/search_data",
        data: {
            "type": type,
            "department_id": department_id,
            "status_form": status_form,
            "create_date": create_date

        },
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            var type_txt = '';
            var status_txt = '';
            var manage_txt = '';
            var date = '';
            if(data.length == 0){
                temp += '<tr>';
                temp += '<td colspan="7"><center>- ไม่พบข้อมูล (No Data) - </center></td>';
                temp += '<tr>';
            }else{
                data.forEach((row, i) => {
                
                if(row.ctg_employment_type == 1){
                    type_txt = "Internal";
                }
                else{
                    type_txt = "External";
                }

                if(row.frm_status == 1){
                    status_txt = '<span class="badge badge-warning">รออนุมัติ</span>';
                    manage_txt = '<a href="<?php echo base_url(); ?>Rcs_admin_controller/form_edit/'+row.frm_id+'"><button type="button" class="btn btn-warning btn-addon btn-sm m-b-10 m-l-5" style="background-color:Tomato;"><i class="ti-pencil"></i>Edit</button></a>';
                }
                else if(row.frm_status == 2){
                    status_txt = '<span class="badge badge-danger">ปฏิเสธ</span>';
                    manage_txt = '<a href="<?php echo base_url(); ?>Rcs_admin_controller/form_edit/'+row.frm_id+'"><button type="button" class="btn btn-warning btn-addon btn-sm m-b-10 m-l-5" style="background-color:Tomato;"><i class="ti-pencil"></i>Edit</button></a>';
                }
                else{
                    status_txt = '<span class="badge badge-success">อนุมัติ</span>';
                    manage_txt += '<a href="<?php echo base_url(); ?>Rcs_admin_controller/form_edit/'+row.frm_id+'"><button type="button" class="btn btn-warning btn-addon btn-sm m-b-10 m-l-5" style="background-color:Tomato;"><i class="ti-pencil"></i>Edit</button></a>';
                    manage_txt += '<a href="<?php echo base_url(); ?>Rcs_Form_Controller/export_pdf/'+row.frm_id+'"> <button type="button" class="btn btn-danger btn-addon btn-sm m-b-10 m-l-5" ><i class="ti-download"></i>PDF</button> </a>';
                }
                
                temp += '<tr>';
                temp += '<td id="index">' + (i+1) + '</td>'; // #
                temp += '<td id="type">' + type_txt + '</td>'; // Type of Recruitment
                temp += '<td id="dpm">' + row.Department +'</td>'; // Department
                temp += '<td id="sec">' + row.Section +'</td>'; // Section
                temp += '<td id="date">' + row.apr_preparer_date +'</td>'; // Date of Create
                temp += '<td id="status">' + status_txt + '</td>'; // Status
                temp += '<td id="manage">'+ manage_txt +'</td>'; // Manage
                temp += '<tr>';

                type_txt = '';
                status_txt = '';
                manage_txt = '';
               
            }); // forEach
            }
            
            $('.dashboard tbody').html(temp);

        }
    });
}
</script>
<div class="col-lg-12">
    <div class="card-header p-3 mb-2 bg-primary text-white rounded"> <b>รายการแบบฟอร์มขอพนักงานสำหรับผู้ดูแลระบบ (Personnel Requisition Form for Admin List)</b> </div>
    <div class="card">
        <!-- fillter -->
        <!-- <form action="<?php echo base_url(); ?>Rcs_controller/index" method="post"> -->


        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>ประเภทการรับสมัคร (Type of Recruitment)</label>
                    <select class="form-control" name="type" id="type" value="<?php echo $type; ?>" selected>
                        <option value="0">ทั้งหมด</option>
                        <option value="1">Internal</option>
                        <option value="2">External</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>แผนก (Department)</label>
                    <select class="form-control" name="department_id" id="department_id">
                        <option value="0">ทั้งหมด</option>
                        <?php
                        foreach($departments as $index => $row ){
                    ?>
                        <option value="<?php echo $row->Department_id ?>"><?php echo $row->Department ?></option>
                        <?php 
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>วันที่สร้างแบบฟอร์ม (Date of Create)</label>
                    <input type="date" class="form-control" name="create_date" id="create_date">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label>สถานะ (Status)</label>
                    <select class="form-control" name="status_form" id="status_form">
                        <option value="0">ทั้งหมด</option>
                        <option value="1">รออนุมัติ</option>
                        <option value="2">ปฏิเสธ</option>
                        <option value="3">อนุมัติ</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 mt-2">
                <br>
                <button type="submit" class="btn btn-primary btn-addon btn-md m-b-10 m-l-5" onclick="search_data()"><i
                        class="ti-search"></i>Search</button>
            </div>
        </div>
        <!-- </form> -->

        <div class="card-body">
            <a href="<?php echo base_url(); ?>Rcs_Form_Controller/form">
                <button type="submit" class="btn btn-success btn-addon btn-md m-b-10 m-l-5" style="float: right;">
                    <i class="ti-plus"></i>Personnel Requisition Form</button></a>
            <div class="table-responsive">
                <table class="table table-bordered dashboard">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ประเภทการรับสมัคร (Type of Recruitment)</th>
                            <th>แผนก (Department)</th>
                            <th>หน่วยงาน (Section)</th>
                            <th>วันที่สร้างแบบฟอร์ม (Date of Create)</th>
                            <th>สถานะ (Status)</th>
                            <th style="text-align:center">จัดการ (Manage)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($form_info) == 0){
                        ?>
                            <tr>
                                <td colspan="7"><center>- ไม่พบข้อมูล (No Data) - </center></td>
                            </tr>
                        <?php
                            }
                            foreach($form_info as $index => $row ){
                        ?>
                        <tr>
                            <td id="index"><?php echo $index+1; ?></td>
                            <?php 
                                    if($row->ctg_employment_type == 1){  
                                ?>
                            <td id="type"><?php echo "Internal"; ?></td>
                            <?php 
                                    }
                                    else{
                                ?>
                            <td id="type"><?php echo "External"; ?></td>
                            <?php 
                                    }
                                ?>
                            <td id="dpm"><?php echo $row->Department; ?></td>
                            <td id="sec"><?php echo $row->Section; ?></td>
                            <td id="date"><?php echo $row->apr_preparer_date; ?></td>
                            <?php 
                                    if($row->frm_status == 1){  //wait for approve
                                ?>
                            <td id="status"><span class="badge badge-warning">รออนุมัติ</span></td>
                            <td id="manage">
                                <a
                                    href="<?php echo base_url(); ?>Rcs_admin_controller/form_edit/<?php echo $row->frm_id; ?>">
                                    <button type="button" class="btn btn-warning btn-addon btn-sm m-b-10 m-l-5"
                                        style="background-color:Tomato;"><i class="ti-pencil"></i>Edit</button>
                                </a>

                            </td>
                            <?php 
                                    }
                                    else if($row->frm_status == 2){ //reject
                                ?>
                                <td id="status"><span class="badge badge-danger">ปฏิเสธ</span></td>
                            <td id="manage">
                                <a
                                    href="<?php echo base_url(); ?>Rcs_admin_controller/form_edit/<?php echo $row->frm_id; ?>">
                                    <button type="button" class="btn btn-warning btn-addon btn-sm m-b-10 m-l-5"
                                        style="background-color:Tomato;"><i class="ti-pencil"></i>Edit</button>
                                </a>

                            </td>
                           
                            <?php 
                                    }
                                    else{   //approved
                            ?>
                             <td id="status"><span class="badge badge-success">อนุมัติ</span></td>
                            <td id="manage">
                                <a
                                    href="<?php echo base_url(); ?>Rcs_admin_controller/form_edit/<?php echo $row->frm_id; ?>">
                                    <button type="button" class="btn btn-warning btn-addon btn-sm m-b-10 m-l-5"
                                        style="background-color:Tomato;"><i class="ti-pencil"></i>Edit</button>
                                </a>
                                <a
                                    href="<?php echo base_url(); ?>Rcs_Form_Controller/export_pdf/<?php echo $row->frm_id; ?>">
                                    <button type="button" class="btn btn-danger btn-addon btn-sm m-b-10 m-l-5" ><i
                                            class="ti-download"></i>PDF</button>
                                </a>
                            </td>

                            <?php
                                    }
                                   
                                ?>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /# card -->
</div>