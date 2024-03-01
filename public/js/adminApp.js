"option strict";

import {
    humanReadableTime,
    addEventOnElements,
    deleteProduct,
    searchProduct
} from "./utils.js";

const productContainer = document.querySelector(".product-list");
const bulkDelete = document.querySelector('[data-bulk_delete]');

// get all date and convert to human readable format
let $date_entries = document.querySelectorAll('[data-date_entry]');
$date_entries?.forEach(entry => entry.innerHTML = humanReadableTime(entry.getAttribute('data-date_entry')))


productContainer?.addEventListener('click', function (ev) {
    ev.stopImmediatePropagation();

    // DELETE SELECTED SINGLE PRODUCT
    if (ev.target.classList.contains('delete_btn')) {
        const { id, title, featured_img } = ev.target.parentNode.parentNode.parentNode.dataset;

        alertify.confirm('Delete Confirmation',
        `Are you sure you want to delete "<b>${title}</b>"`,
        function () {
            deleteProduct(id, featured_img).then(result => {
                // console.log(result);
                if (result?.success) {
                    alertify.success(result.success)
                    ev.target.parentNode.parentNode.parentNode.remove(); //remove item from DOM

                    let tBody = document.querySelector('.product-list table tbody');
                    if (tBody.rows.length === 0) { 
                        let newCol = document.createElement('tr');
                        newCol.innerHTML = `<td colspan="7">Empty product list</td>`;
                        tBody.appendChild(newCol);
                    }
                    
                } else {
                    alertify.error(result.error)
               }
            });
            }
            , function () { alertify.error('Canceled') }
        );
    }

    //CHECK BOX ITEMS - ENABLE/DISABLE BULK DELETE
    if (ev.target.classList.contains('check_item')) {

        let checkBoxes = [];
        let rowCount = ev.target.parentNode.parentNode.parentNode.rows.length;

        //get all the check box
        for (let i = 0; i < rowCount; i++) { 
            checkBoxes.push(ev.target.parentNode.parentNode.parentNode.rows[i].cells[0].childNodes[0]);
        }

        if (ev.target.checked) { 
            bulkDelete.disabled = false;
        } else {
            let noCheckBoxChecked = 0;
    
            checkBoxes.forEach(item => {
                if (item.checked) noCheckBoxChecked += 1;
            });
    
            if (noCheckBoxChecked === 0) {
                bulkDelete.disabled = true;
                productContainer.querySelector('.bulk_check').checked = false;
            }
        }
    }

    // CHECK EACH CHECKBOX STATUS BY CHECKING THE BULK CHECK BOX
    if (ev.target.classList.contains('bulk_check')) {
        //get all the check box
        let checkBoxes = [];
        let rowCount = ev.target.parentNode.parentNode.parentNode.nextElementSibling.rows.length;

        for (let i = 0; i < rowCount; i++) { 
            checkBoxes.push(ev.target.parentNode.parentNode.parentNode.nextElementSibling.rows[i].cells[0].childNodes[0]);
        }

        if (ev.target.checked != true) {
            checkBoxes.forEach(checkBox => checkBox.checked = false);
            bulkDelete.disabled = true;
        } else {
            checkBoxes.forEach(checkBox => checkBox.checked = true);
            bulkDelete.disabled = false;
        }
    }

});

// BULK DELETE ITEMS
bulkDelete.addEventListener("click", function (ev) {
    ev.preventDefault();

    let itemArr = [];
    let itemsStr = "";

    let allCheckBoxes = productContainer.querySelectorAll('.check_item');
    allCheckBoxes.forEach(checkBox => {
        if (checkBox.checked) {
            const { id, title, featured_img } = checkBox.parentNode.parentNode.dataset; // tr
            itemArr.push({ id, featured_img });
            itemsStr = itemsStr + "• " + title + "<br>";
        }
    });

    if (itemArr.length > 0) {

        alertify.confirm('Delete Confirmation',
        `Are you sure you want to delete the following product:<br><br><b>${itemsStr}</b>`,
        function () {
            deleteProduct(itemArr).then(result => {
                // console.log(result);
                if (result?.success) {
                    alertify.success(result.success)

                    allCheckBoxes.forEach(checkBox => {
                        if (checkBox.checked) {
                            checkBox.parentNode.parentNode.remove(); //remove check row item from DOM
                        }
                    });

                    let tBody = document.querySelector('.product-list table tbody');
                    if (tBody.rows.length === 0) { 
                        let newCol = document.createElement('tr');
                        newCol.innerHTML = `<td colspan="7">Empty product list</td>`;
                        tBody.appendChild(newCol);
                        productContainer.querySelector('.bulk_check').checked = false;
                    }
                    
                } else {
                    alertify.error(result.error)
               }
            });
            }
            , function () { alertify.error('Canceled') }
        );

    }
    


});




/** ============================================= */
/** PRODUCT SEARCH */
/** ============================================= */
const form = document.querySelector('[data-search_form]');
form?.addEventListener("submit", ev => {
    document.querySelector('[data-check_all]').checked = false;
    searchProduct(form, ev)
});




