
// Begin with array as files variable of
// named files to be submitted to the carousel
function makeCarousel (files, leftScrollButtonImg, rightScrollButtonImg)
{
    // give the current elem a chance to figure its link
    var carousl = document.getElementById("carousel");
    
    if (carousl == undefined)
        return;
    var carousel = document.getElementById("carousel");
    carousel.innerHTML = '<table style="width:900px;height:70px;"><tbody><tr> \
    <td style="vertical-align:super;width:70;z-index:5"> \
    <img id="carousel-button-left" src="' + leftScrollButtonImg + '" onclick="carouselScrollLeft(this)"></td> \
    <td> \
    <p id="carousel-house" style="width:400px;display:table-layout;"> \
    <div id="carousel-window" style="display:table-row;"></div> \
    </p> \
    </td> \
    <td> \
    <img id="carousel-button-right" src="' + rightScrollButtonImg + '" onclick="carouselScrollRight(this)"></td> \
    </tr></tbody></table>';
    var house = document.getElementById("carousel-house");
    button = document.getElementById("carousel-button-right");
    button.position = "absolute";
    button.style.zIndex = 9999;
    button.left = 400 - 100;
    var cfiles = files[0];
    files.forEach((e,f) => {
        if (f == 0)
            return;
        cfiles = cfiles + ", " + e;
        return;
    });
    console.log(cfiles);
    var dom = document.getElementById("carousel-window");
    dom.setAttribute("ajax", cfiles);

    return;
}

function fillCarousel(file = null)
{
    var carousl = document.getElementById("carousel");
    
    if (carousl == undefined)
        makeCarousel("","adoms/src/icons/omniscroll.png","adoms/src/icons/omniscroll.png");

    var dom = document.getElementById("carousel-window");

    var str = (file != null) ? file : dom.getAttribute("ajax");

    
    var strArray = str.split(",");

    dom = dom;
    console.log(dom);
    while (dom.childElementCount > 0)
    {
        dom.removeChild(dom.lastChild);
    }
    
    strArray.forEach((e) => {

        var f = e;
        console.log(f.toString().trim());
        carouselInsert(f);
        carouselInsert(f);
        carouselInsert(f);
        carouselInsert(f);

    });

}

function carouselInsert(file) {

    elem = document.getElementById("carousel-window");
    

    opts = new Map();
    f = 0;

    //button.scrollY = elem.scrollY;
    ;

    ["method","mode","cache","credentials","content-type","redirect","referrer"].forEach((e,f) => {
        let header_array = ["GET","no-cors","no-cache"," ",'{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}', "manual", "client"];
        opts.set(e, header_array[f]);
    });

    content_thru = '{"Access-Control-Allow-Origin":"*","Content-Type":"text/html"}';
    var opts_req = new Request(file.toString(),opts);
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
                    elem = document.getElementById("carousel-window");
                    //  elem = elem.firstChild;
                    console.log(elem);
                    {
                        let div = document.createElement("div");
                        div.setAttribute("class", "carousel-cell");
                        div.style = "display:table-cell;";
                        div.innerHTML = text;
                        elem.appendChild(div);
                    }
                    return;
                });
            });
    }
    __grab(opts_req, opts);
}
