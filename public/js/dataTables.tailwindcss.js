/*! DataTables Tailwind CSS integration
 */

(function( factory ){
    if ( typeof define === 'function' && define.amd ) {
        // AMD
        define( ['jquery', 'datatables.net'], function ( $ ) {
            return factory( $, window, document );
        } );
    }
    else if ( typeof exports === 'object' ) {
        // CommonJS
        var jq = require('jquery');
        var cjsRequires = function (root, $) {
            if ( ! $.fn.dataTable ) {
                require('datatables.net')(root, $);
            }
        };

        if (typeof window === 'undefined') {
            module.exports = function (root, $) {
                if ( ! root ) {
                    // CommonJS environments without a window global must pass a
                    // root. This will give an error otherwise
                    root = window;
                }

                if ( ! $ ) {
                    $ = jq( root );
                }

                cjsRequires( root, $ );
                return factory( $, root, root.document );
            };
        }
        else {
            cjsRequires( window, jq );
            module.exports = factory( jq, window, window.document );
        }
    }
    else {
        // Browser
        factory( jQuery, window, document );
    }
}(function( $, window, document ) {
    'use strict';
    var DataTable = $.fn.dataTable;



    /*
     * This is a tech preview of Tailwind CSS integration with DataTables.
     */

// Set the defaults for DataTables initialisation
    $.extend( true, DataTable.defaults, {
        renderer: 'tailwindcss'
    } );


// Default class modification
    $.extend( true, DataTable.ext.classes, {
        container: "dt-container dt-tailwindcss",
        search: {
            input: "tw-border tw-placeholder-gray-500 tw-ml-2 tw-px-3 tw-py-2 tw-rounded-lg tw-border-gray-200 focus:tw-border-blue-500 focus:tw-ring focus:tw-ring-blue-500 focus:tw-ring-opacity-50 dark:tw-bg-gray-800 dark:tw-border-gray-600 dark:tw-focus:tw-border-blue-500 dark:tw-placeholder-gray-400"
        },
        length: {
            select: "tw-border tw-w-24 tw-px-4 tw-me-4 tw-py-2 tw-rounded-lg tw-border-gray-200 focus:tw-border-blue-500 focus:tw-ring focus:tw-ring-blue-500 focus:tw-ring-opacity-50 dark:tw-bg-gray-800 dark:tw-border-gray-600 dark:focus:tw-border-blue-500"
        },
        processing: {
            container: "dt-processing"
        },
        paging: {
            active: 'tw-font-semibold tw-bg-gray-100 dark:tw-bg-gray-700/75',
            notActive: 'tw-bg-white dark:tw-bg-gray-800',
            button: 'tw-relative tw-inline-flex tw-justify-center tw-items-center tw-space-x-2 tw-border tw-px-4 tw-py-2 tw--mr-px tw-leading-6 hover:tw-z-10 focus:z-10 active:z-10 tw-border-gray-200 active:tw-border-gray-200 active:tw-shadow-none dark:tw-border-gray-700 dark:tw-active:border-gray-700',
            first: 'tw-rounded-l-lg',
            last: 'tw-rounded-r-lg',
            enabled: 'tw-text-gray-800 hover:tw-text-gray-900 hover:tw-border-gray-300 hover:tw-shadow-sm focus:tw-ring focus:tw-ring-gray-300 focus:tw-ring-opacity-25 dark:tw-text-gray-300 dark:hover:tw-border-gray-600 dark:hover:tw-text-gray-200 dark:focus:tw-ring-gray-600 dark:focus:tw-ring-opacity-40',
            notEnabled: 'tw-text-gray-300 dark:tw-text-gray-600'
        },
        table: 'dataTable tw-min-w-full tw-text-sm tw-align-middle tw-whitespace-nowrap tw-divide-y tw-divide-gray-200 dark:tw-divide-gray-700 tw-mb-8',
        thead: {
            row: 'tw-text-center',
            cell: 'tw-px-6 tw-py-2 tw-text-xs tw-font-medium tw-text-gray-500 tw-uppercase'
        },
        tbody: {
            row: 'even:tw-bg-gray-50 dark:even:tw-bg-gray-900/50 tw-text-center',
            cell: 'tw-px-6 tw-py-2'
        },
        tfoot: {
            row: 'even:tw-bg-gray-50 dark:even:tw-bg-gray-900/50',
            cell: 'tw-p-3 tw-text-left'
        },
    } );

    DataTable.ext.renderer.pagingButton.tailwindcss = function (settings, buttonType, content, active, disabled) {
        var classes = settings.oClasses.paging;
        var btnClasses = [classes.button];

        btnClasses.push(active ? classes.active : classes.notActive);
        btnClasses.push(disabled ? classes.notEnabled : classes.enabled);

        var a = $('<a>', {
            'href': disabled ? null : '#',
            'class': btnClasses.join(' ')
        })
            .html(content);

        return {
            display: a,
            clicker: a
        };
    };

    DataTable.ext.renderer.pagingContainer.tailwindcss = function (settings, buttonEls) {
        var classes = settings.oClasses.paging;

        buttonEls[0].addClass(classes.first);
        buttonEls[buttonEls.length -1].addClass(classes.last);

        return $('<ul/>').addClass('pagination').append(buttonEls);
    };

    DataTable.ext.renderer.layout.tailwindcss = function ( settings, container, items ) {
        var row = $( '<div/>', {
            "class": items.full ?
                'tw-grid tw-grid-cols-1 tw-gap-4 tw-mb-4' :
                'tw-grid tw-grid-cols-2 tw-gap-4 tw-mb-4'
        } )
            .appendTo( container );

        $.each( items, function (key, val) {
            var klass;

            // Apply start / end (left / right when ltr) margins
            if (val.table) {
                klass = 'tw-col-span-2';
            }
            else if (key === 'start') {
                klass = 'tw-flex tw-justify-self-start tw-items-center';
            }
            else if (key === 'end') {
                klass = 'tw-col-start-2 tw-justify-self-end';
            }
            else {
                klass = 'tw-col-span-2 tw-justify-self-center';
            }

            $( '<div/>', {
                id: val.id || null,
                "class": klass + ' ' + (val.className || '')
            } )
                .append( val.contents )
                .appendTo( row );
        } );
    };


    return DataTable;
}));
