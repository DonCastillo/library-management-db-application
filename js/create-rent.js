$(document).ready(function () {

    showBorrowers("")
    showBooks("");



});


function showBorrowers(str)
{
    console.log(str);

    //$('#nav-borrower').addClass('d-none')

    $.ajax(`../ajax/search-borrower.php?search=${str}`)
        .done(function( data, status, jqXHR ){
            $('#borrower-results').html(data);

            $('.select-borrower-tuple').on('click', function(event) {
                let tuple = $(this).parent().parent().children();
                let selectedBorrower = `
                <div class="p-3 border border-success">
                    <div class="close"><i class="fas fa-times"></i></div>
                    <div>Name: ${tuple.eq(1).text()} ${tuple.eq(2).text()}</div>
                    <div>Email: ${tuple.eq(3).text()}</div>
                    <div>Phone: ${tuple.eq(4).text()}</div>
                    <div>Address: ${tuple.eq(5).text()} ${tuple.eq(6).text()} ${tuple.eq(7).text()}</div>
                    <div>Postal: ${tuple.eq(8).text()}</div>
                </div>`;
                $('#selected-borrower').html(selectedBorrower);
                $('#nav-borrower').removeClass('d-none');

                $('.close').on('click', function(event){
                    $(this).parent().remove();
                    $('#nav-borrower').addClass('d-none');

                });


            });


        })
        .fail(function( jqXHR, status, error ){
            console.log('error');
        });
}


function showBooks(str)
{
    $.ajax(`../ajax/search-book.php?search=${str}`)
    .done(function( data, status, jqXHR ){
        $('#book-results').html(data);

        

    })
    .fail(function( jqXHR, status, error ){
        console.log('error');
    });
}

