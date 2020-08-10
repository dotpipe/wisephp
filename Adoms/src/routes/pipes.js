/*
    Tags in script:
        pipe        = name of id
        ajax        = calls and returns this file's ouput
        file-order  = ajax to these files, iterating [0,1,2,3]%array.length
        index       = counter of which index to use with file-order to go with ajax
        redirect    = "follow" to go where the ajax says
        data-pipe   = name of class for multi-tag data (augment with pipe)
        multiple    = states that this object has two or more key/value pairs
        remove      = remove element in tag
        display     = toggle visible and invisible
        replace     = insert ajax callback return in this id
        insert      = same as replace
        json        = returning a JSON
        !!! ALL HEADERS FOR AJAX are available. They will use defaults to
        !!! go on if there is no input to replace them.
*/

function display(elem)
{
            // Toggle visibility of CSS display style of object
    if (elem.hasOwnProperty("display"))
    {
        var rem = elem.getAttribute("display");
        doc_set = document.getElementById(rem);
        if (document.getElementById(rem) && doc_set.style.display !== "none"){
            doc_set.style.display = "none";
        }
        else if (document.getElementById(rem) && doc_set.style.display === "none")
        {
            doc_set.style.display = "block";
        }
    }
}

function remove(elem)
{
    // Remove Object
    if (elem.hasOwnProperty("remove"))
    {
        var rem = elem.getAttribute("remove");
        if (document.getElementById(rem)) {
            doc_set = document.getElementById(rem);
            doc_set.remove();
        }
        doc_set.parentNode.removeChild(doc_set);
            
    }
}

function goto(elem) {

    elem = document.getElementById(elem.id);
    if (!elem || elem.hasOwnProperty("ajax") || elem.hasOwnProperty("insert"))
    {
        return -1;
    }
    else    if (elem.id.indexOf("carousel-table",0))
        return -1;
    
    elem = document.getElementById(elem.id);
    //use 'data-pipe' as the classname to include its value
    // specify which pipe with pipe="target.id"
    var elem_values = document.getElementsByClassName("data-pipe");
    var elem_qstring = "";

    // No 'pipe' means it is generic. This means it is open season for all with this class
    for (var i = 0; i < elem_values.length; i++) {
        //if this is designated as belonging to another pipe, it won't be passed in the url
        if (elem_values && !elem_values[i].hasOwnProperty("pipe") || elem_values[i].getAttribute("pipe") == elem.id)
            elem_qstring = elem_qstring + elem_values[i].name + "=" + elem_values[i].value + "&";
        // Multi-select box
        console.log(".");
        if (elem_values[i].hasOwnProperty("multiple")) {
            for (var o of elem_values.options) {
                if (o.selected) {
                    elem_qstring = elem_qstring + "&" + elem_values[i].name + "=" + o.value;
                }
            }
        }
    }

    console.log(elem.getAttribute("ajax") + "?" + elem_qstring.substr(1));
    elem_qstring = elem.getAttribute("ajax") + "?" + elem_qstring.substr(1);
    window.location.href = elem_qstring;
}

['click', 'touch', 'tap', 'keypress'].forEach(function(e) {
    window.addEventListener(e, function(ev) {

        const elem = ev.target;
        if (-1 == goto(elem))
            classToAJAX(elem);
        notify();
    }, false);
    
});

function makeCarousel (file)
{
    // give the current elem a chance to figure its link
    var carousl = document.getElementById("carousel");
    
    if (carousl == undefined)
        return;
    
    var carousel = document.getElementById("carousel");

    carousel.innerHTML = '<table style="width:500;height:150;background-color:black;color:white;" id="carousel-table" ajax="' + file + '"><tr></tr></table>';
    return;
}

function carouselInsert() {

    elem = document.getElementById("carousel-table");

    opts = new Map();
    f = 0;

    ["method","mode","cache","credentials","content-type","redirect","referrer"].forEach((e,f) => {
        let header_array = ["GET","no-cors","no-cache"," ",'{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}', "manual", "client"];

        opts.set(e, header_array[f]);
        
    });

    content_thru = '{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}';
    var opts_req = new Request(elem.getAttribute("ajax"));
    opts.set('body', JSON.stringify({"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}));
    const abort_ctrl = new AbortController();
    const signal = abort_ctrl.signal;

    setTimeout(() => abort_ctrl.abort(), 10 * 1000);
    const __grab = async (opts_req, opts) => {
        return fetch(opts_req, opts)
            .then(function(response) {
                return response.text().then(function(text) {
                    if (response.status == 404)
                        return;
                    if (elem.firstChild.childElementCount == 2)
                    {
                        let td = document.createElement("td");
                        td.innerHTML = '<p>' + text + '</p>';
                        td.style.position = "relative";
                        elem.firstChild.appendChild(td);
                    }
                    else
                    {
                        let td = document.createElement("td");
                        td.innerHTML = '<p>' + text + '</p>';
                        td.style.position = "relative";
                        elem.firstChild.insertBefore(td,elem.firstChild.lastChild);
                    }
                    return;
                });
            });
    }
    __grab(opts_req, opts);
}

function notify() {

    elem = document.getElementsByTagName("blinkbox")[0];

    opts = new Map();
    f = 0;

    ["method","mode","cache","credentials","content-type","redirect","referrer"].forEach((e,f) => {
        let header_array = ["GET","no-cors","no-cache"," ",'{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}', "manual", "client"];

        opts.set(e, header_array[f]);
        
    });

    
    if (!elem.hasOwnProperty("index") && !elem.hasAttribute("index"))
        elem.setAttribute("index","0");

    var x = parseInt(elem.getAttribute("index"));
    var f = elem.getAttribute("file-order");
    var strArray = f.split(",");
    console.log(strArray);
    elem.setAttribute("ajax", strArray[x%strArray.length].trim());
    x++;
    elem.setAttribute("index", x.toString(10));
    console.log(x);
    
    content_thru = '{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}';
    var opts_req = new Request(elem.getAttribute("ajax"));
    opts.set('body',  JSON.stringify({"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}));
    const abort_ctrl = new AbortController();
    const signal = abort_ctrl.signal;

    target__ = "blinkbox";
    
    setTimeout(() => abort_ctrl.abort(), 10 * 1000);
    const __grab = async (opts_req, opts) => {
        return fetch(opts_req, opts)
            .then(function(response) {
                if (response.status == 404)
                        return;
                return response.text().then(function(text) {
                
                    if (undefined == document.getElementsByTagName("blinkbox")[0]) {

                        ppr = document.createElement("blinkbox");
                        ppr.style.position = "absolute";
                        ppr.style.backgroundColor = "navy";
                        ppr.style.wordwrap = true;
                        ppr.style.width = window.innerWidth / 4;
                        ppr.style.zIndex = 3;
                        ppr.setAttribute("notify-ms",3000);
                        document.body.insertBefore(ppr,document.body.firstChild);
                    }
                    else {
                        ppr = document.getElementsByTagName("blinkbox")[0];
                    }
                        let p = document.createElement("p");
                        p.innerText = text;
                        p.style.position = "relative";
                        p.setAttribute("onclick", "this.remove()");
                        ppr.insertBefore(p,ppr.firstChild);
                    var xy = parseInt(elem.getAttribute("notify-ms"));
                    setTimeout(function() {
                        if (ppr.childElementCount > 0)
                            ppr.removeChild(ppr.lastChild);
                    }, xy);
                    return;
                });
            });
    }
    __grab(opts_req, opts);
}

function classToAJAX(elem) {

    
    if (!elem)
        return;

    opts = new Map();
    f = 0;

    ["method","mode","cache","credentials","content-type","redirect","referrer"].forEach((e,f) => {
        let header_array = ["GET","no-cors","no-cache"," ",'{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}', "manual", "client"];

        opts.set(e, header_array[f]);
        
    });

    content_thru = '{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}';
    var opts_req = new Request(elem.getAttribute("ajax"));
    opts.set('body', JSON.stringify({"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}));
    const abort_ctrl = new AbortController();
    const signal = abort_ctrl.signal;
    
    setTimeout(() => abort_ctrl.abort(), 10 * 1000);
    const __grab =  (opts_req, opts) => {
        return fetch(opts_req, opts)
            .then(function(response) {
                if (response.status == 404)
                    return;
                return response.text().then(function(text) {
                    {
                        let td = '<p>' + text + '</p>';
                        document.getElementById(elem.getAttribute("insert")).innerHTML = td;
                    }
                    return;
                });
            });
    }
    __grab(opts_req, opts);
}

function rem(elem)
{
    elem.remove();
}

function carouselScrollLeft(elem) {

    elem.scrollX -= 150;

}

function carouselScrollRight(elem) {

    elem.scrollX += 150;

}

function carouselXPos(elem) {
    return elem.offsetLeft;
}