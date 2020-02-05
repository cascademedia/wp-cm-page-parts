(function (api, blockEditor, blocks, components, element) {
    let el = element.createElement;
    // let PlainText = blockEditor.PlainText;
    let Dashicon = components.Dashicon;
    let SelectControl = components.SelectControl;

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

                let selectElement = el(
                    SelectControl,
                    {
                        id: id,
                        // value: 'test2',
                        options: [
                            {label: 'Test 1', value: 'test1'},
                            {label: 'Test 2', value: 'test2'},
                        ]
                    }
                );

                let collectionEndpoint = new api.collections.Cm_page_part();
                let selectOptions = [];
                collectionEndpoint.fetch({data:{fields: 'id,title'}}).done(function (pageCollection) {
                    for (let pageIndex in pageCollection) {
                        if (pageCollection.hasOwnProperty(pageIndex)) {
                            let page = pageCollection[pageIndex];
                            selectOptions.push({
                                label: page.title.rendered,
                                value: page.id
                            });
                        }
                    }

                    // (function () {
                    //     this.props.setAttributes({options: selectOptions});
                    // }).bind(selectElement)();
                    // selectElement.props.setAttributes({options: selectOptions});
                    // console.log(selectElement);
                    //@TODO figure out how to dynamically alter select options.
                });

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
                    // el(
                    //     PlainText,
                    //     {
                    //         className: 'input-control',
                    //         id: id,
                    //         placeholder: 'Put ID here...',
                    //         value: props.attributes.id,
                    //         onChange: function (value) {
                    //             props.setAttributes({id: value});
                    //         }
                    //     }
                    // )
                );
            },
            save: function (props) {
                return ['[cm_page_part id="', props.attributes.id, '"]'].join('');
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
