"option strict";

import {
    humanReadableTime,
    strip_tags,
    ajax
} from "./utils.js";

const productContainer = document.querySelector(".product-list");
const bulkDelete = document.querySelector('[data-bulk_delete]');
const btnSearch = document.querySelector('[data-btn_search]');

window.onload = () => { //  change date format to human readable
    const $date_entries = document.querySelectorAll('[data-date_entry]');
    $date_entries?.forEach(entry => {
        entry.innerHTML = humanReadableTime(entry.getAttribute('data-date_entry'))
    })
}

productContainer?.addEventListener('click', function (ev) {
    ev.stopImmediatePropagation();

    // DELETE SELECTED SINGLE PRODUCT
    if (ev.target.matches('[data-delete_btn]')) {

        const { id, title, featured_img } = ev.target.parentNode.parentNode.parentNode.dataset;

        alertify.confirm('Delete Confirmation',
        `Are you sure you want to delete "<b>${title}</b>"`,
        function () {
            handleProductDelete([{ id, featured_img }]).then(result => {
                
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
            handleProductDelete(itemArr).then(result => {
                
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
btnSearch?.addEventListener('click', ev => {
    ev.preventDefault();
    handleProductSearch();
});

/** delete product function */
const handleProductDelete = async (itemArr) => {
    let endPoint = './delete-product';
    const formData = new FormData();

    Array.prototype.forEach.call(itemArr, item => {
        formData.append('id[]', item.id);
        formData.append('featured_img[]', item.featured_img);
    });
  
    // return the promise
    return fetch(endPoint, {
        body: formData,
        method: "POST",
    }).then(res => res.json()).then(res => {
        return res;
    }).catch(err => {
        console.log(err)
        return err;
    });
}

// PRODUCT SEARCHING
const handleProductSearch = () => {

    const { product_key } = document.querySelector('[data-search_form]');
    
    if (product_key.value.trim() === "") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Empty search box");
        product_key.focus();
        return;
    }

    const formData = new FormData();
    formData.append('product_key', strip_tags(product_key.value));

    ajax({
        url: "search-product",
        headers: {
            body: formData,
            method: "POST",
            contentType: false,
        },
        success(data) { 
            
            let productTable = document.querySelector('.product-list table');
           
            //remove all rows
            while (productTable.rows.length > 1) {
                productTable.deleteRow(1);
            }

            if (data["products"].length > 0) {

                // Re-render search to DOM
                data["products"].forEach(item => {

                    let newCol = document.createElement('tr');
                    newCol.setAttribute('data-id', item.id);
                    newCol.setAttribute('data-title', item.title);
                    newCol.setAttribute('data-featured_img', item.featured_img);

                    newCol.innerHTML = `
                        <td><input class="check_item" type="checkbox" name="check"></td>
                        <td>${item.id}</td>
                        <td>${item.title}</td>
                        <td>${strip_tags(item.description)} </td>
                        <td><img src="${data["app_url"]}/public/images/uploads/products/${item.featured_img}" alt="" /></td>
                        <td>${humanReadableTime(item.date_entry)}</td>
                        <td>
                            <div>
                                <a href="${data["app_url"]}edit-product/${item.id}" class="primary-action-btn expand-on-hover">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
                                    </svg>
                                </a>
                                <button class="primary-action-btn danger expand-on-hover" data-delete_btn>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                        <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                    </svg>
                                </button>
                            </div>
                        </td>`;
                        
                    productTable.querySelector('tbody').appendChild(newCol);
                });

            } else {

                let newCol = document.createElement('tr');
                newCol.innerHTML = `
                    <td colspan="7" align="center">No results found<br>
                    Try different or more general keywords</td>
                `;
                productTable.querySelector('tbody').appendChild(newCol);
            }
        },
        error(err) {
            console.log(err);
        }
    })
}


