"use strict";

/** IMPORT MODULES */
import {
    strip_tags,
    ajax
} from "./utils.js";

const quoteListContainer = document.querySelector(".quote-list");
const bulkDelete = document.querySelector('[data-bulk_delete]');
const btnSearch = document.querySelector('[data-btn_search]');

quoteListContainer?.addEventListener("click", (ev) => {
   
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
                quoteListContainer.querySelector('[data-bulk_check]').checked = false;
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

    // DELETE SELECTED SINGLE PRODUCT
    if (ev.target.matches('[data-delete_btn]')) {

        const { id, name } = ev.target.parentNode.parentNode.parentNode.dataset;

        alertify.confirm('Delete Confirmation',
        `Are you sure you want to delete the request of "<b>${name}</b>"`,
            function () {
                handleDelete([id]).then(result => {
                
                alertify.set("notifier", "position", "top-right");
                if (result?.success) {
                    alertify.success(result.success)

                    ev.target.parentNode.parentNode.parentNode.remove(); //remove item from DOM

                    const tBody = document.querySelector('.quote-list table tbody');
                    if (tBody.rows.length === 0) { 
                        let newCol = document.createElement('tr');
                        newCol.innerHTML = `<td colspan="11" align="center">No quote received</td>`;
                        tBody.appendChild(newCol);
                        quoteListContainer.querySelector('[data-bulk_check]').checked = false;
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

btnSearch.addEventListener("click", (ev) => {
    ev.preventDefault();
    handleSearchQuote();
});

/** delete all selected items */
bulkDelete?.addEventListener("click", function (ev) {
    ev.preventDefault();

    let itemArr = [];
    let itemsStr = "";

    const allCheckBoxes = quoteListContainer.querySelectorAll('[data-check_item]');
    allCheckBoxes.forEach(checkBox => {
        if (checkBox.checked) {
            const { id, name } = checkBox.parentNode.parentNode.dataset; // tr
            itemArr.push(id);
            itemsStr = itemsStr + "• " + name + "<br>";
        }
    });

    console.log(itemArr.length);

    if (itemArr.length > 0) {

        alertify.confirm('Delete Confirmation',
        `Are you sure you want to delete the following request:<br><br><b>${itemsStr}</b>`,
            function () {
                handleDelete(itemArr).then(result => {
                
                alertify.set("notifier", "position", "top-right");
                if (result?.success) {
                    alertify.success(result.success)

                    allCheckBoxes.forEach(checkBox => {
                        if (checkBox.checked) {
                            checkBox.parentNode.parentNode.remove(); //remove check row item from DOM
                        }
                    });

                    const tBody = document.querySelector('.quote-list table tbody');
                    if (tBody.rows.length === 0) { 
                        let newCol = document.createElement('tr');
                        newCol.innerHTML = `<td colspan="11" align="center">No quote received</td>`;
                        tBody.appendChild(newCol);
                        quoteListContainer.querySelector('[data-bulk_check]').checked = false;
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

/** handle search request */
const handleSearchQuote = () => {

    const { search_key } = document.querySelector('[data-search_form]');
    
    if (search_key.value.trim() === "") {
        alertify.set("notifier", "position", "top-right");
        alertify.error("Empty search box");
        search_key.focus();
        return;
    }

    const formData = new FormData();

    formData.append('search_key', strip_tags(search_key.value));

    ajax({
        url: "search-quote-request",
        headers: {
            body: formData,
            method: "POST",
            contentType: false,
        },
        success(data) { 
            
            let quoteTable = document.querySelector('.quote-list table');
           
            //remove all rows
            while (quoteTable.rows.length > 1) {
                quoteTable.deleteRow(1);
            }

            if (data.length > 0) {

                // Re-render search to DOM
                data.forEach(item => {

                    let newCol = document.createElement('tr');
                    newCol.setAttribute('data-id', item.id);
                    newCol.setAttribute('data-name', item.name);

                    newCol.innerHTML = `
                        <td><input class="check_item" type="checkbox" name="check" data-check_item="${item.id}"></td>
                        <td>${item.name}</td>
                        <td>${item.email}</td>
                        <td>${item.contact_number}</td>
                        <td>${item.company}</td>
                        <td>${item.address}</td>
                        <td>${item.product}</td>
                        <td>${item.quantity}</td>
                        <td>${item.details}</td>
                        <td>${new Date(item.time_stamp).toLocaleDateString()} ${new Date(item.time_stamp).toLocaleTimeString()}</td>
                        <td><p class="${item.read_status == 0 ? 'UNREAD' : 'READ'}">${item.read_status == 0 ? 'UNREAD' : 'READ'}</p></td>
                        <td>
                            <div>
                                <a href="'. APP_URL .'edit-product/'.  $item->id .'" class="primary-action-btn expand-on-hover">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
                                        <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                                    </svg>
                                </a>
                                <button class="primary-action-btn danger expand-on-hover" data-delete_btn>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                        <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                    </svg>
                                </button>
                            </div>
                        </td>`;
                        
                    quoteTable.querySelector('tbody').appendChild(newCol);
                });

            } else {

                let newCol = document.createElement('tr');
                newCol.innerHTML = `
                    <td colspan="12" align="center">No quote received</td>`;
                quoteTable.querySelector('tbody').appendChild(newCol);
            }
        },
        error(err) {
            console.log(err);
        }
    })
}

const handleDelete = async (itemArr) => {
    let endPoint = './delete-quote-request';
    const formData = new FormData();

    itemArr.forEach(item => formData.append('id[]', item));

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