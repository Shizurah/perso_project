if ($(window).width() <= 575) {
    $('section').css('padding', '0');
}


var urlRedirection = '';

if (window.location.hostname == 'localhost') {
    urlRedirection = 'http://localhost/projet5/index.php?action=';
}
else {
    urlRedirection = 'http://eloise-martin.com/projet5/index.php?action=';
}


$('#connexion-form').on('submit', function() {

    var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};

    that.find('[name]').each(function(index, value) {
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        
        data[name] = value;
    });

    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'html',
        timeout: 5000,

        success: function(response) {
            console.log(response);
            
            if (response == 'success') {
                document.location.replace(urlRedirection + 'mySpace');
            }
            else {
                $('#errorMsg').text('');
                $('#errorMsg').text(response).css('display', 'block');
            }
        },

        error: function() {
            alert('La requête n\'a pas abouti, veuillez essayer ultérieurement');
        }
    });

    return false;
});


$('#registration-form').on('submit', function() {

    var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};

    that.find('[name]').each(function(index, value) {
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        
        data[name] = value;
    });

    $.ajax({
        url: url,
        type: type,
        data: data,
        dataType: 'html',
        timeout: 5000,

        success: function(response) {
            console.log(response);
            
            if (response == 'success') {
                document.location.replace(urlRedirection + 'connexionPage');
            }
            else {
                $('#errorMsg').text('');
                $('#errorMsg').text(response).css('display', 'block');
            }
        },

        error: function() {
            alert('La requête n\'a pas abouti, veuillez essayer ultérieurement');
        }
    });

    return false;
});


// changement avatar :

// var files;

// $('#avatar').on('change', function(e) {
//     files = e.target.files;
// });


// $('#changing-avatar-form').on('submit', function(e) {
//     e.stopPropagation(); 
//     e.preventDefault();

//     var that = $(this),
//         url = that.attr('action'),
//         type = that.attr('method'),
//         data = new FormData();

//     $.each(files, function(key, value) {
//         data.append(key, value);
//     });

//     $.ajax({
//         url: url,
//         type: type,
//         data: data,
//         cache: false,
//         dataType: 'html',
//         processData: false, // Don't process the files
//         contentType: false, // Set content type to false as jQuery will tell the server its a query string request

//         success: function(response) {

//         }
//     });
// });
