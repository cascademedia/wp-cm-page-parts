(function (api, blockEditor, blocks, components, element) {
    let el = element.createElement;
    let Dashicon = components.Dashicon;
    let SelectControl = components.SelectControl;

    let collectionEndpoint = new api.collections.Cm_page_part();
    let selectOptions = [
        {
            label: '-- Select --',
            value: null
        }
    ];
    let selectPromise = collectionEndpoint.fetch().then(function (pageCollection) {
        for (let pageIndex in pageCollection) {
            if (pageCollection.hasOwnProperty(pageIndex)) {
                let page = pageCollection[pageIndex];
                selectOptions.push({
                    label: page.title.rendered,
                    value: page.id
                });
            }
        }
    });

    blocks.registerBlockType(
        'cm/page-part',
        {
            title: 'Page Part',
            description: 'Insert reusable content with a Cascade Media Page Part.',
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
                let id = 'cm_page_part_' + Math.random().toString(36).substr(2, 9);

                selectPromise.then(function () {
                    // props.setAttributes({_rand: 'bleee'});
                });

                let selectElement = el(
                    SelectControl,
                    {
                        id: id,
                        value: props.attributes.id,
                        options: selectOptions,
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
                    selectElement
                );
            },
            save: function () {
                return null;
            }
        }
    );
})(
    window.wp.api,
    window.wp.blockEditor,
    window.wp.blocks,
    window.wp.components,
    window.wp.element
);
