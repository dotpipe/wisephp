
function createBar() {

    if ("1" != getCookie('cookies'))
        return;
    child_of_P = document.getElementsByTagName("body").firstChild;
    div = document.createElement("div");
    p = document.createElement("p");
    w = window.innerWidth;
    p.setAttribute("style", "z-index:5;text-decoration:bold;margin-top:-8px;margin-left:-8px;height:60px;background-color:blue;width:" + w + ";text-align:center;");
    //p3.setAttribute("style", "float:justified");
    div.setAttribute("id","checkCookies");
    div.setAttribute("style", "height:60px;background-color:blue;margin-top:-8px;margin-left:-8px;width:" + w + ";text-align:justified;");
    innerSpan = (("<br/><b>This site uses cookies to better manage and inform users. Allow?</b> &nbsp;&nbsp;"));
    innerSpan += ("<button id=\"allow\" onclick=\"javascript:removeBar(this)\">Yes</button>");
    p.innerHTML = innerSpan + ("&nbsp;&nbsp;<button onclick=\"window.location='http://www.theonion.com/'\">No</button><br/>&nbsp;");
    //span.appendChild(p1);
    //span.appendChild(p2);
    div.appendChild(p);
    document.body.appendChild(div);
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  
  function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

  function removeBar(t) {
    setCookie(cookie, "1", 365);
    var x = document.getElementById('checkCookies');
    x.parentNode.removeChild(x);
  }