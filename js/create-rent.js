
var rentPage = 3;
var bookSelected = [];




$(document).ready(function () {

    // load all borrowers and books records
    showBorrowers("")
    showBooks("");

    togglePages();

    // check if the borrower is already selected
    if ( $('#selected-borrower').children().length > 0 ) {
        $('#nav-borrower').removeClass('d-none');
    }

    // check if any book is already selected
    if ( $('#selected-book').children().length > 0 ) {
        $('#nav-book').removeClass('d-none');
    }

    // set rental date to current date
    let now = moment().format('YYYY-MM-DD')
    $('#rentalDate').attr('value', now);
    changeDueDate(now);


});


function showBorrowers(str)
{
    $.ajax(`../ajax/search-borrower.php?search=${str}`)
        .done(function( data, status, jqXHR ){

            // load borrowers to the selection panel
            $('#borrower-results').html(data);

            // add event listener to the select button
            $('.select-borrower-tuple').on('click', function(event) {
                let tuple = $(this).parent().parent().children();
                let id = tuple.eq(0).text()
                let name = tuple.eq(1).text() + ' ' + tuple.eq(2).text();
                let email = tuple.eq(3).text();
                let phone = tuple.eq(4).text();
                let address = tuple.eq(5).text() + ' ' + tuple.eq(6).text() + ' ' + tuple.eq(7).text();
                let postal = tuple.eq(8).text();
                let selectedBorrower = `
                <div class="p-4 border border-success">
                    <div class="close"><i class="fas fa-times"></i></div>
                    <div><strong>ID:</strong> ${id}</div>
                    <div>${name}</div>
                    <div>${email}</div>
                    <div>${phone}</div>
                    <div>${address}</div>
                    <div>${postal}</div>
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

        // load books to the selection panel
        $('#book-results').html(data);

        // add event listener to the select button
        $('.select-book-tuple').on('click', function(event) {
            let tuple = $(this).parent().parent().children();
            let id = tuple.eq(0).text();
            let title = tuple.eq(1).text();
            let year = tuple.eq(3).text();
            let author = tuple.eq(2).text();

            // to avoid duplicate selections
            if ( !bookSelected.includes(id) )
            {
                bookSelected.push(id);
                let selectedBook = `
                <div class="p-4 border border-success position-relative">
                    <div class="close"><i class="fas fa-times"></i></div>
                    <div data-book="${id}"><strong>ID:</strong> ${id}</div>
                    <div>${title} (${year})</div>
                    <div>by ${author}</div>
                </div>
                `;
                $('#selected-book').append(selectedBook);
                $('#nav-book').removeClass('d-none');
    
                $('.close').on('click', function(event){
                    let removedBook = $(this).parent().find('[data-book]').attr('data-book');
                    $(this).parent().remove();
 
                    bookSelected = bookSelected.filter(id => id != removedBook);

                    if (bookSelected.length < 1) {
                        $('#nav-book').addClass('d-none');
                    }


                });
            }
            
        });
    })
    .fail(function( jqXHR, status, error ){
        console.log('error');
    });
}

function togglePages()
{  
    // activate first page
    $('[data-page]').addClass('d-none');
    $(`[data-page=${rentPage}]`).removeClass('d-none');
    console.log(rentPage);
}


function next()
{
    rentPage++;
    togglePages();
}

function prev()
{
    rentPage--;
    togglePages();
}

function changeDueDate(date)
{
    $('#rentalDate').val(date)
    let rentalDate = date;
    let dueDate = moment(rentalDate).add(2, 'week').format('YYYY-MM-DD');
    console.log(dueDate);
    $('#dueDate').val(dueDate);
}