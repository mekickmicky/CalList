<?php 
							$sql = "SELECT * FROM regis_sub INNER JOIN subject ON regis_sub.sub_id = subject.sub_id INNER JOIN table_subject ON table_subject.sub_id = subject.sub_id WHERE subject.sub_day = '$sub_day' and user_id = '".@$_SESSION['user_id']."'";
							$check_ts = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
							$contHr = 0;
							$count_check = 1;
							$insbox = 1;
							$countnumHr = 0;

							$getHr = array(0,0,0,0,0,0,0,0);
							$checkbox = array(0,0,0,0,0,0,0,0);
							$checksub = array(0,0,0,0,0,0,0,0);

							$query = mysqli_query($con,$sql);
							while ($result = mysqli_fetch_array($query)) {
								for ($i = 1; $i <= 16 ; $i++) {
									if ($result['ts_'.$i]==1) {
										if ($checkbox[$count_check] == 0) {
											$checkbox[$count_check] = $i;
											$checksub[$count_check] = $countnumHr;
											$sub_id[$i] = $result['sub_id'];
											$sub_id_subject[$i] = $result['sub_id_subject'];
											$sub_room[$i] = $result['sub_room'];
										}
										$getHr[$contHr]++;
										$check_ts[$i] = 1;


									}else if($result['ts_'.$i] == 0 && $checkbox[$count_check]!=0){
										$count_check++;
									 	$contHr++;

									}
								}


								$countnumHr++;
							}

							for ($i=0; $i <= $countnumHr ; $i++) {
								if($getHr[$i] == 1){
									$wid_div[$i+1] = 60;
									$setPoleft[$i+1] = "8";
								}else if($getHr[$i] == 2){
									$wid_div[$i+1] = 100;
									$setPoleft[$i+1] = "40";
								}else if($getHr[$i] == 3){
									$wid_div[$i+1] = 100;
									$setPoleft[$i+1] = "60";
								}else if($getHr[$i] == 4){
									$wid_div[$i+1] = 100;
									$setPoleft[$i+1] = "95";
								}else if($getHr[$i] == 5){
									$wid_div[$i+1] = 100;
									$setPoleft[$i+1] = "118";
								}
							}
							if ($count_check>=2) {
								for ($i=1; $i < $count_check-1 ; $i++) { 
									if ($checkbox[$i]>$checkbox[$i+1]) {
										$check1 = $checkbox[$i];
										$checkbox[$i] = $checkbox[$i+1];
										$checkbox[$i+1] = $check1;

										$setPoleft1 = $setPoleft[$i];
										$setPoleft[$i] = $setPoleft[$i+1];
										$setPoleft[$i+1] = $setPoleft1;
									}
									//echo $checkbox[$i];
								}
							}
							for ($i=1; $i <= 16; $i++) {
								if ($check_ts[$i]==1) {
									?>
									<td class="col_data" style="background: #02937e;
									<?php 
									if ($checkbox[$insbox] == $i) {
										echo "border-left: 1px solid #ccc;";
									}
									?>
									">
									<?php 
										if ($checkbox[$insbox] == $i) {
											echo "<a href='?detail_sub_id=".$sub_id[$i]."#detail_sub'><span style='left: ".$setPoleft[$insbox]."px'><div style='width:".$wid_div[$insbox]."px;'>".$sub_id_subject[$i]."<br>".$sub_room[$i]."</div></span></a>";
											$insbox++;
										}
									?>
									</td>
									<?php
								}else if($sub_day==7 && $i==16){
									?>
									<td class="col_data" style="border-radius: 0 0 10px 0;"></td>
									<?php
								}else{
									?>
									<td class="col_data"></td>
									<?php
								} 
							} 
						?>