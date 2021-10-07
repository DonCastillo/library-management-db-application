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
});