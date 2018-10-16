if ($(window).width() <= 575) {
    $('section').css('padding', '0');
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
        timeout: 3000,

        success: function(response) {
            console.log(response);
            
            if (response == 'success') {
                document.location.replace('http://localhost/projets_openclassrooms/projet5/index.php?action=mySpace');
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
        timeout: 3000,

        success: function(response) {
            console.log(response);
            
            if (response == 'success') {
                document.location.replace('http://localhost/projets_openclassrooms/projet5/index.php?action=connexionPage');
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



