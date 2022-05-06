<style>
div.card-header {
    font-size: 24px;
}

table th {
    text-align: center;
    vertical-align: middle;
}
</style>

<input type="hidden" name="form_id" id="form_id" value="<?php echo $form_id; ?>">
<div class="col-lg-12">
    <div class="card-header p-3 mb-2 bg-primary text-white rounded"> <b>อนุมัติแบบฟอร์มขอพนักงาน (Personnel Requisition
            Form
            Approve)</b>
    </div>
    <div class="card">
        <div class="card-body p-b-0">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs customtab2" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#type" role="tab"><span
                            class="hidden-sm-up"></span> <span class="hidden-xs-down">ประเภทการขอพนักงาน</span></a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#qual" role="tab"><span
                            class="hidden-sm-up"></span> <span class="hidden-xs-down">คุณสมบัติ</span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#headcount" role="tab"><span
                            class="hidden-sm-up"></span> <span class="hidden-xs-down">การควบคุมจำนวนพนักงาน</span></a>
                </li>
                <?php   
                    if($form_data[0]->hcc_type != 2){ 
                ?>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#resigned" role="tab"><span
                            class="hidden-sm-up"></span> <span class="hidden-xs-down">รายชื่อพนักงานลาออก</span></a>
                </li>
                <?php   
                    }
                ?>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#transfer" role="tab"><span
                            class="hidden-sm-up"></span> <span class="hidden-xs-down">รายชื่อพนักงานโอนย้าย /
                            หมุนเวียนงาน </span></a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#status" role="tab"><span
                            class="hidden-sm-up"></span> <span class="hidden-xs-down">สถานะการอนุมัติ </span></a> </li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane p-20 active" id="type" role="tabpanel">
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>ประเภทการขอพนักงาน
                                (Recruitment Type) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                            if($form_data[0]->ctg_employment_type == 1){ 
                                echo 'ภายใน (Internal)';
                            }
                            else{
                                echo 'ภายนอก (External)';
                            }
                        ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>ตำแหน่งที่ต้องการ (Required
                                Position) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                                echo $form_data[0]->Position_name;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>แผนก (Department) :</b>
                        </label>
                        <div class="col-sm-8">
                            <?php  
                                echo $form_data[0]->Department;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>หน่วยงาน (Section) :</b>
                        </label>
                        <div class="col-sm-8">
                            <?php  
                                echo $form_data[0]->Section;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>รหัสแผนก (Section Code) :</b>
                        </label>
                        <div class="col-sm-8">
                            <?php  
                                echo $form_data[0]->Section_id;
                            ?>
                        </div>
                    </div>
                    <?php 
                        if($form_data[0]->ctg_employment_type == 1){ //internal
                    ?>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>ประเภทหน่วยงาน (Section Type)
                                :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                                if($form_data[0]->ctg_internal_type == 1){
                                    echo "Indirect to Direct";
                                }else if($form_data[0]->ctg_internal_type == 2){
                                    echo "Indirect to Indirect";
                                }
                                else if($form_data[0]->ctg_internal_type == 3){
                                    echo "Direct to Indirect";
                                }else{
                                    echo "Direct to Direct";
                                }
                            ?>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>จำนวนคนที่ต้องการ (Required
                                Number) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $form_data[0]->ctg_req_num;
                            ?>
                        </div>
                    </div>
                    <?php 
                        if($form_data[0]->ctg_employment_type == 2){ //external
                    ?>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>ประเภทพนักงานและประเภทการจ้าง
                                (Type of Employment) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                                if($form_data[0]->ctg_external_type == 1){
                                    echo "พนักงานประจำ (Permanent Associate)";
                                }
                                else if($form_data[0]->ctg_external_type == 3 || $form_data[0]->ctg_external_type == 4){
                                    echo "พนักงานชั่วคราว (Temporary Associate) - ";
                                    if($form_data[0]->ctg_external_type == 3){
                                        echo "รายวัน (Daily)";
                                    }
                                    else{
                                        echo "รายเดือน (Monthly)";
                                    }
                                }
                                else{
                                    echo "ผู้ปฏิบัติงานรับเหมาช่วง / พนักงานซับคอนแทรค โดยจ้างแบบมีระยะจำกัด (Subcontractor by Limited Employment Contract)";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>วันที่เริ่มการจ้าง (Start
                                Date) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $form_data[0]->ctg_start_date;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>วันที่สิ้นสุดการจ้าง (End
                                Date) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $form_data[0]->ctg_end_date;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>วันที่ต้องการให้เริ่มงาน
                                (Required Date) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $form_data[0]->ctg_req_date;
                            ?>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
                <!-- type -->

                <div class="tab-pane  p-20" id="qual" role="tabpanel">
                    <?php
                        if($form_data[0]->qlf_education_level == 1){
                            $education = "วุฒิการศึกษา ม.3 (Secondary Education)";
                        }
                        else if($form_data[0]->qlf_education_level == 2){
                            $education = "วุฒิการศึกษา ม.6 / ปวช. (Highschool Education / Vocational Certificate)";
                        }else if($form_data[0]->qlf_education_level == 3){
                            $education = "ปวส. (High Vocational Certificate)";
                        }else if($form_data[0]->qlf_education_level == 4){
                            $education = "ปริญญาตรี (Bachelor's Degree)";
                        }else{
                            $education = "ปริญญาโท (Master Degree)";
                        }
                
                        if($form_data[0]->qlf_com == 1){
                            $com = "ไม่ต้องการ (Not Require)";
                        }else if($form_data[0]->qlf_com == 2){
                            $com = "Microsoft Office";
                        }else {
                            $com = $form_data[0]->qlf_com_ect;
                        }
                
                        if($form_data[0]->qlf_eng == 1){
                            $eng = "ไม่ต้องการ (Not Require)";
                        }else{
                            $eng = "TOEIC มากกว่า 400 (TOEIC More than 400)";
                        }
                        
                        if($form_data[0]->qlf_japan == 1){
                            $japan = "ไม่ต้องการ (Not Require)"; 
                        }else if($form_data[0]->qlf_japan == 2){
                            $japan = "ระดับ N 3-4 (Level N 3-4)"; 
                        }
                        else if($form_data[0]->qlf_japan == 3){
                            $japan = "ระดับ N 2 (Level N 2)"; 
                        }
                        else {
                            $japan = "ระดับ N 1 (Level N 1)"; 
                        }
                    ?>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>1. ระดับการศึกษา (Education)
                                :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $education;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>สาขา (Major) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $form_data[0]->qlf_education_major;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>2. ประสบการณ์ (Work
                                Experience) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $form_data[0]->qlf_work_exp. " ปี";
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ทางด้าน (Major) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $form_data[0]->qlf_work_exp_field;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>3. ความสามารถด้านคอมพิวเตอร์
                                (Computer) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $com;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>4. ความสามารถด้านภาษา
                                (Language) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $education;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ภาษาอังกฤษ (English) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $eng;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>ภาษาญี่ปุ่น (Japan) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $japan;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label"> <b>5. อื่น ๆ (Additional
                                Requirement) :</b> </label>
                        <div class="col-sm-8">
                            <?php  
                               echo $form_data[0]->qlf_ect;
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-7 col-form-label"> <b>หน้าที่ความรับผิดชอบ (Duty &
                                Responsibility) อ้างอิง JD หมายเลข (Reference JD No.) :</b> </label>
                        <div class="col-sm-5">
                            <?php  
                               echo $form_data[0]->frm_ref_id;
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-6 col-form-label"> <b>หน้าที่ความรับผิดชอบเพิ่มเติม
                                (AdditionDuty & Responsibility) :</b> </label>
                        <div class="col-sm-6">
                            <?php  
                               echo $form_data[0]->frm_addition;
                            ?>
                        </div>
                    </div>
                </div>
                <!-- qual -->

                <div class="tab-pane p-20" id="headcount" role="tabpanel">
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-12 col-form-label">
                            <b>
                                <?php
                                    if($form_data[0]->hcc_type == 1){ 
                                        echo 'อัตราทดแทนพนักงานลาออก (Replacement of Resigned Member)';
                                    }
                                    else if($form_data[0]->hcc_type == 2){ 
                                        echo 'อัตราเพิ่มจากแผนกำลังคน (Increment from Headcount)';
                                    }
                                    else{
                                        echo 'อัตราทดแทนพนักงานโอนย้าย (Replacement of Job Rotation)';

                                    }
                                ?>
                            </b>
                        </label>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label">
                            <b>
                                <?php
                                    if($form_data[0]->hcc_type == 1){ 
                                        echo 'จำนวนคนที่ลาออก (Number of Resigned) : ';
                                    }
                                    else if($form_data[0]->hcc_type == 2){ 
                                        echo 'จำนวนคน (Number) : ';
                                    }
                                    else{
                                        echo 'จำนวนคนที่โอนย้าย (Number of Transfer) : ';
                                    }
                                ?>
                            </b>
                        </label>
                        <div class="col-sm-8">
                            <?php
                                if($form_data[0]->hcc_type == 1){ 
                                    echo $form_data[0]->hcc_num1;
                                }
                                else if($form_data[0]->hcc_type == 2){ 
                                    echo $form_data[0]->hcc_num1;
                                }
                                else{
                                    echo $form_data[0]->hcc_num1;
                                }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <label for="recruitment_type" class="col-sm-4 col-form-label">
                            <b>
                                <?php
                                    if($form_data[0]->hcc_type == 1){ 
                                        echo 'จำนวนคนที่ต้องการ (Required Number) : ';
                                    }
                                    else if($form_data[0]->hcc_type == 2){ 
                                        echo 'เหตุผลที่ขอคนเพิ่มจากแผนกำลังคน (Reason) : ';
                                    }
                                    else{
                                        echo 'จำนวนคนที่ต้องการ (Required Number) : ';
                                    }
                                ?>
                            </b>
                        </label>
                        <div class="col-sm-8">
                            <?php
                                if($form_data[0]->hcc_type == 1){ 
                                    echo $form_data[0]->hcc_num2;
                                }
                                else if($form_data[0]->hcc_type == 2){ 
                                    echo $form_data[0]->hcc_note;
                                }
                                else{
                                    echo $form_data[0]->hcc_num2;
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- headcount -->

                <div class="tab-pane  p-20" id="resigned" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="emp_list">
                            <thead>
                                <tr>
                                    <th rowspan="2">
                                        <center>#</center>
                                    </th>
                                    <th colspan="5">
                                        <center>
                                            <?php   
                                                if($form_data[0]->hcc_type == 1){ 
                                                    echo 'พนักงานลาออก (Name List of Resigned)';
                                                }else{
                                                    echo 'พนักงานโอนย้าย (Name List of Transfer)';
                                                }
                                                ?>
                                        </center>
                                    </th>
                                    <th rowspan="2">
                                        <center>วันที่มีผล (Effective Date)</center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <center>รหัสพนักงาน (Employee ID)</center>
                                    </th>
                                    <th>
                                        <center>ชื่อ-นามสกุล (Name-Surname)</center>
                                    </th>
                                    <th>
                                        <center>ตำแหน่ง (Position)</center>
                                    </th>
                                    <th>
                                        <center>แผนก (Department)</center>
                                    </th>
                                    <th>
                                        <center>รหัสแผนก (Section Code)</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                                foreach($emp_info as $index => $row){
                                            ?>
                                <tr>
                                    <td>
                                        <center><?php echo $index+1; ?></center>
                                    </td>
                                    <td><?php echo $row->Emp_ID; ?></td>
                                    <td><?php echo $row->Emp_nametitle.$row->Empname_th." ".$row->Empsurname_th; ?>
                                    </td>
                                    <td><?php echo $row->Position_name; ?></td>
                                    <td><?php echo $form_data[0]->Department; ?></td>
                                    <td><?php echo $row->Sectioncode_ID; ?></td>
                                    <td>
                                        <center>
                                            <?php echo date_format(date_create($row->nlt_effective_date),"j F o"); ?>
                                        </center>
                                    </td>
                                </tr>
                                <?php 
                                                }
                                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- resigned -->
                <div class="tab-pane p-20" id="transfer" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="emp_list">
                            <thead>
                                <tr>
                                    <th rowspan="2">
                                        <center>#</center>
                                    </th>
                                    <th colspan="2">
                                        <center>พนักงานที่มาทดแทน (List of Replacement)</center>
                                    </th>
                                    <th rowspan="2">
                                        <center>วันที่มาเริ่มงาน (Starting Date)</center>
                                    </th>
                                </tr>
                                <tr>
                                    <th>
                                        <center>รหัสพนักงาน (Employee ID)</center>
                                    </th>
                                    <th>
                                        <center>ชื่อ-นามสกุล (Name-Surname)</center>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($nlt_info) == 0){ ?>
                                <tr>
                                    <td colspan="5">
                                        <center>- ไม่พบข้อมูล (No Data) - </center>
                                    </td>
                                </tr>

                                <?php }else{ 
                                        foreach($nlt_info as $index => $row){ 
                                        
                                    ?>
                                <tr>
                                    <td>
                                        <center><?php echo $index+1; ?></center>
                                    </td>
                                    <td><?php echo $row->Emp_ID; ?></td>
                                    <td>
                                        <?php echo $row->Empname_th." ".$row->Empsurname_th; ?></td>
                                    <td>
                                        <center>
                                            <?php echo date_format(date_create($row->nlt_start_date),"j F o"); ?>
                                        </center>
                                    </td>
                                </tr>
                                <?php 
                                        }
                                        } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- transfer -->
                <div class="tab-pane  p-20" id="status" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="4">
                                    <center>For Requester of Each Department</center>
                                </th>
                                <th colspan="3" rowspan="3">
                                    <center>For HR Department HRD/Planning & Recruitment Section
                                    </center>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="4">
                                    <center>Case 1: Replacement of Resigned Member / Case 2: Increment
                                        from
                                        Headcount</center>
                                </th>
                            </tr>
                            <tr>
                                <th colspan="3">
                                    <center>Case 3 : Replacement of Job Rotation (For indirect group
                                        utilized
                                        Internal recruitment/transfer only)</center>
                                </th>
                                <th rowspan="2">
                                    <center>Approved by</center>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <center>Prepared by</center>
                                </th>
                                <th>
                                    <center>Checked by</center>
                                </th>
                                <th>
                                    <center>Approved by</center>
                                </th>
                                <th>
                                    <center>Received by</center>
                                </th>
                                <th>
                                    <center>Checked by</center>
                                </th>
                                <th>
                                    <center>Approved by</center>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php  
                                        foreach($approver_info as $index => $row){
                                            
                                            if($index == 0){
                                    ?>
                                <td rowspan="2">

                                    <?php echo $row->Emp_nametitle.$row->Empname_th."   ".$row->Empsurname_th; ?>
                                </td>

                                <?php   }
                                                else if($index+1 != count($approver_info)){
                                            ?>
                                <td>

                                    <?php echo $row->Emp_nametitle.$row->Empname_th."   ".$row->Empsurname_th; ?>
                                </td>

                                <?php   
                                                }else{
                                            ?>

                                <td style="text-align:left">
                                    <?php echo $row->Emp_nametitle.$row->Empname_th."   ".$row->Empsurname_th; ?>
                                </td>


                                <?php  
                                                }
                                        }
                                    ?>
                            </tr>

                            <?php
                                        $approved_status = '<span class="badge badge-success">อนุมัติ</span>';
                                        $reject_status = '<span class="badge badge-danger">ปฏิเสธ</span>';
                                        $wait_status = '<span class="badge badge-warning">รออนุมัติ</span>';
                                        $skip_status = '<span class="badge badge-primary">ข้าม</span>';        
                                    ?>
                            <tr>
                                <td>
                                    <center><?php if($form_data[0]->apr_checker_status == 1) {
                                                echo $approved_status;
                                            }else if($form_data[0]->apr_checker_status == 2){
                                                echo $reject_status;
                                            }else{
                                                echo $wait_status;
                                            }  ?></center>
                                </td>
                                <td>
                                    <center><?php if($form_data[0]->apr_approver_status == 1) {
                                                echo $approved_status;
                                            }else if($form_data[0]->apr_approver_status == 2){
                                                echo $reject_status;
                                            }else{
                                                echo $wait_status;
                                            }  ?></center>
                                </td>
                                <td>
                                    <center><?php 
                                        if($state_to_president == "yes"){
                                            if($form_data[0]->apr_approver_md_status == 1) {
                                                echo $approved_status;
                                            }else if($form_data[0]->apr_approver_md_status == 2){
                                                echo $reject_status;
                                            }else{
                                                echo $wait_status;
                                            }  
                                        }
                                        else{
                                            echo $skip_status;
                                        }?>
                                    </center>
                                </td>
                                <td>
                                    <center><?php if($form_data[0]->apr_receiver_admin_status == 1) {
                                                echo $approved_status;
                                            }else if($form_data[0]->apr_receiver_admin_status == 2){
                                                echo $reject_status;
                                            }else{
                                                echo $wait_status;
                                            }  ?></center>
                                </td>
                                <td>
                                    <center><?php if($form_data[0]->apr_checker_admin_status == 1) {
                                                echo $approved_status;
                                            }else if($form_data[0]->apr_checker_admin_status == 2){
                                                echo $reject_status;
                                            }else{
                                                echo $wait_status;
                                            }  ?></center>
                                </td>
                                <td>
                                    <center><?php if($form_data[0]->apr_approver_admin_status == 1) {
                                                echo $approved_status;
                                            }else if($form_data[0]->apr_approver_admin_status == 2){
                                                echo $reject_status;
                                            }else{
                                                echo $wait_status;
                                            }  ?></center>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center>Staff (T7) above</center>
                                </td>
                                <td>
                                    <center>HoS. above</center>
                                </td>
                                <td>
                                    <center>HoDiv. above</center>
                                </td>
                                <td>
                                    <center>President/MD</center>
                                </td>
                                <td>
                                    <center>Sr. Staff (T6) above</center>
                                </td>
                                <td>
                                    <center>HoS. above</center>
                                </td>
                                <td>
                                    <center>HoDiv. above</center>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center>
                                        <?php echo date_format(date_create($form_data[0]->apr_preparer_date),"j F o");?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if($form_data[0]->apr_checker_date != NULL) echo date_format(date_create($form_data[0]->apr_checker_date),"j F o");?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if($form_data[0]->apr_approver_date != NULL) echo date_format(date_create($form_data[0]->apr_approver_date),"j F o");?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if($form_data[0]->apr_approver_md_date != NULL) echo date_format(date_create($form_data[0]->apr_approver_md_date),"j F o");?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if($form_data[0]->apr_receiver_admin_date != NULL) echo date_format(date_create($form_data[0]->apr_receiver_admin_date),"j F o");?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if($form_data[0]->apr_checker_admin_date != NULL) echo date_format(date_create($form_data[0]->apr_checker_admin_date),"j F o");?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php if($form_data[0]->apr_approver_admin_date != NULL) echo date_format(date_create($form_data[0]->apr_approver_admin_date),"j F o");?>
                                    </center>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                </div>
                <!-- status -->
            </div>
        </div>
    </div>
    <div class="card">
        <h6>หมายเหตุ (Reason)</h6>
        <div class="form-row mt-4">
            <div class="note_div col-12">
                <input type="text" class="form-control" name="note" id="note"
                    value="<?php echo $form_data[0]->apr_note; ?> ">
                    <span id="note_span" style="color: red;"> </span>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div lass="col-2">
                <a href="<?php echo base_url(); ?>Rcs_Approve_Controller/index">
                    <button type="button" class="btn btn-default btn-addon btn-md m-b-10 m-l-5" style="float: left;"><i
                            class="ti-back-left"></i>Back</button>
                </a>
            </div>
            <div class="col-6">

                <button type="button" class="btn btn-success btn-addon btn-md m-b-10 m-l-5" id="btn_success"
                    style="float: right;" onclick="validate_form(1)">
                    <i class="ti-check"></i>Approve</button>

                <button type="button" class="btn btn-danger btn-addon btn-md m-b-10 m-l-5" id="btn_reject"
                    style="float: right;" onclick="validate_form(2)">
                    <i class="ti-close"></i>Reject</button>
            </div>
        </div>
    </div>
</div>

<!-- /# card -->

</div>

</div>
<script>
function validate_string(str) {
    return str.replace(/^\s+|\s+$/g, '');
}

function validate_form(value) {
    var note = document.getElementById("note").value;
    
    if (value == 2 && validate_string(note) == '') {
        $(".note_div").addClass("is-invalid");
        document.getElementById('note_span').innerHTML = " ** กรุณากรอกหมายเหตุ";
    } else {
        $(".note_div").removeClass("is-invalid");
        document.getElementById('note_span').innerHTML = "";
        approve(value);
    }

}

function approve(value) {
    var text = "";
    var btn_color = "";
    var btn_text = "";
    var form_id = document.getElementById("form_id").value;
    var note = document.getElementById("note").value;
    var check = true;


    if (value == 1) { //approve
        text = "ต้องการอนุมัติแบบฟอร์มหรือไม่ ? (Do you want to approve form ?)";
        btn_color = "green";
        btn_text = "อนุมัติ (Approve)";
    } else { //reject
        text = "ต้องการปฏิเสธแบบฟอร์มหรือไม่ ? (Do you want to Reject form ?)";
        btn_color = "#DD6B55";
        btn_text = "ปฏิเสธ (Reject)";
    }
    swal({
            title: "Are you sure?",
            text: text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: btn_color,
            confirmButtonText: btn_text,
            cancelButtonText: "ยกเลิก (Cancel)",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {

            if (isConfirm) {
                swal("Successfully!", "Your data was saved!", "success");
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>/Rcs_Approve_Controller/save_data",
                    data: {
                        "form_status": value,
                        "form_id": form_id,
                        "note": note
                    },
                    dataType: "JSON",
                    success: function(data) {
                        setTimeout(() => {
                            window.location =
                                "<?php echo base_url(); ?>Rcs_Approve_Controller/index";

                        }, 1200);
                    }
                }); 
            } else {
                swal("Cancelled", "Your imaginary data is safe :)", "error");
            }
        });
}
</script>