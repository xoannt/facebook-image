$(document).ready(function() {
    var $el = $( '#wi-el' ),
        windy = $el.windy(),
        allownavnext = false,
        allownavprev = false;
    $( '#nav-prev' ).on( 'mousedown', function( event ) {
        allownavprev = true;
        navprev();     
        } ).on( 'mouseup mouseleave', function( event ) {
        allownavprev = false;      
        } );
    $( '#nav-next' ).on( 'mousedown', function( event ) {
        allownavnext = true;
        navnext();     
        } ).on( 'mouseup mouseleave', function( event ) {
        allownavnext = false;          
        } );
    function navnext() {
        if( allownavnext ) {
            windy.next();
            setTimeout( function() {   
            navnext();
            }, 150 );
        }
    }          
    function navprev() {
        if( allownavprev ) {
            windy.prev();
            setTimeout( function() {   
            navprev();
            }, 150 );
        }
    }
});