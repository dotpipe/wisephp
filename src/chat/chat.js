function getChatSock() {
    var evtSrc = new EventSource("chat/mysqli_connect(localhost,root,'',adrs,3306)");


    if (document.getElementById("startchat").getAttribute("loaded") == "0") { // Listen for messages/events on the EventSource
        evtSrc.onmessage = function (e) {
            callPage();
        }
        evtSrc.addEventListener("open", function (e) {
            callPage();
        }, false);
    } else {
        evtSrc.removeEventListener("open", this);
        evtSrc.close();
    }
}
// Functions to display the messages

function callRequest(th, str, redirect = "index.php") {

    varxhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // setCookie("aliases",this.response,1);
            // console.log(this.response);
            listConvoFunc(th, this.response, redirect) //
        }
    };
    xhttp.open("GET", str, false);
    xhttp.send();
}

function listConvo(th, redirect = "index.php") {
    callRequest(th, "chat/chataliases.php?c=1", redirect);
}

function getOption(x) {
    var idx = x.options[x.selectedIndex];
    var str = getCookie("chataddr");
    if (idx.value !== getCookie("chataddr")) 
        str = idx.value;
    
    setCookie("nodeNo", x.selectedIndex);
    setCookie("chataddr", str);
    getChatSock();
    callPage(x);
}

function callFile(str) {

    varxhttp = new XMLHttpRequest();
    xhttp.open("GET", str, false);
    xhttp.send();
}

function listConvoFunc(dom, alias, chat_redirect) {

    if (getCookie("login") !== "true") {
        window.location = chat_redirect;
        return;
    }
    alias = alias.substring(1, alias.length - 1);
    alias = alias.split(",");
    varx = document.getElementById(dom);
    varh = 0;
    while (x.childElementCount > h ++) {
        x.removeChild(x.firstChild);
    }

    if (alias[0] === "") {
        x.options[0] = new Option("You have 0 people to chat with.", "");
        return;
    }
    x.options[0] = new Option("You have " + alias.length + " people to chat with!", "");
    if (alias.length == 1) {
        console.log(alias);
        x.options[1] = new Option(alias, alias);
    } else {
        for (vari = 0; i < alias.length; i ++) 
            x.options[i + 1] = new Option(alias[i].substr(1, alias[i].length - 2), alias[i].substr(1, alias[i].length - 2));
    }
}

function pipeXSLT(dom, x) {

    var xsltProcessor = new XSLTProcessor();
    var myXMLHTTPRequest = new XMLHttpRequest();
    myXMLHTTPRequest.open("GET", "./xml_files/chatxml.xsl", false);
    myXMLHTTPRequest.send(null);

    xslStylesheet = myXMLHTTPRequest.responseXML;
    xsltProcessor.importStylesheet(xslStylesheet);

    // load the xml file, example1.xml
    myXMLHTTPRequest = new XMLHttpRequest();
    myXMLHTTPRequest.open("GET", x, false);
    myXMLHTTPRequest.send(null);
    xmlDoc = myXMLHTTPRequest.responseXML;

    var fragment = xsltProcessor.transformToFragment(xmlDoc, document);

    document.innerHTML = fragment;
    console.log();
    document.getElementById(dom).appendChild(fragment);
    
}

function goCheri(i, j) {
    if (j == 13) {
      var y = i.cloneNode();
      i.value = "";
      var v = y.value;
      var t = "";
  
      t = v.replace(/\b(?:slut|fuck|fucking|fuckin|whore|asshole?|tard|fucker|nigger|blackie|queer|noose|slave|retard|shit|ass|damn?|anal|sex|bitch|twat|cunt|fag|faggot|fags|faggots|dick|dicks|penis|porno?|pussy?|pussies|vagina|crack|cocaine|heroin|motherfucker|bullshit)\b/ig, "CENSORED");
  
      var x = document.getElementById("in-window");
      x.offsetTop = x.childElementCount * 20;
  
      // Get current username
      var z = document.getElementById("Cheriters");
      var idx = z.options[getCookie("nodeNo")];
      z.selectedIndex = getCookie("nodeNo");
      var str = idx.value;
      getConduct();
      // Check cuss filter and if they are allowing it
      if (getCookie("conductOn") == 1 && t.toUpperCase() != v.toUpperCase()) {
        callFile("Cheri/Cherialiases.php?c=4&d=" + str + "&a=" + v);
        callFile("Cheri/Cheri.php?a=" + t + "&d=" + str);
        callPage(str);
      }
      else {
        callFile("Cheri/Cherialiases.php?c=1&d=" + str);
        callFile("Cheri/Cheri.php?a=" + y.value + "&d=" + str);
        callPage(str);
      }
    }
  }
  
function setConduct(th) {

    var z = document.getElementById("Cheriters");
    var idx = z.options[getCookie("nodeNo")];
    z.selectedIndex = getCookie("nodeNo");
    var str = idx.value;
  
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        setCookie("conductOn", this.responseText);
  
      }
    };
    xhttp.open("GET", "Cheri/Cherialiases.php?c=5&d=" + str, false);
    xhttp.send();
  
    if (getCookie("conductOn") == 0)
      th.style.color = "red";
    else
      th.style.color = "green";
  }

  function flagComment(r_val) {

    var z = document.getElementById("Cheriters");
    var idx = z.options[getCookie("nodeNo")];
    z.selectedIndex = getCookie("nodeNo");
    var str = idx.value;
  
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
  
      }
    };
    var tyd = r_val.parentNode.previousElementSibling;
  
    console.log(r_val.parentNode.previousElementSibling);
    xhttp.open("GET", "Cheri/Cherialiases.php?c=6&d=" + str + "&msg=" + tyd.innerHTML + "&time=" + tyd.getAttribute("time"), false);
    xhttp.send();
    console.log(getCookie("conductOn"));
  }

  function getConduct() {

    var z = document.getElementById("Cheriters");
    var idx = z.options[getCookie("nodeNo")];
    z.selectedIndex = getCookie("nodeNo");
    var str = idx.value;
  
    var xhttp = new XMLHttpRequest();
    var r_val = "";
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        setCookie("conductOn", this.responseText);
        return this.responseText;
      }
    };
    xhttp.open("GET", "Cheri/Cherialiases.php?c=3&d=" + str, false);
    xhttp.send();
    console.log(getCookie("conductOn"));
  }
      