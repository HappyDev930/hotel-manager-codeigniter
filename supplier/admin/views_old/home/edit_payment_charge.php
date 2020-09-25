
							<h3> Edit Payment Gateway Charge</h3>
						
                    <?php if(!empty($payment_info)) {?>
						<form class="form-horizontal" action="<?php echo site_url(); ?>/home/edit_payment_charge/<?php echo $id; ?>" method="post">
							<fieldset>
                                                       
                             <?php if(validation_errors() != '') {?> 
                              <div class="alert alert-error">
                                <button class="close" data-dismiss="alert" type="button">×</button>
                                <?php echo validation_errors(); ?>                               
                              </div>
                          <?php } ?> 
                          
                               <?php if(!empty($errors))
								{
								?>
                                <div class="alert alert-error">
								<button class="close" data-dismiss="alert" type="button">×</button>
									<strong>Error!</strong>
									 <?php echo $errors; ?>
								</div>
								 <?php } ?>
                                                         
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="disabledInput">Service Type</label>
								<div class="col-sm-6">
                                 <div class="input-append">
								  <input class="form-control" id="disabledInput" type="text" placeholder="<?php if($payment_info->service_type == 1) echo 'Hotel'; else if($payment_info->service_type == 2) echo 'Flight'; else if($payment_info->service_type == 3) echo 'Car'; ?>" disabled="">
                                 
								</div>
                                </div>
							  </div>
                                                          
                              <div class="form-group">
								<label class="col-sm-3 control-label" for="focusedInput">Payment Charge (%)</label>

								<div class="col-sm-6">
								  <input class="form-control" id="focusedInput" type="number" name="charge" value="<?php echo $payment_info->charge;?>" maxlength="2" required />                                   
								</div>
							  </div>
                                                           
							 <div class="form-actions">
								<button type="submit" class="btn btn-primary">Update</button>
								<a href="<?php echo site_url(); ?>/home/payment_manager" title="Click here to go back" data-rel="tooltip" class="btn btn-warning">Cancel</a>
							  </div>
                               
							</fieldset>
						  </form>
               <?php } else { ?>
               		<div class="alert alert-error">
                        <button class="close" data-dismiss="alert" type="button">×</button>
                            <strong>Error!</strong>
                             No Data Found. Please try after some time....
                     </div>
               <?php } ?>
					
					</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>	
