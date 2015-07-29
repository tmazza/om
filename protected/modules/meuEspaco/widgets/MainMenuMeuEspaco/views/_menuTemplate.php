<ul class="sidebar-menu">
    <?php
    foreach ($this->menu as $item) {
        if ($item['visible']) {
            echo '<li class="header">' . $item['label'] . '</li>';
            foreach ($item['items'] as $i) {
                if ($i['visible']) {
                    echo '<li>';
                    if (isset($i['icon'])) {
                        echo CHtml::link('<i class="fa fa-' . $i['icon'] . '"></i>' . $i['label'], $i['url']);
                    } else {
                        echo CHtml::link($i['label'], $i['url']);
                    }

                    // 1º nível de submeno. TODO: se existir mais niveis, fazer recursivo!
                    if (isset($i['items'])) {
                        if (count($i['items']) > 0) {
                            echo '<ul class="treeview-menu">';
                            foreach ($i['items'] as $si) {
                                echo '<li>' . CHtml::link($si['label'], $si['url']) . '</li>';
                            }
                            echo '</ul>';
                        }
                    }
                    echo '</li>';
                }
            }
        }
    }
    ?>
</ul>