 $(document).ready(function(){

 $("#modal").load("algo.php");

$( '#show-modal' ).on( 'click', function( ev ) {
   
  $( '#modal' ).fadeIn();
  
  $( '#modal-background' ).fadeTo( 700, .5 );
//   $("#modal").load("algo.php");
  ev.preventDefault();
} );

// Function to hide modal
//$( '#close-modal' ).on( 'click', function( ev ) {
//  $( '#modal, #modal-background' ).fadeOut();
//  ev.preventDefault();
//} );
     
 });