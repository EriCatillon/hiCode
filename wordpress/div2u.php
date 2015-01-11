<?php
$posts = range(0, 10);
$c = function ($count) {
    $classNames = ['2u', '3u', '4u', '3u', '4u', '5u'];
    return ['rest' => $count % 4, 'lines' => round(($count - ($count % 4)) / 4), 'classname' => $classNames[( $count % 4)]];
};
var_dump($c(count($posts)));
?>
<html>
    <head>
        <title>title</title>
        <style type="text/css">
            .u2u{
                background: #77aaff;
            }
            .u2u2u{
                background: #ff77aa;
            }
            .u2u3u{
                background: #aaff77;
            }
            .u2u4u{
                background: #ead61c;
            }
            .u2u5u{
                background: #ead555;
            }
        </style>
    </head>
    <body>
    	<!-- Une classe unique pour le premier div de la première row, puis si on a moins de 4 elements par ligne, 
    	la première classe du premier div de la ligne change également -->
        <div class="containter">
            <?php
            $l = 0;
            $count = $c(count($posts));
            $dec = $count['rest'] ? 1 : 0;
            while ($l < $count['lines'] + $dec):
                $s = ($l == $count['lines'] + abs($dec - 1))? [$count['rest'], $count['classname']] : [4, '2u'];
                ?>
                <div class="row">
                    <?php for ($i = 0; $i < $s[0]; $i++) : ?>
                    <div class="u2u<?php echo ($i==0)? $s[1]:''; ?>" >div<?php echo $i; ?></div>
                    <?php endfor;
                    $l++; ?>
                </div><?php endwhile; ?>
        </div>
    </body>
</html>