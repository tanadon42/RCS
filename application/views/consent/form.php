<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

<div class="multisteps-form">
    <br><br>
    <!--progress bar-->
    <div class="row">
        <div class="col-12 ml-auto mr-auto mb-4">
            <div class="multisteps-form__progress">
                <button class="multisteps-form__progress-btn js-active" type="button" disabled>ประเภทการขอพนักงาน (Type of
                    Recruitment)</button>
                <button class="multisteps-form__progress-btn" type="button" disabled>คุณสมบัติ (Qualification Required)</button>
                <button class="multisteps-form__progress-btn" type="button" disabled>การควบคุมจำนวนพนักงาน (Headcount
                    Control)</button>
                <button class="multisteps-form__progress-btn" type="button" disabled>รายชื่อพนักงาน (Employee List) </button>
            </div>
        </div>
    </div>
    <!--form panels-->
    <div class="row">
        <div class="col-12 m-auto">
            <div class="card-header p-3 mb-2 bg-primary text-white rounded"> <b>ประเภทการขอพนักงาน (Type of
                    Recruitment)</b> </div>
            <form class="multisteps-form__form" id="rcs_form">
                <!--single form panel-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                    <label>
                        <h5>ประเภทการขอพนักงาน (Type of Recruitment) <font color="red">*</font>
                        </h5>
                    </label>
                    <select class="form-control" name="recruitment_type" id="recruitment_type"
                        onchange="show_category(value)">
                        <option>กรุณาเลือกประเภทการขอพนักงาน (Please Select Type of Recruitment)</option>
                        <option value="1">ภายใน (Internal Recruitment)</option>
                        <option value="2">ภายนอก (External Recruitment)</option>
                    </select>
                    <div class="multisteps-form__content">
                        <div id="internal" style="display: none;">
                            <div class="multisteps-form__content">
                                <div class="form-row mt-4">
                                    <div class="position_select_1_div col-12 col-sm-6">
                                        <label>
                                            <h5>ตำแหน่งที่ต้องการ (Required Position) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <input list="pos_list_1" class="form-control" id="position_select_1"
                                            placeholder="กรุณาเลือกรหัสพนักงาน (Please Select Employee ID)">
                                        <datalist id="pos_list_1">
                                            <?php foreach($position as $index => $row){ ?>
                                            <option data-value="<?php echo $row->Position_ID; ?>"
                                                value="<?php echo $row->Position_name; ?>">
                                            </option>
                                            <?php
                                            } 
                                        ?>
                                        </datalist>
                                        <span id="position_select_1_span" style="color: red;"> </span>
                                    </div>
                                    <div class="department_select_1_div col-12 col-sm-6">
                                        <label>
                                            <h5>แผนก (Department) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <select class="form-control" id="department_select_1" name="department_select_1"
                                            onchange="get_section_1(value)">
                                            <option value="0">กรุณาเลือกแผนก (Please Select Department)</option>
                                            <?php
                                        foreach($department as $index => $row ){
                                    ?>
                                            <option value="<?php echo $row->Department_id; ?>">
                                                <?php echo $row->Department; ?></option>
                                            <?php 
                                        } 
                                    ?>
                                        </select>
                                        <span id="department_select_1_span" style="color: red;"> </span>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                    <div class="section_select_1_div col-12 col-sm-6">
                                        <label>
                                            <h5>หน่วยงาน (Section) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <select class="form-control" id="section_select_1" name="section_select_1"
                                            onchange="get_section_code_1(value)" disabled>
                                            <option value="0">กรุณาเลือกแผนก (Please Select Section)</option>
                                        </select>
                                        <span id="section_select_1_span" style="color: red;"> </span>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                                        <label>
                                            <h5>รหัสแผนก (Section Code) </h5>
                                        </label>
                                        <select class="form-control" id="section_code_select_1"
                                            name="section_code_select_1" readonly="">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                    <div class="section_type_select_1_div col-12 col-sm-6">
                                        <label>
                                            <h5>ประเภทหน่วยงาน (Section Type) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <select class="form-control" id="section_type_select_1"
                                            name="section_type_select_1">
                                            <option value="0">กรุณาเลือกประเภทหน่วยงาน</option>
                                            <option value="1">Indirect to Direct</option>
                                            <option value="2">Indirect to Indirect</option>
                                            <option value="3">Direct to Indirect</option>
                                            <option value="4">Direct to Direct</option>
                                        </select>
                                        <span id="section_type_select_1_span" style="color: red;"> </span>
                                    </div>
                                    <div class="req_num_select_1_div col-12 col-sm-6">
                                        <label>
                                            <h5>จำนวนคนที่ต้องการ (Required Number) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <input type="number" class="form-control" id="req_num_select_1"
                                            name="req_num_select_1"
                                            placeholder="กรุณากรอกจำนวนคนที่ต้องการ (Please Enter Required Number)"
                                            min="1">
                                        <span id="req_num_select_1_span" style="color: red;"> </span>
                                    </div>
                                </div>
                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary ml-auto js-btn-next" type="button"
                                        title="Next">Next</button>
                                </div>
                            </div>
                        </div>
                        <!-- internal -->

                        <div id="external" style="display: none;">
                            <div class="multisteps-form__content">
                                <div class="form-row mt-4">
                                    <div class="position_select_2_div col-12 col-sm-6">
                                        <label>
                                            <h5>ตำแหน่งที่ต้องการ (Required Position) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <input list="pos_list_2" class="form-control" id="position_select_2"
                                            placeholder="กรุณาเลือกรหัสพนักงาน (Please Select Employee ID)">
                                        <datalist id="pos_list_2">
                                            <?php foreach($position as $index => $row){ ?>
                                            <option data-value="<?php echo $row->Position_ID; ?>"
                                                value="<?php echo $row->Position_name; ?>">
                                            </option>
                                            <?php
                                            } 
                                        ?>
                                        </datalist>
                                        <span id="position_select_2_span" style="color: red;"> </span>
                                    </div>
                                    <div class="department_select_2_div col-12 col-sm-6">
                                        <label>
                                            <h5>แผนก (Department) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <select class="form-control" id="department_select_2" name="department_select_2"
                                            onchange="get_section_2(value)">
                                            <option value="0">กรุณาเลือกแผนก (Please Select Department)</option>
                                            <?php
                                        foreach($department as $index => $row ){
                                    ?>
                                            <option value="<?php echo $row->Department_id; ?>">
                                                <?php echo $row->Department; ?></option>
                                            <?php 
                                        } 
                                    ?>
                                        </select>
                                        <span id="department_select_2_span" style="color: red;"> </span>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                    <div class="section_select_2_div col-12 col-sm-6">
                                        <label>
                                            <h5>หน่วยงาน (Section) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <select class="form-control" id="section_select_2" name="section_select_2"
                                            onchange="get_section_code_2(value)" disabled>
                                            <option value="0">กรุณาเลือกแผนก (Please Select Section)</option>
                                        </select>
                                        <span id="section_select_2_span" style="color: red;"> </span>
                                    </div>
                                    <div class="col-12 col-sm-6 mt-4 mt-sm-0">
                                        <label>
                                            <h5>รหัสแผนก (Section Code)</h5>
                                        </label>
                                        <select class="form-control" id="section_code_select_2"
                                            name="section_code_select_2" readonly="">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row mt-4">
                                    <div class="req_num_select_2_div col-12 col-sm-6">
                                        <label>
                                            <h5>จำนวนคนที่ต้องการ (Required Number) <font color="red">*</font>
                                            </h5>
                                        </label>
                                        <input type="number" class="form-control" id="req_num_select_2"
                                            name="req_num_select_2"
                                            placeholder="กรุณากรอกจำนวนคนที่ต้องการ (Please Enter Required Number)"
                                            min="1">
                                        <span id="req_num_select_2_span" style="color: red;"> </span>
                                    </div>
                                </div>
                                <div class="form-check mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="radio" name="external_type"
                                                    id="external_type" value="1" onclick="show_data_type(1)">
                                                <div class="col-sm-10">
                                                    <label class="form-check-label" for="external_type">
                                                        พนักงานประจำ (Permanent Associate)
                                                    </label>
                                                </div>
                                                <span id="external_type_span1" style="color: red;"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input class="form-check-input" type="radio" name="external_type"
                                                    id="external_type" value="2" onclick="show_data_type(2)">
                                                <div class="col-sm-10">
                                                    <label class="form-check-label" for="external_type">
                                                        พนักงานชั่วคราว (Temporary Associate)
                                                    </label>
                                                </div>
                                                <span id="external_type_span2" style="color: red;"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mt-2" id="daily_type" style="display: none;">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="radio" name="ex_type" id="ex_type"
                                                    value="3" onclick="show_data_external_type(3)">
                                                <div class="col-sm-10">
                                                    <label class="form-check-label" for="ex_type">
                                                        รายวัน (Daily)
                                                    </label>
                                                </div>
                                                <span id="ex_type_daily_span" style="color: red;"> </span>
                                            </div>
                                            <div class="start_date_type_daily_div col-sm-4" id="ex_start_daily"
                                                style="display: none;">
                                                <label>วันที่เริ่มการจ้าง (Start Date) <font color="red">*</font>
                                                </label>
                                                <input type="date" class="form-control" name="start_date_type_daily"
                                                    id="start_date_type_daily" placeholder="วัน/เดือน/ปี">
                                                <span id="start_date_type_daily_span" style="color: red;"> </span>
                                            </div>
                                            <div class="end_date_type_daily_div col-sm-4" id="ex_end_daily"
                                                style="display: none;">
                                                <label>วันที่สิ้นสุดการจ้าง (End Date) <font color="red">*</font>
                                                </label>
                                                <input type="date" class="form-control" name="end_date_type_daily"
                                                    id="end_date_type_daily" placeholder="วัน/เดือน/ปี">
                                                <span id="end_date_type_daily_span" style="color: red;"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mt-2" id="month_type" style="display: none;">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="col-sm-2">
                                                <input class="form-check-input" type="radio" name="ex_type" id="ex_type"
                                                    value="4" onclick="show_data_external_type(4)">
                                                <div class="col-sm-10">
                                                    <label class="form-check-label" for="ex_type">
                                                        รายเดือน (Monthly)
                                                    </label>
                                                </div>
                                                <span id="ex_type_month_span" style="color: red;"> </span>
                                            </div>
                                            <div class="start_date_type_month_div col-sm-4" id="ex_start_month"
                                                style="display: none;">
                                                <label>วันที่เริ่มการจ้าง (Start Date) <font color="red">*</font>
                                                </label>
                                                <input type="date" class="form-control" name="start_date_type_month"
                                                    id="start_date_type_month" placeholder="วัน/เดือน/ปี">
                                                <span id="start_date_type_month_span" style="color: red;"> </span>
                                            </div>
                                            <div class="end_date_type_month_div col-sm-4" id="ex_end_month"
                                                style="display: none;">
                                                <label>วันที่สิ้นสุดการจ้าง (End Date) <font color="red">*</font>
                                                </label>
                                                <input type="date" class="form-control" name="end_date_type_month"
                                                    id="end_date_type_month" placeholder="วัน/เดือน/ปี">
                                                <span id="end_date_type_month_span" style="color: red;"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mt-4">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input class="form-check-input" type="radio" name="external_type"
                                                    id="external_type" value="5" onclick="show_data_type(5)">
                                                <div class="col-sm-12">
                                                    <label class="form-check-label" for="external_type">
                                                        ผู้ปฏิบัติงานรับเหมาช่วง / พนักงานซับคอนแทรค
                                                        โดยจ้างแบบมีระยะจำกัด (Subcontractor by Limited Employment
                                                        Contract)
                                                    </label>
                                                </div>
                                                <span id="external_type_span3" style="color: red;"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mt-2" id="date_sub" style="display: none;">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-sm-2">
                                            </div>
                                            <div class="start_date_type_sub_div col-sm-4">
                                                <label>วันที่เริ่มการจ้าง (Start Date) <font color="red">*</font>
                                                </label>
                                                <input type="date" class="form-control" name="start_date_type_sub"
                                                    id="start_date_type_sub" placeholder="วัน/เดือน/ปี">
                                                <span id="start_date_type_sub_span" style="color: red;"> </span>
                                            </div>
                                            <div class="end_date_type_sub_div col-sm-4">
                                                <label>วันที่สิ้นสุดการจ้าง (End Date) <font color="red">*</font>
                                                </label>
                                                <input type="date" class="form-control" name="end_date_type_sub"
                                                    id="end_date_type_sub" placeholder="วัน/เดือน/ปี">
                                                <span id="end_date_type_sub_span" style="color: red;"> </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check mt-4">
                                    <div class="col-4 req_start_date_div">
                                        <div class="row">
                                            <label>วันที่ต้องการให้เริ่มงาน (Required Date) <font color="red">*</font>
                                            </label>
                                            <input type="date" class="form-control" name="req_start_date"
                                                id="req_start_date" placeholder="วัน/เดือน/ปี">
                                            <span id="req_start_date_span" style="color: red;"> </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="button-row d-flex mt-4">
                                    <button class="btn btn-primary ml-auto js-btn-next" type="button"
                                        title="Next">Next</button>
                                </div>
                            </div>
                        </div>
                        <!-- external -->
                    </div>
                </div>

                <!--single form panel-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <div class="multisteps-form__content">
                        <h5>1. ระดับการศึกษา (Education) <font color="red">*</font>
                        </h5>
                        <span id="education_span" style="color: red;"> </span>
                        <div class="form-check mt-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input class="form-check-input col-sm-2" type="radio" name="education_type"
                                            id="education_type" value="1">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="education_type">
                                                วุฒิการศึกษา ม.3 (Secondary Education)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input class="form-check-input col-sm-2" type="radio" name="education_type"
                                            id="education_type" value="2">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="education_type">
                                                วุฒิการศึกษา ม.6 / ปวช. (Highschool Education / Vocational
                                                Certificate)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="education_type"
                                            id="education_type" value="3">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="education_type">
                                                ปวส. (High Vocational Certificate)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="education_type"
                                            id="education_type" value="4">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="education_type">
                                                ปริญญาตรี (Bachelor's Degree)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="education_type"
                                            id="education_type" value="5">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="education_type">
                                                ปริญญาโท (Master Degree)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <div class="education_major_div col-12">
                                <div class="row">
                                    <label for="education_major" class="col-sm-2 col-form-label">สาขา
                                        (Major)</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="education_major"
                                            name="education_major" placeholder="กรุณากรอกสาขา (Please Enter Major)">
                                        <span id="education_major_span" style="color: red;"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h5>2. ประสบการณ์ (Work Experience) <font color="red">*</font>
                        </h5>
                        <div class="form-row mt-4">
                            <div class="work_exp_year_div col-6">
                                <label class="col-sm-6 control-label">จำนวนปีประสบการณ์ (Number of Years of
                                    Experience)</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" min="0" name="work_exp_year"
                                        id="work_exp_year"
                                        placeholder="กรุณากรอกจำนวนปีประสบการณ์ (Please Enter Number of Years of Experience)">
                                    <span id="work_exp_year_span" style="color: red;"> </span>
                                </div>
                            </div>
                            <div class="work_exp_field_div col-6">
                                <label class="col-sm-3 control-label">ทางด้าน (Field) </label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="work_exp_field" id="work_exp_field"
                                        placeholder="กรุณากรอกทางด้าน (Please Enter Field)">
                                    <span id="work_exp_field_span" style="color: red;"> </span>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <h5>3. ความสามารถด้านคอมพิวเตอร์ <font color="red">*</font>
                        </h5>
                        <span id="com_span" style="color: red;"> </span>
                        <div class="form-check mt-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="com_type"
                                            id="com_type" value="1">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="com_type">
                                                ไม่ต้องการ (Not Require)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="com_type"
                                            id="com_type" value="2">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="com_type">
                                                Microsoft Office
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="com_type"
                                            id="com_type" value="3">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="com_type">
                                                โปรแกรมอื่น ๆ โปรดระบุ (etc.)
                                            </label>
                                        </div>
                                        <div class="col-sm-2"></div>
                                        <div class="com_ect_div col-sm-12">
                                            <input type="text" class="form-control" name="com_ect" id="com_ect"
                                                placeholder="กรุณากรอกโปรแกรมอื่น ๆ (Please Enter Program Ect.)">
                                            <span id="com_ect_span" style="color: red;"> </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <h5>4. ความสามารถด้านภาษา (Language) <font color="red">*</font>
                        </h5>
                        <div class="form-check mt-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="col-sm-8" style="text-align: right">
                                            <h6>4.1 ภาษาอังกฤษ (English)</h6>
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="eng_type"
                                            id="eng_type" value="1">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="eng_type">
                                                ไม่ต้องการ (Not Require)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="eng_type"
                                            id="eng_type" value="2">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="eng_type">
                                                TOEIC ≥ 400
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span id="eng_span" style="color: red;"> </span>
                                    </div>
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="col-sm-8" style="text-align: right">
                                            <h6>4.2 ภาษาญี่ปุ่น (Japanese)</h6>
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="japan_type"
                                            id="japan_type" value="1">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="japan_type">
                                                ไม่ต้องการ (Not Require)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="japan_type"
                                            id="japan_type" value="2">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="japan_type">
                                                ระดับ N 3-4 (Level N 3-4)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <span id="japan_span" style="color: red;"> </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="japan_type"
                                            id="japan_type" value="3">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="japan_type">
                                                ระดับ N 2 (Level N 2)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input col-sm-2" type="radio" name="japan_type"
                                            id="japan_type" value="4">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="japan_type">
                                                ระดับ N 1 (Level N 1)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <h5>5. อื่น ๆ (Additional Requirement) <font color="red">*</font>
                        </h5>
                        <div class="form-row mt-4">
                            <div class="ect_div col-12">
                                <input type="text" class="form-control" name="ect" id="ect"
                                    placeholder="กรุณากรอกอื่น ๆ (Please Enter Additional Requirement)">
                                <span id="ect_span" style="color: red;"> </span>
                            </div>
                        </div>
                        <br><br>
                        <h5>หน้าที่ความรับผิดชอบ (Duty & Responsibility) อ้างอิง JD หมายเลข (Reference JD No.) <font
                                color="red">*</font>
                        </h5>
                        <div class="form-row mt-4">
                            <div class="ref_jd_div col-12">
                                <input type="text" class="form-control" name="ref_jd" id="ref_jd"
                                    placeholder="กรุณากรอกอ้างอิง JD หมายเลข (Please Enter Reference JD No.)">
                                <span id="ref_jd_span" style="color: red;"> </span>
                            </div>
                        </div>
                        <br><br>
                        <h5>หน้าที่ความรับผิดชอบเพิ่มเติม (AdditionDuty & Responsibility) <font color="red">*</font>
                        </h5>
                        <div class="form-row mt-4">
                            <div class="addition_div col-12">
                                <input type="text" class="form-control" name="addition" id="addition"
                                    placeholder="กรุณากรอกหน้าที่ความรับผิดชอบเพิ่มเติม (Please Enter AdditionDuty & Responsibility)">
                                <span id="addition_span" style="color: red;"> </span>
                            </div>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                        </div>
                    </div>
                </div>
                <!--single form panel-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <div class="multisteps-form__content">
                        <div class="form-check mt-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input class="form-check-input col-sm-2" type="radio"
                                            name="headcount_control_type" id="headcount_control_type" value="1"
                                            onclick="show_btn_send(value)">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="headcount_control">
                                                1. อัตราทดแทนพนักงานลาออก (Replacement of Resigned Member)<font
                                                    color="red">*</font>
                                            </label>
                                        </div>
                                        <span id="type_1_span" style="color: red;"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label class="col-sm-6 control-label">จำนวนคนที่ลาออก (Number of Resigned)</label>
                                <div class="num_1_type_1_div col-sm-12">
                                    <input type="number" class="form-control" name="num_1_type_1" id="num_1_type_1">
                                    <span id="num_1_type_1_span" style="color: red;"> </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-sm-6 control-label">จำนวนคนที่ต้องการ (Required Number) </label>
                                <div class="num_2_type_1_div col-sm-12">
                                    <input type="number" class="form-control" name="num_2_type_1" id="num_2_type_1">
                                    <span id="num_2_type_1_span" style="color: red;"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input class="form-check-input" type="radio" name="headcount_control_type"
                                            id="headcount_control_type" value="2" onclick="show_btn_send(value)">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="headcount_control">
                                                2. อัตราเพิ่มจากแผนกำลังคน (Increment from Headcount) <font
                                color="red">*</font>
                                            </label>
                                        </div>
                                        <span id="type_2_span" style="color: red;"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label class="col-sm-6 control-label">จำนวนคน (Number)</label>
                                <div class="num_1_type_2_div col-sm-12">
                                    <input type="number" class="form-control" name="num_1_type_2" id="num_1_type_2">
                                    <span id="num_1_type_2_span" style="color: red;"> </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-sm-6 control-label">เหตุผลที่ขอคนเพิ่มจากแผนกำลังคน
                                    (Reason)</label>
                                <div class="num_2_type_2_div col-sm-12">
                                    <input type="text" class="form-control" name="num_2_type_2" id="num_2_type_2"
                                        placeholder="กรุณาเหตุผล (Please Enter Reason)">
                                        <span id="num_2_type_2_span" style="color: red;"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input class="form-check-input" type="radio" name="headcount_control_type"
                                            id="headcount_control_type" value="3" onclick="show_btn_send(value)">
                                        <div class="col-sm-10">
                                            <label class="form-check-label" for="headcount_control">
                                                3. อัตราทดแทนพนักงานโอนย้าย (Replacement of Job Rotation) <font
                                color="red">*</font>
                                            </label>
                                        </div>
                                        <span id="type_3_span" style="color: red;"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-6">
                                <label class="col-sm-6 control-label">จำนวนคนที่โอนย้าย (Number of Transfer)</label>
                                <div class="num_1_type_3_div col-sm-12">
                                    <input type="number" class="form-control" name="num_1_type_3" id="num_1_type_3">
                                    <span id="num_1_type_3_span" style="color: red;"> </span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label class="col-sm-6 control-label">จำนวนคนที่ต้องการ (Required Number)</label>
                                <div class="num_2_type_3_div col-sm-12">
                                    <input type="number" class="form-control" name="num_2_type_3" id="num_2_type_3">
                                    <span id="num_2_type_3_span" style="color: red;"> </span>
                                </div>
                            </div>
                            <div class="button-row d-flex mt-4 col-12">
                                <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                                <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next"
                                    id="btn_next_headcount" onclick="show_row_table()">Next</button>
                                <button class="btn btn-success ml-auto" type="button" title="Send" id="btn_send"
                                    onclick="valid_form_headcount_2(2)" style="display: none;">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--single form panel-->
                <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <div class="form-row">
                        <div class="col-12 col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="emp_list">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">
                                                <center>#</center>
                                            </th>
                                            <th colspan="5">
                                                <center>พนักงานลาออก / โอนย้าย</center>
                                            </th>
                                            <th rowspan="2">
                                                <center>วันที่มีผล<font color="red">*</font></center>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <center>รหัสพนักงาน (Employee ID)<font color="red">*</font></center>
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

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="button-row d-flex mt-4">
                        <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                        <button class="btn btn-success ml-auto" type="button" title="Send"
                            onclick="save_data()">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
div.card-header {
    font-size: 24px;
}

input[type=radio] {
    height: 30px;
    width: 30px;
}

.multisteps-form__progress {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(0, 1fr));
}

.multisteps-form__progress-btn {
    transition-property: all;
    transition-duration: 0.15s;
    transition-timing-function: linear;
    transition-delay: 0s;
    position: relative;
    padding-top: 20px;
    color: rgba(108, 117, 125, 0.7);
    text-indent: -9999px;
    border: none;
    background-color: transparent;
    outline: none !important;
    cursor: pointer;
}

@media (min-width: 500px) {
    .multisteps-form__progress-btn {
        text-indent: 0;
    }
}

.multisteps-form__progress-btn:before {
    position: absolute;
    top: 0;
    left: 50%;
    display: block;
    width: 13px;
    height: 13px;
    content: '';
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
    transition: all 0.15s linear 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
    transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
    transition: all 0.15s linear 0s, transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s, -webkit-transform 0.15s cubic-bezier(0.05, 1.09, 0.16, 1.4) 0s;
    border: 2px solid currentColor;
    border-radius: 50%;
    background-color: #fff;
    box-sizing: border-box;
    z-index: 3;
}

.multisteps-form__progress-btn:after {
    position: absolute;
    top: 5px;
    left: calc(-50% - 13px / 2);
    transition-property: all;
    transition-duration: 0.15s;
    transition-timing-function: linear;
    transition-delay: 0s;
    display: block;
    width: 100%;
    height: 2px;
    content: '';
    background-color: currentColor;
    z-index: 1;
}

.multisteps-form__progress-btn:first-child:after {
    display: none;
}

.multisteps-form__progress-btn.js-active {
    color: #007bff;
}

.multisteps-form__progress-btn.js-active:before {
    -webkit-transform: translateX(-50%) scale(1.2);
    transform: translateX(-50%) scale(1.2);
    background-color: currentColor;
}

.multisteps-form__form {
    position: relative;
}

.multisteps-form__panel {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 0;
    opacity: 0;
    visibility: hidden;
}

.multisteps-form__panel.js-active {
    height: auto;
    opacity: 1;
    visibility: visible;
}
</style>

<script>
function get_section_1(department_id) {
    if (department_id == 0) {
        document.getElementById("section_select_1").disabled = true;
    }
    var temp = '';
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>/Rcs_Form_Controller/get_section_by_department_id",
        data: {
            "department_id": department_id
        },
        dataType: "JSON",
        success: function(data) {
            if (department_id == 0) {
                document.getElementById("section_select_1").disabled = true;
            } else {
                document.getElementById("section_select_1").disabled = false;
            }
            temp += '<option value="0">กรุณาเลือกแผนก (Please Select Section)</option>';

            data.forEach((row, index) => {
                temp += '<option value="' + row.Section_id + '">' + row.Section + '</option>';
            }); // forEach
            $('#section_select_1').html(temp);
            $('#section_code_select_1').html('');
        }
    });
}

function get_section_code_1(section_id) {
    var temp = '';
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>/Rcs_Form_Controller/get_section_by_id",
        data: {
            "section_id": section_id
        },
        dataType: "JSON",
        success: function(data) {
            data.forEach((row, index) => {
                temp = '<option value="' + row.Section_id + '">' + row.Section_id + '</option>';
            }); // forEach
            $('#section_code_select_1').html(temp);
        }
    });
}

function get_section_2(department_id) {
    if (department_id == 0) {
        document.getElementById("section_select_2").disabled = true;
    }
    var temp = '';
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>/Rcs_Form_Controller/get_section_by_department_id",
        data: {
            "department_id": department_id
        },
        dataType: "JSON",
        success: function(data) {
            if (department_id == 0) {
                document.getElementById("section_select_2").disabled = true;
            } else {
                document.getElementById("section_select_2").disabled = false;
            }
            temp += '<option value="0">กรุณาเลือกแผนก (Please Select Section)</option>';

            data.forEach((row, index) => {
                temp += '<option value="' + row.Section_id + '">' + row.Section + '</option>';
            }); // forEach
            $('#section_select_2').html(temp);
            $('#section_code_select_2').html('');
        }
    });
}

function get_section_code_2(section_id) {
    var temp = '';
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>/Rcs_Form_Controller/get_section_by_id",
        data: {
            "section_id": section_id
        },
        dataType: "JSON",
        success: function(data) {
            data.forEach((row, index) => {
                temp = '<option value="' + row.Section_id + '">' + row.Section_id + '</option>';
            }); // forEach
            $('#section_code_select_2').html(temp);
        }
    });
}

function show_category(value) {
    if (value == "1") {
        document.getElementById("internal").style.display = 'block';
        document.getElementById("external").style.display = 'none';
    } else if (value == "2") {
        document.getElementById("external").style.display = 'block';
        document.getElementById("internal").style.display = 'none';
    }

}

function show_data_type(value) {
    var radio_temp_types = document.querySelectorAll('input[name="ex_type"]');
    var temp_type_val;
    for (const radio_temp_type of radio_temp_types) {
        if (radio_temp_type.checked) {
            temp_type_val = radio_temp_type.value;
            break;
        }
    }

    if (value == "1") {
        document.getElementById("ex_start_daily").style.display = 'none';
        document.getElementById("ex_end_daily").style.display = 'none';
        document.getElementById("ex_start_month").style.display = 'none';
        document.getElementById("ex_end_month").style.display = 'none';
        document.getElementById("date_sub").style.display = 'none';
        document.getElementById("daily_type").style.display = 'none';
        document.getElementById("month_type").style.display = 'none';

    } else if (value == "2") {
        document.getElementById("daily_type").style.display = 'block';
        document.getElementById("month_type").style.display = 'block';
        document.getElementById("date_sub").style.display = 'none';
        if (temp_type_val == "3") {
            document.getElementById("ex_start_daily").style.display = 'block';
            document.getElementById("ex_end_daily").style.display = 'block';
            document.getElementById("ex_start_month").style.display = 'none';
            document.getElementById("ex_end_month").style.display = 'none';
        } else if (temp_type_val == "4") {
            document.getElementById("ex_start_daily").style.display = 'none';
            document.getElementById("ex_end_daily").style.display = 'none';
            document.getElementById("ex_start_month").style.display = 'block';
            document.getElementById("ex_end_month").style.display = 'block';
        }

    } else if (value == "5") {
        document.getElementById("date_sub").style.display = 'block';
        document.getElementById("daily_type").style.display = 'none';
        document.getElementById("month_type").style.display = 'none';
        document.getElementById("ex_start_daily").style.display = 'none';
        document.getElementById("ex_end_daily").style.display = 'none';
        document.getElementById("ex_start_month").style.display = 'none';
        document.getElementById("ex_end_month").style.display = 'none';
    }
}

function show_data_external_type(value) {
    if (value == "3") {
        document.getElementById("ex_start_daily").style.display = 'block';
        document.getElementById("ex_end_daily").style.display = 'block';
        document.getElementById("ex_start_month").style.display = 'none';
        document.getElementById("ex_end_month").style.display = 'none';
    } else if (value == "4") {
        document.getElementById("ex_start_daily").style.display = 'none';
        document.getElementById("ex_end_daily").style.display = 'none';
        document.getElementById("ex_start_month").style.display = 'block';
        document.getElementById("ex_end_month").style.display = 'block';
    }

}

function show_btn_send(value) {
    if (value == "2") {
        document.getElementById("btn_send").style.display = 'block';
        document.getElementById("btn_next_headcount").style.display = 'none';
    } else {
        document.getElementById("btn_send").style.display = 'none';
        document.getElementById("btn_next_headcount").style.display = 'block';
    }
}

function show_emp_detail(emp_id, index) {
    var temp_emp_name = '';
    var temp_position = '';
    var temp_department = '';
    var temp_section_code = '';
    var selected_recruitment_type = $('#recruitment_type option:selected').val();

    var e_department;
    var department_name;

    if (selected_recruitment_type == "1") {
        e_department = document.getElementById("department_select_1");
        department_name = e_department.options[e_department.selectedIndex].text;
    } else {
        e_department = document.getElementById("department_select_2");
        department_name = e_department.options[e_department.selectedIndex].text;
    }
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>/Rcs_Form_Controller/get_employee_by_id",
        data: {
            "emp_id": emp_id
        },
        dataType: "JSON",
        success: function(data) {
            //console.log(data);
            data.forEach((row, i) => {
                temp_emp_name = '' + row.Empname_th + " " + row.Empsurname_th + '';
                temp_position = '' + row.Position_name + '';
                temp_department = '' + department_name + '';
                temp_section_code = '' + row.Sectioncode_ID + '';

                $('#surname_' + index).html(temp_emp_name);
                $('#position_' + index).html(temp_position);
                $('#department_' + index).html(temp_department);
                $('#section_code_' + index).html(temp_section_code);
            }); // forEach

        }
    });
}

function show_row_table() {

    var row_number = 0;
    var temp = '';
    const radio_headcounts = document.querySelectorAll('input[name="headcount_control_type"]');
    var department_id;
    let selected_value_headcount;
    let selected_recruitment_type;

    for (const radio_headcount of radio_headcounts) {
        if (radio_headcount.checked) {
            selected_value_headcount = radio_headcount.value;
            break;
        }
    }

    selected_recruitment_type = $('#recruitment_type option:selected').val();

    // headcount control
    if (selected_value_headcount == "1") {
        row_number = document.getElementById("num_1_type_1").value;
    } else if (selected_value_headcount == "2") {
        row_number = document.getElementById("num_1_type_2").value;
    } else {
        row_number = document.getElementById("num_1_type_3").value;
    }

    // recruitment type
    if (selected_recruitment_type == "1") {
        department_id = document.getElementById("department_select_1").value;
    } else {
        department_id = document.getElementById("department_select_2").value;
    }

    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>/Rcs_Form_Controller/get_employee_by_key",
        data: {
            "department_id": department_id
        },
        dataType: "JSON",
        success: function(data) {
            // console.log(data);
            for (i = 1; i <= row_number; i++) {
                temp += '<tr>';
                temp += '<td>' + i + '</td>';
                temp += '<td><input list="emp_list_id" class="form-control" name="emp_id_' + i +
                    '" id="emp_id_' + i + '" onchange="show_emp_detail(value,' + i + ')">';
                temp += '<datalist id="emp_list_id">';
                data.forEach((row, index) => {
                    temp += '<option value="' + row.Emp_ID + '">' + row.Empname_th + " " + row
                        .Empsurname_th + '</option>';
                }); // forEach
                temp += '</datalist>';
                temp += '<span id="emp_id_'+ i +'_span" style="color: red;"> </span></td>';
                temp += '<td id="surname_' + i + '"></td>'; //name-surname
                temp += '<td id="position_' + i + '"></td>'; //position
                temp += '<td id="department_' + i + '"></td>'; //department
                temp += '<td id="section_code_' + i + '"></td>'; //section code
                temp += '<td><input type="date" class="form-control" id="effective_date_' + i + '"><span id="effective_date_'+ i +'_span" style="color: red;"> </span></td>';
                temp += '</tr>';

                
            } //for
            $('#emp_list tbody').html(temp);
        }
    });
}

function save_data() {

    // Type of Recruitment
    var selected_recruitment_type = $('#recruitment_type option:selected').val();
    var radio_external_types = document.querySelectorAll('input[name="external_type"]');
    var position_id;
    var department_id;
    var section_code;
    var section_type = $('#section_type_select_1 option:selected').val();
    var req_number;
    var external_type;
    var start_date;
    var end_date;
    var req_date = document.getElementById("req_start_date").value;
    var external_type_val;
    var position_selected;
    var position_id;



    // 1. recruitment type
    // 1: internal
    // 2: external
    if (selected_recruitment_type == "1") {
        position_selected = document.getElementById("position_select_1").value;
        position_id = document.querySelector("#pos_list_1 option[value='" + position_selected + "']").dataset.value;
        department_id = document.getElementById("department_select_1").value;
        section_code = document.getElementById("section_code_select_1").value;
        req_number = document.getElementById("req_num_select_1").value;
    } else {
        position_selected = document.getElementById("position_select_2").value;
        position_id = document.querySelector("#pos_list_2 option[value='" + position_selected + "']").dataset.value;
        department_id = document.getElementById("department_select_2").value;
        section_code = document.getElementById("section_code_select_2").value;
        req_number = document.getElementById("req_num_select_2").value;

        for (const radio_external_type of radio_external_types) {
            if (radio_external_type.checked) {
                external_type_val = radio_external_type.value;
                break;
            }
        }

        var radio_temp_types = document.querySelectorAll('input[name="ex_type"]');
        var temp_type_val;
        for (const radio_temp_type of radio_temp_types) {
            if (radio_temp_type.checked) {
                temp_type_val = radio_temp_type.value;
                break;
            }
        }

        //external type 
        //1: Permanent Associate
        //2: Temporary Associate
        //3: Daily
        //4: Monthly
        //5: Subcontractor by Limited Employment Contract

        if (temp_type_val == "3") { // Daily 
            start_date = document.getElementById("start_date_type_daily").value;
            end_date = document.getElementById("end_date_type_daily").value;
            external_type_val = temp_type_val;
        } else if (temp_type_val == "4") { // Monthly
            start_date = document.getElementById("start_date_type_month").value;
            end_date = document.getElementById("end_date_type_month").value;
            external_type_val = temp_type_val;
        } else if (external_type_val == "5") { // Subcontractor by Limited Employment Contract
            start_date = document.getElementById("start_date_type_sub").value;
            end_date = document.getElementById("end_date_type_sub").value;
        }
    }


    // 2. Qualification Required
    var radio_education_types = document.querySelectorAll('input[name="education_type"]');
    var radio_com_types = document.querySelectorAll('input[name="com_type"]');
    var radio_eng_types = document.querySelectorAll('input[name="eng_type"]');
    var radio_japan_types = document.querySelectorAll('input[name="japan_type"]');
    var education_type_val;
    var education_major_val = document.getElementById("education_major").value;;
    var work_exp_year = document.getElementById("work_exp_year").value;
    var work_exp_field = document.getElementById("work_exp_field").value;
    var com_type_val;
    var com_ect_val;
    var eng_type_val;
    var japan_type_val;
    var ect = document.getElementById("ect").value;
    var ref_jd = document.getElementById("ref_jd").value;
    var addition = document.getElementById("addition").value;

    //education type
    for (const radio_education_type of radio_education_types) {
        if (radio_education_type.checked) {
            education_type_val = radio_education_type.value;
            break;
        }
    }

    //com type
    for (const radio_com_type of radio_com_types) {
        if (radio_com_type.checked) {
            com_type_val = radio_com_type.value;
            break;
        }
    }

    //eng type
    for (const radio_eng_type of radio_eng_types) {
        if (radio_eng_type.checked) {
            eng_type_val = radio_eng_type.value;
            break;
        }
    }

    //japan type
    for (const radio_japan_type of radio_japan_types) {
        if (radio_japan_type.checked) {
            japan_type_val = radio_japan_type.value;
            break;
        }
    }

    if (com_type_val == "3") {
        com_ect_val = document.getElementById("com_ect").value;
    } else {
        com_ect_val = "";
    }


    // 3. Headcount Control
    var radio_headcount_types = document.querySelectorAll('input[name="headcount_control_type"]');
    var headcount_val;
    var headcount_num1;
    var headcount_num2;

    //headcount control
    for (const radio_headcount of radio_headcount_types) {
        if (radio_headcount.checked) {
            headcount_val = radio_headcount.value;
            break;
        }
    }

    // 4. employee list
    var emp_obj = [];
    var emp_row_index = 0;
    var emp_id;
    var emp_effective_date;
    var check_emp = true;

    if (headcount_val == "1") {
        headcount_num1 = document.getElementById("num_1_type_1").value;
        headcount_num2 = document.getElementById("num_2_type_1").value;
        emp_row_index = document.getElementById("num_1_type_1").value;
    } else if (headcount_val == "2") {
        headcount_num1 = document.getElementById("num_1_type_2").value;
        headcount_num2 = document.getElementById("num_2_type_2").value;
    } else {
        headcount_num1 = document.getElementById("num_1_type_3").value;
        headcount_num2 = document.getElementById("num_2_type_3").value;
        emp_row_index = document.getElementById("num_1_type_3").value;
    }

    if (headcount_val == "2") {
        emp_obj = null;
    } else {

        for (i = 1; i <= emp_row_index; i++) {
                
                emp_id = document.getElementById("emp_id_" + i).value;
                emp_effective_date = document.getElementById("effective_date_" + i).value;

                if(!emp_id){
                    document.getElementById("emp_id_"+i+'_span').innerHTML = ' ** กรุณาเลือกรหัสพนักงาน';
                    check_emp = false;
                }
                else{
                    document.getElementById("emp_id_"+i+'_span').innerHTML = '';

                }
                if(!emp_effective_date){
                    document.getElementById('effective_date_'+i+'_span').innerHTML = ' ** กรุณากรอกวันที่มีผล';
                    check_emp = false;
                }
                else{
                    document.getElementById('effective_date_'+i+'_span').innerHTML = '';

                }
                
        }
    }

    if(check_emp){
        for (i = 1; i <= emp_row_index; i++) {
            emp_id = document.getElementById("emp_id_" + i).value;
            emp_effective_date = document.getElementById("effective_date_" + i).value;
            emp_obj.push({
                "emp_id": emp_id,
                "effective_date": emp_effective_date
            });
        }
        $.ajax({
            type: "post",
            url: "<?php echo base_url(); ?>/Rcs_Form_Controller/insert_form_data",
            data: {
                "selected_recruitment_type": selected_recruitment_type,
                "position_id": position_id,
                "department_id": department_id,
                "section_code": section_code,
                "section_type": section_type,
                "req_number": req_number,
                "external_type_val": external_type_val,
                "start_date": start_date,
                "end_date": end_date,
                "req_date": req_date,
                "education_type_val": education_type_val,
                "education_major_val": education_major_val,
                "work_exp_year": work_exp_year,
                "work_exp_field": work_exp_field,
                "com_type_val": com_type_val,
                "com_ect_val": com_ect_val,
                "eng_type_val": eng_type_val,
                "japan_type_val": japan_type_val,
                "ect": ect,
                "ref_jd": ref_jd,
                "addition": addition,
                "headcount_val": headcount_val,
                "headcount_num1": headcount_num1,
                "headcount_num2": headcount_num2,
                "emp_obj": emp_obj
            },
            dataType: "JSON",
            success: function(data) {
                swal({
                    title: "Success",
                    text: "Your data was saved!",
                    icon: "success",
                    type: "success"
                }, function() {
                    window.location = "<?php echo base_url(); ?>Rcs_Controller/index";
                });
            }
        });
    }

    // console.log(" selected_recruitment_type  ", selected_recruitment_type);
    // console.log(" position_id  ", position_id);
    // console.log(" department_id ", department_id);
    // console.log(" section_code ", section_code);
    // console.log(" req_number ", req_number);
    // console.log(" external_type_val  ", external_type_val);
    // console.log(" start_date  ", start_date);
    // console.log(" end_date  ", end_date);
    // console.log(" req_date ", req_date);
    // console.log(" education_type_val  ", education_type_val);
    // console.log(" education_major_val  ", education_major_val);
    // console.log(" work_exp_year  ", work_exp_year);
    // console.log(" com_type_val  ", com_type_val);
    // console.log(" eng_type_val  ", eng_type_val);
    // console.log(" japan_type_val  ", japan_type_val);
    // console.log(" ect  ", ect);
    // console.log(" ref_jd  ", ref_jd);
    // console.log(" addition  ", addition);
    // console.log(" headcount_val  ", headcount_val);
    // console.log(" headcount_num1  ", headcount_num1);
    // console.log(" headcount_num2  ", headcount_num2);
    // console.log(" emp_obj  ", emp_obj);
    
}


//DOM elements
const DOMstrings = {
    stepsBtnClass: 'multisteps-form__progress-btn',
    stepsBtns: document.querySelectorAll(`.multisteps-form__progress-btn`),
    stepsBar: document.querySelector('.multisteps-form__progress'),
    stepsForm: document.querySelector('.multisteps-form__form'),
    stepsFormTextareas: document.querySelectorAll('.multisteps-form__textarea'),
    stepFormPanelClass: 'multisteps-form__panel',
    stepFormPanels: document.querySelectorAll('.multisteps-form__panel'),
    stepPrevBtnClass: 'js-btn-prev',
    stepNextBtnClass: 'js-btn-next'
};

//remove class from a set of items
const removeClasses = (elemSet, className) => {
    elemSet.forEach(elem => {
        elem.classList.remove(className);
    });
};
//return exect parent node of the element
const findParent = (elem, parentClass) => {
    let currentNode = elem;
    while (!currentNode.classList.contains(parentClass)) {
        currentNode = currentNode.parentNode;
    }
    return currentNode;
};
//get active button step number
const getActiveStep = elem => {
    return Array.from(DOMstrings.stepsBtns).indexOf(elem);
};
//set all steps before clicked (and clicked too) to active
const setActiveStep = activeStepNum => {
    //remove active state from all the state
    removeClasses(DOMstrings.stepsBtns, 'js-active');
    //set picked items to active
    DOMstrings.stepsBtns.forEach((elem, index) => {
        if (index <= activeStepNum) {
            elem.classList.add('js-active');
        }
    });
};
//get active panel
const getActivePanel = () => {
    let activePanel;
    DOMstrings.stepFormPanels.forEach(elem => {
        if (elem.classList.contains('js-active')) {
            activePanel = elem;
        }
    });
    return activePanel;
};
//open active panel (and close unactive panels)
const setActivePanel = activePanelNum => {
    //remove active class from all the panels
    removeClasses(DOMstrings.stepFormPanels, 'js-active');
    //show active panel
    DOMstrings.stepFormPanels.forEach((elem, index) => {
        if (index === activePanelNum) {
            elem.classList.add('js-active');
            setFormHeight(elem);
        }
    });
};
//set form height equal to current panel height
const formHeight = activePanel => {
    const activePanelHeight = activePanel.offsetHeight;
    DOMstrings.stepsForm.style.height = `${activePanelHeight}px`;
};
const setFormHeight = () => {
    const activePanel = getActivePanel();
    formHeight(activePanel);
};
//STEPS BAR CLICK FUNCTION
DOMstrings.stepsBar.addEventListener('click', e => {
    //check if click target is a step button
    const eventTarget = e.target;
    if (!eventTarget.classList.contains(`${DOMstrings.stepsBtnClass}`)) {
        return;
    }
    //get active button step number
    const activeStep = getActiveStep(eventTarget);
    //set all steps before clicked (and clicked too) to active
    setActiveStep(activeStep);
    //open active panel
    setActivePanel(activeStep);
});
//PREV/NEXT BTNS CLICK
DOMstrings.stepsForm.addEventListener('click', e => {
    const eventTarget = e.target;
    //check if we clicked on `PREV` or NEXT` buttons
    if (!(eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`) || eventTarget.classList
            .contains(
                `${DOMstrings.stepNextBtnClass}`))) {
        return;
    }
    //find active panel
    const activePanel = findParent(eventTarget, `${DOMstrings.stepFormPanelClass}`);
    let activePanelNum = Array.from(DOMstrings.stepFormPanels).indexOf(activePanel);

    //set active step and active panel onclick
    if (eventTarget.classList.contains(`${DOMstrings.stepPrevBtnClass}`)) {
        activePanelNum--;
    } else {
        activePanelNum++;
        show_row_table();
    }

    if (activePanelNum == 0) {
        $('.card-header').html('<b>ประเภทการขอพนักงาน (Type of Recruitment)</b>');
    } else if (activePanelNum == 1) {
        $('.card-header').html('<b>คุณสมบัติ (Qualification Required)</b>');
    } else if (activePanelNum == 2) {
        $('.card-header').html('<b>การควบคุมจำนวนพนักงาน (Headcount Control)</b>');
    } else {
        $('.card-header').html(
            '<b>รายชื่อพนักงานลาออก / โอนย้าย / หมุนเวียนงาน (List of resigned / transfer / Job rotation)</b>'
        );
    }

    if (activePanelNum == 1) {
        // Type of Recruitment
        var selected_recruitment_type = $('#recruitment_type option:selected').val();
        var radio_external_types = document.querySelectorAll('input[name="external_type"]');
        var position_id;
        var department_id;
        var section_code;
        var section_type = $('#section_type_select_1 option:selected').val();
        var req_number;
        var external_type;
        var start_date;
        var end_date;
        var req_date = document.getElementById("req_start_date").value;
        var external_type_val;
        var position_selected;
        var position_id;
        var check_step_1 = true;



        // 1. recruitment type
        // 1: internal
        // 2: external
        if (selected_recruitment_type == "1") {
            position_selected = document.getElementById("position_select_1").value;
            if (position_selected) {
                position_id = document.querySelector("#pos_list_1 option[value='" + position_selected + "']").dataset.value;
            }
            department_id = document.getElementById("department_select_1").value;
            section_code = document.getElementById("section_code_select_1").value;
            req_number = document.getElementById("req_num_select_1").value;

            if (!position_id) {
                $(".position_select_1_div").addClass("is-invalid");
                document.getElementById('position_select_1_span').innerHTML = " ** กรุณาเลือกตำแหน่งที่ต้องการ";
                check_step_1 = false;
            } else {
                $(".position_select_1_div").removeClass("is-invalid");
                document.getElementById('position_select_1_span').innerHTML = "";
            }

            if (department_id == "0") {
                $(".department_select_1_div").addClass("is-invalid");
                document.getElementById('department_select_1_span').innerHTML = " ** กรุณาเลือกแผนก";
                check_step_1 = false;
            } else {
                $(".department_select_1_div").removeClass("is-invalid");
                document.getElementById('department_select_1_span').innerHTML = "";
            }

            if (!section_code) {
                $(".section_select_1_div").addClass("is-invalid");
                document.getElementById('section_select_1_span').innerHTML = " ** กรุณาเลือกหน่วยงาน";
                check_step_1 = false;
            } else {
                $(".section_select_1_div").removeClass("is-invalid");
                document.getElementById('section_select_1_span').innerHTML = "";
            }

            if (section_type == "0") {
                $(".section_type_select_1_div").addClass("is-invalid");
                document.getElementById('section_type_select_1_span').innerHTML =
                    " ** กรุณากเลือกประเภทหน่วยงาน";
                    check_step_1 = false;
            } else {
                $(".section_type_select_1_div").removeClass("is-invalid");
                document.getElementById('section_type_select_1_span').innerHTML = "";
            }

            if (!req_number) {
                $(".req_num_select_1_div").addClass("is-invalid");
                document.getElementById('req_num_select_1_span').innerHTML = " ** กรุณากรอกจำนวนคนที่ต้องการ";
                check_step_1 = false;
            } else {
                $(".req_num_select_1_div").removeClass("is-invalid");
                document.getElementById('req_num_select_1_span').innerHTML = "";
            }

        } else {
            position_selected = document.getElementById("position_select_2").value;
            if (position_selected) {
                position_id = document.querySelector("#pos_list_2 option[value='" + position_selected + "']").dataset.value;
            }
            department_id = document.getElementById("department_select_2").value;
            section_code = document.getElementById("section_code_select_2").value;
            req_number = document.getElementById("req_num_select_2").value;

            for (const radio_external_type of radio_external_types) {
                if (radio_external_type.checked) {
                    external_type_val = radio_external_type.value;
                    break;
                }
            }

            var radio_temp_types = document.querySelectorAll('input[name="ex_type"]');
            var temp_type_val;
            for (const radio_temp_type of radio_temp_types) {
                if (radio_temp_type.checked) {
                    temp_type_val = radio_temp_type.value;
                    break;
                }
            }

            if (!position_id) {
                $(".position_select_2_div").addClass("is-invalid");
                document.getElementById('position_select_2_span').innerHTML = " ** กรุณาเลือกตำแหน่งที่ต้องการ";
                check_step_1 = false;
            } else {
                $(".position_select_2_div").removeClass("is-invalid");
                document.getElementById('position_select_2_span').innerHTML = "";
            }

            if (department_id == "0") {
                $(".department_select_2_div").addClass("is-invalid");
                document.getElementById('department_select_2_span').innerHTML = " ** กรุณาเลือกแผนก";
                check_step_1 = false;
            } else {
                $(".department_select_2_div").removeClass("is-invalid");
                document.getElementById('department_select_2_span').innerHTML = "";
            }

            if (!section_code) {
                $(".section_select_2_div").addClass("is-invalid");
                document.getElementById('section_select_2_span').innerHTML = " ** กรุณาเลือกหน่วยงาน";
                check_step_1 = false;
            } else {
                $(".section_select_2_div").removeClass("is-invalid");
                document.getElementById('section_select_2_span').innerHTML = "";
            }

            if (!req_number) {
                $(".req_num_select_2_div").addClass("is-invalid");
                document.getElementById('req_num_select_2_span').innerHTML = " ** กรุณาเลือกประเภทหน่วยงาน";
                check_step_1 = false;
            } else {
                $(".req_num_select_2_div").removeClass("is-invalid");
                document.getElementById('req_num_select_2_span').innerHTML = "";
            }

            //external type 
            //1: Permanent Associate
            //2: Temporary Associate
            //3: Daily
            //4: Monthly
            //5: Subcontractor by Limited Employment Contract

            if (!external_type_val) {
                document.getElementById('external_type_span1').innerHTML = " ** กรุณาเลือกประเภทพนักงาน";
                document.getElementById('external_type_span2').innerHTML = " ** กรุณาเลือกประเภทพนักงาน";
                document.getElementById('external_type_span3').innerHTML = " ** กรุณาเลือกประเภทพนักงาน";
                check_step_1 = false;
            } else {

                document.getElementById('external_type_span1').innerHTML = "";
                document.getElementById('external_type_span2').innerHTML = "";
                document.getElementById('external_type_span3').innerHTML = "";
            }
            if (external_type_val == "2") {
                if (!temp_type_val) {
                    document.getElementById('ex_type_daily_span').innerHTML =
                        " ** กรุณาเลือกประเภทพนักงานชั่วคราว";
                    document.getElementById('ex_type_month_span').innerHTML =
                        " ** กรุณาเลือกประเภทพนักงานชั่วคราว";
                        check_step_1 = false;
                } else if (temp_type_val == "3") { // Daily 
                    document.getElementById('ex_type_daily_span').innerHTML = "";
                    document.getElementById('ex_type_month_span').innerHTML = "";
                    start_date = document.getElementById("start_date_type_daily").value;
                    end_date = document.getElementById("end_date_type_daily").value;
                    external_type_val = temp_type_val;
                    if (!start_date) {
                        $(".start_date_type_daily_div").addClass("is-invalid");
                        document.getElementById('start_date_type_daily_span').innerHTML =
                            " ** กรุณาเลือกวันที่เริ่มการจ้าง";
                            check_step_1 = false;
                    } else {
                        $(".start_date_type_daily_div").removeClass("is-invalid");
                        document.getElementById('start_date_type_daily_span').innerHTML = "";
                    }
                    if (!end_date) {
                        $(".end_date_type_daily_div").addClass("is-invalid");
                        document.getElementById('end_date_type_daily_span').innerHTML =
                            " ** กรุณาเลือกวันที่สิ้นสุดการจ้าง";
                            check_step_1 = false;
                    } else {
                        $(".end_date_type_daily_div").removeClass("is-invalid");
                        document.getElementById('end_date_type_daily_span').innerHTML = "";
                    }

                } else if (temp_type_val == "4") { // Monthly
                    document.getElementById('ex_type_month_span').innerHTML = "";
                    document.getElementById('ex_type_daily_span').innerHTML = "";
                    start_date = document.getElementById("start_date_type_month").value;
                    end_date = document.getElementById("end_date_type_month").value;
                    external_type_val = temp_type_val;
                    if (!start_date) {
                        $(".start_date_type_month_div").addClass("is-invalid");
                        document.getElementById('start_date_type_month_span').innerHTML =
                            " ** กรุณาเลือกวันที่เริ่มการจ้าง";
                            check_step_1 = false;
                    } else {
                        $(".start_date_type_month_div").removeClass("is-invalid");
                        document.getElementById('start_date_type_month_span').innerHTML = "";
                    }
                    if (!end_date) {
                        $(".end_date_type_month_div").addClass("is-invalid");
                        document.getElementById('end_date_type_month_span').innerHTML =
                            " ** กรุณาเลือกวันที่สิ้นสุดการจ้าง";
                            check_step_1 = false;
                    } else {
                        $(".end_date_type_month_div").removeClass("is-invalid");
                        document.getElementById('end_date_type_month_span').innerHTML = "";
                    }
                }
            } else if (external_type_val == "5") { // Subcontractor by Limited Employment Contract
                start_date = document.getElementById("start_date_type_sub").value;
                end_date = document.getElementById("end_date_type_sub").value;
                if (!start_date) {
                    $(".start_date_type_sub_div").addClass("is-invalid");
                    document.getElementById('start_date_type_sub_span').innerHTML =
                        " ** กรุณาเลือกวันที่เริ่มการจ้าง";
                        check_step_1 = false;
                } else {
                    $(".start_date_type_sub_div").removeClass("is-invalid");
                    document.getElementById('start_date_type_sub_span').innerHTML = "";
                }
                if (!end_date) {
                    $(".end_date_type_sub_div").addClass("is-invalid");
                    document.getElementById('end_date_type_sub_span').innerHTML =
                        " ** กรุณาเลือกวันที่สิ้นสุดการจ้าง";
                        check_step_1 = false;
                } else {
                    $(".end_date_type_sub_div").removeClass("is-invalid");
                    document.getElementById('end_date_type_sub_span').innerHTML = "";
                }
            }

            if (!req_date) {
                $(".req_start_date_div").addClass("is-invalid");
                document.getElementById('req_start_date_span').innerHTML =
                    " ** กรุณาเลือกวันที่ต้องการให้เริ่มงาน";
                    check_step_1 = false;
            } else {
                $(".req_start_date_div").removeClass("is-invalid");
                document.getElementById('req_start_date_span').innerHTML = "";
            }


        }
        if(!check_step_1){
            activePanelNum--;    
        }

    } else if (activePanelNum == 2) {
        var radio_education_types = document.querySelectorAll('input[name="education_type"]');
        var radio_com_types = document.querySelectorAll('input[name="com_type"]');
        var radio_eng_types = document.querySelectorAll('input[name="eng_type"]');
        var radio_japan_types = document.querySelectorAll('input[name="japan_type"]');
        var education_type_val;
        var education_major_val = document.getElementById("education_major").value;;
        var work_exp_year = document.getElementById("work_exp_year").value;
        var work_exp_field = document.getElementById("work_exp_field").value;
        var com_type_val;
        var com_ect_val;
        var eng_type_val;
        var japan_type_val;
        var ect = document.getElementById("ect").value;
        var ref_jd = document.getElementById("ref_jd").value;
        var addition = document.getElementById("addition").value;
        var check_step_2 = true;

        //education type
        for (const radio_education_type of radio_education_types) {
            if (radio_education_type.checked) {
                education_type_val = radio_education_type.value;
                break;
            }
        }

        //com type
        for (const radio_com_type of radio_com_types) {
            if (radio_com_type.checked) {
                com_type_val = radio_com_type.value;
                break;
            }
        }

        //eng type
        for (const radio_eng_type of radio_eng_types) {
            if (radio_eng_type.checked) {
                eng_type_val = radio_eng_type.value;
                break;
            }
        }

        //japan type
        for (const radio_japan_type of radio_japan_types) {
            if (radio_japan_type.checked) {
                japan_type_val = radio_japan_type.value;
                break;
            }
        }

        if (com_type_val == "3") {
            com_ect_val = document.getElementById("com_ect").value;
        } else {
            com_ect_val = "";
        }

        if (!education_type_val) {
            $(".education_div").addClass("is-invalid");
            document.getElementById('education_span').innerHTML = " ** กรุณาเลือกระดับการศึกษา";
            check_step_2 = false;
        } else {
            $(".education_div").removeClass("is-invalid");
            document.getElementById('education_span').innerHTML = "";
        }
        if (!education_major_val) {
            $(".education_major_div").addClass("is-invalid");
            document.getElementById('education_major_span').innerHTML = " ** กรุณากรอกสาขา";
            check_step_2 = false;
        } else {
            $(".education_major_div").removeClass("is-invalid");
            document.getElementById('education_major_span').innerHTML = "";
        }
        if (!work_exp_year) {
            $(".work_exp_year_div").addClass("is-invalid");
            document.getElementById('work_exp_year_span').innerHTML = " ** กรุณากรอกจำนวนปีประสบการณ์";
            check_step_2 = false;
        } else {
            $(".work_exp_year_div").removeClass("is-invalid");
            document.getElementById('work_exp_year_span').innerHTML = "";
        }
        if (!work_exp_field) {
            $(".work_exp_field_div").addClass("is-invalid");
            document.getElementById('work_exp_field_span').innerHTML = " ** กรุณากรอกทางด้าน";
            check_step_2 = false;
        } else {
            $(".work_exp_field_div").removeClass("is-invalid");
            document.getElementById('work_exp_field_span').innerHTML = "";
        }
        if (!com_type_val) {
            $(".com_div").addClass("is-invalid");
            document.getElementById('com_span').innerHTML = " ** กรุณาเลือกความสามารถด้านคอมพิวเตอร์";
            check_step_2 = false;
        } else {
            $(".com_div").removeClass("is-invalid");
            document.getElementById('com_span').innerHTML = "";
        }
        if (com_type_val == "3") {
            if (!com_ect_val) {
                $(".com_ect_div").addClass("is-invalid");
                document.getElementById('com_ect_span').innerHTML = " ** กรุณากรอกโปรแกรมอื่น ๆ";
                check_step_2 = false;
            } else {
                $(".com_ect_div").removeClass("is-invalid");
                document.getElementById('com_ect_span').innerHTML = "";
            }
        }
        if (!eng_type_val) {
            $(".eng_div").addClass("is-invalid");
            document.getElementById('eng_span').innerHTML = " ** กรุณาเลือกความสามารถด้านภาษาอังกฤษ";
            check_step_2 = false;
        } else {
            $(".eng_div").removeClass("is-invalid");
            document.getElementById('eng_span').innerHTML = "";
        }
        if (!japan_type_val) {
            $(".japan_div").addClass("is-invalid");
            document.getElementById('japan_span').innerHTML = " ** กรุณาเลือกความสามารถด้านภาษาญี่ปุ่น";
            check_step_2 = false;
        } else {
            $(".japan_div").removeClass("is-invalid");
            document.getElementById('japan_span').innerHTML = "";
        }
        if (!ect) {
            $(".ect_div").addClass("is-invalid");
            document.getElementById('ect_span').innerHTML = ' ** กรุณากรอกอื่น ๆ หากไม่มีให้กรอก "-" (ขีด)';
            check_step_2 = false;
        } else {
            $(".ect_div").removeClass("is-invalid");
            document.getElementById('ect_span').innerHTML = "";
        }
        if (!ref_jd) {
            $(".ref_jd_div").addClass("is-invalid");
            document.getElementById('ref_jd_span').innerHTML =
                ' ** กรุณากรอกหน้าที่ความรับผิดชอบอ้างอิง JD หมายเลข';
                check_step_2 = false;
        } else {
            $(".ref_jd_div").removeClass("is-invalid");
            document.getElementById('ref_jd_span').innerHTML = "";
        }
        if (!addition) {
            $(".addition_div").addClass("is-invalid");
            document.getElementById('addition_span').innerHTML =
                ' ** กรุณากรอกหน้าที่ความรับผิดชอบเพิ่มเติม หากไม่มีให้กรอก "-" (ขีด)';
                check_step_2 = false;
        } else {
            $(".addition_div").removeClass("is-invalid");
            document.getElementById('addition_span').innerHTML = "";
        }
        if(!check_step_2){
            activePanelNum--;
        }

    } else if (activePanelNum == 3){
        var radio_headcount_types = document.querySelectorAll('input[name="headcount_control_type"]');
        var headcount_val;
        var headcount_num1;
        var headcount_num2;
        var check_step_3 = true;

        //headcount control
        for (const radio_headcount of radio_headcount_types) {
            if (radio_headcount.checked) {
                headcount_val = radio_headcount.value;
                break;
            }
        }

        if (headcount_val == "1") {
            headcount_num1 = document.getElementById("num_1_type_1").value;
            headcount_num2 = document.getElementById("num_2_type_1").value;
            emp_row_index = document.getElementById("num_1_type_1").value;
        } else if (headcount_val == "2") {
            headcount_num1 = document.getElementById("num_1_type_2").value;
            headcount_num2 = document.getElementById("num_2_type_2").value;
        } else {
            headcount_num1 = document.getElementById("num_1_type_3").value;
            headcount_num2 = document.getElementById("num_2_type_3").value;
            emp_row_index = document.getElementById("num_1_type_3").value;
        }

        if(!headcount_val){
            document.getElementById('type_1_span').innerHTML = ' ** กรุณาเลือกการควบคุมจำนวนพนักงาน';
            document.getElementById('type_2_span').innerHTML = ' ** กรุณาเลือกการควบคุมจำนวนพนักงาน';
            document.getElementById('type_3_span').innerHTML = ' ** กรุณาเลือกการควบคุมจำนวนพนักงาน';
            check_step_3 = false;
        }
        else{
            document.getElementById('type_1_span').innerHTML = '';
            document.getElementById('type_2_span').innerHTML = '';
            document.getElementById('type_3_span').innerHTML = '';
            if (headcount_val == "1") {
                if(!headcount_num1){
                    $(".num_1_type_1_div").addClass("is-invalid");
                    document.getElementById('num_1_type_1_span').innerHTML = ' ** กรุณากรอกจำนวนคนที่ลาออก';
                    check_step_3 = false;
                }else{
                    $(".num_1_type_1_div").removeClass("is-invalid");
                    document.getElementById('num_1_type_1_span').innerHTML = '';
                }
                if(!headcount_num2){
                    $(".num_2_type_1_div").addClass("is-invalid");
                    document.getElementById('num_2_type_1_span').innerHTML = ' ** กรุณากรอกจำนวนคนที่ต้องการ';
                    check_step_3 = false;
                }else{
                    $(".num_2_type_1_div").removeClass("is-invalid");
                    document.getElementById('num_2_type_1_span').innerHTML = '';
                }
                $(".num_1_type_2_div").removeClass("is-invalid");
                document.getElementById('num_1_type_2_span').innerHTML = '';
                $(".num_2_type_2_div").removeClass("is-invalid");
                document.getElementById('num_2_type_2_span').innerHTML = '';

                $(".num_1_type_3_div").removeClass("is-invalid");
                document.getElementById('num_1_type_3_span').innerHTML = '';
                $(".num_2_type_3_div").removeClass("is-invalid");
                document.getElementById('num_2_type_3_span').innerHTML = '';
        }
            else if (headcount_val == "2") {
                if(valid_form_headcount_2()){
                        save_data();
                }
                else{
                        check_step_3 = false;
                }
            }
            else if (headcount_val == "3") {
                if(!headcount_num1){
                    $(".num_1_type_3_div").addClass("is-invalid");
                    document.getElementById('num_1_type_3_span').innerHTML = ' ** กรุณากรอกอัตราทดแทนพนักงานโอนย้าย';
                    check_step_3 = false;
                }else{
                    $(".num_1_type_3_div").removeClass("is-invalid");
                    document.getElementById('num_1_type_3_span').innerHTML = '';
                }
                if(!headcount_num2){
                    $(".num_2_type_3_div").addClass("is-invalid");
                    document.getElementById('num_2_type_3_span').innerHTML = ' ** กรุณากรอกจำนวนคนที่ต้องการ';
                    check_step_3 = false;
                }else{
                    $(".num_2_type_3_div").removeClass("is-invalid");
                    document.getElementById('num_2_type_3_span').innerHTML = '';
                }
                $(".num_1_type_1_div").removeClass("is-invalid");
                document.getElementById('num_1_type_1_span').innerHTML = '';

                $(".num_2_type_1_div").removeClass("is-invalid");
                document.getElementById('num_2_type_1_span').innerHTML = '';

                $(".num_1_type_2_div").removeClass("is-invalid");
                document.getElementById('num_1_type_2_span').innerHTML = '';

                $(".num_2_type_2_div").removeClass("is-invalid");
                document.getElementById('num_2_type_2_span').innerHTML = '';

            }
        }

        if(!check_step_3){
            activePanelNum--;
        }
        
    }
    
    
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;

    setActiveStep(activePanelNum);
    setActivePanel(activePanelNum);
});

function valid_form_headcount_2(value){
    var headcount_num1;
    var headcount_num2;
    var check = true;

    headcount_num1 = document.getElementById("num_1_type_2").value;
    headcount_num2 = document.getElementById("num_2_type_2").value;

    if(!headcount_num1){
        $(".num_1_type_2_div").addClass("is-invalid");
        document.getElementById('num_1_type_2_span').innerHTML = ' ** กรุณากรอกอัตราเพิ่มจากแผนกำลังคน';
        check = false;
    }else{
        $(".num_1_type_2_div").removeClass("is-invalid");
        document.getElementById('num_1_type_2_span').innerHTML = '';
    }
    if(!headcount_num2){
        $(".num_2_type_2_div").addClass("is-invalid");
        document.getElementById('num_2_type_2_span').innerHTML = ' ** กรุณากรอกเหตุผลที่ขอคนเพิ่มจากแผนกำลังคน';
        check = false;
    }else{
        $(".num_2_type_2_div").removeClass("is-invalid");
        document.getElementById('num_2_type_2_span').innerHTML = '';
    }
           
    $(".num_1_type_1_div").removeClass("is-invalid");
    document.getElementById('num_1_type_1_span').innerHTML = '';
    
    $(".num_2_type_1_div").removeClass("is-invalid");
    document.getElementById('num_2_type_1_span').innerHTML = '';

    $(".num_1_type_3_div").removeClass("is-invalid");
    document.getElementById('num_1_type_3_span').innerHTML = '';

    $(".num_2_type_3_div").removeClass("is-invalid");
    document.getElementById('num_2_type_3_span').innerHTML = '';

    document.getElementById('type_1_span').innerHTML = '';
    document.getElementById('type_2_span').innerHTML = '';
    document.getElementById('type_3_span').innerHTML = '';
    return check;

}
//SETTING PROPER FORM HEIGHT ONLOAD
window.addEventListener('load', setFormHeight, false);
//SETTING PROPER FORM HEIGHT ONRESIZE
window.addEventListener('resize', setFormHeight, false);
</script>
<script src="/path/to/bootstrap.min.css"></script>
