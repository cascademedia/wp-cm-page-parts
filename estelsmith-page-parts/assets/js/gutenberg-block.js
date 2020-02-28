(function (blocks, components, element) {
    let el = element.createElement;
    let Dashicon = components.Dashicon;
    let SelectControl = components.SelectControl;

    blocks.registerBlockType(
        'estelsmith/page-part',
        {
            title: 'Page Part',
            description: "Insert reusable content with Estel's Page Part.",
            icon: 'layout',
            category: 'widgets',
            attributes: {
                id: {
                    type: 'number'
                }
            },
            supports: {
                customClassName: false,
                className: false,
                html: false
            },
            edit: function (props) {
                let id = 'estelsmith_page_part_' + Math.random().toString(36).substr(2, 9);

                let selectElement = el(
                    SelectControl,
                    {
                        className: 'page-part-select',
                        id: id,
                        value: props.attributes.id,
                        options: window['estelsmith_page_part']['options'],
                        onChange: function (value) {
                            value = parseInt(value);
                            if (Number.isNaN(value)) value = null;

                            props.setAttributes({id: value});
                        }
                    }
                );

                return el(
                    'div',
                    {
                        className: 'wp-block-estelsmith-page-part components-placeholder'
                    },
                    el(
                        'label',
                        {
                            className: 'components-placeholder__label',
                            for: id
                        },
                        el(
                            Dashicon,
                            {
                                icon: 'layout'
                            },
                        ),
                        'Page Part'
                    ),
                    selectElement
                );
            },
            save: function () {
                return null;
            }
        }
    );
})(
    window.wp.blocks,
    window.wp.components,
    window.wp.element
);
