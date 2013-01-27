<div id="main-menu">
    <ul>
        <?php
            $cont = 1;
            foreach ($mainmenu as $name => $link) {
                echo '<li>';
                    echo '<a id="op-' . $cont . '" href="' . site_url() . $link . '">';
                        echo $name;
                    echo '</a>';
                echo '</li>';
                $cont++;
            }
        ?>
    </ul>
</div>
<div id="sub-menu">
    <ul>
        <?php
            $cont = 1;
            foreach ($submenu as $name => $link) {
                echo '<li>';
                    echo '<a id="sb-' . $cont . '" href="' . site_url() . $link . '">';
                        echo $name;
                    echo '</a>';
                echo '</li>';
                $cont++;
            }
        ?>
    </ul>
</div>