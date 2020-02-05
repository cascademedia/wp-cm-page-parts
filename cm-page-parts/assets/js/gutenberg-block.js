(function (blocks, element) {
    let el = element.createElement;

    blocks.registerBlockType(
        'cm/page-part',
        {
            title: 'Page Part',
            icon: 'layout',
            category: 'layout',
            edit: function () {
                return el(
                    'p',
                    {},
                    'Testing editor...'
                );
            },
            save: function () {
                return el(
                    'p',
                    {},
                    'Testing frontend...'
                );
            }
        }
    );
})(
    window.wp.blocks,
    window.wp.element
);
