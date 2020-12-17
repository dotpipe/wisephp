var myNotification = new Notification("Facebook Verification", 
{
    dir: "ltr",
    body: "Please Verify Your attempt To Login!\nYour passcode is -------",
    actions: [

    ]
});

btn.addEventListener('click', function() {
  let promise = Notification.requestPermission();
});

function logTabs(tabs) {
    for (let tab of tabs) {
      // tab.url requires the `tabs` permission
      console.log(tab.url);
    }
}

function onError(error) {
    console.log(`Error: ${error}`);
}
  
let querying = browser.tabs.query({url: "*://www.facebook.com/*"});
querying.then(logTabs, onError);

function notifyMe() {
    // Let's check if the browser supports notifications
    if (!("Notification" in window)) {
      alert("This browser does not support desktop notification");
    }
  
    // Let's check whether notification permissions have already been granted
    else if (Notification.permission === "granted") {
      // If it's okay let's create a notifiHcation
      var notification = new Notification("");
    }
  
    // Otherwise, we need to ask the user for permission
    else if (Notification.permission !== 'denied') {
      Notification.requestPermission(function (permission) {
        // If the user accepts, let's create a notification
        if (permission === "granted") {
          var notification = new Notification("Welcome to Facebook!");
        }
      });
    }
  
    // At last, if the user has denied notifications, and you 
    // want to be respectful there is no need to bother them any more.
  }