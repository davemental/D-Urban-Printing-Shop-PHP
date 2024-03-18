"use strict";

// change header height when scrolling
const scrollFunction = () => {
    let main = document.querySelector("[data-main]").offsetTop;
    let imageLogo = document.querySelector("[data-image-logo]");

    if (document.body.scrollTop > main || document.documentElement.scrollTop > main) {
        imageLogo.classList.add("image-scrolled");
    } else {
        imageLogo.classList.remove("image-scrolled");
    }
}

/** this function strips all html tag and return string with alpha numeric value */
const strip_tags = (str, allow) => {
    // making sure the allow arg is a string containing only tags in lowercase (<a><b><c>)
    allow = (((allow || '') + '').toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join('');
   
    var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi;
    var commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    return str.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {
    return allow.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 :'';
    });
}

/** accept string and remove all special characters and return alpha numeric characters */
const removeSpecials = (str) => {
    return str.replace(/[^\p{L}\d\s]+/gu, "");
};

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

function debounce(callback, wait) {
    let timeout;
    return (...args) => {
        clearTimeout(timeout);
        timeout = setTimeout(function () { callback.apply(this, args); }, wait);
    };
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

const isUserNameValid = (username) => {
    /* 
      Usernames can only have: 
      - Lowercase Letters (a-z) 
      - Numbers (0-9)
      - Dots (.)
      - Underscores (_)
    */
    const res = /^[a-z0-9_\.]+$/.exec(username);
    const valid = !!res;
    return valid;
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
    removeSpecials,
    humanReadableTime,
    addEventOnElements,
    ajax,
    debounce,
    showAlert,
    changeActiveStatusOfMainNav,
    isUserNameValid
}