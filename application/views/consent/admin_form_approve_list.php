<style>

.swal-wide{
    width:55% !important;
    overflow: scroll;
}
.data-qty-cer {
    padding: 9px 18px;
    border-radius: 5px;
    background-color: #f2f2f2;
    color: black;
    font-weight: bold;
}

div.card-header {
    font-size: 20px;
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

<script src="//unpkg.com/@ungap/global-this"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
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
    console.log("type111212 ");
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
            var checkbox_txt = '';
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
                    manage_txt = '<a href="<?php echo base_url(); ?>Rcs_Approve_Controller/form_approve/'+row.frm_id+'"><button type="button" class="btn btn-warning btn-addon btn-sm m-b-10 m-l-5" style="background-color:Tomato;"><i class="ti-pencil"></i>Edit</button></a>';
                }
                else{
                    status_txt = '<span class="badge badge-danger">ปฏิเสธ</span>';
                    manage_txt = '<a href="<?php echo base_url(); ?>Rcs_Approve_Controller/form_approve/'+row.frm_id+'"><button type="button" class="btn btn-warning btn-addon btn-sm m-b-10 m-l-5" style="background-color:Tomato;"><i class="ti-pencil"></i>Edit</button></a>';
                }

                checkbox_txt = '<div class="checkbox-single"> <input type="checkbox" id="chk-'+(i+1)+'" data-x-id="'+row.frm_id+'" data-x-type="'+row.ctg_employment_type+'" data-x-dpm="'+row.Department+'" data-x-sec="'+row.Section+'" data-x-date="'+row.apr_preparer_date+'"> </div>';
                
                temp += '<tr>';
                temp += '<td id="index">' + checkbox_txt + '</td>'; // #
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
                checkbox_txt = '';
               
            }); // forEach
            }
            
            $('.dashboard tbody').html(temp);

        }
    });
}
$(document).ready(function() {
    $('#btn-approve, #btn-reject').hide(); //เริ่มต้นให้ปุ่ม "อนุมัติ" และ "ปฏิเสธ" (ซ่อน)
    $('.data-qty-cer').show(); // เริ่มต้นให้จำนวนที่เลือกรายการ (แสดง)

    //คลิกปุ่ม checkbox เลือกรายการทั้งหมด
    $('.checkbox-all').on('change', function(e) {
        let inputs = $('.checkbox-single input:checkbox');
        if (e.originalEvent === undefined) { //ไม่ได้เลือก checkbox-all แต่เป็นการเลือกทีละ checkbox
            let allChecked = true;
            inputs.each(function() {
                allChecked = allChecked && this.checked;
            });
            this.checked = allChecked;
        } else {
            inputs.prop('checked', this
                .checked); //ให้ปุ่ม checkbox ทุกแถว (checked:false/true) ตาม event
        }
        let items = getResult(); //get value ตามที่เลือกรายการ (checkbox)
        QtyCer(items.length); //จำนวนการเลือกรายการ
        // console.log(items);

        // เช็คจำนวนการเลือกของ checkbox
        var numberOfChecked = $('.checkbox-single input:checkbox:checked')
            .length; //จำนวน checkbox ที่เลือกแล้ว
        var totalCheckboxes = $('.checkbox-single input:checkbox').length; //จำนวน checkbox ทั้งหมด
        var numberNotChecked = totalCheckboxes -
            numberOfChecked; //จำนวน checkbox ที่ยังไม่เลือก โดยที่นำ (จำนวนเลือกแล้ว - จำนวนทั้งหมด)

        if (items.length == 0) {
            $('#btn-approve, #btn-reject').hide(); //ปุ่ม "อนุมัติ" และ "ปฏิเสธ" (ซ่อน)

        } else {
            $('#btn-approve, #btn-reject').show(); //ปุ่ม "อนุมัติ" และ "ปฏิเสธ" (ซ่อน)

        }
    });

    //คลิกปุ่ม checkbox ครั้งละรายการ
    $('.checkbox-single input:checkbox').on('change', function() {
        $('.checkbox-all').trigger('change');
        var items = getResult(); //get value ตามที่เลือกรายการ (checkbox)
        QtyCer(items.length); //จำนวนการเลือกรายการ

        // เช็คจำนวนการเลือกของ checkbox
        var numberOfChecked = $('.checkbox-single input:checkbox:checked')
            .length; //จำนวน checkbox ที่เลือกแล้ว
        var totalCheckboxes = $('.checkbox-single input:checkbox').length; //จำนวน checkbox ทั้งหมด
        var numberNotChecked = totalCheckboxes -
            numberOfChecked; //จำนวน checkbox ที่ยังไม่เลือก โดยที่นำ (จำนวนเลือกแล้ว - จำนวนทั้งหมด)

        if (items.length == 0) {
            $('#btn-approve, #btn-reject').hide(); //ปุ่ม "อนุมัติ" และ "ปฏิเสธ" (ซ่อน)

        } else {
            $('#btn-approve, #btn-reject').show(); //ปุ่ม "อนุมัติ" และ "ปฏิเสธ" (ซ่อน)

        }
    });
});
//------- FUNCTION GET ข้อมูลตามที่เลือกในตาราง (checkbox) ------
function getResult() {
    var list = [];
    $(".checkbox-single input:checkbox:checked:not(.checkbox-all)").map(function() {
        let type = $(this).data('x-type');
        let department = $(this).data('x-dpm');
        let section = $(this).data('x-sec');
        let form_id = $(this).data('x-id');
        let date = $(this).data('x-date');
        if(type == 1){
            type = "Internal";
        }else{
            type = "External";
        }

        var obj = {
            "type": type,
            "department": department,
            "section": section,
            "form_id": form_id,
            "date": date

        };
        list.push(obj);
    }).get();
    return list;
}
//------- FUNCTION แสดงจำนวนรายการที่เลือก ------
function QtyCer(qty) {
    $(".data-qty-cer").html(function() {
        $("#chk-qty").text(qty);
        return "จำนวนที่เลือก " + qty + " รายการ";
    });
}

//------- FUNCTION แสดงปุ่มตาม value สถานะการอนุมัติ ------
function CheckHideAndShowBtn(value) {
    if (value == 1) {
        $('#btn-approve').show();

    } else if (value == 2) {
        $('#btn-disapproved').show();
    }
    //ไม่แสดงปุ่ม "อนุมัติ" และ "ปฏิเสธ"
    else {
        $('#btn-approve, #btn-disapproved').hide();
    }
}


//------- FUNCTION DIALOG อนุมัติสำหรับการเลือกข้อมูล ------
function ClickBtn(isApprove) {
    var text = "";
    var btn_text = "";
    var ActionText = "";
    var btn_color = "";
    var form_status = 0;
    if (isApprove == true) {
        text = "ต้องการอนุมัติแบบฟอร์มหรือไม่ ? (Do you want to approve form ?)";
        btn_text = "อนุมัติ (Approve)";
        ActionText = "อนุมัติ"
        btn_color = "green";
        form_status = 1;

    } else {
        text = "ต้องการปฏิเสธแบบฟอร์มหรือไม่ ? (Do you want to Reject form ?)";
        btn_text = "ปฏิเสธ (Reject)";
        ActionText = "ปฏิเสธ"
        btn_color = "#DD6B55";
        form_status = 2;

    }
    var temp = [];


    //forloop เก็บข้อมูลไว้ในตัวแปร temp และไปแสดงในตาราง (tbody) ของ dialog
    getResult().map(function(v) {
        temp.push('<tr><td>' + v.type + ' </td><td>' + v.department + '</td><td>' + v.section + '</td><td>' + 
        v.date + '</td></tr>');
    });

    //ปริ้นข้อมูลที่จะแสดงใน dialog
    var msg = '' +
        '<div class="msg_status_approve">' +
        '<div class="text-left"><h5> คุณทำการเลือกแบบฟอร์มขอพนักงานเพื่อ' + ActionText + 'จำนวนทั้งหมด ' + getResult()
        .length + ' รายการ ดังนี้</h5></div>' +
        '</div class="table-responsive">' +
        '<table class="table table-bordered">' +
        '<thead class="thead-light"> ' +
        '<th width="30%">Type of Recruitment </th>' +
        '<th width="30%"> Department </th>' +
        '<th width="20%"> Section </th>' +
        '<th width="20%"> Date of Create </th>' +
        '</thead>' +
        '<tbody>' +
        temp.join(' ') +
        '</tbody>' +
        '</table>';
        msg += '<br>';
        msg += '<p class="text-left">หมายเหตุ</p>';
    swal({
            title: text,
            html: true,
            text: msg,
            type: "input",
            customClass: 'swal-wide',
            showCancelButton: true,
            confirmButtonColor: btn_color,
            confirmButtonText: btn_text,
            cancelButtonText: "ยกเลิก (Cancel)",
            closeOnConfirm: false,
            closeOnCancel: false  
        },
        function(inputValue){
            var check = true;   
           //isApprove == true (อนุมัติ)
           //isApprove == false (ปฏิเสธ)

            if (inputValue === null && isApprove == false){
                check = false;
                return false;
            } 
            else if (inputValue === "" && isApprove == false) {
                swal.showInputError("กรุณากรอกหมายเหตุ (Please Enter Reason)");
                check = false;
                return false;
            }
            
            else if(inputValue === false && isApprove == true){   //cancel Approve
                swal("Cancelled", "Your imaginary data is safe :)1", "error");
                check = false;
            }

            else if(inputValue == false && isApprove == false){  //cancel reject
                swal("Cancelled", "Your imaginary data is safe :)2", "error");
                check = false;
            }

            if(check){
                swal("Successfully!", "Your data was saved!", "success");
                    var length = getResult().length;
                    var clonedModel = Object.assign([], getResult());
                    clonedModel.map(function(model, i) {

                        $.ajax({
                            type: 'post',
                            url: "<?php echo base_url(); ?>/Rcs_Approve_Controller/save_data",
                            data: {
                                "form_id": model.form_id,
                                "form_status" : form_status,
                                "note" : inputValue
                            },
                            dataType: "JSON",
                            success: function(data) {
                                i++;
                                if (length == i) {
                                    setTimeout(() => {
                                        window.location =
                                            "<?php echo base_url(); ?>Rcs_Approve_Controller/index";

                                    }, 1200);
                                }
                            }
                        });
                    });

            }
  
        });

}
</script>
<input type="hidden" id="form_info_count" value="<?php echo count($form_info); ?>">
<div class="col-lg-12">
    <div class="card-header p-3 mb-2 bg-primary text-white rounded"> <b>รายการอนุมัติแบบฟอร์มขอพนักงานสำหรับผู้ดูแลระบบ (Personnel Requisition Form Approve for Admin List)</b> </div>
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

            <div class="table-responsive mt-5">
                <table class="table table-bordered dashboard">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkbox-all" class="checkbox-all"></th>
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
                                <td colspan="7"><center>- ไม่พบข้อมูล (No Data) -</center></td>
                            </tr>
                        <?php
                        }
                            foreach($form_info as $index => $row ){
                        ?>
                        <tr>
                            <td id="index">
                                <div class="checkbox-single">
                                    <input type="checkbox" id="chk-<?php echo $index+1; ?>"
                                        data-x-id="<?php echo $row->frm_id; ?>"
                                        data-x-type="<?php echo $row->ctg_employment_type; ?>"
                                        data-x-dpm="<?php echo $row->Department; ?>"
                                        data-x-sec="<?php echo $row->Section; ?>"
                                        data-x-date="<?php echo $row->apr_preparer_date; ?>">
                                </div>

                            </td>
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
                                    href="<?php echo base_url(); ?>Rcs_Admin_Controller/form_approve/<?php echo $row->frm_id; ?>">
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
                                    href="<?php echo base_url(); ?>Rcs_Admin_Controller/form_approve/<?php echo $row->frm_id; ?>">
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
                                <button type="button" class="btn btn-danger btn-addon btn-sm m-b-10 m-l-5"><i
                                        class="ti-download"></i>PDF</button>
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
            <br><br>
            <div class="text-right mt-12" id="footer">
                <span class="label-after-title mr-8">
                    <span class="data-qty-cer btn" style="float: left;">จำนวนที่เลือก <span id="chk-qty">0</span>
                        รายการ</span>
                    <button type="button" class="btn btn-success btn-addon btn-md m-b-10 m-l-5" id="btn-approve"
                        style="float: right;" onclick="ClickBtn(true)">
                        <i class="ti-check"></i>อนุมัติ (Approve)</button>
                    <button type="button" class="btn btn-danger btn-addon btn-md m-b-10 m-l-5" id="btn-reject"
                        style="float: right;" onclick="ClickBtn(false)">
                        <i class="ti-close"></i>ปฏิเสธ (Reject)</button>
                </span>
            </div>
        </div>
    </div>
    <!-- /# card -->
</div>