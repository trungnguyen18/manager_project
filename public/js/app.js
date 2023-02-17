$(document).ready(function() {
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();

    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    $("input[name='checkall']").click(function() {
        var checked = $(this).is(':checked');
        $('.table-checkall tbody tr td input:checkbox').prop('checked', checked);
    });

    $(".checkAll").on('click', function(){
        $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
    });

    $(".checkbox_wrapper").on('click', function(){
        // $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
        $(this)
       .closest(".card")
       .find(".checkbox_childrent")
       .prop("checked", this.checked);
    })

    $(".checkall").on('click', function(){
        $(this)
        .closest(".col-md-12")
        .find(".module_childrent")
        .prop("checked", this.checked);
    });
});

// function actionDelete(event){
//     event.preventDefault();
//     let urlRequest = $(this).data('url');
//     let that = $(this);

//     Swal.fire({
//         title: 'Are you sure?',
//         text: "You won't be able to revert this!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes, delete it!'
//     }).then((result) => {
//         if(result.value) {
//             $.ajax({
//                 type: 'GET',
//                 url: urlRequest,
//                 success: function (data) {
//                     if(data.code == 200){
//                         that.parents().parent().remove();
//                         Swal.fire(
//                             'Deleted!',
//                             'Your file has been deleted.',
//                             'success'
//                         )
//                     }
//                 },
//                 error: function (){

//                 }

//             });
//         }
//     })
// }
//     $(function (){
//         $(document).on('click', '.action_delete', actionDelete);
//     });