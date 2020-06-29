//modal- inserted
$('[data-tarjet-inserted="modal-inserted"]').click( function(){
    $(".modal_box").addClass("active");
});

$('[dimiss-inserted="modal-close-inserted"]').click( function(){
    $(".modal_box").removeClass("active");
});

//modal-updated
$('[ data-tarjet-updated="modal-updated"]').click( function(){
    $(".modal_box_update").addClass("active");
});

$('[dimiss-updated="modal-close-updated"]').click( function(){
    $(".modal_box_update").removeClass("active");
});

//modal-deleted
$('[data-tarjet-deleted="modal-deleted"]').click( function(){
    $(".modal_box_delete").addClass("active");
});

$('[ dimiss-deleted="modal-close-deleted"]').click( function(){
    $(".modal_box_delete").removeClass("active");
});

