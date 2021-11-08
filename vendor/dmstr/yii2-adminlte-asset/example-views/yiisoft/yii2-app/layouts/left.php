<aside class="main-sidebar">

    <section class="sidebar">


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Universitet bo`limlari', 'options' => ['class' => 'header']],
                    ['label' => 'O`qituvchilar', 'icon' => 'file-code-o', 'url' => ['/teachers']],
                    ['label' => 'Xonalar', 'icon' => 'file-code-o', 'url' => ['/rooms']],
                    ['label' => 'Fanlar', 'icon' => 'file-code-o', 'url' => ['/subjects']],
                    ['label' => 'Guruhlar', 'icon' => 'file-code-o', 'url' => ['/groups']],
                    ['label' => 'Dars biriktirish', 'icon' => 'file-code-o', 'url' => ['/teachers-subject']],
                    // ['label' => 'Foydalanuvchilar', 'icon' => 'file-code-o', 'url' => ['/users']],
                    // [
                    //     'label' => 'Some tools',
                    //     'icon' => 'share',
                    //     'url' => '#',
                    //     'items' => [
                    //         ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                    //         ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                    //         [
                    //             'label' => 'Level One',
                    //             'icon' => 'circle-o',
                    //             'url' => '#',
                    //             'items' => [
                    //                 ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                    //                 [
                    //                     'label' => 'Level Two',
                    //                     'icon' => 'circle-o',
                    //                     'url' => '#',
                    //                     'items' => [
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                         ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                    //                     ],
                    //                 ],
                    //             ],
                    //         ],
                    //     ],
                    // ],
                ],
            ]
        ) ?>

    </section>

</aside>
