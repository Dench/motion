<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Activity', 'icon' => 'fa fa-bar-chart', 'url' => '#', 'items' => [
                        ['label' => 'Датчик 1', 'url' => ['/activity', 'id' => 1]],
                        ['label' => 'Датчик 2', 'url' => ['/activity', 'id' => 2]],
                        ['label' => 'Датчик 3', 'url' => ['/activity', 'id' => 3]],
                        ['label' => 'Датчик 4', 'url' => ['/activity', 'id' => 4]],
                    ]],
                    ['label' => 'Objects', 'icon' => 'fa fa-home', 'url' => ['/object']],
                    ['label' => 'Device', 'icon' => 'fa fa-cog', 'url' => ['/device']],
                ],
            ]
        ) ?>

    </section>

</aside>
