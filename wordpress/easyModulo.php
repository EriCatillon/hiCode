<!-- afficher deux <p> dans un row -->
<div class="containter">
<?php $i=0; $count=10; while($i<$count): ?>
<?php echo ($i%2 == 0 )?  '<div class="row">': '' ; ?> 
<?php echo $i; echo '<p>Je suis un paragraphe</p>'; ?>
<?php echo (($i+1) %2 ==0 || $i==($count-1)) ? '</div>' : '' ?>
<?php $i++; endwhile; ?>
</div>
