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
  }

  .accdash .summary-table td.counter-name {
    font-weight: 600;
    color: #1a3a5c;
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
  }

  .accdash .summary-table tfoot td.cash-val,
  .accdash .summary-table tfoot td.bank-val {
    text-align: right;
    color: #7d6608;
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

  .accdash .btn-action:hover { background: #2563a8; }

  .accdash .btn-action.green { background: #1a7a4a; }
  .accdash .btn-action.green:hover { background: #15643c; }

  .accdash .btn-action svg {
    width: 10px; height: 10px;
    fill: #fff;
  }

  /* Stats strip */
  .accdash .stats-strip {
    display: flex;
    justify-content: space-between;
    background: #1a3a5c;
    color: #fff;
    border-radius: 0 0 5px 5px;
    padding: 5px 14px;
  }

  .accdash .stats-strip .st { display: flex; flex-direction: column; align-items: center; }
  .accdash .stats-strip .st-label {
    font-size: 7.5px;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    opacity: 0.65;
    margin-bottom: 1px;
  }
  .accdash .stats-strip .st-val {
    font-size: 12px;
    font-weight: 800;
    color: #7dd3fc;
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

  /* Placeholder panel */
  .accdash .panel-placeholder {
    padding: 30px 10px;
    text-align: center;
    font-size: 10px;
    color: #aaa;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  @media (max-width: 640px) {
    .accdash .dashboard-grid { grid-template-columns: 1fr; }
  }
</style>

<div class="side_right">
<div class="accdash">

  <!-- Page header -->
  <div class="page-header">
    <h1>&#9783;&nbsp; Accounts Dashboard</h1>
    <form method="post" action="<?php echo base_url(); ?>index.php/accounts/dashboard" style="margin:0;">
      <div class="date-bar">
        <label>Choose Date</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($selected_date); ?>" max="<?php echo date('Y-m-d'); ?>">
        <button type="submit" class="btn-go">Go</button>
      </div>
    </form>
  </div>

  <!-- Two-panel grid -->
  <div class="dashboard-grid">

    <!-- PANEL 1 — Counter Summary -->
    <div class="panel">
      <div class="panel-title">Counter Summary &mdash; <?php echo date('d M Y', strtotime($selected_date)); ?></div>

      <table class="summary-table">
        <thead>
          <tr>
            <th>Counter</th>
            <th class="num">Cash</th>
            <th class="num">Bank</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($counter_summary)): ?>
            <?php foreach ($counter_summary as $row): ?>
              <tr>
                <td class="counter-name"><?php echo htmlspecialchars($row['counter_name']); ?></td>
                <td class="cash-val"><?php echo number_format((float)$row['cash_total'], 2); ?></td>
                <td class="bank-val"><?php echo number_format((float)$row['bank_total'], 2); ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="3" style="text-align:center; padding:10px; font-size:9px; color:#aaa;">No data for this date</td>
            </tr>
          <?php endif; ?>
        </tbody>
        <?php
          $total_cash  = array_sum(array_column($counter_summary, 'cash_total'));
          $total_bank  = array_sum(array_column($counter_summary, 'bank_total'));
          $grand_total = $total_cash + $total_bank;
        ?>
        <tfoot>
          <tr>
            <td><strong>Total</strong></td>
            <td class="cash-val"><?php echo number_format($total_cash, 2); ?></td>
            <td class="bank-val"><?php echo number_format($total_bank, 2); ?></td>
          </tr>
        </tfoot>
      </table>

      <div class="panel-actions">
        <button type="button" class="btn-action green" disabled>
          <svg viewBox="0 0 16 16"><path d="M13.5 2h-11A1.5 1.5 0 001 3.5v9A1.5 1.5 0 002.5 14h11a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0013.5 2zM8 11L3 6h3V4h4v2h3L8 11z"/></svg>
          Verify &amp; Post to Account
        </button>
      </div>

      <div class="stats-strip">
        <div class="st">
          <span class="st-label">Cash Total</span>
          <span class="st-val"><?php echo number_format($total_cash, 2); ?></span>
        </div>
        <div class="st">
          <span class="st-label">Bank Total</span>
          <span class="st-val"><?php echo number_format($total_bank, 2); ?></span>
        </div>
        <div class="st">
          <span class="st-label">Grand Total</span>
          <span class="st-val"><?php echo number_format($grand_total, 2); ?></span>
        </div>
      </div>
    </div>

    <!-- PANEL 2 — Guest House (placeholder) -->
    <div class="panel">
      <div class="panel-title">Guest House</div>
      <div class="panel-placeholder">
        Coming soon
      </div>
    </div>

  </div><!-- /.dashboard-grid -->

</div><!-- /.accdash -->
</div><!-- /.side_right -->
