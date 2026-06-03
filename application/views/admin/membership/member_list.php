<div class="side_right">
<div class="m-4 p-4 card">
    <h1>Member List</h1>
    <?php if ($members): ?>
     <div class="row">  
		   <div class="col-lg-12">
          <table class="border table table-responsive-sm">
            <thead class="bg-light">
                <tr>
                    <th class="border">Name</th>
                    <th class="border">Membership ID</th>
                    <th class="border">Mobile Number</th>
                	<th class="border">Referral</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td class="border"><?php echo $member->name; ?></td>
                        <td class="border"><?php echo $member->membership_id; ?></td>
                        <td class="border"><?php echo $member->mobile_number; ?></td>
                    	<td class="border"><?php echo $member->referral_code; ?> ( <?php echo $member->referred_by; ?> )</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       </div>
	</div>
    <?php else: ?>
        <p>No members found.</p>
    <?php endif; ?>
</div>
</div>
