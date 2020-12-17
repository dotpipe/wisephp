function filler()
{

    elem = document.getElementsByClassName("content-fill");
    
    Array(elem).forEach((e,f) => {
        opts = new Map();
        f = 0;
        console.log("!!!" + e[f]);
        ["method","mode","cache","credentials","content-type","redirect","referrer"].forEach((e,f) => {
            let header_array = ["GET","no-cors","no-cache"," ",'{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}', "manual", "client"];
            opts.set(e[f], header_array[f]);
        });

        content_thru = '{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}';
        var opts_req = new Request(e[f].getAttribute("inject").toString(),opts);
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
                        e[f].innerHTML = "<b>" + text + "</b>";
                        return;
                    });
                });
        }
        __grab(opts_req, opts);
    });
}