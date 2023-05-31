/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

const addmoreFields = () => {
    let section2 = document.getElementById('features_input');
    let divId = Math.floor(Math.random() * 11);
    document.getElementById('features_input').insertAdjacentHTML('beforeend', "<input type='text' placeholder='Enter Feature' name='features[]' class='form-control input__box--wrapper my-2 mr-2 d-inline w-75' id=" + divId + "><a class='btn btn-primary' onclick='removeAdded(" + divId + ")' id='remove_"+ divId +"'><i class='fa fa-minus text-white' aria-hidden='true'></i></a>")
}

// remove added HTML fields on  page
const removeAdded = (id) => {
    document.getElementById(id).remove();
    document.getElementById("remove_"+id).remove();
}

// Delete Course
$('.course_delete').on('click', function(e){
    var id = $(this).data('id');
    e.preventDefault();
    if(confirm("Do you want to delete this course?")){
        console.log(id);
    } else {
        alert("not confirmed");
    }
})
