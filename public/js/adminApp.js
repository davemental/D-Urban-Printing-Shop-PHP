"option strict";

import {
    humanReadableTime,
    deleteProduct,
    searchProduct,
    changeActiveStatusOfMainNav,
} from "./utils.js";

const productContainer = document.querySelector(".product-list");
const bulkDelete = document.querySelector('[data-bulk_delete]');
const $date_entries = document.querySelectorAll('[data-date_entry]');

/** change main navigation background color when current */
window.onload = () => changeActiveStatusOfMainNav();

// get all date and convert to human readable format
$date_entries?.forEach(entry => entry.innerHTML = humanReadableTime(entry.getAttribute('data-date_entry')))


productContainer?.addEventListener('click', function (ev) {
    ev.stopImmediatePropagation();

    // DELETE SELECTED SINGLE PRODUCT
    if (ev.target.matches('[data-delete_btn]')) {

        const { id, title, featured_img } = ev.target.parentNode.parentNode.parentNode.dataset;

        alertify.confirm('Delete Confirmation',
        `Are you sure you want to delete "<b>${title}</b>"`,
        function () {
            deleteProduct([{ id, featured_img }]).then(result => {
                
                alertify.set("notifier", "position", "top-right");
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
            , function () {
                alertify.set("notifier", "position", "top-right");
                alertify.error('Canceled')
            }
        );
    }

    //CHECK BOX ITEMS - ENABLE/DISABLE BULK DELETE
    if (ev.target.matches('[data-check_item]')) {

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
                productContainer.querySelector('[data-bulk_check]').checked = false;
            }
        }
    }

    // CHECK EACH CHECKBOX STATUS BY CHECKING THE BULK CHECK BOX
    if (ev.target.matches('[data-bulk_check]')) {
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
bulkDelete?.addEventListener("click", function (ev) {
    ev.preventDefault();

    let itemArr = [];
    let itemsStr = "";

    let allCheckBoxes = productContainer.querySelectorAll('[data-check_item]');
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
                
                alertify.set("notifier", "position", "top-right");
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
                        productContainer.querySelector('[data-bulk_check]').checked = false;
                    }
                    
                } else {
                    alertify.error(result.error)
               }
            });
            }
            , function () {
                alertify.set("notifier", "position", "top-right");
                alertify.error('Canceled')
            }
        );

    }
    


});

/** product search */
const btnSearch = document.querySelector('[data-btn_search]');
btnSearch?.addEventListener('click', ev => {
    ev.preventDefault();
    searchProduct();
});
