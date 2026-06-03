<html>
<head>
    <style>
        th, td {
            padding: 5px;
        }
        h4 {
            margin-bottom: -12px;
        }
        /* CSS to force each date onto a new printed page */
        .page-break {
            page-break-after: always;
            clear: both;
        }
        /* Prevents a blank page at the very end */
        .page-break:last-child {
            page-break-after: auto;
        }
        @media print {
            .page-break {
                display: block;
            }
        }
    </style>
</head>
<body onload="printcontend('printer')" onafterprint="myFunction()">
    <div id="printer">
        <?php
        if (!empty($bill_list) && is_array($bill_list)) {
            // Loop through each date (the keys of your grouped array)
            foreach ($bill_list as $current_date => $pooja_items) {
                $day_tot = 0;
                $i = 0;
                ?>
                <div class="page-break">
                    <table border="1" style="border-collapse:collapse;width:100%;margin-bottom:1cm;">
                        <thead>
                            <tr>
                                <td colspan="7" style="width:100%;">
                                    <h4 style="text-align:center;margin-bottom:2px;">
                                        <?php echo $temple_list[0]['name']; ?><br>
                                        <?php echo $temple_list[0]['address'] . " , " . $temple_list[0]['location']; ?>
                                    </h4>
                                    <p style="text-align:center;"><strong>POOJA SUMMARY</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="7">
                                    <label style="float:left;">DATE : <?php echo date('d-m-Y', strtotime($current_date)); ?></label>
                                    
                                </th>
                            </tr>
                            <tr>
                                <th width="5%">SL No</th>
                                <th>Name of the Pooja</th>
                                <th width="10%">Quantity</th>
                                <th style="text-align:right" width="10%">Rate</th>
                                <th style="text-align:right" width="12%">Cash</th>
                                <th style="text-align:right" width="12%">Qr</th>
                                <th style="text-align:right" width="15%">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($pooja_items as $val) { 
                                $qty = $val['quantity'];
                                $pooja_rt = $val['pooja_rt'];
                                $row_total = $val['amount']; // Using the pre-calculated amount from the model
                                $day_tot += $row_total;
                                ?>
                                <tr>
                                    <td><?= ++$i; ?></td>
                                    <td><?= $val['pooja']; ?></td>
                                    <td style="text-align:center;"><?= $qty; ?></td>
                                    <td style="text-align:right;"><?= number_format($pooja_rt, 2); ?></td>
                                    <td style="text-align:right;"><?= number_format($val['cash'], 2); ?></td>
                                    <td style="text-align:right;"><?= number_format($val['qr'], 2); ?></td>
                                    <td style="text-align:right;"><?= number_format($row_total, 2); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" style="text-align:left;">Daily Total</th>
                                <th style="text-align:right"><?= number_format($day_tot, 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <?php 
            } 
        } else { ?>
            <div style="text-align:center; padding:20px;">No Data Found!</div>
        <?php } ?>
    </div>

    <script>
        window.onfocus = function () { 
            setTimeout(function () { 
                window.location = "<?php echo base_url();?>index.php/admin/admin/bill_summary" 
            }, 500); 
        }
        function myFunction(){
            window.location = "<?php echo base_url();?>index.php/admin/admin/bill_summary";
        }
        function printcontend(value) {
            var restorpage = document.body.innerHTML;
            var printcontent = document.getElementById(value).innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            document.body.innerHTML = restorpage;
        }
    </script>
</body>
</html>