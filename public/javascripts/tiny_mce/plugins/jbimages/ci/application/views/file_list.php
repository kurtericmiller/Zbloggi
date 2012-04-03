<?php
foreach ($files as $name => $fileinfo): ?>
	<?php
  if (strpos($name, 't_') === 0): ?>
		<img src="<?php
    echo $img_path
?>/<?php
    echo $name
?>" width="25" height="25" alt="<?php
    echo $name
?>" />
	<?php
  endif; ?>
<?php
endforeach; ?>