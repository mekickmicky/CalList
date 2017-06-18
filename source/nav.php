
<nav>
		<div class="wrap_main">
			<ul>
				<a href="profile.php">
					<li 
					<?php 
					if ($acMenu == 1) {
						echo "class='acNav'";
					}
					?>
					>
						<div>
							<img src="../images/icon-profile.png">
						</div>
						<p>โปรไฟล์</p>
					</li>
				</a>
				<a href="cal_sub.php">
					<li 
					<?php 
					if ($acMenu == 2) {
						echo "class='acNav'";
					}
					?>
					>
						<div>
							<img src="../images/icon-cal.png">
						</div>
						<p>คำนวณ</p>
					</li>
				</a>
				<a href="list_sub.php">
					<li 
					<?php 
					if ($acMenu == 3) {
						echo "class='acNav'";
					}
					?>
					>
						<div>
							<img src="../images/icon-list-sub.png">
						</div>
						<p>ตารางวิชาเรียน</p>
					</li>
				</a>
				<a href="logout.php">
					<li class="btn_logout">
						<div>
							<img src="../images/icon-logout.png">
						</div>
						<p>ออกจากระบบ</p>
					</li>
				</a>
			</ul>
		</div>
	</nav>
	<script src="../js/pace.js"></script>