jQuery(document).ready(function($) {
    var engine = new Bloodhound({
        remote: '/query?user=%st%',
        // '...' = displayKey: '...'
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('username'),
        queryTokenizer: Bloodhound.tokenizers.whitespace
    });

    engine.initialize();

    $("#users").typeahead({
        hint: true,
        highlight: true
    }, {
        source: engine.ttAdapter(),
        // This will be appended to "tt-dataset-" to form the class name of the suggestion menu.
        name: 'User_list',
        // the key from the array we want to display (name,id,email,etc...)
        displayKey: 'name',
        templates: {
            empty: [
                '<div class="empty-message">unable to find any</div>'
            ]
        }
    });
});