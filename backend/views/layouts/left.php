<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Activity', 'icon' => 'fa fa-bar-chart', 'url' => ['/activity']],
                    ['label' => 'Objects', 'icon' => 'fa fa-home', 'url' => ['/object']],
                    ['label' => 'Device', 'icon' => 'fa fa-cog', 'url' => ['/device']],
                ],
            ]
        ) ?>

    </section>

</aside>
