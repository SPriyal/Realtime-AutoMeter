jQuery(document).ready(function($) {
    var engine = new Bloodhound({
        remote: {
            url: '/query?user=%QUERY',
            wildcard: '%QUERY'
        },
        // '...' = displayKey: '...'
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('username'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

    $('#remote .typeahead').typeahead({
        hint: true,
        classNames: {
            input: 'form-control',
            hint: 'Typeahead-hint',
            selectable: 'Typeahead-selectable'
        },
        highlight: true
    }, {
        source: engine.ttAdapter(),
        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
        name: 'User_list',
        // the key from the array we want to display (name,id,email,etc...)
        displayKey: 'name',
        templates: {
            empty: [
                '<div style="background: #FFFFFF; font-size: x-large;">',
                'unable to find current query',
                '</div>'
            ].join('\n'),
            suggestion: function(variable){
                return '<div style="background: #FFFFFF; font-size: x-large;">'+variable.name+'</div>'
            }
        }


    });



});

//templates: {
//    empty: [
//        '<div class="empty-message">',
//        'unable to find any Best Picture winners that match the current query',
//        '</div>'
//    ].join('\n'),
//        suggestion: Handlebars.compile('<div style="background: #ffffff"><strong>{{name}}</strong></div>')
//}


//$('.typeahead').typeahead({
//    hint: true,
//    //classNames: {
//    //    input: 'Typeahead-input',
//    //    hint: 'Typeahead-hint',
//    //    selectable: 'Typeahead-selectable'
//    //},
//    highlight: true
//}, {
//    source: engine.ttAdapter(),
//    // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
//    name: 'User_list',
//    // the key from the array we want to display (name,id,email,etc...)
//    displayKey: 'name',
//    templates: {
//        empty: [
//            '<div>',
//            'unable to find current query',
//            '</div>'
//        ].join('\n')
//    }
//});