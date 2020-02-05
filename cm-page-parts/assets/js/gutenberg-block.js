(function (api, blockEditor, blocks, components, element) {
    let el = element.createElement;
    let Dashicon = components.Dashicon;
    let SelectControl = components.SelectControl;

    let collectionEndpoint = new api.collections.Cm_page_part();
    let selectOptions = [];
    collectionEndpoint.fetch().done(function (pageCollection) {
        selectOptions.push({
            label: '-- Select --',
            value: null
        });

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
                },
                title: {
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
                if (!props.attributes.title) {
                    props.attributes.title = '-- Select --';
                }

                let emptySelect = [{
                    label: props.attributes.title,
                    value: null
                }];

                let selectElement = el(
                    SelectControl,
                    {
                        id: id,
                        value: props.attributes.id,
                        options: selectOptions.length !== 0 ? selectOptions : emptySelect,
                        onChange: function (value) {
                            value = parseInt(value);
                            if (Number.isNaN(value)) value = null;
                            let title = '';

                            for (let selectIndex in selectOptions) {
                                if (selectOptions.hasOwnProperty(selectIndex)) {
                                    let selectOption = selectOptions[selectIndex];
                                    if (selectOption.value === value) {
                                        title = selectOption.label;
                                        break;
                                    }
                                }
                            }

                            props.setAttributes({
                                id: value,
                                title: title
                            });
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
