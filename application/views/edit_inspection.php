<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.css">
<style>
    #dimensionModal,
    #ndtModal {
        margin-top: 17px;
    }

    #dimensionModal table,
    #ndtModal table {
        border-collapse: collapse;
        border: 1px solid #000;
    }

    #dimensionModal tr th,
    #dimensionModal tr td,
    #ndtModal tr th,
    #ndtModal tr td {
        border: 1px solid #000;
        border-collapse: collapse;
    }

    #dimensionModal tr td,
    #ndtModal tr td {
        padding: 0;
    }

    thead tr th {
        text-align: center;
    }

    #dimensionModal .form-control,
    #ndtModal .form-control {
        border: none !important;
        background-color: #fff !important;
    }

    .note-btn-group .dropdown-menu {
        background-color: #fff !important;
        padding: 3px !important;
    }

    .form-heatno-control {
        display: block;
        width: 100%;
        height: 34px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

</style>

<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-reorder"></i>Create Inspection
                            </div>
                        </div>
                        <div class="portlet-body form">

                            <form id="inspectionForm">
                                <input type="hidden" name="id" id="id" value="<?php echo $edit->id; ?>">
                                <div class="row" style="margin:10px 0;">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Report No</label>
                                            <input type="text" class="form-control" name="insno" autocomplete="off" id="insno" readonly value="<?php echo $edit->insno; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Inspection Date</label>
                                            <input type="text" class="form-control" name="inspection_date" autocomplete="off" id="inspection_date" value="<?php echo $edit->inspection_date; ?>">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Customer Name</label>
                                            <input type="text" class="form-control" name="customername" autocomplete="off" id="customername" value="<?php echo $edit->customername; ?>">
                                            <input type="hidden" class="form-control" name="customerid" id="customerid" value="<?php echo $edit->customerid; ?>">
                                            <div id="cusname_valid" style="position: absolute;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <input type="text" class="form-control" name="itemname" autocomplete="off" id="itemname" value="<?php echo $edit->itemname; ?>">
                                            <div id="itemname_valid" style="position: absolute;"></div>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Drawing No</label>
                                            <input type="text" class="form-control" name="drawingno" autocomplete="off" id="drawingno" value="<?php echo $edit->drawingno; ?>">

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Product Code</label>
                                            <input type="text" class="form-control" name="product_code" autocomplete="off" id="product_code" value="<?php echo $edit->product_code; ?>">

                                        </div>
                                    </div>


                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Purchase Order No</label>
                                            <select name="purchase_order_no" id="purchase_order_no" class="form-control" onchange="getpurchaseorderdetails()">

                                            </select>


                                        </div>
                                    </div> -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Grade</label>
                                            <?php $grade = $this->db->where('status', 1)->get('grade')->result(); ?>
                                            <select name="grade" id="grade" class="form-control">
                                                <option value="">Select Grade</option>
                                                <?php foreach ($grade as $g) { ?>
                                                    <option value="<?php echo $g->id; ?>"><?php echo $g->grade; ?></option>

                                                <?php } ?>
                                            </select>
                                            <script>
                                                document.getElementById('grade').value = '<?php echo $edit->grade; ?>';
                                            </script>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">Dimension In</label>
                                            <input type="text" class="form-control" name="dimension_in" autocomplete="off" id="dimension_in" value="<?php echo $edit->dimension_in; ?>">

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div id="dimensionModal">
                                            <div>
                                                <h4 style="margin-bottom: 17px;color: #000;">Dimension Details
                                                </h4>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Heatno 1</label>
                                                    <input type="text" class="form-heat-control" name="heatno1" id="heatno1" value="<?php echo $edit->heatno1; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Heatno 2</label>
                                                    <input type="text" class="form-heat-control" name="heatno2" id="heatno2" value="<?php echo $edit->heatno2; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Heatno 3</label>
                                                    <input type="text" class="form-heat-control" name="heatno3" id="heatno3" value="<?php echo $edit->heatno3; ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Heatno 4</label>
                                                    <input type="text" class="form-heat-control" name="heatno4" id="heatno4" value="<?php echo $edit->heatno4; ?>">
                                                </div>
                                            </div>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>S.no</th>
                                                        <th>View</th>
                                                        <th>Heat No Drg.Dim </th>
                                                        <th>1</th>
                                                        <th>2</th>
                                                        <th>3</th>
                                                        <th>4</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>


                                                <?php
                                                // Example data (replace this array with data fetched from your database)
                                                $rows = [
                                                    ['sno' => 1, 'view' => 'Length', 'length' => '353', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 2, 'view' => 'Length', 'length' => '98', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 3, 'view' => 'Width', 'length' => '331', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 4, 'view' => 'Length', 'length' => '364', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 5, 'view' => 'Height', 'length' => '22.5', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 6, 'view' => 'Inner Width', 'length' => '30', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 7, 'view' => 'Degree', 'length' => '45°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 8, 'view' => 'Depth', 'length' => '48', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 9, 'view' => 'Inner Width', 'length' => '126.5', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 10, 'view' => 'Width', 'length' => '51.5', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 11, 'view' => 'Height', 'length' => '271', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 12, 'view' => 'Height', 'length' => '24', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 13, 'view' => 'Height', 'length' => '11', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 14, 'view' => 'Inner Width', 'length' => '97', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 15, 'view' => 'Inner Width', 'length' => '119.5', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 16, 'view' => 'Width', 'length' => '331', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 17, 'view' => 'Width', 'length' => '62', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 18, 'view' => 'DIM', 'length' => '1.5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 19, 'view' => 'DIM', 'length' => '1.5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 20, 'view' => 'DIM', 'length' => '5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 21, 'view' => 'DIM', 'length' => '2.5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 22, 'view' => 'DIM', 'length' => '5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 23, 'view' => 'DIM', 'length' => '1.5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 24, 'view' => 'Inner Width', 'length' => '54.5', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 25, 'view' => 'Width', 'length' => '98', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 26, 'view' => 'DIM', 'length' => '1.5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 27, 'view' => 'DIM', 'length' => '1.5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 28, 'view' => 'DIM', 'length' => '1°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 29, 'view' => 'Height', 'length' => '32', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 30, 'view' => 'DIM', 'length' => '5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 31, 'view' => 'DIM', 'length' => '5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 32, 'view' => 'DIM', 'length' => '1.5°', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 33, 'view' => 'Height', 'length' => '20', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 34, 'view' => 'Height', 'length' => '35', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 35, 'view' => 'Inner Width', 'length' => '97', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 36, 'view' => 'Inner Width', 'length' => '119.5', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 37, 'view' => 'Width', 'length' => '331', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 38, 'view' => 'Height', 'length' => '25', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 39, 'view' => 'Height', 'length' => '42', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 40, 'view' => 'Height', 'length' => '220', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 41, 'view' => 'Height', 'length' => '45', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 42, 'view' => 'Height', 'length' => '32', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 43, 'view' => 'Width', 'length' => '57', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 44, 'view' => 'Width', 'length' => '50', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 45, 'view' => 'Width', 'length' => '70', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                    ['sno' => 46, 'view' => 'Width', 'length' => '20', 'inspection1' => '', 'inspection2' => '', 'inspection3' => '', 'inspection4' => '', 'remark' => ''],
                                                ];

                                                ?>

                                                <tbody id="dimensionTableBody">
                                                    <?php

                                                    $sno = explode(',', $edit->sno);
                                                    $view = explode(',', $edit->view);
                                                    $length = explode(',', $edit->length);
                                                    $inspection1 = explode(',', $edit->inspection1);
                                                    $inspection2 = explode(',', $edit->inspection2);
                                                    $inspection3 = explode(',', $edit->inspection3);
                                                    $inspection4 = explode(',', $edit->inspection4);
                                                    $remark = explode(',', $edit->remark);
                                                    $count = count($sno);

                                                    for ($i = 0; $i < $count; $i++) {
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control centered-input" name="sno[]" id="sno<?php echo $i; ?>"
                                                                    value="<?= $sno[$i]; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control centered-input" name="view[]" id="view<?php echo $i; ?>"
                                                                    value="<?= $view[$i]; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control centered-input" name="length[]" id="length<?php echo $i; ?>"
                                                                    value="<?= $length[$i]; ?>" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="inspection1[]" id="inspection1<?php echo $i; ?>"
                                                                    value="<?= $inspection1[$i]; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="inspection2[]" id="inspection2<?php echo $i; ?>"
                                                                    value="<?= $inspection2[$i]; ?>">
                                                            </td>

                                                            <td>
                                                                <input type="text" class="form-control" name="inspection3[]" id="inspection3<?php echo $i; ?>"
                                                                    value="<?= $inspection3[$i]; ?>">
                                                            </td>

                                                            <td>
                                                                <input type="text" class="form-control" name="inspection4[]" id="inspection4<?php echo $i; ?>"
                                                                    value="<?= $inspection4[$i]; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="remark[]" id="remark<?php echo $i; ?>"
                                                                    value="<?= $remark[$i]; ?>">
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                                <!-- <tbody id="dimensionTableBody">
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="1" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Length" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="353" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="inspection1" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="2" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Length" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="98" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="3" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="331" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="4" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Length" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="364" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="5" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="22.5" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="6" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Inner Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="30" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="7" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Degree" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="45°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="8" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Depth" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="48" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="9" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Inner Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="126.5" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="10" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="51.5" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="11" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="271" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="12" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="24" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="13" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="11" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="14" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Inner Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="97" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="15" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Inner Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="119.5" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="16" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="331" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="17" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="62" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="18" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="1.5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="19" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="1.5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="20" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="21" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="2.5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="22" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="23" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="1.5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="24" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Inner Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="54.5" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="25" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="98" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="26" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="1.5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="27" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="1.5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="28" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="1°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="29" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="32" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="30" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="31" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="32" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="DIM" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="1.5°" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="33" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="20" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="34" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="35" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="35" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Inner Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="97" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="36" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Inner Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="119.5" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="37" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="331" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="38" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="25" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="39" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="42" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="40" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="220" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="41" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="45" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="42" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Height" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="32" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="43" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="57" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="44" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="50" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="45" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="70" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="text" class="form-control" name="" id="" value="46" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="Width" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id="" value="20" readonly style="color: #000;text-align: center;"></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                        <td><input type="text" class="form-control" name="" id=""></td>
                                                    </tr>
                                                </tbody>
                                            </table> -->
                                        </div>
                                    </div>

                                    <?php
                                    $ndt = [
                                        "DP ",
                                        "MP",
                                        "RT",
                                        "UT",
                                        "VISUAL (As Per Mss SP-55)",
                                        "DIM.INSPECTION",
                                        "DESPATCH QTY",
                                        "OTHER REQUIRMENT"
                                    ];
                                    ?>

                                    <div class="col-md-12">
                                        <div id="ndtModal">
                                            <div>
                                                <h4 style="margin-bottom: 17px;color: #000;">NDT Details
                                                </h4>
                                            </div>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Type of NDT</th>
                                                        <th>Qty</th>
                                                        <th>Result</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="ndtTableBody">
                                                    <?php
                                                    $ndt = explode(',', $edit->ndt);
                                                    $qty = explode(',', $edit->qty);
                                                    $result = explode(',', $edit->result);
                                                    $ndt_remarks = explode(',', $edit->ndt_remarks);
                                                    $count1 = count($ndt);

                                                    for ($i = 0; $i < $count1; $i++) {

                                                    ?>
                                                        <tr>
                                                            <td><input type="text" class="form-control" name="ndt[]" id="ndt<?php echo $i; ?>" value="<?php echo $ndt[$i]; ?>" readonly style="color: #000;text-align: center;"></td>
                                                            <td><input type="text" class="form-control" name="qty[]" id="qty<?php echo $i; ?>" value="<?php echo $qty[$i]; ?>"></td>
                                                            <td><input type="text" class="form-control" name="result[]" id="result<?php echo $i; ?>" value="<?php echo $result[$i]; ?>"></td>

                                                            <td><input type="text" class="form-control" name="ndt_remarks[]" id="ndt_remarks<?php echo $i; ?>" value="<?php echo $ndt_remarks[$i]; ?>"></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    <div class="col-md-12" style="margin: 25px 0 30px 0;">
                                        <h4 style="margin-bottom: 17px;color: #000;">Remarks</h4>
                                        <textarea id="summernote" name="overall_remarks"><?php echo $edit->overall_remarks; ?></textarea>
                                    </div> <br><br>




                                    <div class="col-md-12 text-center mt-5">
                                        <button class="btn btn-info" id="submit" name="save" value="save">Update Inspection</button>

                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/autocomplete/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $('#inspection_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
            placeholder: 'Remarks...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            lineHeights: [
                '0.3', '0.4', '0.5', '1.0', '1.5', '2.0', '2.5', '3.0'
            ],
            callbacks: {
                onInit: function() {
                    // Set default font size to 12px
                    $('#summernote').summernote('fontSize', 12);
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 200,
            placeholder: 'Remarks...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph', 'height']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            lineHeights: [
                '0.3', '0.4', '0.5', '1.0', '1.5', '2.0', '2.5', '3.0'
            ],
            callbacks: {
                onInit: function() {
                    // Set default font size to 12px
                    $('#summernote').summernote('fontSize', 12);
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#customername").autocomplete({
            appendTo: '#cusname_valid',
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url(); ?>invoice/autocomplete_customername",
                    data: {
                        keyword: $("#customername").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $("#customername").val(ui.item.label);
                $('#customerid').val(ui.item.customerid);
                var name = $('#customername').val();
                if (name != '') {
                    $.post('<?php echo base_url(); ?>invoice/getcustomer', {
                        name: name
                    }, function(res) {
                        if (res > 0) {
                            $('#cusname_valid').html('<span><font color="green">Available!</span>');
                            $('#submit').attr('disabled', false);
                            $('#print').attr('disabled', false);
                        } else {
                            $('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
                            $('#submit').attr('disabled', true); //set button enable 
                            $('#print').attr('disabled', true); //set button enable 
                            //set button enable     
                        }
                    });
                    return false;
                }
            }
        });



        $("#itemname").autocomplete({
            appendTo: '#itemname_valid',
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo base_url(); ?>Mtc/autocomplete_itemname",
                    data: {
                        keyword: $("#itemname").val()
                    },
                    dataType: "json",
                    type: "POST",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $("#itemname").val(ui.item.label);
                $('#itemid').val(ui.item.itemid);
                $('#drawingno').val(ui.item.drawingno);
                $('#product_code').val(ui.item.itemcode);

            }
        });


        $('#submit').click(function(e) {
            e.preventDefault();

            $('#summernote').val($('#summernote').summernote('code'));

            $.ajax({
                url: '<?php echo base_url(); ?>Mtc/update_inspection',
                type: 'POST',
                data: $('#inspectionForm').serialize(),
                success: function(res) {
                    alert('INSPECTION update successfully !');
                    window.location.href = "<?php echo base_url(); ?>Mtc/reports_inspection";
                }
            })
        });


    });
</script>