
'use strict'


/*** auto hide bs5 alerts */

setTimeout(function () {
    let alertList = document.querySelectorAll('.alertFlash');

    alertList.forEach(function (element) {

        bootstrap.Alert.getOrCreateInstance(element).close();
    })
}, 2000);