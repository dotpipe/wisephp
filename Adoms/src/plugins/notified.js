
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
    
    if (!document.body.contains(elem))
        return;
    content_thru = '{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}';
    var opts_req = new Request(elem.getAttribute("ajax"), opts);
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
                        if (document.body.contains(p))
                            ppr.removeChild(ppr.lastChild);
                    }, xy);
                    return;
                });
            });
    }
    __grab(opts_req, opts);
}
