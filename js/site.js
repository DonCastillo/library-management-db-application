$(document).ready(function () {
    console.log('Hello');

    // resizeMenuText();
    // $(window).resize(function(){
    //     resizeMenuText();
    // });


    function resizeMenuText() {
        let items = $('.menu ul li a div');
        let maxHeight = 0;
        
        items.innerHeight('auto');
        
        
        items.each(function(index){
            // console.log($(this))
            if(maxHeight < $(this).innerHeight()) {
                maxHeight = $(this).innerHeight();
            }
        });

        // console.log(maxHeight)
        items.innerHeight(maxHeight);

       

    }

    // $('.addfield').click(function(){
    //     console.log('hello')
    //     let row = $(this).parent();
    //     let container = $(this).parent().parent();
    //     container.append(row.clone());
    // });

    // function addField(this) {
    //     console.log(this)
    // }

});

function addField(event) {
    let row = $(event).parent();
    let container = $(event).parent().parent();
    container.append(row.clone());
}

function removeField(event) {
    let numRows = $(event).parent().parent().children();
    //console.log(numRows)
    if (numRows.length > 1) {
        $(event).parent().remove();
    }
}