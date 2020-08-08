function loadScript(url, callback)
{

    // adding the script tag to the head as suggested before
   var head = document.getElementsByTagName('head')[0];
   var script = document.createElement('script');
   script.type = 'text/javascript';
   script.src = url;

   // then bind the event to the callback function 
   // there are several events for cross browser compatibility
   script.onreadystatechange = callback;
   script.onload = callback;

   // fire the loading
   head.appendChild(script);
}

/*
    Tags in script:
        pipe        = name of id
        ajax        = calls and returns this file's ouput
        file-order  = ajax to these files, iterating [0,1,2,3]%array.length
        index       = counter of which index to use with file-order to go with ajax
        goto        = follows this uri
        data-pipe   = name of class for multi-tag data (augment with pipe)
        multiple    = states that this object has two or more key/value pairs
        remove      = remove element in tag
        display     = toggle visible and invisible
        replace     = insert ajax callback return in this id
        !!! ALL HEADERS FOR AJAX are available. They will use defaults to
        !!! go on if there is no input to replace them.

*/

['click', 'touch', 'tap', 'keypress'].forEach(function(e) {
    window.addEventListener(e, function(ev) {
        var method_thru = "";
        var mode_thru = "";
        var cache_thru = "";
        var cred_thru = "";
        var content_thru = "";
        var redirect_thru = "";
        var refer_thru = "";
        var elem = document.getElementById(ev.target.id);

        if ((ev.target.className === null || ev.target.className === undefined) && (elem === null || elem === undefined)) {
            if (ev.target.onclick !== null && ev.target.onclick !== undefined)
                (ev.target.onclick)();
            //does not mix with href (but you can still use <a></a>)
            if (ev.target.href !== null && ev.target.href !== undefined)
                window.location.href = ev.target.href;
            return;
        }
        
        //use 'data-pipe' as the classname to require_once its value
        // specify which pipe with pipe="target.id"
        var elem_values = document.getElementsByClassName("data-pipe");
        var elem_qstring = "";
        // No 'pipe' means it is generic. This means it is open season for all with this class
        for (var i = 0; i < elem_values.length; i++) {

            //if this is designated as belonging to another pipe, it won't be passed in the url
            if (elem_values[i].hasAttribute("pipe") && elem_values[i].getAttribute("pipe") == elem)
                elem_qstring = elem_qstring + elem_values[i].name + "=" + elem_values[i].value + "&";
            // Multi-select box
            if (elem_values[i].hasAttribute("multiple")) {
                for (var o of elem_values.options) {
                    if (o.selected) {
                        elem_qstring = elem_qstring + elem_values[i].name + "=" + o.value + "&";
                    }
                }
            }
        }

        //strip last & char
        if (elem_qstring[elem_qstring.length - 1] === "&")
            elem_qstring = elem_qstring.substring(0, elem_qstring.length - 1);

        // if thru-pipe isn't used, then use goto
        if (!elem.hasAttribute("ajax")) {
            if (elem.hasAttribute("goto") && elem.getAttribute("goto") !== ""){
                window.location.href = elem.getAttribute("goto") + "?" + elem_qstring;
            }
            // Remove Object
            if (elem.hasAttribute("remove"))
            {
                var rem = elem.getAttribute("remove");
                if (document.getElementById(rem)) {
                    doc_set = document.getElementById(rem);
                    doc_set.remove();
                }
                doc_set.parentNode.removeChild(doc_set);
                    
            }
            // Toggle visibility of CSS display style of object
            if (elem.hasAttribute("display"))
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
            // Replace individual elements with others in an array
            return;
        }
        document.cookie = document.cookie  + "SameSite=Strict; Max-Age=2600000; Secure";
        // communicate properties of Fetch Request
        
        // updated "headers" attribute to more friendly "content-type" attribute
        (!elem.hasAttribute("content-type")) ? content_thru = '{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}': content_thru = elem.getAttribute("headers");
        
        opts = new Map();
        f = 0;
        
        ["method","mode","cache","credentials","content-type","redirect","referrer"].forEach(function(e,f) {
            let header_array = ["GET","no-cors","no-cache"," ",'{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}', "manual", "client"];

            if (elem.hasAttribute(e))
                opts.set(e, elem.getAttribute(e));
            else
                opts.set(e, header_array[f]);
            
        });
        
        console.log(opts);
        if (elem.hasAttribute("ajax") && elem.hasAttribute("file-order"))
        {
            string_to_array = elem.getAttribute("file-order");
            let strArray = string_to_array.split(",");
            console.log(strArray);
            integr = 0;
            if (!elem.hasAttribute("index"))
                elem.setAttribute("index", integr);
            else
            {
                integr = parseInt(elem.getAttribute("index")) + 1;
                elem.setAttribute("index", integr%strArray.length);
            }
            elem.setAttribute("ajax", strArray[integr%strArray.length].trim());
        }
        var opts_req = new Request(elem.getAttribute("ajax") + "?" + elem_qstring);
        opts.set('body', JSON.stringify(content_thru));
        const abort_ctrl = new AbortController();
        const signal = abort_ctrl.signal;
        var target__ = null;

        var pipe_back = "";
        // This is where the output will go. Indicates id attribute to aim at
        if (elem.hasAttribute("replace"))
            target__ = document.getElementById(elem.getAttribute("replace"));
        // This determines if the information will be passed back as a json
        if (elem.hasAttribute("json")) {
            target__ = document.getElementById(elem.getAttribute("json"));
            pipe_back = "json";
        }
        fetch(opts_req, {
            signal
        });

        setTimeout(() => abort_ctrl.abort(), 10 * 1000);
        const __grab = async (opts_req, opts) => {
            return fetch(opts_req, opts)
                .then(function(response) {
                    return response.text().then(function(text) {
                        // Make sure that the target out-pipe exists still
                        if (target__ != null && pipe_back != "json") {
                            let p = document.createElement("p");
                            p.innerText = text;
                            target__.insertBefore(p,target__.firstChild);
                        }
                        else if (target__ != null && pipe_back == "json") {
                            let v = JSON.parse(text);
                            return v;
                        }
                        return text;
                    });
                });
        }

        //  Insert a callback function by useing call-pipe
        const getActivity = async (opts_req, opts) => {
            let g = await __grab(opts_req, opts);
            if (elem.hasAttribute("callback")) {
                var t = elem.getAttribute("callback");
                return (t)(g);
            }
            return;
        }
        var s = getActivity(opts_req, opts);

        // to-pipe means, go here with current browser window
        // Only uses if thru-pipe exists. Unlike above.
        if (elem.hasAttribute("ajax") && elem.hasAttribute("goto"))
            window.location.href = elem.getAttribute("goto");
    }, false);
});