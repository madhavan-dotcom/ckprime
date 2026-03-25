<div class="table-responsive myform" style="margin-top:10px;">
    <table class="responsive table" width="100%">
        <thead>
            <tr>
                <th>HSN Code</th>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Qty</th>
                <th>UOM</th>
                <th>Weight</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Disc <?php echo $discType ?></th>
                <th>Taxable Amount</th>
                <th class="sgst">CGST</th>
                <th class="sgst">CGST Amount</th>
                <th class="sgst">SGST</th>
                <th class="sgst">SGST Amount</th>
                <th class="igst" style="display:none;">IGST</th>
                <th class="igst" style="display:none;">IGST Amount</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $k = 0;
            foreach ($items as $rows) {
                $itemDet = $this->db->select('*')
                    ->where('itemcode', $rows['itemcode'])
                    ->get('additem')->row();
            ?>
                <tr>
                    <td style="width:100px;">
                        <input id="hsnno<?php echo $k ?>" readonly type="text" name="hsnno[]" value="<?php echo $rows['hsnno'] ?>">
                        <input type="hidden" name="priceType[]" id="priceType<?php echo $k ?>" value="<?php echo isset($itemDet->priceType) ? $itemDet->priceType : '' ?>" />
                        <input type="hidden" name="joborder_No[]" value="<?php echo isset($rows['dcno']) ? $rows['dcno'] : '' ?>" />
                        <input type="hidden" name="JO_RecordId[]" value="<?php echo $rows['id'] ?>" />
                        <input type="hidden" name="itemid[]" id="itemid<?php echo $k ?>" value="<?php echo isset($itemDet->id) ? $itemDet->id : '' ?>">
                        <!-- Hidden field for JO max quantity -->
                        <input type="hidden" id="jo_max_qty<?php echo $k ?>" value="<?php echo $rows['balanceqty'] ?>">
                    </td>
                    <td style="width:100px;">
                        <input class="itemcode_class" data-id="<?php echo $k ?>" id="itemcode<?php echo $k ?>" required type="text" name="itemcode[]" value="<?php echo $rows['itemcode'] ?>" readonly>
                    </td>
                    <td style="width:180px;">
                        <input class="itemname_class" data-id="<?php echo $k ?>" id="itemname<?php echo $k ?>" required type="text" name="itemname[]" value="<?php echo htmlentities($rows['itemname']) ?>" readonly>
                    </td>
                    <td style="width:50px;">
                        <input class="qty_class decimals" id="qty<?php echo $k ?>" data-id="<?php echo $k ?>" type="text" name="qty[]" autocomplete="off" value="<?php echo $rows['balanceqty'] ?>">
                        <div class="jo_qty_valid" id="jo_qty_valid<?php echo $k ?>" style="color:green;font-size:11px;"></div>
                    </td>
                    <td style="width:100px;">
                        <input id="uom<?php echo $k ?>" readonly type="text" name="uom[]" value="<?php echo $rows['uom'] ?>">
                    </td>
                    <td style="width:100px;">
                        <input class="weight_class" id="weight<?php echo $k ?>" type="text" name="weight[]" value="<?php echo $rows['weight'] ?>">
                    </td>
                    <td style="width:120px;">
                        <input class="rate_class decimals" data-id="<?php echo $k ?>" required id="rate<?php echo $k ?>" type="text" name="rate[]" value="<?php echo $rows['rate'] ?>">
                    </td>
                    <td style="width:140px;">
                        <input class="decimals" id="amount<?php echo $k ?>" readonly type="text" name="amount[]" value="">
                    </td>
                    <td style="width:100px;">
                        <input class="discount_class decimals" id="discount<?php echo $k ?>" data-id="<?php echo $k ?>" type="text" name="discount[]" value="0">
                    </td>
                    <td style="width:150px;">
                        <input class="decimals" id="taxableamount<?php echo $k ?>" readonly type="text" name="taxableamount[]" value="">
                        <input type="hidden" name="discountamount[]" id="discountamount<?php echo $k ?>">
                    </td>
                    <td class="sgst" style="width:20px;">
                        <input class="decimals" readonly id="cgst<?php echo $k ?>" type="text" name="cgst[]" value="<?php echo isset($itemDet->cgst) ? $itemDet->cgst : 0 ?>">
                    </td>
                    <td class="sgst" style="width:120px;">
                        <input class="decimals" readonly id="cgstamount<?php echo $k ?>" type="text" name="cgstamount[]" value="">
                    </td>
                    <td class="sgst" style="width:20px;">
                        <input class="decimals" readonly id="sgst<?php echo $k ?>" type="text" name="sgst[]" value="<?php echo isset($itemDet->sgst) ? $itemDet->sgst : 0 ?>">
                    </td>
                    <td class="sgst" style="width:120px;">
                        <input class="decimals" readonly id="sgstamount<?php echo $k ?>" type="text" name="sgstamount[]" value="">
                    </td>
                    <td class="igst" style="display:none;width:20px;">
                        <input class="decimals" readonly id="igst<?php echo $k ?>" type="text" name="igst[]" value="<?php echo isset($itemDet->igst) ? $itemDet->igst : 0 ?>">
                    </td>
                    <td class="igst" style="display:none;width:120px;">
                        <input class="decimals" readonly id="igstamount<?php echo $k ?>" type="text" name="igstamount[]" value="">
                    </td>
                    <td style="width:160px;">
                        <input id="total<?php echo $k ?>" type="text" name="total[]" value="" readonly>
                    </td>
                </tr>
            <?php
                $k++;
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Show/hide GST columns based on GST type
        var gsttype = '<?php echo $gsttype ?>';
        if(gsttype == 'interstate') {
            $('.igst').show();
            $('.sgst').hide();
        } else {
            $('.igst').hide();
            $('.sgst').show();
        }

        // Initialize calculations for all rows
        $('tbody tr').each(function() {
            calculateRow($(this));
            updateJoQtyValidation($(this));
        });
        recalculateGrandTotal();

        // ========== Job Order Qty Validation ==========
        $(document).on('keyup change', '.qty_class', function() {
            var row = $(this).closest('tr');
            updateJoQtyValidation(row);
            calculateRow(row);
            recalculateGrandTotal();
        });

        function updateJoQtyValidation(row) {
            var rowIndex = row.find('.qty_class').data('id');
            var enteredQty = parseFloat(row.find('[name="qty[]"]').val()) || 0;
            var maxQty = parseFloat($('#jo_max_qty' + rowIndex).val()) || 0;
            var validationDiv = $('#jo_qty_valid' + rowIndex);
            
            // Update the display message
            validationDiv.html('Job Order Qty: ' + maxQty);
            
            if (enteredQty > maxQty) {
                validationDiv.css('color', 'red');
                validationDiv.html('Job Order Qty: ' + maxQty + ' <span style="font-weight:bold;">(Exceeded by ' + (enteredQty - maxQty).toFixed(2) + ')</span>');
                row.find('[name="qty[]"]').css('border-color', 'red');
                row.find('[name="qty[]"]').css('background-color', '#ffe6e6');
                row.find('[name="qty[]"]').val('');
            } else if (enteredQty <= maxQty && enteredQty > 0) {
                validationDiv.css('color', 'green');
                row.find('[name="qty[]"]').css('border-color', '');
                row.find('[name="qty[]"]').css('background-color', '');
                
                if (enteredQty == maxQty) {
                    validationDiv.html('Job Order Qty: ' + maxQty + ' <span style="font-weight:bold;">(Full quantity used)</span>');
                } else {
                    var remaining = maxQty - enteredQty;
                    validationDiv.html('Job Order Qty: ' + maxQty + ' <span style="color:blue;">(Remaining: ' + remaining.toFixed(2) + ')</span>');
                }
            } else if (enteredQty == 0) {
                validationDiv.css('color', 'orange');
                validationDiv.html('Job Order Qty: ' + maxQty + ' <span style="font-weight:bold;">(Enter quantity)</span>');
                row.find('[name="qty[]"]').css('border-color', 'orange');
            } else {
                validationDiv.css('color', 'green');
                row.find('[name="qty[]"]').css('border-color', '');
                row.find('[name="qty[]"]').css('background-color', '');
            }
        }

        // ========== Live Calculation ==========
        $(document).on('keyup change', '.weight_class, .rate_class, .discount_class', function() {
            var row = $(this).closest('tr');
            calculateRow(row);
            recalculateGrandTotal();
        });

        function calculateRow(row) {
            var qty = parseFloat(row.find('[name="qty[]"]').val()) || 0;
            var rate = parseFloat(row.find('[name="rate[]"]').val()) || 0;
            var discount = parseFloat(row.find('[name="discount[]"]').val()) || 0;
            var weight = parseFloat(row.find('[name="weight[]"]').val()) || 0;

            var cgst = parseFloat(row.find('[name="cgst[]"]').val()) || 0;
            var sgst = parseFloat(row.find('[name="sgst[]"]').val()) || 0;
            var igst = parseFloat(row.find('[name="igst[]"]').val()) || 0;

            var gsttype = '<?php echo $gsttype ?>';

            var amount = qty * rate;
            var discountAmount = (amount * discount) / 100;
            var taxable = amount - discountAmount;

            var cgstAmount = (taxable * cgst) / 100;
            var sgstAmount = (taxable * sgst) / 100;
            var igstAmount = (taxable * igst) / 100;

            if(gsttype == 'intrastate') {
                var total = taxable + cgstAmount + sgstAmount;
            } else {
                var total = taxable + igstAmount;
            }

            row.find('[name="amount[]"]').val(amount.toFixed(2));
            row.find('[name="discountamount[]"]').val(discountAmount.toFixed(2));
            row.find('[name="taxableamount[]"]').val(taxable.toFixed(2));
            row.find('[name="cgstamount[]"]').val(cgstAmount.toFixed(2));
            row.find('[name="sgstamount[]"]').val(sgstAmount.toFixed(2));
            row.find('[name="igstamount[]"]').val(igstAmount.toFixed(2));
            row.find('[name="total[]"]').val(total.toFixed(2));
        }

        function recalculateGrandTotal() {
            var grand = 0;
            $('[name="total[]"]').each(function() {
                grand += parseFloat($(this).val()) || 0;
            });
            $('#subtotal').val(grand.toFixed(2));
            $('#grandtotal').val(grand.toFixed(2));
        }

        // Initialize calculations on page load
        recalculateGrandTotal();
    });
</script>