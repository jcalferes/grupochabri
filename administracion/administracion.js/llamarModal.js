// Function to show modal
$( '#show-modal' ).on( 'click', function( ev ) {
    $("#modal").load("algo.php");
  $( '#modal' ).fadeIn();
  $( '#modal-background' ).fadeTo( 700, .5 );
  ev.preventDefault();
} );

// Function to hide modal
$( '#close-modal' ).on( 'click', function( ev ) {
  $( '#modal, #modal-background' ).fadeOut();
  ev.preventDefault();
} );