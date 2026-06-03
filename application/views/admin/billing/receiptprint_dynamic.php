<!DOCTYPE html>
<html lang="ml">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>വഴിപാട് രസീത് - <?php echo htmlspecialchars($temple_list[0]['name']); ?></title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Malayalam:wght@400;600;700&family=IM+Fell+English:ital@0;1&display=swap');

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    background: #e8e0d5;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding: 30px 20px;
    font-family: 'Noto Serif Malayalam', serif;
  }

  .receipt-wrapper {
    display: flex;
    flex-direction: column;
    gap: 20px;
    align-items: center;
  }

  .receipt {
    background: #fff;
    width: 80mm;
    padding: 12px 14px 16px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.18);
    font-size: 11px;
    color: #111;
    line-height: 1.45;
  }

  /* Header */
  .header { text-align: center; margin-bottom: 8px; }

  .temple-logo {
    width: 54px; height: 54px;
    margin: 0 auto 6px; display: block;
  }

  .temple-name {
    font-family: 'IM Fell English', serif;
    font-size: 13px; font-weight: bold;
    letter-spacing: 0.5px; line-height: 1.3;
    text-transform: uppercase;
  }

  .temple-sub { font-size: 10.5px; margin-top: 2px; color: #333; }

  .divider-thick { border: none; border-top: 2px solid #111; margin: 6px 0 4px; }
  .divider-thin  { border: none; border-top: 1px solid #555; margin: 5px 0; }

  .receipt-title {
    font-family: 'Noto Serif Malayalam', serif;
    text-align: center; font-size: 13px;
    font-weight: 700; margin: 4px 0 6px;
  }

  /* Meta */
  .meta-row {
    display: flex; justify-content: space-between;
    font-size: 10px; margin-bottom: 3px;
  }

  .pooja-name { font-size: 10.5px; margin-bottom: 2px; }

  /* Table */
  .items-table {
    width: 100%; border-collapse: collapse;
    margin-top: 5px; border: 1px solid #333;
  }

  .items-table th {
    font-size: 10.5px; font-weight: 700;
    padding: 4px 5px; border-bottom: 1px solid #333;
    text-align: left;
  }

  .items-table th.right, .items-table td.right { text-align: right; }
  .items-table th.center, .items-table td.center { text-align: center; }

  .items-table td {
    padding: 3px 5px; font-size: 10.5px; vertical-align: top;
  }

  .items-table tr:not(:last-child) td { border-bottom: 1px dashed #ccc; }

  .person-name  { font-weight: 600; display: block; }
  .person-star  { font-size: 9.5px; color: #444; }
  .person-pooja { font-size: 9px; color: #555; }
  .person-date  { font-size: 9px; color: #666; }

  /* Deity caption */
  .deity-caption {
    font-size: 11px; font-weight: 700;
    text-align: center; padding: 4px 0 2px;
    letter-spacing: 0.3px;
  }

  /* Adjustments */
  .adj-section { margin-top: 6px; }
  .adj-title {
    font-size: 10px; font-weight: 700;
    text-align: center; padding: 3px 0;
    border-top: 1px solid #333; border-bottom: 1px solid #333;
    margin-bottom: 3px;
  }
  .adj-table { width: 100%; border-collapse: collapse; font-size: 9.5px; }
  .adj-table th, .adj-table td { padding: 2px 4px; border-bottom: 1px dashed #ccc; }
  .adj-table th { font-weight: 700; text-align: center; }
  .adj-table td { text-align: center; }
  .adj-table td:first-child { text-align: left; }
  .adj-table td:last-child  { text-align: right; }

  /* Subtotal / Grand Total */
  .subtotal-row {
    display: flex; justify-content: space-between;
    font-size: 11px; font-weight: 600;
    padding: 3px 0; margin-top: 4px;
    border-top: 1px solid #999;
  }

  .total-row {
    display: flex; justify-content: flex-end;
    align-items: center; gap: 10px;
    margin-top: 7px; font-size: 12px; font-weight: 700;
  }

  /* Footer */
  .footer-meta {
    margin-top: 6px; font-size: 9.5px;
    border-top: 1px solid #ccc; padding-top: 5px;
  }
  .footer-meta .row {
    display: flex; justify-content: space-between; margin-bottom: 2px;
  }

  .footer-date  { margin-top: 8px; font-size: 10.5px; font-weight: 600; }

  .footer-website {
    text-align: center; font-size: 9.5px;
    margin: 5px 0; color: #333;
  }

  .footer-note {
    margin-top: 5px; font-size: 9px; color: #555;
    line-height: 1.4; border-top: 1px solid #999; padding-top: 5px;
  }

  /* Schedule date range */
  .schedule-range { font-size: 9px; color: #555; }

  /* Print */
  @media print {
    body { background: #fff; padding: 0; }
    .receipt { box-shadow: none; width: 80mm; margin: 0; page-break-after: always; }
    .receipt:last-child { page-break-after: auto; }
    .no-print { display: none; }
  }
</style>
</head>
<body onload="window.print()" onafterprint="myFunction()">

<?php
  /* -------------------------------------------------------
   *  Pre-compute data (mirrors receiptprint.php logic)
   * ----------------------------------------------------- */
  $grandtotal  = $this->db->query(
      "SELECT SUM(billing_dtls.amount) AS total
       FROM billing_dtls
       WHERE billing_dtls.bill_id = $bill_id"
  )->row()->total;

  $site_settings = $this->site_model->settings();

  $preparedby = $this->db->query(
      "SELECT admin.name, bill_time, counter.name AS countername,
              payment_modes.name AS mode
       FROM admin
       JOIN billing        ON billing.user_id     = admin.id
       JOIN counter        ON billing.counter      = counter.id
       JOIN payment_modes  ON billing.mode         = payment_modes.id
       WHERE billing.id = $bill_id"
  )->row();

  /* Distinct deities (non-schedule) */
  $deities = $this->db->query(
      "SELECT DISTINCT diety_id
       FROM billing_dtls
       WHERE bill_id = $bill_id AND type != 'S'
       GROUP BY diety_id"
  )->result_array();

  /* Schedule poojas */
  $this->db->select('billing_dtls.*, stars.name_mal AS star_eng,
      pooja.name_mal AS pooja_nm, billing.bal_amt AS balance,
      billing.mode AS mode, billing_dtls.rate AS pooja_rt,
      SUM(billing_dtls.qlt) AS qlt,
      SUM(billing_dtls.postal_amt) AS postalamt,
      billing_dtls.amount AS prasad_rt,
      diety.name_mal AS deity_nm,
      billing.count, billing.customer_id, billing.total, billing.recv_amt,
      billing_dtls.date AS date,
      MAX(billing_dtls.date) AS maxdate,
      MIN(billing_dtls.date) AS mindate,
      billing_dtls.pooja');
  $this->db->from('billing_dtls');
  $this->db->join('billing', 'billing.id = billing_dtls.bill_id');
  $this->db->join('stars',   'stars.id   = billing_dtls.star');
  $this->db->join('pooja',   'pooja.id   = billing_dtls.pooja');
  $this->db->join('diety',   'diety.id   = billing_dtls.diety_id');
  $this->db->where('billing_dtls.bill_id', $bill_id);
  $this->db->where('billing_dtls.type',    'S');
  $this->db->group_by('billing_dtls.name, billing_dtls.pooja');
  $schedulePoojas = $this->db->get()->result_array();

  /* Helper: render the standard receipt header */
  function renderHeader($temple_list, $bill_list) { ?>
    <div class="header">
      <svg class="temple-logo" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
        <g fill="none" stroke="#111" stroke-width="2">
          <rect x="10" y="82" width="80" height="8" rx="1"/>
          <rect x="32" y="45" width="36" height="37"/>
          <path d="M42 82 L42 62 Q50 55 58 62 L58 82" fill="#111"/>
          <polygon points="50,8 20,45 80,45" fill="#111"/>
          <polygon points="50,18 26,45 74,45" fill="#fff" stroke="#111"/>
          <polygon points="50,26 32,45 68,45" fill="#111"/>
          <polygon points="50,33 37,45 63,45" fill="#fff" stroke="#111"/>
          <line x1="50" y1="3" x2="50" y2="8"/>
          <ellipse cx="50" cy="3" rx="3" ry="3" fill="#111"/>
          <rect x="16" y="65" width="10" height="17"/>
          <rect x="74" y="65" width="10" height="17"/>
        </g>
      </svg>
      <div class="temple-name"><?php echo htmlspecialchars($temple_list[0]['name']); ?></div>
      <div class="temple-sub"><?php echo htmlspecialchars($temple_list[0]['address']); ?> - <?php echo htmlspecialchars($temple_list[0]['pincode']); ?></div>
      <div class="temple-sub"><?php echo htmlspecialchars($temple_list[0]['phone']); ?></div>
    </div>

    <hr class="divider-thick">
    <div class="receipt-title">വഴിപാട് രസീത്</div>
    <hr class="divider-thin">

    <div class="meta-row">
      <span>തീയതി: <?php echo date('d/m/Y h:i A', strtotime($bill_list[0]['date'])); ?></span>
      <span>നമ്പർ: <?php echo htmlspecialchars($bill_list[0]['id']); ?></span>
    </div>
  <?php }

  /* Helper: render footer meta (counter, mode, time) */
  function renderFooter($preparedby, $temple_list) { ?>
    <div class="footer-meta">
      <div class="row">
        <span>Counter: <strong><?php echo htmlspecialchars($preparedby->countername); ?></strong></span>
        <span>Mode: <strong><?php echo htmlspecialchars($preparedby->mode); ?></strong></span>
      </div>
      <div class="row">
        <span>Time: <strong><?php echo date('d/m/Y h:i a'); ?></strong></span>
      </div>
    </div>
    <?php if (!empty($temple_list[0]['website'])): ?>
    <div class="footer-website">
      For Online Pooja booking<br>
      <strong><?php echo htmlspecialchars($temple_list[0]['website']); ?></strong>
    </div>
    <?php endif; ?>
    <div class="footer-note">
      വഴിപാട് രസീത് മേൽസാന്നിദ്ധ്യം കാണിച്ച് പ്രവേശം സ്വീകരിക്കേണ്ടതാണ്
    </div>
  <?php }
?>

<div class="receipt-wrapper">

<?php /* ===================================================
       *  SECTION 1 — SCHEDULE POOJAS
       * ================================================= */
  if (count($schedulePoojas) > 0):
    $scheduleTotal = 0;
?>
<div class="receipt">
  <?php renderHeader($temple_list, $bill_list); ?>

  <div class="pooja-name deity-caption"><?php echo htmlspecialchars($schedulePoojas[0]['deity_nm']); ?></div>
  <hr class="divider-thin">

  <table class="items-table">
    <thead>
      <tr>
        <th>പേര്</th>
        <th class="center">അളവ്</th>
        <th class="right">തുക</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($schedulePoojas as $val):
        $qlt      = $val['qlt'];
        $pooja_rt = $val['rate'];
        $amt      = $pooja_rt > 0 ? ($qlt * $pooja_rt) : $val['amount'];
        $scheduleTotal += $amt;

        $name     = $val['name'];
        $mm       = $this->db->query(
            "SELECT MAX(date) AS max_date, MIN(date) AS min_date
             FROM billing_dtls
             WHERE bill_id = '$bill_id' AND name = '$name'"
        )->result_array();
        $min_date = date('d-m-Y', strtotime($mm[0]['min_date']));
        $max_date = date('d-m-Y', strtotime($mm[0]['max_date']));
    ?>
      <tr>
        <td>
          <span class="person-name"><?php echo strtoupper(htmlspecialchars($val['name'])); ?></span>
          <span class="person-star">(<?php echo htmlspecialchars($val['star_eng']); ?>)</span>
          <span class="person-pooja"><?php echo htmlspecialchars($val['pooja_nm']); ?> | <?php echo $qlt; ?></span>
          <span class="person-date schedule-range"><?php echo $min_date . ' – ' . $max_date; ?></span>
        </td>
        <td class="center"><?php echo number_format($qlt, 2); ?></td>
        <td class="right"><?php echo number_format($amt, 2); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <hr class="divider-thin">
  <div class="total-row">
    <span>ആകെ തുക:</span>
    <span><?php echo number_format($scheduleTotal, 2); ?></span>
  </div>

  <?php renderFooter($preparedby, $temple_list); ?>
</div>
<?php endif; ?>


<?php /* ===================================================
       *  SECTION 2 — REGULAR POOJAS (Deity > Date > Category)
       * ================================================= */
  $lastDeity = end($deities)['diety_id'];
  foreach ($deities as $deity):
    $da = $deity['diety_id'];

    $dates = $this->db->query(
        "SELECT DISTINCT date FROM billing_dtls
         WHERE bill_id = $bill_id AND diety_id = $da AND type != 'S'
         GROUP BY date"
    )->result_array();

    $lastDate = end($dates)['date'];
    foreach ($dates as $dateArr):
      $date = $dateArr['date'];

      $pooja_cats = $this->db->query(
          "SELECT DISTINCT pooja_cat FROM pooja
           WHERE id IN (
               SELECT pooja FROM billing_dtls
               WHERE bill_id = $bill_id AND diety_id = '$da'
               AND date = '$date' AND type != 'S'
           )
           GROUP BY pooja_cat"
      )->result_array();

      $lastCat = end($pooja_cats);
      foreach ($pooja_cats as $id):

        $this->db->select('billing_dtls.*, stars.name_mal AS star_eng,
            pooja.name_mal AS pooja_nm, billing_dtls.rate AS pooja_rt,
            diety.name_mal AS deity_nm');
        $this->db->from('billing_dtls');
        $this->db->join('stars', 'stars.id = billing_dtls.star',  'left');
        $this->db->join('pooja', 'pooja.id = billing_dtls.pooja');
        $this->db->join('diety', 'diety.id = billing_dtls.diety_id');
        $this->db->where('billing_dtls.bill_id', $bill_id);
        $this->db->where('pooja.pooja_cat',       $id['pooja_cat']);
        $this->db->where('billing_dtls.date',      $date);
        $this->db->where('billing_dtls.diety_id',  $da);
        $this->db->where('billing_dtls.type !=',   'S');
        $this->db->group_by('billing_dtls.pooja');
        $this->db->group_by('billing_dtls.name');
        $this->db->group_by('billing_dtls.id');
        $query = $this->db->get()->result_array();

        if (empty($query)) continue;

        $sectionTotal = 0;
?>

<div class="receipt">
  <?php renderHeader($temple_list, $bill_list); ?>

  <div class="pooja-name"><?php echo htmlspecialchars($query[0]['deity_nm']); ?></div>
  <div class="pooja-name" style="font-size:9.5px;color:#555;">
    <?php echo date('d-m-Y', strtotime($date)); ?>
  </div>
  <hr class="divider-thin">

  <table class="items-table">
    <thead>
      <tr>
        <th>പേര്</th>
        <th class="center">അളവ്</th>
        <th class="right">തുക</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($query as $val):
        $qlt      = $val['qlt'];
        $pooja_rt = $val['pooja_rt'];
        $amt      = $val['amount'];
        $sectionTotal += $amt;
    ?>
      <tr>
        <td>
          <span class="person-name"><?php echo strtoupper(htmlspecialchars($val['name'])); ?></span>
          <span class="person-star">(<?php echo htmlspecialchars($val['star_eng']); ?>)</span>
          <span class="person-pooja"><?php echo htmlspecialchars($val['pooja_nm']); ?> | <?php echo number_format($pooja_rt, 2); ?></span>
          <span class="person-date"><?php echo date('d-m-Y', strtotime($val['date'])); ?></span>
        </td>
        <td class="center"><?php echo number_format($qlt, 2); ?></td>
        <td class="right"><?php echo number_format($amt, 2); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

  <hr class="divider-thin">
  <div class="subtotal-row">
    <span>Total</span>
    <span><?php echo number_format($sectionTotal, 2); ?></span>
  </div>

  <?php /* --- Adjustments (Received Items) --- */
  if (!empty($adjustment)): ?>
  <div class="adj-section">
    <div class="adj-title">RECEIVED ITEMS</div>
    <table class="adj-table">
      <thead>
        <tr>
          <th>#</th><th>Item</th><th>Qty</th><th>Unit</th><th>Rate</th><th>Total</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($adjustment as $k => $adj): ?>
        <tr>
          <td><?php echo $k + 1; ?></td>
          <td><?php echo htmlspecialchars($adj['product']); ?></td>
          <td><?php echo $adj['qty']; ?></td>
          <td><?php echo htmlspecialchars($adj['unit']); ?></td>
          <td><?php echo number_format($adj['rate'], 2); ?></td>
          <td><?php echo number_format($adj['qty'] * $adj['rate'], 2); ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <?php endif; ?>

  <?php renderFooter($preparedby, $temple_list); ?>
</div>

<?php
      endforeach; // category
    endforeach; // date
  endforeach; // deity
?>

<!-- Grand Total slip -->
<div class="receipt" style="padding: 10px 14px;">
  <div class="total-row" style="font-size:13px;border-top:2px solid #111;padding-top:8px;">
    <span>Grand Total</span>
    <span><?php echo number_format($grandtotal, 2); ?></span>
  </div>
</div>

</div><!-- /.receipt-wrapper -->

<div class="no-print" style="position:fixed;bottom:24px;right:24px;">
  <button onclick="window.print()" style="
    background:#8b1a1a;color:#fff;border:none;padding:10px 22px;
    font-size:13px;border-radius:4px;cursor:pointer;
    font-family:'IM Fell English',serif;letter-spacing:0.5px;
    box-shadow:0 3px 10px rgba(0,0,0,0.25);">
    🖨 Print
  </button>
</div>

<script>
  function myFunction() {
    window.location = "<?php echo base_url(); ?>index.php/admin/newbilling/billing";
  }
</script>
</body>
</html>
