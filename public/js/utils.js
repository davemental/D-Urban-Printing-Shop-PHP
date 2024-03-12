"use strict";

// change header height when scrolling
const scrollFunction = () => {
    let header = document.querySelector("[data-header]");
    let main = document.querySelector("[data-main]").offsetTop;
    let imageLogo = document.querySelector("[data-image-logo]");

    if (document.body.scrollTop > main || document.documentElement.scrollTop > main) {
        header.classList.add("header-scrolled");
        imageLogo.classList.add("image-scrolled");
    } else {
        header.classList.remove("header-scrolled");
        imageLogo.classList.remove("image-scrolled");
    }
}

// window.onscroll = () => scrollFunction();

const strip_tags = (str, allow) => {
    // making sure the allow arg is a string containing only tags in lowercase (<a><b><c>)
    allow = (((allow || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');
   
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
    var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
    return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 :'';
    });
}

const humanReadableTime = (date) => {
    
    // in miliseconds
    var units = {
        year  : 24 * 60 * 60 * 1000 * 365,
        month : 24 * 60 * 60 * 1000 * 365/12,
        day   : 24 * 60 * 60 * 1000,
        hour  : 60 * 60 * 1000,
        minute: 60 * 1000,
        second: 1000
    }
    
    var rtf = new Intl.RelativeTimeFormat('en', { numeric: 'auto' })
    
    var getRelativeTime = (d1, d2 = new Date()) => {
        var elapsed = d1 - d2
    
        // "Math.abs" accounts for both "past" & "future" scenarios
        for (var u in units) 
        if (Math.abs(elapsed) > units[u] || u == 'second') 
            return rtf.format(Math.round(elapsed/units[u]), u)
    }
    
    // console.log(date);

    return getRelativeTime(+new Date(date));
}

const addEventOnElements = ($elements, eventType, callback) => {
    $elements?.forEach(($element) => {
        $element.addEventListener(eventType, callback);
    })
}

const ajax = async (config) => {
    try {
        const request = await fetch(config.url, config.headers);
        const response = await request.json();
        config.success(response);
    } catch(err) {
        config.error(err);
    }
}

const deleteProduct = async (itemArr) => {
    let endPoint = '';
    const url = window.location.href;
    const formData = new FormData();

    Array.prototype.forEach.call(itemArr, item => {
        formData.append('id[]', item.id);
        formData.append('featured_img[]', item.featured_img);
    });
  
    if (url.includes('page')) {
        endPoint = '../delete-product';
    } else {
        endPoint = 'delete-product';
    }

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
const searchProduct = () => {

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
                                <a href="${data["app_url"]}edit-product/${item.id}" class="primary-action-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15">
                                        <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/>
                                    </svg>
                                </a>
                                <button class="primary-action-btn delete_btn" data-delete_btn>
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
                    <td colspan="7">No results found<br>
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

const showAlert = (title,message) => {
    alertify.alert()
    .setting({
    'title': title,
        'message': `${message}`,
    
        notifier: {
            delay: 5,
            closeButton: false,
        }
}).show();
}

const changeActiveStatusOfMainNav = () => {
    const url = window.location.href;
    document.querySelectorAll("[data-main_nav]").forEach(elem => {
    
        if (elem.href == url) {
            elem.classList.add('active');
        } else if (url.includes("add-product") &&  elem.href.includes("manage-products")) {
            elem.classList.add('active');
        } else if (url.includes("edit-product") && elem.href.includes("manage-products")) {
            elem.classList.add('active');
        } else {
            elem.classList.remove('active');
        }
    });

}


export {
    scrollFunction,
    strip_tags,
    humanReadableTime,
    addEventOnElements,
    ajax,
    deleteProduct,
    searchProduct,
    showAlert,
    changeActiveStatusOfMainNav
}