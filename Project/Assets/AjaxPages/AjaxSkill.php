
<option>---select---</option>
          <?php
		  include("../Connection/Connection.php");
		  $selqry="select * from tbl_skill where category_id='".$_GET["did"]."'";
		  $re=$conn->query($selqry);
		  while($row=$re->fetch_assoc())
		  {
			  ?>
              <option value="<?php echo $row["skill_id"]?>"><?php echo $row["skill_name"]?></option>
              <?php
		  }
		  ?>
