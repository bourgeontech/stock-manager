<style>
  .accdash * { box-sizing: border-box; margin: 0; padding: 0; }

  .accdash {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #eef2f7;
    color: #1a3a5c;
    font-size: 13px;
    padding: 18px;
  }

  /* Page header */
  .accdash .page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
  }

  .accdash .page-header h1 {
    font-size: 17px;
    font-weight: 700;
    color: #1a3a5c;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }

  /* Date chooser */
  .accdash .date-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    border: 1px solid #c9d8e8;
    border-radius: 5px;
    padding: 5px 10px;
    font-size: 11px;
    color: #1a3a5c;
    font-weight: 600;
  }

  .accdash .date-bar input[type="date"] {
    border: none;
    outline: none;
    font-size: 11px;
    color: #1a3a5c;
    font-family: inherit;
    font-weight: 600;
  }

  .accdash .date-bar label { opacity: 0.6; font-weight: 400; }

  .accdash .btn-go {
    background: #1a3a5c;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 4px 12px;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: 0.04em;
  }

  .accdash .btn-go:hover { background: #2563a8; }

  /* Two-panel grid */
  .accdash .dashboard-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
  }

  /* Panel card */
  .accdash .panel {
    background: #fff;
    border-radius: 6px;
    overflow: hidden;
    border: 1px solid #c9d8e8;
    box-shadow: 0 1px 4px rgba(26,58,92,0.07);
  }

  .accdash .panel-title {
    background: #1a3a5c;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 6px 12px;
  }

  /* Summary table */
  .accdash .summary-table {
    width: 100%;
    border-collapse: collapse;
  }

  .accdash .summary-table thead tr {
    background: #eef3f9;
    border-bottom: 1px solid #c9d8e8;
  }

  .accdash .summary-table thead th {
    padding: 5px 10px;
    font-size: 8.5px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #1a3a5c;
    text-align: left;
    white-space: nowrap;
  }

  .accdash .summary-table thead th.num { text-align: right; }

  .accdash .summary-table tbody tr {
    border-bottom: 1px solid #e8eef5;
  }

  .accdash .summary-table tbody tr:last-child { border-bottom: none; }

  .accdash .summary-table tbody tr:hover { background: #f5f9ff; }

  .accdash .summary-table td {
    padding: 4px 10px;
    font-size: 9.5px;
    color: #334;
    text-align: right;
    white-space: nowrap;
  }

  .accdash .summary-table td.counter-name {
    text-align: left;
    font-weight: 600;
    color: #1a3a5c;
  }

  .accdash .summary-table td.mode-val {
    font-weight: 700;
    color: #2563a8;
  }

  .accdash .summary-table td.row-total {
    font-weight: 700;
    color: #1a7a4a;
  }

  .accdash .summary-table td.cash-val {
    text-align: right;
    font-weight: 700;
    color: #2563a8;
  }

  .accdash .summary-table td.bank-val {
    text-align: right;
    font-weight: 700;
    color: #1a7a4a;
  }

  .accdash .summary-table tfoot td.cash-val,
  .accdash .summary-table tfoot td.bank-val {
    color: #7d6608;
  }

  /* Total footer row */
  .accdash .summary-table tfoot tr {
    background: #fef9e7;
    border-top: 1px dashed #d4ac0d;
  }

  .accdash .summary-table tfoot td {
    padding: 4px 10px;
    font-size: 9px;
    font-weight: 800;
    color: #7d6608;
    text-align: right;
    white-space: nowrap;
  }

  .accdash .summary-table tfoot td.lbl {
    text-align: left;
  }

  /* Action button row */
  .accdash .panel-actions {
    display: flex;
    gap: 6px;
    padding: 7px 10px;
    background: #f7fafd;
    border-top: 1px solid #e0e6ed;
    flex-wrap: wrap;
  }

  .accdash .btn-action {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #1a3a5c;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 4px 10px;
    font-size: 9px;
    font-weight: 700;
    letter-spacing: 0.04em;
    cursor: pointer;
    text-transform: uppercase;
    transition: background 0.15s;
  }

  .accdash .btn-action.green { background: #1a7a4a; }
  .accdash .btn-action.green:hover { background: #15643c; }

  .accdash .btn-action svg {
    width: 10px; height: 10px;
    fill: #fff;
  }

  /* Stats strip */
  .accdash .stats-strip {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 6px;
    background: #1a3a5c;
    color: #fff;
    border-radius: 0 0 5px 5px;
    padding: 6px 14px;
  }

  .accdash .stats-strip .st { display: flex; flex-direction: column; align-items: center; }
  .accdash .stats-strip .st-label {
    font-size: 7.5px;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    opacity: 0.65;
    margin-bottom: 1px;
    white-space: nowrap;
  }
  .accdash .stats-strip .st-val {
    font-size: 12px;
    font-weight: 800;
    color: #7dd3fc;
  }

  /* Placeholder panel */
  .accdash .panel-placeholder {
    padding: 30px 10px;
    text-align: center;
    font-size: 10px;
    color: #aaa;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  /* Sub-section label */
  .accdash .sub-label {
    font-size: 8px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #2563a8;
    padding: 4px 10px 2px;
    border-top: 1px solid #e0e6ed;
    background: #f0f5fa;
  }

  /* Payment mode tags */
  .accdash .mode-list {
    display: flex;
    gap: 5px;
    padding: 5px 10px;
    flex-wrap: wrap;
    background: #fff;
  }

  .accdash .mode-tag {
    background: #eef3f9;
    border: 1px solid #c9d8e8;
    border-radius: 3px;
    padding: 2px 8px;
    font-size: 9px;
    font-weight: 700;
    color: #1a3a5c;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }

  @media (max-width: 800px) {
    .accdash .dashboard-grid { grid-template-columns: 1fr; }
  }
</style>

<?php
$counters = isset($counter_summary["counters"])
    ? $counter_summary["counters"]
    : [];
$modes = isset($counter_summary["modes"]) ? $counter_summary["modes"] : [];
$is_posted = isset($is_posted) ? $is_posted : false;

/* column totals per mode */
$mode_totals = [];
$grand_total = 0;
foreach ($modes as $mid => $mname) {
    $mode_totals[$mid] = 0;
}
foreach ($counters as $cdata) {
    foreach ($cdata["modes"] as $mid => $amt) {
        $mode_totals[$mid] = ($mode_totals[$mid] ?? 0) + $amt;
        $grand_total += $amt;
    }
}
?>

<div class="side_right">
<div class="accdash">

  <!-- Page header -->
  <div class="page-header">
    <h1>&#9783;&nbsp; Accounts Dashboard</h1>
    <form method="post" action="<?php echo base_url(); ?>index.php/admin/account/dashboard" style="margin:0;">
      <div class="date-bar">
        <label>Choose Date</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars(
            $selected_date,
        ); ?>" max="<?php echo date("Y-m-d"); ?>">
        <button type="submit" class="btn-go">Go</button>
      </div>
    </form>
  </div>

  <!-- Two-panel grid -->
  <div class="dashboard-grid">

    <!-- PANEL 1 — Counter Summary -->
    <div class="panel">
      <div class="panel-title">Counter Summary &mdash; <?php echo date(
          "d M Y",
          strtotime($selected_date),
      ); ?></div>

      <table class="summary-table">
        <thead>
          <tr>
            <th>Counter</th>
            <?php foreach ($modes as $mid => $mname): ?>
              <th class="num"><?php echo htmlspecialchars($mname); ?></th>
            <?php endforeach; ?>
            <th class="num">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($counters)): ?>
            <?php foreach ($counters as $cdata): ?>
              <tr>
                <td class="counter-name"><?php echo htmlspecialchars(
                    $cdata["counter_name"],
                ); ?></td>
                <?php foreach ($modes as $mid => $mname): ?>
                  <td class="mode-val">
                    <?php echo number_format($cdata["modes"][$mid] ?? 0, 2); ?>
                  </td>
                <?php endforeach; ?>
                <td class="row-total"><?php echo number_format(
                    $cdata["row_total"],
                    2,
                ); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="<?php echo count($modes) +
                  2; ?>" style="text-align:center; padding:10px; font-size:9px; color:#aaa;">
                No data for this date
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
        <tfoot>
          <tr>
            <td class="lbl"><strong>Total</strong></td>
            <?php foreach ($modes as $mid => $mname): ?>
              <td><?php echo number_format($mode_totals[$mid] ?? 0, 2); ?></td>
            <?php endforeach; ?>
            <td><?php echo number_format($grand_total, 2); ?></td>
          </tr>
        </tfoot>
      </table>

      <div class="panel-actions">
        <?php if ($is_posted): ?>
          <button type="button" class="btn-action" style="background:#6c757d;cursor:default;" disabled>
            <svg viewBox="0 0 16 16"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM7 11.5L3 7.5l1.4-1.4L7 8.7l4.6-4.6L13 5.5z"/></svg>
            Already Posted
          </button>
        <?php else: ?>
          <button type="button" class="btn-action green" id="btnVerifyPost"
                  data-date="<?php echo htmlspecialchars($selected_date); ?>"
                  data-url="<?php echo base_url(); ?>index.php/admin/account/postCounterSummary"
                  <?php echo empty($counters) ? "disabled" : ""; ?>>
            <svg viewBox="0 0 16 16"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM8 11L3 6h3V4h4v2h3L8 11z"/></svg>
            Verify &amp; Post to Account
          </button>
        <?php endif; ?>
        <span id="postMsg" style="font-size:9px;font-weight:700;padding:3px 6px;border-radius:3px;display:none;"></span>
      </div>

      <!-- Stats strip: one tile per mode + grand total -->
      <div class="stats-strip">
        <?php foreach ($modes as $mid => $mname): ?>
          <div class="st">
            <span class="st-label"><?php echo htmlspecialchars(
                $mname,
            ); ?></span>
            <span class="st-val"><?php echo number_format(
                $mode_totals[$mid] ?? 0,
                2,
            ); ?></span>
          </div>
        <?php endforeach; ?>
        <div class="st">
          <span class="st-label">Grand Total</span>
          <span class="st-val"><?php echo number_format(
              $grand_total,
              2,
          ); ?></span>
        </div>
      </div>
    </div>

    <!-- PANEL 2 — Guest House -->
    <div class="panel">
      <div class="panel-title">Guest House &mdash; <?php echo date("d M Y", strtotime($selected_date)); ?></div>

      <?php
        $gh_is_posted = isset($gh_is_posted) ? $gh_is_posted : false;
      ?>
      <?php if (!empty($gh_summary)): $g = $gh_summary;
        /* Collect payment mode keys dynamically from room_rent (cash, upi, card, etc.) */
        $gh_modes = [];
        $mode_labels = ['cash' => 'Cash', 'upi' => 'UPI', 'card' => 'Card'];
        foreach ($mode_labels as $mk => $ml) {
            if (isset($g['room_rent'][$mk])) $gh_modes[$mk] = $ml;
        }
      ?>

        <!-- Collection table -->
        <div class="sub-label">Collection</div>
        <table class="summary-table">
          <thead>
            <tr>
              <th>Description</th>
              <?php foreach ($gh_modes as $mk => $ml): ?>
              <th class="num"><?php echo $ml; ?></th>
              <?php endforeach; ?>
              <th class="num">Total</th>
            </tr>
          </thead>
          <tbody>
            <!-- Room Rent -->
            <tr>
              <td class="counter-name">Room Rent</td>
              <?php foreach ($gh_modes as $mk => $ml): ?>
              <td class="cash-val"><?php echo number_format($g['room_rent'][$mk] ?? 0, 2); ?></td>
              <?php endforeach; ?>
              <td class="bank-val"><?php echo number_format($g['room_rent']['total'] ?? 0, 2); ?></td>
            </tr>
            <!-- Extra Charge — show only if total > 0 -->
            <?php if (!empty($g['extra_charge']['total'])): ?>
            <tr>
              <td class="counter-name">Extra Charge</td>
              <?php foreach ($gh_modes as $mk => $ml): ?>
              <td class="cash-val"><?php echo number_format($g['extra_charge'][$mk] ?? 0, 2); ?></td>
              <?php endforeach; ?>
              <td class="bank-val"><?php echo number_format($g['extra_charge']['total'], 2); ?></td>
            </tr>
            <?php endif; ?>
            <!-- Tax Charge — show only if total > 0 -->
            <?php if (!empty($g['tax_charge']['total'])): ?>
            <tr>
              <td class="counter-name">
                Tax
                <?php if (!empty($g['tax_charge']['cgst']) || !empty($g['tax_charge']['sgst'])): ?>
                <span style="font-weight:400;font-size:8.5px;opacity:.75;">
                  (CGST &#8377;<?php echo number_format($g['tax_charge']['cgst'] ?? 0, 2); ?>
                  + SGST &#8377;<?php echo number_format($g['tax_charge']['sgst'] ?? 0, 2); ?>)
                </span>
                <?php endif; ?>
              </td>
              <?php foreach ($gh_modes as $mk => $ml): ?>
              <td class="cash-val"><?php echo number_format($g['tax_charge'][$mk] ?? 0, 2); ?></td>
              <?php endforeach; ?>
              <td class="bank-val"><?php echo number_format($g['tax_charge']['total'], 2); ?></td>
            </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <td class="lbl"><strong>Total Collection</strong></td>
              <?php foreach ($gh_modes as $mk => $ml): ?>
              <td class="cash-val"><?php echo number_format($g['total_collection'][$mk] ?? 0, 2); ?></td>
              <?php endforeach; ?>
              <td class="bank-val"><?php echo number_format($g['total_collection']['total'] ?? 0, 2); ?></td>
            </tr>
          </tfoot>
        </table>

        <!-- Verify & Post -->
        <div class="panel-actions">
          <?php if ($gh_is_posted): ?>
            <button type="button" class="btn-action" style="background:#6c757d;cursor:default;" disabled>
              <svg viewBox="0 0 16 16"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM7 11.5L3 7.5l1.4-1.4L7 8.7l4.6-4.6L13 5.5z"/></svg>
              Already Posted
            </button>
          <?php else: ?>
            <button type="button" class="btn-action green" id="btnGhPost"
                    data-date="<?php echo htmlspecialchars($selected_date); ?>"
                    data-url="<?php echo base_url(); ?>index.php/admin/account/postGuestHouseSummary">
              <svg viewBox="0 0 16 16"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM8 11L3 6h3V4h4v2h3L8 11z"/></svg>
              Verify &amp; Post to Account
            </button>
          <?php endif; ?>
          <span id="ghPostMsg" style="font-size:9px;font-weight:700;padding:3px 6px;border-radius:3px;display:none;"></span>
        </div>

        <!-- Payment Modes with amounts -->
        <div class="sub-label">Payment Modes</div>
        <div class="mode-list">
          <?php foreach ($gh_modes as $mk => $ml):
            $val = $g['total_collection'][$mk] ?? 0;
          ?>
          <span class="mode-tag"><?php echo $ml; ?> &mdash; &#8377;<?php echo number_format($val, 2); ?></span>
          <?php endforeach; ?>
        </div>

        <!-- Stats strip -->
        <div class="stats-strip">
          <?php foreach ($gh_modes as $mk => $ml): ?>
          <div class="st">
            <span class="st-label"><?php echo $ml; ?></span>
            <span class="st-val"><?php echo number_format($g['total_collection'][$mk] ?? 0, 2); ?></span>
          </div>
          <?php endforeach; ?>
          <div class="st">
            <span class="st-label">Total</span>
            <span class="st-val"><?php echo number_format($g['total_collection']['total'] ?? 0, 2); ?></span>
          </div>
        </div>

      <?php else: ?>
        <div class="panel-placeholder">No data for this date</div>
      <?php endif; ?>
    </div>

  </div><!-- /.dashboard-grid -->

</div><!-- /.accdash -->
</div><!-- /.side_right -->

<script>
(function () {
  var btn = document.getElementById('btnVerifyPost');
  if (!btn) return;

  btn.addEventListener('click', function () {
    var date = btn.getAttribute('data-date');
    var url  = btn.getAttribute('data-url');
    var msg  = document.getElementById('postMsg');

    if (!confirm('Post counter summary for ' + date + ' to accounts?\nThis cannot be undone.')) return;

    btn.disabled = true;
    btn.textContent = 'Posting...';
    msg.style.display = 'none';

    var fd = new FormData();
    fd.append('date', date);

    fetch(url, { method: 'POST', body: fd })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (res.success) {
          btn.style.background = '#6c757d';
          btn.innerHTML = '<svg viewBox="0 0 16 16" style="width:10px;height:10px;fill:#fff"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM7 11.5L3 7.5l1.4-1.4L7 8.7l4.6-4.6L13 5.5z"/></svg> Already Posted';
          msg.style.cssText = 'display:inline-block;background:#d4edda;color:#155724;font-size:9px;font-weight:700;padding:3px 8px;border-radius:3px;';
          msg.textContent = res.message;
        } else {
          btn.disabled = false;
          btn.innerHTML = '<svg viewBox="0 0 16 16" style="width:10px;height:10px;fill:#fff"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM8 11L3 6h3V4h4v2h3L8 11z"/></svg> Verify &amp; Post to Account';
          msg.style.cssText = 'display:inline-block;background:#f8d7da;color:#721c24;font-size:9px;font-weight:700;padding:3px 8px;border-radius:3px;';
          msg.textContent = res.message;
        }
      })
      .catch(function () {
        btn.disabled = false;
        btn.textContent = 'Verify & Post to Account';
        msg.style.cssText = 'display:inline-block;background:#f8d7da;color:#721c24;font-size:9px;font-weight:700;padding:3px 8px;border-radius:3px;';
        msg.textContent = 'Network error. Please try again.';
      });
  });
}());

(function () {
  var btn = document.getElementById('btnGhPost');
  if (!btn) return;

  btn.addEventListener('click', function () {
    var date = btn.getAttribute('data-date');
    var url  = btn.getAttribute('data-url');
    var msg  = document.getElementById('ghPostMsg');

    if (!confirm('Post Guest House summary for ' + date + ' to accounts?\nThis cannot be undone.')) return;

    btn.disabled = true;
    btn.textContent = 'Posting...';
    msg.style.display = 'none';

    var fd = new FormData();
    fd.append('date', date);

    fetch(url, { method: 'POST', body: fd })
      .then(function (r) { return r.json(); })
      .then(function (res) {
        if (res.success) {
          btn.style.background = '#6c757d';
          btn.innerHTML = '<svg viewBox="0 0 16 16" style="width:10px;height:10px;fill:#fff"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM7 11.5L3 7.5l1.4-1.4L7 8.7l4.6-4.6L13 5.5z"/></svg> Already Posted';
          msg.style.cssText = 'display:inline-block;background:#d4edda;color:#155724;font-size:9px;font-weight:700;padding:3px 8px;border-radius:3px;';
          msg.textContent = res.message;
        } else {
          btn.disabled = false;
          btn.innerHTML = '<svg viewBox="0 0 16 16" style="width:10px;height:10px;fill:#fff"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM8 11L3 6h3V4h4v2h3L8 11z"/></svg> Verify &amp; Post to Account';
          msg.style.cssText = 'display:inline-block;background:#f8d7da;color:#721c24;font-size:9px;font-weight:700;padding:3px 8px;border-radius:3px;';
          msg.textContent = res.message;
        }
      })
      .catch(function () {
        btn.disabled = false;
        btn.textContent = 'Verify & Post to Account';
        msg.style.cssText = 'display:inline-block;background:#f8d7da;color:#721c24;font-size:9px;font-weight:700;padding:3px 8px;border-radius:3px;';
        msg.textContent = 'Network error. Please try again.';
      });
  });
}());
</script>
