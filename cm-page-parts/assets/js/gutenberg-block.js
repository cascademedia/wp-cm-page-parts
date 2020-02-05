(function (blockEditor, blocks, components, element) {
    let el = element.createElement;
    let PlainText = blockEditor.PlainText;
    let Dashicon = components.Dashicon;

    blocks.registerBlockType(
        'cm/page-part',
        {
            title: 'Page Part',
            description: 'Insert reusable content with a Cascade Media Page Part.',
            icon: 'layout',
            category: 'widgets',
            attributes: {
                id: {
                    type: 'string'
                }
            },
            supports: {
                customClassName: false,
                className: false,
                html: false
            },
            edit: function (props) {
                let id = 'cm_page_part_' + Math.random().toString(36).substr(2, 9);

                return el(
                    'div',
                    {
                        className: 'wp-block-cm-page-part components-placeholder'
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
                    el(
                        PlainText,
                        {
                            className: 'input-control',
                            id: id,
                            placeholder: 'Put ID here...',
                            value: props.attributes.id,
                            onChange: function (value) {
                                props.setAttributes({id: value});
                            }
                        }
                    )
                );
            },
            save: function (props) {
                return ['[cm_page_part id="', props.attributes.id, '"]'].join('');
            }
        }
    );
})(
    window.wp.blockEditor,
    window.wp.blocks,
    window.wp.components,
    window.wp.element
);
