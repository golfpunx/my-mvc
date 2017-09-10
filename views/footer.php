</div><!-- context -->
<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/min/default.min.js"></script>
  <?php 
  		if(isset($this->js)){
  			foreach ($this->js as $js) {
  			 	echo '<script type="text/javascript" src="'.URL.$js.'"></script>';
  			}
  		}
   ?>
</body>
</html>