<div id="printArea">
	<style type="text/css">
		.voucher_table {
			width: 100%;
			max-width: 100%;
			margin-bottom: 5px;
			background-color: transparent;
			border-spacing: 0;
			border-collapse: collapse;
		}
		.voucher_table>tbody>tr>td, .voucher_table>tbody>tr>th, .voucher_table>thead>tr>td, .voucher_table>thead>tr>th {
			padding: 5px;
			line-height: 1.42857143;
			vertical-align: middle;
			font-size: 13px;
			text-align: left;
			/*border-bottom: 1px solid #e9e9e9;*/
		}
		.top-align.voucher_table>tbody>tr>td{
			vertical-align: top;
		}
		#printArea hr {
			margin-top: 10px;
			margin-bottom: 10px;
			border: 0;
			border-top: 1px solid #eee;
		}
		.clearfix:after, .clearfix:before {
			display: table;
			content: " ";
		}
		.clearfix:after {
			clear: both;
		}
		@page printArea {
			size: auto;
			margin: .5in .5in .5in .5in;
			mso-header-margin: .5in;
			mso-footer-margin: .5in;
			mso-paper-source: 0;
		}
		div#printArea {
			page: printArea;
		}
		.voucher_table ul li {
			margin-left: 20px;
			margin-bottom: 5px;
		}
		@media print {
			.voucher_table ul li {
			margin-left: -20px;
			}
			.voucher_table #jump_map{
			display: none;
			}
		}
	</style>
	<div class="clearfix">
		<table class="voucher_table" style="width: 100%">
			<tbody>
				<tr>
					<td><img src="<?php echo getLogoImage('public/img/logo/logo.png') ?>" alt="" width="150px"></td>
					<td style="text-align: right;"><strong>Itinerary number: <?php echo $result->uniqueRefNo; ?></strong></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="clearfix">
		<table width="100%" style="width: 100%">
			<tr>
				<td width="70%" style="padding: 15px 0;background: #4788c2;color: #fff;text-align: center;">
					<h3 style="margin: 0;font-size: 22px;margin-bottom: 5px">Thank you for booking with Vacaymenow <?php echo $result->first_name ?> ! </h3>
				</td>
			</tr>
		</table>
	</div>
	<div>
		<table width="100%">
			<tr>
				<td width="70%" style="padding: 8px ;background: #fff;text-align: left;">
					<?php  if ($result->booking_status == 'Success' || $result->booking_status == 'Confirmed' && $result->Cancellation_Status == '')
					echo '<p>Your reservation is now confirmed</p>';
					else if ($result->booking_status == 'Cancelled' ||  $result->Cancellation_Status == 'Cancelled')
					echo '<p style="color:red">Your reservation is cancelled</p>';
					else
					echo '<p style="color:red">Your reservation is failed</p>';?>
				</td>
			</tr>
		</table>
	</div>
	<!-- hr -->
	<div>
		<table width="100%">
			<tr>
				<td style="padding: 8px;background: #fff;text-align: left;font-size: 20px;color:#1a00aa">
					<b><?php echo $result->package_title; ?></b>
				</td>
			</tr>
			<tr>
				<td style="padding: 8px;"><?php echo $result->address ?></td>
			</tr>
			<!-- <tr>
				<td style="padding: 8px ;">Phone: <?php //echo $result->phone; ?></td>
			</tr> -->
		</table>
	</div>
	<div>
		<table width="100%" class="voucher_table">
			<!-- <tr style="border-bottom: 1px solid #eee">
				<td width="17%" style="padding: 8px;">Reservation</td>
				<td style="padding: 8px;text-align:center"><?php //echo $result->guests; ?> Guest(s), <?php //echo $result->bedrooms; ?> Bedroom(s), <?php //echo $result->bathrooms; ?> Bathroom(s)</td>
			</tr> -->
			<tr style="border-bottom: 1px solid #eee">
				<td width="17%" style="padding: 8px;">Departure</td>
				<td style="padding: 8px;text-align:center"><?php echo date('M d, Y',strtotime($result->depart_date)); ?></td>
			</tr>
			<!-- <tr style="border-bottom: 1px solid #eee">
				<td width="17%" style="padding: 8px;">Check-out</td>
				<td style="padding: 8px;text-align:center"><?php //echo date('M d, Y',strtotime($result->check_out)); ?></td>
			</tr> -->
		</table>
	</div>
	<div>
		<table width="50%" style="background: #428bca12">
			<tr>
				<td style="padding: 8px;background: #fff;text-align: left;font-size: 20px;color:#1a00aa">
					<b>Tour</b>
				</td>
			</tr>
			<tr>
				<td style="padding: 8px;color:#1a00aa;"><b><?php echo $result->package_title; ?></b></td>
			</tr>
			<tr>
				<td style="padding:8px;padding-bottom:5px;font-size:20px;color:#1a00aa;"><b>TOTAL PRICE : US$ <?php echo number_format($result->total_cost,2);?></b></td>
				<tr>
					<td style="padding-left:8px;">Collected by Vacaymenow</td>
				</tr>
			</tr>
			
			<!-- <tr>
				<td style="padding:8px"><?php //echo $result->government_tax;?>% Government tax is included.</td>
			</tr>
			<tr>
				<td style="padding:8px;">US$ <?php //echo number_format(($result->resort_fee/$result->nights), 2) ?> Resort fee per night is included.</td>
			</tr>
			<tr>
				<td style="padding:8px;"><?php //echo $result->service_tax; ?>% Resort service fee included</td>
			</tr> -->
		</table>
	</div>
	<div>
		<table width="100%" class="voucher_table">
			<th style="padding:8px;font-size:20px;color:#1a00aa;">Details</th>
			<tr style="border-bottom: 1px solid #eee">
				<td width="17%" style="padding:8px;">Guest Name</td>
				<td style="padding: 8px;text-align:center"><?php echo $result->first_name.' '.$result->last_name; ?></td>
			</tr>
			<!-- <tr style="border-bottom: 1px solid #eee">
				<td width="17%" style="padding:8px;">Number of guest</td>
				<td style="padding: 8px;text-align:center"><?php //echo $result->guests ?></td>
			</tr> -->
		</table>
	</div><br>
	<?php if($result->cancellation_policy != '') { ?>
	<div>
		<table width="100%" >
			<tr><td style="font-size:23px;padding:8px;"><b>Cancellation Policy</b></td></tr>
			<tr>
				<td width="17%" style="padding:8px;"><?php echo $result->cancellation_policy; ?> </td>
			</tr>
		</table>
	</div>
	<?php } ?>
	<!-- <?php //if($result->hp_additional_info != '') { ?>
	<div>
		<table width="100%">
			<tr><td style="font-size:23px;padding:8px;"><b>Important Information</b></td></tr>
			<tr>
				<td width="17%" style="padding: 8px;"></td>
			</tr>
		</table>
	</div>
	<?php //} ?> -->
	<!-- <div>
		<table width="100%">
			<tr>
				<td width="17%" style="padding: 8px;"><a onclick="" href="#" class="label label-info" style="background-color:#5bc0de;padding: .2em .6em .3em;text-decoration: none;color: #fff;font-size: 17px;">View your booking</a></td>
			</tr>
		</table>
	</div> -->
	<div>
		<table class="clearfix" width="100%">
			<tr>
				<td width="17%" style="padding:8px;color:#1a00aa;font-size: 20px;"><b>Need help with your reservation?</b></td>
			</tr>
		</table>
	</div>
	<div>
		<table class="clearfix" width="100%">
			<tr>
				<td width="17%" style="padding:8px;">For special requests or questions about the tour, please call the tour operator directly at <br/><b style="color:#e62d0f">Tel: <?php echo $result->operator_no ?></b></td>
			</tr>
		</table>
	</div>
	<div>
		<table class="clearfix" width="100%">
			<tr>
				<td width="17%" style="padding:8px;border-bottom: 1px solid #eee">Or you can contact Vacaymenow <a href="" style="color:#e62d0f"><b>Customer Support</b></a> or call 1-302-212-4246</td>
			</tr>
		</table>
	</div>
	<!-- <div>
		<table class="clearfix" width="100%">
			<tr>
				<td width="17%" style="padding:8px;">You are viewing this transactional email based on a recent booking or account-related update on <a href="<?php echo site_url() ?>"><b>Vacaymenow.com</b></a> </td>
			</tr>
		</table>
	</div>
	<div>
		<table class="clearfix" width="100%">
			<tr>
				<td width="17%" style="padding:8px;">Please do not reply to this message. This email was sent from a notification-only email address that cannot accept incoming emails.</td>
			</tr>
		</table>
	</div> -->
	<div>
		<table class="clearfix" width="100%">
			<tr>
				<td width="17%" style="padding:8px;text-align: center;color:#a29797">Copyright © <?php echo Date('Y') ?> Barnes Travel International LLC. All rights reserved.</td>
			</tr>
		</table>
	</div>
	<div>
		<table class="clearfix" width="100%">
			<tr>
			</tr>
		</table>
	</div>
</div>


