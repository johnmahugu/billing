<?=$this->load->view('cp/header');?>
<h1>Recurring Details</h1>
<div id="recurring_info">
<p><b>Recurring ID</b><br />
<?=$id;?></p>
<p><b>Amount</b><br />
<?=$amount;?> every <?=$interval;?> days</p>
<p><b>Date Created</b><br />
<?=$start_date;?></p>
<p><b>End Date</b><br />
<?=$start_date;?></p>
<? if ($status == 'active') { ?>
<p><b>Next Charge Date</b><br />
<?=$next_charge_date;?> (<a href="<?=site_url('transactions/cancel_recurring/' . $id);?>">cancel recurring</a>)</p>
<? } ?>
<p><b>Status</b><br />
<?=$status;?>&nbsp;
<? if ($status == 'active') { ?><img src="<?=site_url('images/ok.png');?>" alt="active" /><? } ?>
<? if ($status == 'inactive') { ?><img src="<?=site_url('images/failed.png');?>" alt="inactive" /><? } ?></p>
<p><b>Gateway</b><br />
<a href="<?=site_url('settings/edit_gateway/' . $gateway['gateway_id']);?>"><?=$gateway['name'];?></a></p>
</div>
<? if (isset($customer)) { ?>
<div id="charge_customer">
<? if (!empty($customer['first_name'])) { ?>
	<p><b>Name</b><br />
	<?=$customer['first_name'];?> <?=$customer['last_name'];?></p>
<? } ?>
<? if (!empty($customer['address_1'])) { ?>
	<p><b>Address</b><br />
	<?=$customer['address_1'];?>
	<? if (!empty($customer['address_2'])) { ?>
	<br /><?=$customer['address_2'];?><? } ?>
	<br /><?=$customer['city'];?>, <?=$customer['state'];?>
	<br /><?=$customer['country'];?>
	<br /><?=$customer['postal_code'];?></p>
	<? if (!empty($customer['phone'])) { ?>
	<p><b>Phone</b><br />
	<?=$customer['phone'];?></p>
	<? } ?>
	<? if (!empty($customer['email'])) { ?>
	<p><b>Email</b><br />
	<a href="mailto:<?=$customer['email'];?>"><?=$customer['email'];?></a></p>
	<? } ?>
<? } ?>
</div>

<? } ?>
<?=$this->load->view('cp/footer');?>