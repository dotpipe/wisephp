
function choseKeyword(keywrd) {
    if (keywrd === "")
      return;
    document.getElementById("div-keys").style.display = "visible";
    var div_out = document.createElement("div");
    div_out.style = 'margin:3px;border-right:2px solid white;background:lightblue;border-radius:10px;color:black;width:55px;font-size:12px;display:table-cell;height:13px;vertical-align:middle;';
    var div_word = document.createElement("div");
    div_word.style = 'margin:3px;width:45px;background:lightblue;display:table-cell;font-size:10px;padding:0px;';
    div_word.innerHTML = keywrd;
    div_out.appendChild(div_word);
    var div_hid = document.createElement("input");
    div_hid.type = "hidden";
    div_hid.className = 'key-names';
    div_hid.value = keywrd;
    div_hid.name = "key" + (document.getElementsByClassName("key-names").length + 1);
    div_word.appendChild(div_hid);
    var div_final = document.createElement("div");
    div_final.style = 'background:lightblue;display:table-cell;font-size:10px;padding:0px';
    div_final.setAttribute("onclick", "insertTagInput();this.parentNode.parentNode.removeChild(this.parentNode);");
    div_final.innerHTML = "&times;";
    div_out.appendChild(div_final);
    document.getElementById("keywrds").insertBefore(div_out, document.getElementById("keywrds").lastChild);
    document.getElementById("insWrd").value = "";
  }
  

function keywordLookup(keys, j) {
    var dense = keys.value.length;
    term = keys.value;
    if (dense >= 12)
      keys.value = term.substr(0, 12);
    if (dense < 2) {
      var z = document.getElementById("div-keys");
      z.removeChild(z.firstChild);
    }
    if (j == 13) {
      term = term.replace(/\b(?:slut|fuck?|whore|asshole|tard|fucker|nigger|blackie|queer|noose|slave|retard|shit|ass|damn?|anal|sex|bitch|twat|cunt|fag|faggot|dick|penis|porno?|?pussy?|vagina|crack|cocaine|heroin|motherfucker)\b/ig, '');
      if (term.length < dense || term == undefined) {
        alert("Watch it, bud");
        keys.value = "";
        return;
      }
      keys.value = "";
      setCookie("word", term);
      def = term;
      def = def;
      var urlstr = "data/keyword.php?b=2&str=";
  
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          var g = this.responseText;
          if (g === undefined || g === "") {
            document.getElementById("insWrd").value = "";
            newWord(def);
            return;
          }
          var h = document.getElementById('div-keys');
          h.innerHTML = g;
          keys.value = "";
        }
      };
      xhttp.open("GET", urlstr + def, false);
      xhttp.send();
      if (document.getElementById("keywrds").childElementCount > 4)
        document.getElementById("insWrd").parentNode.removeChild(document.getElementById("insWrd"));
      choseKeyword(def);
      document.getElementById("insWrd").value = "";
      return;
    }
  }

function insertTagInput() {

    var y = document.getElementsByClassName("key-names");
    var z = document.getElementById("div-keys");
    if (z.hasChildNodes()) {
      for (var i = 0; i < y.length; i++) {
        if (z.firstChild.firstChild.innerHTML.toUpperCase() == y[i].value.toUpperCase()) {
          z.removeChild(z.firstChild);
          break;
        }
      }
    }
    if (document.getElementById("keywrds").lastChild.tagName == "INPUT")
      return;
    var x = document.createElement("input");
    x.setAttribute("id", "insWrd");
    x.style = 'display:table-cell;width:100%;color:black;border-radius:10px;border:0px solid white;';
    x.setAttribute("onkeypress", 'keywordLookup(this,event.keyCode);');
    document.getElementById("keywrds").append(x);
  
  }

  function newWord(indef) {
    if (indef === "" || indef === undefined)
      return;
    if (document.getElementById("div-keys").childElementCount > 0)
      document.getElementById("div-keys").removeChild(document.getElementById("div-keys").firstChild);
    var block = document.createElement("div");
    block.id = "defineKey";
    var keyword = document.createElement("div");
    keyword.id = "word";
    keyword.style = "width:50%;font-size:14px;text-decoration:bold;";
    keyword.innerHTML = indef;
    block.append(keyword);
    var rowhr = document.createElement("div");
    var hr = document.createElement("hr");
    rowhr.append(hr);
    block.append(rowhr);
    var inputdiv = document.createElement("div");
    inputdiv.style = "vertical-align:middle;display:table;width:100%;";
    var inputdef = document.createElement("input");
    inputdef.id = "insDef";
    inputdef.style = "display:table-cell;width:90%;color:black;border-radius:10px;border:0px solid white;";
    inputdef.type = "text";
    inputdef.max = "50";
    inputdef.min = "15";
    inputdiv.append(inputdef);
    var button = document.createElement("div");
    button.style = "font-size:19px;background:black;display:table-cell;color:green";
    button.name = "accept";
    button.innerHTML = "&check;";
    button.setAttribute("onclick", "defineWord(this)");
    inputdiv.append(button);
    block.append(inputdiv);
    document.getElementById("div-keys").append(block);
  }
  
  function defineWord(t) {
    if (t.tagName !== "DIV" && t.name !== "accept")
      return;
    var deflen = document.getElementById("insDef").value.length;
    var indef = document.getElementById("insDef").value;
    var def = indef.replace(/\b(?:slut|fuck?|whore|asshole|tard|fucker|nigger|blackie|queer|noose|slave|retard|shit|ass|damn?|anal|sex|bitch|twat|cunt|fag|faggot|dick|penis|porno?|?pussy?|vagina|crack|cocaine|heroin|motherfucker)\b/ig, '');
    if (def.length < deflen) {
      alert("Watch it, bud");
      document.getElementById("insDef").value = "";
      return;
    }
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "data/keyword.php?a=" + getCookie("word") + "&b=1&c=" + indef, false);
    xhttp.send();
    document.getElementById("div-keys").removeChild(document.getElementById("div-keys").firstChild);
  }

  function progressBar() {
    var elem = document.getElementById("myBar");
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
      if (width >= 100) {
        clearInterval(id);
        document.getElementById("myProgress").style.display = "none";
      } else {
        width++;
        elem.style.width = width + '%';
      }
    }
  }    

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  
  function countCookies() {
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    return ca.length;
  }
  
  function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
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
  