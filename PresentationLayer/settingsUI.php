				<!-- The content of tab 4 (settings)-->
				<div class="tab-pane fade" id="settingstab">
					<p id="settings-header-text">Please tick the slot that you want it to be free time!</p>
					<form name="settingsform" action="BusinessAccessLayer/preferenceManager.php" method="POST">
						<table class="table">
							<tr>
							<?php 	
								$timepreference = array(array());			
								for ($w = 0; $w < sizeof($days); $w++) {
									for ($x = 0; $x < sizeof($times)-1; $x++) {
										$timepreference[$w][$x] = true;					//Initially all timeslots are selected
									}
								}
								for ($y = 0; $y< sizeof($days); $y++) { ?>
								<td>
									<p id="settings-day"><?php echo $days[$y];?></p>
									<?php for ($z = 0; $z < sizeof($times)-1; $z++) { ?>
										<div class="item">
										<label><input type="checkbox" name="<?php echo $days[$y]."checklist[]" ?>" value="<?php echo strtoupper(substr($days[$y], 0, 3)).$times[$z]; ?>"><?php echo $times[$z]; ?> - <?php echo $times[$z+1]; ?></input></label>
										</div>
									<?php	} ?>
										<div>
											<button type="button" class="btn btn-default" onClick="<?php echo "selectAll(document.settingsform['".$days[$y]."checklist[]'])"?>">Select All</button>

										</div>
										<div>
											<button type="button" class="btn btn-default" onClick="<?php echo "deselectAll(document.settingsform['".$days[$y]."checklist[]'])"?>">Deselect All</button>
										</div>
								 </td> 
							<?php } ?>
							
							</tr>

						</table>
						<button type="submit" name="editTimePreferenceSubmitBtn" class="btn btn-default" >Save</button>
					</form>
				</div>	