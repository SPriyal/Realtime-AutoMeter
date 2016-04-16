jQuery(document).ready(function($) {
    var engine = new Bloodhound({
        //remote: {
        //    url: '/query?user=%QUERY',
        //    wildcard: '%QUERY'
        //},
        prefetch: 'searchDescendant',
        // '...' = displayKey: '...'
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    //engine.initialize();

    $('#remote .typeahead').typeahead({
        hint: false,
        classNames: {
            input: 'form-control',
            menu: 'form-control',
            selectable: 'Typeahead-selectable'
        },
        highlight: true
    }, {
        source: engine,
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
                //var link = /l/public/e/"+variable.id;
                return '<a href="/l/public/e/'+variable.id+'"><div style="background: #FFFFFF; font-size: x-large;">'+variable.name+'  '+variable.id+'</div></a>'
                //TODO - Hardcoded link above (URL_ENTITY)!
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