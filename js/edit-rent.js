
var rentPage = 1;
var currentBook = $('[data-current-book]').attr('data-current-book');



$(document).ready(function () {

    // load all borrowers and books records
    showBorrowers( $('#search-borrowers').val() );
    showBooks( "", currentBook );

    togglePages();

    // check if the borrower is already selected
    if ( $('#selected-borrower').children().length > 0 ) {
        $('#nav-borrower-next').removeClass('d-none');
    }

    // check if any book is already selected
    if ( $('#selected-book').children().length > 0 ) {
        $('#nav-book-next').removeClass('d-none');
    }

    // set rental date to current date
    // let now = moment().format('YYYY-MM-DD')
    // $('#rentalDate').attr('value', now);
    // changeDueDate(now);

    // validateDate()

    // add event listeners to date
    // $('input[type="date"]').on('change', function(){
    //     validateDate();
    // });


    // close buttons
    $('.close-borrower').on('click', function() {
       closeBorrower($(this));
    });


    $('.close-book').on('click', function() {
        closeBook($(this));
    });

    


});


function showBorrowers(str)
{
    $.ajax(`../ajax/search-borrower.php?search=${str}`)
        .done(function( data, status, jqXHR ) {

            // load borrowers to the selection panel
            $('#borrower-results').html(data);

            // add event listener to the select button
            $('.select-borrower-tuple').on('click', function() {
                selectBorrowerTuple($(this));
            });
        })
        .fail(function( jqXHR, status, error ){
            console.log('error');
        });
}


function showBooks(str, restrict)
{
    $.ajax(`../ajax/search-book.php?search=${str}&restrict=${restrict}`)
    .done(function( data, status, jqXHR ) {

        // load books to the selection panel
        $('#book-results').html(data);

        // add event listener to the select button
        $('.select-book-tuple').on('click', function() {
            selectBookTuple($(this));
        });
    })
    .fail(function( jqXHR, status, error ){
        console.log('error');
    });
}




function restoreBook (thisRestoreButton)
{
    let restoredBook = $(thisRestoreButton).parent().detach();

    $('#selected-book').html(restoredBook);
    $('#selected-book').find('[data-book]')
                       .removeClass('border-warning')
                       .addClass('border-success');
    $('#selected-book').find('[data-book]')
                       .find('.restore-book')
                       .removeClass('restore-book')
                       .addClass('close-book')
                       .html('<i class="fas fa-times"></i>');

    $('.close-book').on('click', function() {
        closeBook($(this));
    });
    
}


function closeBook (thisCloseButton)
{
    let removedBook = $(thisCloseButton).parent().attr('data-book');
    if (removedBook == currentBook) {
        let removedCard = $(`[data-book="${removedBook}"]`).detach();
        $('#previous-book').html(removedCard);
        $('#previous-book').find('[data-book]')
                           .removeClass('border-success')
                           .addClass('border-warning');
        $('#previous-book').find('[data-book]')
                           .find('.close-book')
                           .removeClass('close-book')
                           .addClass('restore-book')
                           .html('<i class="fas fa-undo"></i>');

        $('.restore-book').on('click', function() {
            restoreBook($(this));
        });
    } else {
        $(`[data-book="${removedBook}"]`).remove();
        $(`[data-summary-book="${removedBook}"]`).remove();
    }
}


function closeBorrower (thisCloseButton) 
{
    let removedBorrower = $(thisCloseButton).parent().attr('data-borrower');
    $(`[data-borrower="${removedBorrower}"]`).remove();
    $(`[data-summary-borrower="${removedBorrower}"]`).remove();
    $('#nav-borrower-next').addClass('d-none');
}


function selectBorrowerTuple (thisSelectButton)
{
    let tuple = $(thisSelectButton).parent().parent().children();
    let id = tuple.eq(0).text()
    let name = tuple.eq(1).text() + ' ' + tuple.eq(2).text();
    let email = tuple.eq(3).text();
    let phone = tuple.eq(4).text();
    let address = tuple.eq(5).text() + ' ' + tuple.eq(6).text() + ' ' + tuple.eq(7).text();
    let postal = tuple.eq(8).text();
    let selectedBorrower = `
    <div class="p-4 border border-success" data-borrower="${id}">
        <div class="close close-borrower"><i class="fas fa-times"></i></div>
        <div><strong>ID:</strong> ${id}</div>
        <div>${name}</div>
        <div>${email}</div>
        <div>${phone}</div>
        <div>${address}</div>
        <div>${postal}</div>
    </div>`;
    let selectedBorrowerSummary = `
    <div class="p-4" data-summary-borrower="${id}">
        <div><strong>ID:</strong> ${id}</div>
        <div>${name}</div>
        <div>${email}</div>
        <div>${phone}</div>
        <div>${address}</div>
        <div>${postal}</div>
        <input type="hidden" value="${id}" name="borrowerID">
    </div>
    `;
   
    insertSelected ( 
        $('#selected-borrower'), 
        selectedBorrower, 
        $('summary > #summary-borrower'),
        selectedBorrowerSummary,
        $('#nav-borrower-next'),
        'data-borrower'
    );


    $('.close-borrower').on('click', function() {
        closeBorrower($(this));
    });
}

function selectBookTuple (thisSelectButton)
{
    let tuple = $(thisSelectButton).parent().parent().children();
    let id = tuple.eq(0).text();
    let title = tuple.eq(1).text();
    let year = tuple.eq(3).text();
    let author = tuple.eq(2).text();

    // to avoid duplicate selections
    let selectedBook = `
    <div class="p-4 border border-success position-relative" data-book="${id}">
        <div class="close close-book"><i class="fas fa-times"></i></div>
        <div><strong>ID:</strong> ${id}</div>
        <div>${title} (${year})</div>
        <div>by ${author}</div>
    </div>
    `;

    let selectedBookSummary = `
    <div class="p-4" data-summary-book="${id}">
        <div><strong>ID:</strong> ${id}</div>
        <div>${title} (${year})</div>
        <div>by ${author}</div>
        <input type="hidden" value="${id}" name="bookID[]">
    </div>
    `;

    insertSelected ( 
        $('#selected-book'), 
        selectedBook, 
        $('summary > #summary-book'),
        selectedBookSummary,
        $('#nav-book-next'),
        'data-book'
    );

    $('.close-book').on('click', function() {
        closeBook($(this));
    });
}



function insertSelected(aContainer, aContent, bContainer, bContent, next, flag)
{
    if (aContainer.children().length > 0) {
        let card = aContainer.find(`[${flag}]`); // get the index of the card
        let index = card.attr(flag);
        if (index == currentBook) {
            closeBook( card.find('.close-book') );
        }
    }
    aContainer.html(aContent);
    bContainer.html(bContent);
    next.removeClass('d-none');
}


function togglePages()
{  
    // activate first page
    $('[data-page]').addClass('d-none');
    $(`[data-page=${rentPage}]`).removeClass('d-none');
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

function validateDate()
{
    rentDate = $('#rentalDate').val();
    dueDate = $('#dueDate').val();
    updateSummaryDates(rentDate, dueDate);

    if (!rentDate) {
        $('#nav-date-next').addClass('d-none');
        $('#date-error').text('Specify a rental date.');
        $('#date-error').removeClass('d-none');
    }
    // valid
    if( moment(rentDate).isBefore(dueDate) ) {
        $('#nav-date-next').removeClass('d-none');
        $('#date-error').addClass('d-none');
    } else {
        $('#nav-date-next').addClass('d-none');
        $('#date-error').text('Due date should be at least one day after the rental date.');
        $('#date-error').removeClass('d-none');
    }

}


function updateSummaryDates(rentDate, dueDate)
{
    let rentDateEl = `
    <div>
        Starting rent date:<br>
            <strong>${moment(rentDate).format('LL')}</strong>
            <br><br>
        Must return on or before:<br>
            <strong>${moment(dueDate).format('LL')}</strong>
        <input type="hidden" value="${rentDate}" name="rentDate">
        <input type="hidden" value="${dueDate}" name="dueDate">
    </div>
    `
    $('summary > #summary-date').html(rentDateEl)

}